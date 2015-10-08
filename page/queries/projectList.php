<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	$list = Array();
	
	$query = $db->query("SELECT *FROM project JOIN customer USING (p_id) WHERE p_status = '1'");
	
	if($query->rowCount() > 0){
		foreach($query as $row){
			$list[] = array("projId" => strtoupper($row["p_id"]),
							"projName" => strtoupper($row["p_name"]),
							"location" => strtoupper($row["p_location"]),
							"period" => $row["p_timeperiod"],
							"customer" => $row["c_name"]);
		}
		
		echo json_encode($list);
	}
?>