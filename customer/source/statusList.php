<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	$status = Array();
	
	$query = $db->query("SELECT *FROM civil_status");

		foreach($query as $row){
			$status []= array( // array name of the query $project
			
				"civilCode"=>$row["civId"],
				"civilstat"=>$row["civDes"],
				
				
			);
		}
		
		echo json_encode($status);
	
?>