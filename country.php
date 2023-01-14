<?php

	
		
	function getMyresurs($a){
		$db = mysqli_connect('localhost','root',"","arun");
		if($db){
		$selectQuery = "SELECT * FROM `items` WHERE '{$a}' like concat('%',`itemCost`,'%')";
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
	$biografia = isset($_GET['biografia']) ? $_GET['biografia'] : null;
	$boevik = isset($_GET['boevik']) ? $_GET['boevik'] : null;	
	$Netflix = isset($_GET['Netflix']) ? $_GET['Netflix'] : null;
	$link = isset($_GET['link']) ? $_GET['link'] : null;
	$vestern = isset($_GET['vestern']) ? $_GET['vestern'] : null;
	$voennye = isset($_GET['voennye']) ? $_GET['voennye'] : null;	
	$detektiv = isset($_GET['detektiv']) ? $_GET['detektiv'] : null;
	$detskie = isset($_GET['detskie']) ? $_GET['detskie'] : null;
	if($link) getMyresurs('цепи');
	if($biografia) getMyresurs('Биографии');
	if($boevik) getMyresurs('Боевики');
	if($vestern) getMyresurs('Вестерны');
	if($voennye) getMyresurs('Военные');
	if($detektiv) getMyresurs('Детективы');
	if($detskie) getMyresurs('Детские');
	if($Netflix) getMyresurs('Netflix');
	
	$dokumentalnye = isset($_GET['dokumentalnye']) ? $_GET['dokumentalnye'] : null;
	$drama = isset($_GET['drama']) ? $_GET['drama'] : null;	
	$storicheskie = isset($_GET['storicheskie']) ? $_GET['storicheskie'] : null;
	$komedia = isset($_GET['komedia']) ? $_GET['komedia'] : null;
	$kriminal = isset($_GET['kriminal']) ? $_GET['kriminal'] : null;
	$melodrama = isset($_GET['melodrama']) ? $_GET['melodrama'] : null;	
	$multfilmy = isset($_GET['multfilmy']) ? $_GET['multfilmy'] : null;
	$muzikl = isset($_GET['muzikl']) ? $_GET['muzikl'] : null;
	
	if($dokumentalnye) getMyresurs('Докумен-ые');
	if($drama) getMyresurs('Драмы');
	if($storicheskie) getMyresurs('Исторические');
	if($komedia) getMyresurs('Комедия');
	if($kriminal) getMyresurs('Криминал');
	if($melodrama) getMyresurs('Мелодрамы');
	if($multfilmy) getMyresurs('Мультфильмы');
	if($muzikl) getMyresurs('Мюзиклы');
	
	
	$prikluchenia = isset($_GET['prikluchenia']) ? $_GET['prikluchenia'] : null;
	$family = isset($_GET['family']) ? $_GET['family'] : null;	
	$sport = isset($_GET['sport']) ? $_GET['sport'] : null;
	$triller = isset($_GET['triller']) ? $_GET['triller'] : null;
	$uzhasy = isset($_GET['uzhasy']) ? $_GET['uzhasy'] : null;
	$fantastika = isset($_GET['fantastika']) ? $_GET['fantastika'] : null;	
	$fentezi = isset($_GET['fentezi']) ? $_GET['fentezi'] : null;
	$animatedseries = isset($_GET['animatedseries']) ? $_GET['animatedseries'] : null;	
	$multfilmy = isset($_GET['multfilmy']) ? $_GET['multfilmy'] : null;
	$anime = isset($_GET['anime']) ? $_GET['anime'] : null;
	
	
	if($prikluchenia) getMyresurs('Приключения');
	if($family) getMyresurs('Семейные');
	if($sport) getMyresurs('Cпортивные');
	if($triller) getMyresurs('Триллеры');
	if($uzhasy) getMyresurs('Ужасы');
	if($fantastika) getMyresurs('Фантастика');
	if($fentezi) getMyresurs('Фэнтези');
	if($animatedseries) getMyresurs('мультфильм');
	if($multfilmy) getMyresurs('Мультиксериал');
	if($anime) getMyresurs('Аниме');
	
				
	?>