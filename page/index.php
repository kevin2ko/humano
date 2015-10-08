<?php
include "../class/extension.class.php";
$extension = new includes();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?PHP
			echo $extension->includeCSS();
			echo $extension->includeJS();
		?>
		<script>
			$(document).ready(function(){
				var projects = {
					dataType: "json",
					dataFields: [
						{name: "projId"},
						{name: "projName"},						{name: "location"},						{name: "period"},
						{name: "customer"}
					],
					url: "queries/projectList.php",
					async: false
				}
				
				var projAdapter = new $.jqx.dataAdapter(projects);
				var  p = null;
				$("#projectList").on("rowdoubleclick", function(){
					var row = $("#projectList").jqxGrid("getselectedrowindex");
					var data = $("#projectList").jqxGrid("getrowdata", row);
					p = data.projId;
					$.ajax({
						url: "queries/getProject.php",
						type: "post",
						dataType: "json",
						data: {projId: data.projId},
						success: function(data){
							$("#projectModal").jqxWindow("open");
							$("#projectModal input")[0].value = data.projName;
							$("#projectModal input")[1].value = data.location;
							$("#projectModal input")[2].value = data.customer;
							$("#projectModal input")[3].value = data.price;
							$("#projectModal input")[4].value = data.period;
						}
					});
				});
				
                $("#jqxMenu").jqxMenu({ 
					width: window.innerWidth-2,
					height: "100%",
					theme: "humano"
				});

				$("#mainSplitter").jqxSplitter({
					width: window.innerWidth-2, 
					height: window.innerHeight-40,
					theme:"humano",
					resizable:true,
					orientation: "horizontal",
					panels: [{ size:"60%",collapsible:false  }, 
					{ size: "30%",collapsible: false }] 
				});
				
				$("#projectList").jqxGrid({
					width: "100%",
					height: "100%",
					theme: "humano",
					source: projAdapter,
					showtoolbar: true,
					renderToolbar: function(toolbar) {
						var container = $("<div style='margin: 5px;'></div>");
						var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'>Search : </span>");
						var input = $("<input class='jqx-input jqx-widget-content jqx-rc-all' id='searchField' type='text' placeholder='Search' style='height: 23px; float: left; width: 223px;' />");
						toolbar.append(container);
						container.append(span);
						container.append(input);
						container.append("<button style='margin-left: 5px;' id = 'addProject'>Add Project</button>");
						// container.append("<button style='margin-left: 5px;' id = 'editProject'>Edit Project</button>");
						
						$("#searchField").jqxInput({theme: "humano"});
						$("#addProject").jqxButton({theme: "energyblue"});
						// $("#editProject").jqxButton({theme: "energyblue"});
					},
					columns: [
						{text: "Project ID", dataField: "projId", align: "center", width: 100},
						{text: "Project Name", dataField: "projName", align: "center", width: 300},
						{text: "Location", dataField: "location", align: "center", width: 350},
						{text: "Customer", dataField: "customer", align: "center", width: 350},
						{text: "Time Period (Days)", dataField: "period", align: "center", width: 250},
					]
				});
				
				$("#projectModal").jqxWindow({
					height: 300, width:  550, cancelButton: $("#cancel"), showCloseButton: true, draggable: false, resizable: false, isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#confirm").jqxWindow({
					height: 150, width:  350, cancelButton: $("#cancel2"), showCloseButton: true, draggable: false, resizable: false, isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#addProject").on("click", function(events){
					$("#projectModal").jqxWindow("open");
				});
				
				$("#submit").click(function(){
					$("#confirm").jqxWindow("open");
				});
				
				$("#confirm2").click(function(){
					var data = {
						projName: $("#projName").val(),
						location: $("#location").val(),
						customer: $("#customer").val(),
						contractPrice: $("#contractPrice").val(),
						period: $("#period").val()
					}
					
					$.ajax({
						url: "functions/addProject.php?p="+p,
						type: "post",
						data: data,
						success: function(result){
							if(result == 1){
								$("#confirm").jqxWindow("close");
								$("#projectModal").jqxWindow("close");
								
								projects.url = "queries/projectList.php";
								var projAdapter = new $.jqx.dataAdapter(projects);
								$('#projectList').jqxGrid({source:projAdapter});
							}
						}
					})
				});
			});
		</script>
	</head>

	<body>
		<div id = "jqxMenu">
	<!-- top menu -->
			<ul>
                <li><a href = "../index.php">HOME</a></li>
                <li>LOG OUT</li>
            </ul>
		</div>
		<div id = "mainSplitter">
			<div class = "splitter-panel">
				<div id = "projectList"></div>
			</div>
			<div class = "splitter-panel">
				<div id = ""></div>
			</div>
		</div>
		
		<div id = "projectModal">
			<div>
				<h5>Add New Project<h5>
			</div>
			<div>
				<input type = "text" class = "form-control" id = "projName" placeholder = "Project Name">
				<input type = "text" class = "form-control" id = "location" placeholder = "Location" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "customer" placeholder = "Customer Name" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "contractPrice" placeholder = "Contract Price" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "period" placeholder = "Time Period (Days)" style = "margin-top: 5px;">
				<div class = "col-sm-6">
					<button class = "btn btn-success btn-block" id = "submit" style = "margin-top: 15px;">Submit</button>
				</div>
				<div class = "col-sm-6">
					<button class = "btn btn-danger btn-block" id = "cancel" style = "margin-top: 15px;">Cancel</button>
				</div>
			</div>
		</div>
		
		<div id = "confirm">
			<div>
				<h5>Confirm<h5>
			</div>
			<div>
				<h4 class = "text-center">Submit New Project?</h4>
				<div class = "col-sm-6">
					<button class = "btn btn-success btn-block" id = "confirm2" style = "margin-top: 15px;">Submit</button>
				</div>
				<div class = "col-sm-6">
					<button class = "btn btn-danger btn-block" id = "cancel2" style = "margin-top: 15px;">Cancel</button>
				</div>
			</div>
		</div>
	</body>
</html>