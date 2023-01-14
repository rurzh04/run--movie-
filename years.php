<?php	
	function getMyresurs($a){
		$db = mysqli_connect('localhost','root',"","arun");
		if($db){
		$selectAllInCategory = "SELECT * FROM `items` WHERE itemGenre='{$a}' ORDER BY id DESC";
			if($result = mysqli_query($db, $selectAllInCategory)){
			
			$allQuerys = mysqli_fetch_all($result, MYSQLI_ASSOC);
			if($allQuerys){
			foreach($allQuerys as $item){
						include('nambe.php');
			}
			}else{
				echo "<h1>ничего нету</h1>";
			}
				
		}else{
			echo "Ошибка не могу получить данные";
		}
	}else{
		echo "нет подключень база данных";
	}
		}

	$years23 = isset($_GET['years23']) ? $_GET['years23'] : null;
	$years22 = isset($_GET['years22']) ? $_GET['years22'] : null;	
	$years21 = isset($_GET['years21']) ? $_GET['years21'] : null;
	$years20 = isset($_GET['years20']) ? $_GET['years20'] : null;
	$years19 = isset($_GET['years19']) ? $_GET['years19'] : null;
	
	if($years23) getMyresurs('23');
	if($years22) getMyresurs('22');
	if($years21) getMyresurs('21');
	if($years20) getMyresurs('20');
	if($years19) getMyresurs('19');
	
	
	
	
?>