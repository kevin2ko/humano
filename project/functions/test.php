<?php
		include "../../class/connect.class.php";
	
	$connect = new connection();
	$db = $connect->PDO();
	
	$q = $db->query("SELECT * FROM items");
						// LEFT OUTER JOIN item_cost b ON a.item_id = b.item_id
							// ORDER BY b.price_date DESC LIMIT 1");
	
	foreach($q as $row){
		$q2 = $db->query("SELECT * FROM item_cost WHERE item_id = ".$row["item_id"]." ORDER BY price_date DESC LIMIT 1");
		foreach($q2 as $row2)
			echo $row["item_des"]." ".$row2["item_cost"]." ".$row2["price_date"]."<br>";
			
	}
?>