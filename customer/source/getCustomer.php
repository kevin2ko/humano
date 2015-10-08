<?php
	include "../../class/connect.class.php";
	
	$connection = new connection();
	$db = $connection->PDO();
	
	$customer = array();
	//$queryname = $db->query(""); // insert query insice ("")
	// $query = $db->query("SELECT * FROM applicants JOIN civil_status USING(civId)");
	$query = $db->query("SELECT * FROM applicants");
	
	if($query->rowcount()>0){
		foreach($query as $row){
			$customer[] = array( // array name of the query $project
			
				"name"=>$row["appName"],
				"address"=>$row["address"],
				"contact"=>$row["contact"],
				"dob"=>$row["dob"],
				"civilstat"=>$row["civilstatus"],
				// "civilstat"=>$row["civDes"],
				// "civilCode"=>$row["civId"]
				
				
				
			);
		}
		
		echo json_encode($customer);//print $items as json format // ()inside this is the array name of the querry
	}
?>