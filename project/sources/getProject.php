<?php
	include "../../class/connect.class.php";
	
	$connection = new connection();
	$db = $connection->PDO();
	
	$projects = array();
	//$queryname = $db->query(""); // insert query insice ("")
	$query = $db->query("SELECT * FROM project");
	if($query->rowcount()>0){
	//echo "asd";
		foreach($query as $row){
			$projects[] = array( // array name of the query $project
			
				"pname"=>$row["p_name"],
				"location"=>$row["p_location"],
				//"client"=>$row[""],
				"status"=>$row["p_status"],
				"datestarted"=>$row["p_datestarted"],
				"timeperiod"=>$row["p_timeperiod"],
				
				
			);
		}
		
		echo json_encode($projects);//print $items as json format // ()inside this is the array name of the querry
	}
?>