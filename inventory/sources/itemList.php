<?php
	include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	//$list = Array();
	
	$query = $db->query("SELECT *FROM inventory_master JOIN unit_cost USING (iCode)");
	
	if(isset($_POST["item_id"])){
		$it_id = $_POST["item_id"];
		$query = $db->query("SELECT *FROM inventory_master JOIN unit_cost USING (iCode) WHERE iCode = '$it_id'");
		// echo "$itemc";
		foreach($query as $row){
			$list = array(
							"l_unit" => strtoupper($row["iUnit"]),
							"l_des" => strtoupper($row["iDescription"]),
							"l_brand" => strtoupper($row["brand"]),
							"l_model" => strtoupper($row["iModel"]),
							"l_serial" => strtoupper($row["iSerial"]),
							"l_date" => $row["dateAcquired"],
							"l_amount" => $row["amount"],
							"item_id" => strtoupper($row["iCode"])// i put the itemc here because in the editing it always goes at the top
							);
		}

		echo json_encode($list);
	}
?>