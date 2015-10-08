<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	//$list = Array();
	
	$query = $db->query("SELECT *FROM applicants");
	
	if(isset($_POST["projId"])){
		$p_id = $_POST["projId"];
		$query = $db->query("SELECT * FROM applicants WHERE appId = '$p_id'");z
		foreach($query as $row){
			$list = array("projId" => strtoupper($row["pid"]),
							"projName" => strtoupper($row["pDescription"]),
							"location" => strtoupper($row["pLocation"]),
							"days" => $row["pWorkingDays"],
							"price" => $row["pContractPrice"],
							"customer" => $row["appName"]);
		}
		
		echo json_encode($list);
	}
?>