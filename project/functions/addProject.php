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
			$days = $_POST["days"];
			
			$insert = $db->prepare("INSERT INTO projects (pDescription, pLocation, pContractPrice, pWorkingDays, pStatus) VALUES (?, ?, ?, ?, ?)");
			$insert->execute(array($projName, $location, $price, $days, 1));
			
			$lastId = $db->lastInsertId();
			$insert2 = $db->prepare("INSERT INTO applicants (appId, appName) VALUES (?, ?)");
			$insert2->execute(array($lastId, $customer));
			
			echo 1;
		}
	}
	else{
		$projName = strtoupper($_POST["projName"]);
		$location = strtoupper($_POST["location"]);
		$price = $_POST["contractPrice"];
		$days = $_POST["days"];
		$p = $_GET["p"];
		
		$update = $db->prepare("UPDATE projects SET pDescription = ?, pLocation = ?, pContractPrice = ?, pWorkingDays = ? WHERE pid = ?");
		$update->execute(array($projName, $location, $price, $days, $p));
		
		echo 1;
	}
?>