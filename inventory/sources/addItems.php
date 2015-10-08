<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	if(isset($_GET["i"]) && $_GET["i"] == "null"){
		if(isset($_POST["item_unit"])){
			$unit = strtoupper($_POST["item_unit"]);
			$des = strtoupper($_POST["item_des"]);
			$brand = strtoupper($_POST["item_brand"]);
			$model = strtoupper($_POST["item_model"]);
			$serial = strtoupper($_POST["item_serial"]);
			$date = $_POST["item_date"];
			$amount = $_POST["item_amount"];
			
			$insert = $db->prepare("INSERT INTO inventory_master (iUnit, iDescription, brand, iModel, iSerial) VALUES (?, ?, ?, ?, ?)");
			$insert->execute(array($unit, $des, $brand, $model, $serial));
			
			$lastId = $db->lastInsertId();
			$insert2 = $db->prepare("INSERT INTO unit_cost (iCode,dateAcquired,amount ) VALUES (?, ?, ?)");
			$insert2->execute(array($lastId, $date, $amount));
			
			echo 1;
		}
	}
	else{
		$unit = strtoupper($_POST["item_unit"]);
		$des = strtoupper($_POST["item_des"]);
		$brand = strtoupper($_POST["item_brand"]);
		$model = strtoupper($_POST["item_model"]);
		$serial = strtoupper($_POST["item_serial"]);
		$date = $_POST["item_date"];
		$amount = $_POST["item_amount"];
		$i = $_GET["i"];
		
		$update = $db->prepare("UPDATE inventory_master SET iUnit = ?,iDescription = ?,brand = ?, iModel = ?, iSerial = ? WHERE iCode = ? LIMIT 1");
		$update->execute(array($unit, $des, $brand, $model, $serial, $i));
		
		$update2 = $db->prepare("UPDATE unit_cost SET dateAcquired = ?, amount =? WHERE iCode = ? LIMIT 1");
		$update2->execute(array($date, $amount, $i));
		
		echo 1;
	}
?>