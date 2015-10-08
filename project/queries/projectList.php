<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	$list = Array();
	
	$query = $db->query("SELECT * FROM projects JOIN applicants USING (appId) WHERE pStatus = '1'");
	
	if($query->rowCount() > 0){
		foreach($query as $row){
	 		$list[] = array("projId" => strtoupper($row["pid"]),
							"projName" => strtoupper($row["pDescription"]),
							"location" => strtoupper($row["pLocation"]),
							"days" => $row["pWorkingDays"],
							"customer" => $row["appName"]);
		}
		
		echo json_encode($list);
	}
?>