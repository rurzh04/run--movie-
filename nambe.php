<?php	

		$date = date("d.m.Y", $item['addDate']);
include('select.php');


							echo <<<HTML
								<div class="shortstory">
										<div class="shortstorytitle">
											<h2 class="zagolovki">
												<a href="/?action=item&id={$item['id']}" style="font-weight:700;">{$item['itemName']}</a>
											</h2>
											<div class="izbrannoe">
											<form method="POST" action="">
												<input type="submit" name="addToCart" class="addToCart" value="S" />
											</form>
											</div>
										</div>
									<div class="shortimg">
										<a href="/?action=item&id={$item['id']}">
											<div class="shortimga" style="width: 33%;">
												<img src="../images/{$item['itemMainImg']}" style="width: 120%;height: 100%;"/>
											</div>
										</a>
										<div class="shortp">
											<div style="padding-top:7px; font-size:14px;">
												<b style="color:#a8a8a8;">Год выпуска : <a href="/?action=item&id={$item['id']}"> {$items}</a></b>
													<a href="/?action=item&id={$item['id']}">
HTML;
						
									echo <<<HTML
											</a>
												<br>
												<b style="color:#a8a8a8; ">Страна :</b>
												<a href="/?action=item&id={$item['id']}">{$item['itemCountry']}</a>
												<br>
												<b style="color:#a8a8a8;">Жанр :</b>
												<a href="/?action=item&id={$item['id']}">{$item['itemCost']}</a>
												<br>
												<b style="color:#a8a8a8;">Продолжительность: </b>
												<a href="/?action=item&id={$item['id']}"> {$item['itemTime']}</a>
												<br>
												<br>
												<br>
												<br>
												<br>
												<br>
												<b style="color:#a8a8a8;">Качество  :  4k/1080/480/240</b>
												<br>
												<b style="color:#a8a8a8;">Оценка  : 10/{$item['itemRaisal']}</b>
												<br>
												<br>
												<br>
												<br>
												<br>
												<b style="color:#a8a8a8;">{$item['itemDescription']}</b>
											</div>
											
										</div>
										
										<div class="icons">
											<span class="podrobnee" style="padding: 6px 0 4px 0px;">
												<a href="/?action=item&id={$item['id']}" style="text-decoration: none; ">
													<b >Смотреть сейчас</b>
												</a>
												<span class="smotr"><span class="glyphicon glyphicon-eye-open"><span class="smotra">91241</span></span></span>
												<span class="smotr"><span class="glyphicon glyphicon-thumbs-up"><span class="smotra">500</span></span></span>
											</span>
											<span class="glyphicon glyphicon-time " style="padding: 10px 10px 4px 20px;"><span class="watch">{$date}</span></span>
										</div>
										
										
									</div>
								</div>
HTML;

?>
						
						