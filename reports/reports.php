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
			$(document).ready(function(){  // completely necessary
			// start scripts here
			//start of the variable
			var project={
					datatype: "json",
					dataFields: [
						{name: "pname"},
						{name: "location"},
						{name: "status"},
						{name: "datestarted"},
						{name: "timeperiod"}
					],
					url: "sources/getProject.php",
					async: false
				};
			
			//render
				var renderer = function (id) {
					return '<input type="button" onClick="buttonclick(event)" class="gridButton" id="btn' + id + '" value="Delete Row"/>'
}			//delete function
				var buttonclick = function (event) {
					var id = event.target.id;
						$("#jqxgrid").jqxGrid('deleterow', id);
	}
			//start of grid script
				$("#reports").jqxGrid({// start for the srcipt of the grid view of project list
					source: project,// source of the data used in the grid
					width: "100%",
					height: "70%",
					theme: "humano",// used theme or the design
					/* showtoolbar: true, */
					//editable: true,
					altrows: true,
					selectionmode: "singlerow",
					columns: [
						{text: "item no", dataField: "itemnum", cellsalign: "center", align: "center", width: 150},
						{text: "Description", dataField: "rdes", cellsalign: "center", align: "center", width: 500},
						{text: "Amount", dataField: "ramount", cellsalign: "center", align: "center", width: 100},
						{text: "Total Wt. Percentage", dataField: "totalwtp", cellsalign: "center", align: "center", width: 200},
						{text: "Previous Percent Accomplished", dataField: "prevPaccom", cellsalign: "center",type: "date", align: "center", width: 300},
						{text: "Present Percent Accomplishment", dataField: "presentPacom", cellsalign: "center",align: "center", width: 300},
						{text: "To Date Percentage Accomplishment", dataField: "toDatePaccom", cellsalign: "center",align: "center", width: 300},
						{text: "Previous Weight Percentage", dataField: "prevWeightp", cellsalign: "center",align: "center", width: 300},
						{text: "Present Weight Percentage", dataField: "presWeightp", cellsalign: "center",align: "center", width: 300},
						{text: "Accomplishment Billing", dataField: "acomBiling", cellsalign: "center",align: "center", width: 300},
						{text: 'Delete Row', datafield: 'id', cellsrenderer: renderer },
					]
				});
				
				$("#topMenu").jqxMenu({ width: "100%", height: "64px", theme:"humano", autoOpen:false});
				
				$("#mainSplitter").jqxSplitter({
					width: "100%", 
					height: window.innerHeight-50,
					theme:"humano",
					resizable: false,
					orientation: "vertical",
					panels: [{ size:"15%",collapsible:false  }, 
					{ size: "85%",collapsible: false }] 
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
					<h4>REPORTS<h4>
				</div>
			</div>
		</div>
		<div class = "row no-margin">
			<div class = "col-sm-12">
				<div id = "mainSplitter">
					<!--FIRST PANEL-->
					<div class = "splitter-panel">
						 <div id='jqxMenu'>
							<ul>
								<li><h5>Dashboard</h5>
									<ul>
									<li><h5>Dashboard</h5></li>
									<li><h5>Items</h5></li>
									<li><h5>Contracts1</h5></li>
									<li><h5>Transactions</h5></li>
									<li><h5>Reports</h5></li>
								</ul>
								</li>
								<li><a href="../index.php" class="link">HOME</a></li>
							</ul>
						</div>
					</div>
					<!--SECOND PANEL-->
					<div class = "splitter-panel">
						<div id = "panel">
							<div id = "reports"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
