<?php
	include "../../class/connect.class.php";
	
	$connection = new connection();
	$db = $connection->PDO();
	
	//$query = $db->query()							
	//$insert = $db->prepare(insert into tbl_name (column1, column2) values (?, ?))		
	//$insert->execute(array($a, $b))					^--------------------------------
	//$query->rowCount() return how many rows you have									|
	//foreach($query as $row)															|
	//		$row["column1"]; refers	to this ---------------------------------------------
	$items = array();
	$query = $db->query("SELECT * FROM inventory_master JOIN unit_cost USING (iCode)");
	
	if($query->rowcount()>0){
		foreach($query as $row){
			$items[] = array(
			
				"item_id"=>$row["iCode"],
				// "scope_id"=>$row["scopeId"],
				"item_des"=>$row["iDescription"],
				"item_unit"=>$row["iUnit"],
				"item_flag"=>$row["iFlag"],
				"item_Consumable"=>$row["iConsumable"],
				"item_model"=>$row["iModel"],
				"item_serial"=>$row["iSerial"],
				"item_brand"=>$row["brand"],
				// "item_branddes"=>$row["bDescription"],
				"item_amount"=>$row["amount"],
				"item_date"=>$row["dateAcquired"]
				
			);
		}
		
		echo json_encode($items);//print $items as json format
	}
	
?>