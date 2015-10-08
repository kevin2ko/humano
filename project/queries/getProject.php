<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	//$list = Array();
	
	$query = $db->query("SELECT *FROM projects WHERE pStatus = '1'");
	
	if(isset($_POST["projId"])){
		$p_id = $_POST["projId"];
		$query = $db->query("SELECT * FROM projects JOIN applicants USING (appId) WHERE pid = '$p_id'");
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