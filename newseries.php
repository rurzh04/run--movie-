<?php
$error  = '';
	$db = mysqli_connect('localhost','root',"","arun");
	
			$selectAllInCategory = "SELECT * FROM `items` WHERE 'сериал' like concat('%',`itemSeries`,'%') ORDER BY id DESC LIMIT 4";
			
			if($result = mysqli_query($db, $selectAllInCategory)){
				$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			}else{
				$error .= "Ошибка: Не удалось получить список всех товаров из категории";
			}
		

			foreach($items as $item){
						 $descr = mb_substr($item['itemCountry'], 0, 10);
						 $descrc = mb_substr($item['itemName'], 0, 18);
						include('select.php');
		echo <<<HTML
							<a href="/?action=item&id={$item['id']}">
							<li class="li_serial">
								<div class="lenta22">
									<div class="edge-left22"></div>
									<div class="cont22">{$descr}</div>
								</div>
								<img src="../images/{$item['itemMainImg']}" />
								<br/>
								{$descrc}<br/>
									{$items}
							</li>
						</a>
HTML;
				}
				


		
?>				


		