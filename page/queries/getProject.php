<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	//$list = Array();
	
	$query = $db->query("SELECT *FROM project WHERE p_status = '1'");
	
	if(isset($_POST["projId"])){
		$p_id = $_POST["projId"];
		$query = $db->query("SELECT *FROM project JOIN customer USING (p_id) WHERE p_id = '$p_id'");
		foreach($query as $row){
			$list = array("projId" => strtoupper($row["p_id"]),
							"projName" => strtoupper($row["p_name"]),
							"location" => strtoupper($row["p_location"]),
							"period" => $row["p_timeperiod"],
							"price" => $row["p_contractprice"],
							"customer" => $row["c_name"]);
		}
		
		echo json_encode($list);
	}
?>