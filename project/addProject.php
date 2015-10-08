<?php
include "../class/extension.class.php";
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
				form { 
					margin: 5 auto; 
					width:500px;
					border: 3px solid black;
					padding: 25px;
					
					}
		</style>
		<script>
		
				var data = [
				{firstname: "Andrew", lastname: "Fuller", productname: "Black Tea", quantity: "2", price: "2.5", total: "5"},
				{firstname: "Nancy", lastname: "Davolio", productname: "Green Tea", quantity: "1", price: "3", total: "3"},
				{firstname: "Shelley", lastname: "Burke", productname: "Caffe Espresso", quantity: "3", price: "1.5", total: "4.5"},
				{firstname: "Regina", lastname: "Murphy", productname: "Doubleshot Espresso", quantity: "3", price: "3", total: "9"},
				{firstname: "Yoshi", lastname: "Nagase", productname: "Caffe Latte", quantity: "4", price: "3", total: "12"},
				{firstname: "Antoni", lastname: "Saavedra", productname: "White Chocolate Mocha", quantity: "3", price: "2", total: "6"},
				{firstname: "Mayumi", lastname: "Ohno", productname: "Cramel Latte", quantity: "3", price: "1", total: "3"},
				{firstname: "Ian", lastname: "Devling", productname: "Caffe Americano", quantity: "2", price: "3", total: "6"},
				{firstname: "Peter", lastname: "Wilson", productname: "Cappuccino", quantity: "5", price: "4", total: "20"}, 
				{firstname: "Lars", lastname: "Peterson", productname: "Espresso Truffle", quantity: "1", price: "2", total: "2"}
			];
			
			var source = {
				localdata: data,
				datatype: "json"
				// datafields: [
					// {name: "firstname"},
					// {name: "lastname"},
					// {name: "productname"},
					// {name: "quantity"},
					// {name: "price"},
					// {name: "total"}
				// ],
				//url: list.php,
				//async: false
			};
			
			var dataAdapter = new $.jqx.dataAdapter(source);
				$("#jqxWidget").jqxDropDownList({ checkboxes: true, source: dataAdapter, displayMember: "firstname", valueMember: "firstname", width: 200, height: 25});
               // $("#select1in").jqxDropDownList('checkIndex', 0);
			   $("#topMenu").jqxMenu({ 
					width: window.innerWidth-2,
					height: "32px",
					theme: "humano"
				});
		</script>
	</head>
	<body>
		<div id = "topMenu">
		<!-- top menu -->
			<ul>
                <li><a href = "../index.php">HOME</a></li>
                <li>LOG OUT</li>
            </ul>
		</div>
	
		 
			<label>Project Title:</label>
				<input type = "text" name = "projectTitle" class = "form-control">
			<label>Location:</label>
				<input type = "text" name = "projectLocation" class = "form-control">
			<label>Client:</label>
				<input type = "text" name = "projectClient" class = "form-control">
			<label>Time Period:</label>
				<input type = "text" name = "projectTime" class = "form-control">
			<div style='float: left;' id='jqxWidget'>
            </div>
				<input type = "submit" name = "addProject" value = "Add Project" class = "btn btn-primary">
				
		
	</body>
</html>