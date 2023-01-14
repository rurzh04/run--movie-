<?php
				
	function getMyresur($a){
		$db = mysqli_connect('localhost','root',"","arun");
		if($db){
		$selectQuery = "SELECT * FROM `items` WHERE itemSeries='{$a}'  ORDER BY id DESC LIMIT 5";
	 	if($result = mysqli_query($db, $selectQuery)){
			
			$allQuery = mysqli_fetch_all($result, MYSQLI_ASSOC);
			foreach($allQuery as $item){
						include('nambe.php');
				}
				
		}else{
			echo "Ошибка не могу получить данные";
		}
	}else{
		echo "нет подключень база данных";
	}
		}
	$cinema = isset($_GET['cinema']) ? $_GET['cinema'] : null;
	$series = isset($_GET['series']) ? $_GET['series'] : null;	
	if($cinema) getMyresur('кино');
	if($series) getMyresur('Сериал');
	
	
?>	


	
			