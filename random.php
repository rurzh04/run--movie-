<?php						
						$selectRandom = "SELECT * FROM `items` ORDER BY RAND() LIMIT 5";
								if($result = mysqli_query($db, $selectRandom)){
										$allrandom = mysqli_fetch_all($result, MYSQLI_ASSOC);
									}else{
										$error .= "<b>Ошибка запроса в базу:</b> не могу получить список товаров";
								}
								foreach($allrandom as $item){
									include('select.php');
								echo <<<HTML
								<li>
										<a href="/?action=item&id={$item['id']}" title="{$item['itemName']} ({$item['itemGenre']})">
											<img src="../images/{$item['itemMainImg']} " style="height:165px; width:110px;" />
											{$item['itemName']} <br/>
											({$items})
										</a>
									</li>
									
HTML;
									}
?>