<?php

$db = mysqli_connect('localhost','root',"","arun");
		$sql="SELECT COUNT(itemName) as count FROM items";
		
		if($result = mysqli_query($db,$sql)){
			$items = mysqli_fetch_row($result);
			echo "<pre>";
				var_dump($items);
			echo "<pre>";
		
		echo $items[0];
		}



?>
