<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	if(isset($_GET["c"]) && $_GET["c"] == "null"){
		if(isset($_POST["name"])){
			$name = strtoupper($_POST["name"]);
			$address = strtoupper($_POST["address"]);
			$contact = strtoupper($_POST["contact"]);
			$dob = strtoupper($_POST["dob"]);
			$civilstat = strtoupper($_POST["civilstat"]);
			// $civilid = strtoupper($_POST["civilCode"]);
			
			$insert = $db->prepare("INSERT INTO applicants (appName, address, contact, dob, civilstatus) VALUES (?, ?, ?, ?, ?)");
			$insert->execute(array($name, $address, $contact, $dob, $civilstat));

			
			echo 1;
		}
	}
	else{
		$name = strtoupper($_POST["name"]);
		$address = strtoupper($_POST["address"]);
		$contact = strtoupper($_POST["contact"]);
		$dob = strtoupper($_POST["dob"]);
		$c = $_GET["c"];
		
		$update = $db->prepare("UPDATE applicants SET appName = ?,address = ?, contact = ?, dob = ?,WHERE appId = ?");
		$update->execute(array($name, $address, $contact, $dob, $c));

		echo 1;
	}
?>