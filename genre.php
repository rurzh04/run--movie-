<?php


	
	function getMyresurs($a){
		$db = mysqli_connect('localhost','root',"","arun");
		if($db){
		$selectQuery = "SELECT * FROM `items` WHERE '{$a}' like concat('%',`itemCountry`,'%')";
	 	if($result = mysqli_query($db, $selectQuery)){
			
			$allQuerys = mysqli_fetch_all($result, MYSQLI_ASSOC);
			foreach($allQuerys as $item){
					include('nambe.php');
				}
				
		}else{
			echo "Ошибка не могу получить данные";
		}
	}else{
		echo "нет подключень база данных";
	}
		}
	$american = isset($_GET['american']) ? $_GET['american'] : null;
	$turkish = isset($_GET['turkish']) ? $_GET['turkish'] : null;	
	$russian = isset($_GET['russian']) ? $_GET['russian'] : null;
	$serialy = isset($_GET['serialy']) ? $_GET['serialy'] : null;
	$zarubezhnyeserialy = isset($_GET['zarubezhnyeserialy']) ? $_GET['zarubezhnyeserialy'] : null;
	
	if($american) getMyresurs('США');
	if($turkish) getMyresurs('Турецки');
	if($russian) getMyresurs('россия');
	if($serialy) getMyresurs('Сериал');
	if($zarubezhnyeserialy) getMyresurs('Зарубежные');
	
	
	
	
	?>