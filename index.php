<!DOCTYPE HTML>
<?php
include "class/extension.class.php";
$extension = new includes();
?>
<html>
	<head>
	<?PHP
			echo $extension->includeCSS();
			echo $extension->includeJS();
		?>
		<title>HUMANO</title>
		<style>
			body{
				background-color: #202020;
			}
			
			.no-margin {
				margin: 0 !important;
			}

			.no-padding {
				padding: 0 !important;
			}

			.row {
				margin: 0 !important;
			}
		</style>
		<script>
			$(document).ready(function(){
				$("#grid").jqxGrid({//change to main page pictures
					width: "100%",
					height: "100%",
					theme: "humano",
					//columns: [
						//{ text: "ITEM CODE", datafield: "item_code", align: "center", width: 200},
						//{ text: "DESCRIPTION", datafield: "description", align: "center", width: 400},
						//{ text: "UNIT", datafield: "unit", align: "center", width: 100},
						//{ text: "UNIT COST", datafield: "unit_cost", align: "center", width: 200},
					
					//]
				});
				
				$("#calendar").jqxCalendar({
					width: 220,
					height: 220,
					theme: "humano"});
				
				$("#topMenu").jqxMenu({ width: "100%", height: "32px", theme:"humano", autoOpen:false});
				
				$("#mainSplitter").jqxSplitter({
					width: "100%", 
					height: window.innerHeight-50,
					theme:"humano",
					resizable: false,
					orientation: "vertical",
					panels: [
					{ size:"20%",collapsible:false  }, 
					{ size: "80%",collapsible: false },
					
					] 
				});
				
				$("#jqxMenu").jqxMenu({ width: '100%', height: '100%', mode: 'vertical', theme: "humano"});
				$("#panel").jqxPanel({ width: '100%', height: '100%', theme: "humano"});
			});
		</script>
	</head>
	
	<body>
		<div class = "row no-margin">
			<div class = "col-sm-12">
				<div id = "topMenu" style = "margin-bottom: 5px;">
					<h4>HUMANO - Construction & Supply<h4>
				</div>
			</div>
		</div>
		<div class = "row no-margin">
			<div class = "col-sm-12">
				<div id = "mainSplitter">
					<!--FIRST PANEL-->
					<div class = "splitter-panel">
						 <div id='jqxMenu'>
						 <div id='calendar'>
									</div>
							<ul>
								<!--<li><h5>Admin</h5>
									<ul>
									<li><h5><a href="project/addProject.php" class="link">Add Projects</a></h5></li>
									<li><h5>Items</h5></li>
									<li><h5>Contracts1</h5></li>
									<li><h5>Transactions</h5></li>
									<li><h5>Reports</h5></li>
								</ul>
								</li> not yet ready-->
								<li><h5><a href="inventory/inventory.php" class="link">Inventory</a></h5></li>
								<li><h5><a href="project/project.php" class="link">Projects</a></h5></li>
								<li><h5><a href="customer/customer.php" class="link">Customers</a></h5></li>
								<li><h5>Transactions</h5></li>
								<li><h5>Reports</h5></li>
							</ul>
						</div>
					</div>
					<!--SECOND PANEL-->
					<div class = "splitter-panel">
						<div id = "panel">
							<div id = "grid"></div>
								
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</body>
</html>