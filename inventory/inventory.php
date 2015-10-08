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
		<title id='Description'>Inventory</title>
		<script>
			$(document).ready(function(){
				// Create a jqxMenu
                
				
				var items={
					datatype: "json",
					dataFields: [
						{name: "item_id"},
						{name: "item_des"},
						{name: "item_unit"},
						{name: "item_flag"},
						{name: "item_consumable"},
						{name: "item_model"},
						{name: "item_amount"},
						{name: "item_brand"},
						{name: "item_date"},
						{name: "item_serial"}
					],
					url: "sources/getItems.php",
					async: false
				};
				
				
				
				// $("#item_grid").on(function(){ //edit function
					// var row = $("#item_grid").jqxGrid("getselectedrowindex"); // gets row index from project list table example from $(#projectList)
					// var data = $("#item_grid").jqxGrid("getrowdata", row);// and this gets the data
					// i = data.item_id; // stores data.projId |projId is appended to data|
					// $.ajax({
						// url: "sources/itemlist.php", // query used to display the data to be edited or GET
						// type: "post",
						// dataType: "json",
						// data: {item_id: data.item_id},
						
						// success: function(data){
							
							// $("#itemModal").jqxWindow("open");// opens the modal menu to start the editing 
															// NOTE: use the same modal properties as adding because its just the same
							// $("#itemModal input")[0].value = data.l_unit;// use the variable declared from itemList.php
							// $("#itemModal input")[1].value = data.l_des;
							          // $("#itemModal input")[2].value = data.item_flag;
										// $("#itemModal input")[3].value = data.item_consumable;
							// $("#itemModal input")[2].value = data.l_model;
							// $("#itemModal input")[3].value = data.l_serial;
							// $("#itemModal input")[4].value = data.l_date;
							// $("#itemModal input")[5].value = data.l_amount;
							
						// }
					// });
				// });
			
				$("#jqxMenu").jqxMenu({ 
				width: "100%",
				theme: "humano",
				height: '30px'
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
				
				$("#item_grid").jqxGrid({
					source: items,
					width: "100%",
					height: 500,
					theme: "humano",
					sortable: true,
					showtoolbar: true,
					//editable: true,
					altrows: true,
					selectionmode: "singlerow",
					//pageable: true,
					//pagerMode: 'advanced',
					showtoolbar: true,
					renderToolbar: function(toolbar) {
						var container = $("<div style='margin: 5px;'></div>");
						var span = $("");
						var input = $("");
						toolbar.append(container);
						container.append(span);
						container.append(input);
						container.append("<button style='margin-left: 5px;' id = 'addItem'>Add item</button>");
						// container.append("<button style='margin-left: 5px;' id = 'upPrice'>Update Price</button>");
						
						$("#addItem").jqxButton({theme: "humano"});
						// $("#upPrice").jqxButton({theme: "humano"});
				
					},
					
					columns: [
						// {text: "QTY", dataField: "item_model", cellsalign: "center", align: "center", width: "10%"},
						{text: "Unit", dataField: "item_unit", cellsalign: "center", align: "center", width: "10%"},
						{text: "Description", dataField: "item_des", cellsalign: "center", align: "center", width: "30%"},
						{text: "Manufacturer/Brand", dataField: "item_brand", cellsalign: "center", align: "center", width: "10%"},
						{text: "Model", dataField: "item_model", cellsalign: "center", align: "center", width: "15%"},
						{text: "Serial No.", dataField: "item_serial", cellsalign: "center", align: "center", width: "15%"},
						{text: "date Acquired", dataField: "item_date", cellsalign: "center", align: "center", width: "10%"},
						{text: "Unit Price", dataField: "item_amount", cellsalign: "center", align: "center", width: "10%"},
						
						]
					});
			
		
				$("#itemModal").jqxWindow({
					height: 300, width:  550, cancelButton: $("#cancel"), 
					showCloseButton: true, draggable: false, resizable: false, 
					isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
					});
				
				$("#confirm").jqxWindow({
					height: 150, width:  350, cancelButton: $("#cancel2"), showCloseButton: true, draggable: false, resizable: false, isModal: true, autoOpen: false, modalOpacity: 0.50,theme:'humano'
					});
				
				$("#addItem").on("click", function(events){
					i = null;
					// $("#QTY").val(""); // the data fields is used here
					$("#item_unit").val(""); // the data fields is used here
					$("#item_des").val(""); // the data fields is used here
					$("#item_brand").val(""); // the data fields is used here
					$("#item_model").val("");
					$("#item_serial").val("");
					$("#item_date").jqxWindow("open");
					$("#item_amount").jqxWindow("open");
					$("#itemModal").jqxWindow("open");
				});
				
				$("#submit").click(function(){
					$("#confirm").jqxWindow("open");
				});
				
				$("#confirm2").click(function(){
					var data = {
						// qty: $("#qty").val(),
						item_unit: $("#item_unit").val(),
						item_des: $("#item_des").val(),
						item_brand: $("#item_brand").val(),
						item_model: $("#item_model").val(),
						item_serial: $("#item_serial").val(),
						item_date: $("#item_date").val(),
						item_amount: $("#item_amount").val(),
						
					}
					
					$.ajax({
						url: "sources/addItems.php?i="+i,
						type: "post",
						data: data,
						success: function(result){
							if(result == 1){
								$("#confirm").jqxWindow("close");
								$("#itemModal").jqxWindow("close");
								//refresh
								item.url = "sources/getItems.php";
								var itemAdapter = new $.jqx.dataAdapter(items);
								$('#item_grid').jqxGrid({source:itemAdapter});
							}
						}
					})
				});
				var itemAdapter = new $.jqx.dataAdapter(items);
				var  i = null; //
				$("#item_grid").on("rowdoubleclick", function(){ //edit function
					var row = $("#item_grid").jqxGrid("getselectedrowindex"); // gets row index from project list table example from $(#projectList)
					var data = $("#item_grid").jqxGrid("getrowdata", row);// and this gets the data
					i = data.item_id; // stores data.projId |projId is appended to data|
					$.ajax({
						url: "sources/itemlist.php", // query used to display the data to be edited or GET
						type: "post",
						dataType: "json",
						data: {item_id: data.item_id},
						
						success: function(data){
							
							$("#itemModal").jqxWindow("open");// opens the modal menu to start the editing 
															// NOTE: use the same modal properties as adding because its just the same
							$("#itemModal input")[0].value = data.l_unit;// use the variable declared from itemList.php
							$("#itemModal input")[1].value = data.l_des;
							$("#itemModal input")[2].value = data.l_brand;
							// $("#itemModal input")[2].value = data.item_flag;
							// $("#itemModal input")[3].value = data.item_consumable;
							$("#itemModal input")[3].value = data.l_model;
							$("#itemModal input")[4].value = data.l_serial;
							$("#itemModal input")[5].value = data.l_date;
							$("#itemModal input")[6].value = data.l_amount;
							
						}
					});
				});
            });    
		</script>
	</head>

	<body>
		<div id='jqxMenu'>
			<ul>
                <li><a href="../index.php" class="link">HOME</a></li>
                <li>LOG OUT</li>
            </ul>
		</div>
		
		<div id = "mainSplitter">
			<div class = "splitter-panel"><!--up split-->
				<div id = "item_grid"></div>
			</div>
			<div class = "splitter-panel"><!--down split-->
				<div id = ""></div>
			</div>
		</div>
		
		<div id = "itemModal">
			<div>
				<h5>Add New item<h5>
			</div>
			<div>
				<input type = "text" class = "form-control" id = "item_unit" placeholder = "Item Unit">
				<input type = "text" class = "form-control" id = "item_des" placeholder = "Item Name">
				<input type = "text" class = "form-control" id = "item_brand" placeholder = "Item Brand">
				<input type = "text" class = "form-control" id = "item_model" placeholder = "item model" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "item_serial" placeholder = "item serial" style = "margin-top: 5px;">
				<input type = "date" class = "form-control" id = "item_date" placeholder = "date acquired" style = "margin-top: 5px;">
				<input type = "text" class = "form-control" id = "item_amount" placeholder = "unit price" style = "margin-top: 5px;">
				
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
				<h4 class = "text-center">Submit New item?</h4>
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