<?php
$error  = '';
	$db = mysqli_connect('localhost','root',"","arun");
	
			$selectAllInCategory = "SELECT * FROM `items` WHERE '1' like concat('%',`itemGenre`,'%') ORDER BY id DESC LIMIT 2";
			
			if($result = mysqli_query($db, $selectAllInCategory)){
				$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			}else{
				$error .= "Ошибка: Не удалось получить список всех товаров из категории";
			}
		

			foreach($items as $item){
						 $descr = mb_substr($item['itemDescription'], 0, 45);
	
		echo <<<HTML
			<li class="li_block ">
								<div class="li_block_title">
									<a href="/?action=item&id={$item['id']}" style="color:#ffffff;">
										<img src="../images/{$item['itemMainImg']} " style="width:100px;" align="left" alt="{$item['itemName']}" />
										{$item['itemName']}
									</a>
								</div>
									<div class="blockstory" style="color:#e0dfdc;">
										{$descr}...
									</div>
							</li>	
HTML;
				}
				

		
?>				


		