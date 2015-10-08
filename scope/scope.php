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
				$("#jqxMenu").jqxMenu({ 
					width: window.innerWidth-2,
					height: "100%",
					theme: "humano"
				});

				$("#scopeSplitter").jqxSplitter({
					width: window.innerWidth-2, 
					height: window.innerHeight-40,
					theme:"humano",
					resizable:true,
					orientation: "horizontal",
					panels: [{ size:"60%",collapsible:false  }, 
					{ size: "30%",collapsible: false }] 
				});
				
				$("#scopeList").jqxGrid({
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
						container.append("<button style='margin-left: 5px;' id = 'addScope'>Add Project</button>");
						$("#addScope").jqxButton({theme: "energyblue"});
						
					},
					columns: [
						{text: "Project ID", dataField: "projId", align: "center", width: 100},
						{text: "Project Name", dataField: "projName", align: "center", width: 300},
						
					]
				});
				
				$("#scopeModal").jqxWindow({
					height: 300, width:  550, cancelButton: $("#cancel"),
					showCloseButton: true, draggable: false, resizable: false,
					isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#projectModal").jqxWindow({
					height: 300, width:  550, cancelButton: $("#cancel"),
					showCloseButton: true, draggable: false, resizable: false,
					isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#confirm").jqxWindow({
					height: 150, width:  350, cancelButton: $("#cancel2"), showCloseButton: true, draggable: false, resizable: false, isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#addProject").on("click", function(events){
					p = null;
					$("#projName").val("");
					$("#location").val("");
					$("#customer").val("");
					$("#contractPrice").val("");
					$("#days").val("");
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
						days: $("#days").val()
					}
					
					$.ajax({
						url: "functions/addProject.php?p="+p,
						type: "post",
						data: data,
						success: function(result){
							if(result == 1){
								$("#confirm").jqxWindow("close");
								$("#projectModal").jqxWindow("close");
								//refresh
								projects.url = "queries/projectList.php";
								var projAdapter = new $.jqx.dataAdapter(projects);
								$('#projectList').jqxGrid({source:projAdapter});
							}
						}
					})
				});
			});
		</script>
	<body>
	
	</body>
</html>