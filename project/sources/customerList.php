<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	$list = Array();
	
	$query = $db->query("SELECT *FROM applicants");

		foreach($query as $row){
			$list []= array( // array name of the query $project
			
				"customer"=>$row["appName"],
				"customerId"=>$row["appId"],
				
				
			);
		}
		
		echo json_encode($list);
	
?>