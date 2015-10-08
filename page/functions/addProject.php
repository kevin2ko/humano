<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	if(isset($_GET["p"]) && $_GET["p"] == "null"){
		if(isset($_POST["projName"])){
			$projName = strtoupper($_POST["projName"]);
			$location = strtoupper($_POST["location"]);
			$customer = strtoupper($_POST["customer"]);
			$price = $_POST["contractPrice"];
			$period = $_POST["period"];
			
			$insert = $db->prepare("INSERT INTO project (p_name, p_location, p_contractprice, p_timeperiod, p_status) VALUES (?, ?, ?, ?, ?)");
			$insert->execute(array($projName, $location, $price, $period, 1));
			
			$lastId = $db->lastInsertId();
			$insert2 = $db->prepare("INSERT INTO customer (p_id, c_name) VALUES (?, ?)");
			$insert2->execute(array($lastId, $customer));
			
			echo 1;
		}
	}
	else{
		$projName = strtoupper($_POST["projName"]);
		$location = strtoupper($_POST["location"]);
		$customer = strtoupper($_POST["customer"]);
		$price = $_POST["contractPrice"];
		$period = $_POST["period"];
		$p = $_GET["p"];
		
		$update = $db->prepare("UPDATE project SET p_name = ?, p_location = ?, p_contractprice = ?, p_timeperiod = ? WHERE p_id = ?");
		$update->execute(array($projName, $location, $price, $period, $p));
		
		$update2 = $db->prepare("UPDATE customer SET c_name = ? WHERE p_id = ?");
		$update2->execute(array($customer, $p));
		
		echo 1;
	}
?>