<?php
include "../class/extension.class.php";
$extension = new includes();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<?PHP
			echo $extension->includeCSS();
			echo $extension->includeJS();
		?>
		<script>
			$(document).ready(function(){
			// Create a jqxMenu
               $("#jqxMenu").jqxMenu({ 
					width: "100%",
					height: "15%",
					theme: "humano"
				});
			var customer={
					datatype: "json",
					dataFields: [
						{name: "name"},
						{name: "address"},
						{name: "contact"},
						{name: "dob"},
						{name: "civilstat"}
						
					],
					url: "source/getCustomer.php",
					async: false
				};
				var custAdapter = new $.jqx.dataAdapter(customer);
				var  c = null;
				
				$("#customerg").on("rowdoubleclick", function(){ //edit function
					var row = $("#customerg").jqxGrid("getselectedrowindex"); // gets row index from project list table example from $(#customerg)
					var data = $("#customerg").jqxGrid("getrowdata", row);// and this gets the data
					p = data.custId; // stores data.projId |projId is appended to data|
					$.ajax({
						url: "", //not yet made
						type: "post",
						dataType: "json",
						data: {projId: data.custId},
						success: function(data){
							$("#projectModal").jqxWindow("open");
							$("#projectModal input")[0].value = data.name;
							$("#projectModal input")[1].value = data.address;
							$("#projectModal input")[2].value = data.contact;
							$("#projectModal input")[3].value = data.dob;
							$("#projectModal input")[4].value = data.civilstat;
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
				
				$("#customerg").jqxGrid({
					source: customer,
					width: "100%",
					height: "100%",
					showtoolbar: true,
					renderToolbar: function(toolbar) {
						var container = $("<div style='margin: 5px;'></div>");
						var span = $("");
						var input = $("");
						toolbar.append(container);
						container.append(span);
						container.append(input);
						container.append("<button style='margin-left: 5px;' id = 'addcustomer'>Add Customer</button>");
						
						
						
						$("#addcustomer").jqxButton({theme: "humano"});
				
					},
					theme: "humano",
					columns: [
						{ text: "Name", datafield: "name", align: "center", width: "20%"},
						{ text: "Address", datafield: "address", align: "center", width: "25%"},
						{ text: "Contact Number", datafield: "contact", align: "center", width: "20%"},
						{ text: "Date Of Birth", datafield: "dob", align: "center", width: "20%"},
						{ text: "Civil Status", datafield: "civilstat", align: "center", width: "15%"},
					]
				});
				$("#custModal").jqxWindow({
					height: 300, width:  550, cancelButton: $("#cancel"),
					showCloseButton: true, draggable: false, resizable: false,
					isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#confirm").jqxWindow({
					height: 150, width:  350, cancelButton: $("#cancel2"), showCloseButton: true, draggable: false, resizable: false, isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
				});
				
				$("#addcustomer").on("click", function(events){
					c = null;
					$("#name").val("");
					$("#address").val("");
					$("#contact").val("");
					$("#dob").val("");
					$("#civilstat").val("");
					$("#custModal").jqxWindow("open");
					
				});
				
				$("#submit").click(function(){
					$("#confirm").jqxWindow("open");
				});
				
				$("#confirm2").click(function(){
					var data = {
						name: $("#name").val(),
						address: $("#address").val(),
						contact: $("#contact").val(),
						dob: $("#dob").val(),
						civilstat: $("#civilstat").val(),
					}
					
				$.ajax({
						url: "query/addCustomer.php?c="+c,
						type: "post",
						data: data,
						success: function(result){
							if(result == 1){
								$("#confirm").jqxWindow("close");
								$("#custModal").jqxWindow("close");
								//refresh
								customer.url = "queries/getCustomer.php";
								var custAdapter = new $.jqx.dataAdapter(customer);
								$('#customerg').jqxGrid({source:custAdapter});
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
			<div class = "splitter-panel"><!--up split-->
				<div id = "customerg"></div>
			</div>
			<div class = "splitter-panel"><!--down split-->
				<div id = ""></div>
			</div>
		</div>
		
		<div id = "custModal">
			<div>
				<h5>Add New Customer<h5>
			</div>
			<div>
				<input type = "text" class = "form-control" id = "name" placeholder = "Customer Name">
				<input type = "text" class = "form-control" id = "address" placeholder = "Customer Address" style = "margin-top: 5px;">
				<input type = "number" class = "form-control" id = "contact" placeholder = "Contact Number" style = "margin-top: 5px;">
				Date of Birth<br>
				<input type = "date" class = "form-control" id = "dob" placeholder = "Date of Birth" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "civilstat" placeholder = "Civil Status" style = "margin-top: 5px;">
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
				<h4 class = "text-center">Submit New custect?</h4>
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