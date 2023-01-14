<?php
	$db = mysqli_connect('localhost','root',"","arun");
	$userId= $_COOKIE['id'];
	$selectQuery = "SELECT * FROM viewlater LEFT JOIN items ON viewlater.film_id=items.id 
	WHERE viewlater.user_id='{$userId}'";
		
	if($result = mysqli_query($db,$selectQuery)){
		$item = mysqli_fetch_all($result,MYSQLI_ASSOC);
		
	
		foreach($item as $item){
			include('nambe.php');
		}
		
	}else{
		echo "что не так в select";
	}
?>