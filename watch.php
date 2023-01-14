<?php
	$kinoid =  trim($item['id']);
		if($_POST['addToCart']){
		
		$user_id = $_COOKIE['id'];
		$film_id = $item['id'];
		
		$selectQueryDB ="INSERT INTO `viewlater` (user_id, film_id) VALUES('{$user_id}', '{$film_id}')";
								
					
				if(mysqli_query($db, $selectQueryDB)){
						
				}else{
							$content .= "Ошибка <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
					}
						
   
	}
?>
						<div class="dle-content">
							<div class="contentdle">
								<div class="shortstory">
										<div class="shortstorytitle">
											<h2 class="zagolovki">
												<a href="/" style="font-weight:700;"><?=$item['itemName']?></a>
											</h2>
											<div class="izbrannoe">
											<form method="POST" action="">
												<input type="submit" name="addToCart" class="addToCart" value="S" />
											</form>
											</div>
										</div>
									<div class="shortimg">
											<div class="shortimga">
												<img src="../images/<?=$item['itemMainImg']?>" style="width: 120%;height: 100%;" />
											</div>
										<div class="shortp">
											<div style="padding-top:7px; font-size:14px;">
												<b style="color:#a8a8a8;">Год выпуска:</b>
												<b style="color:#a8a8a8;"><?=$items?></b>
												<br>
												<b style="color:#a8a8a8; ">Страна:</b>
												<b style="color:#a8a8a8;"><?=$item['itemCountry']?></b>
												<br>
												<b style="color:#a8a8a8;">Жанр:</b>
												<b style="color:#a8a8a8;"><?=$item['itemCost']?></b>
												<br>
												<b style="color:#a8a8a8;">Продолжительность:  </b>
												<b style="color:#a8a8a8;"><?=$item['itemTime']?></b>
												
												
												<br>
												<br>
												<b style="color:#e0dfdc;">Описане:  </b>
												<b style="color:#a8a8a8;"><?=$item['itemDescription']?></b>
												<br>
												<br>
												<br>
											</div>
											
										</div>
										
										<div class="icons">
											<span class="podrobnee" style="padding: 6px 0 4px 0px;">
													<b >Смотреть сейчас</b>
												<span class="smotr"><span class="glyphicon glyphicon-eye-open"><span class="smotra">91241</span></span></span>
											<a href="#">
											<span class="smotr"><span class="glyphicon glyphicon-thumbs-up"><span class="smotra">500
											</span></span></span>
											</a>
											</span>
											<span class="glyphicon glyphicon-time"><span class="watch"><?=date("d.m.Y", $item['addDate'])?></span></span>
										</div>
										
										
									</div>
								</div>
							</div>
						</div>
						<div class="dle-content">
							<div class="contentdle">
								<div class="shortstorvideo">
										<div class="shortstorytitle">
											<h2 class="namevideo">
											cмотреть онлайн <?=$item['itemName']?>   в хорошем качестве:
											</h2>
										</div>
									<div class="videonum">
										<iframe src="<?=$item['itemMainVideo']?>" width="640" height="480" frameborder="0" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						<div class="relatednews_title">
							<i>
							Рекомендуем посмотреть
							</i>
						</div>
							<div class="relatednews">
								<ul class="ul_related">
								<?php
								include('random.php');
								?>
								</ul>
							</div>
							<div id="dle-comment-list">
							<div style="clear:both;"></div>
								<div style="padding: 20px; border-left: 1px solid #404040; float: left;">

								
										<button class="fbutton5zhs"  style="background-color:#383838; border:1px solid #383838;" value="click" onmousedown="viewDiv()">
			<span id="loginmydiv">Добавить комментарий</span>
			<div id="displaynik">
			<p>
																<?php
	if($_SERVER['REQUEST_METHOD'] === "POST"){
	
	$trust ='';
			if(empty($_POST['commName']) OR strlen($_POST['commName']) < 3) $trust .= "Не заполнина поле <b>Никнейм</b> или меньше 3 букв <br/>";
			if(empty($_POST['commDescription']) OR strlen($_POST['commDescription']) > 25) $trust .= "Не заполнина <b>комментария</b> поле или меньше 15 букв <br/>";
			
			if(empty($trust)){
			$addDate = mktime();
			$commName = trim($_POST['commName']);
			$commDescription = trim($_POST['commDescription']);
			

			
			$insertQuery ="INSERT INTO `commentary` (addDate, commName, commDescription, kinoid) VALUES('{$addDate}', '{$commName}', '{$commDescription}','{$kinoid}')";
			
			if($result = mysqli_query($db, $insertQuery)){
				
				echo  "перезагрузите сайт чтобы снова добавить комментария";
				}else{
				echo  "Ошибка Комментария не добавлен.Информация для отладки: <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
			}
		}else{
			 echo "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
			 echo $trust;
		}
	}else{
		$userd = $_COOKIE['log'];
	echo  <<<HTML
	<style>
	.commName{
		width:400px;
		text-align: center;
		border: 3px solid #767676;
	}
	.textarea{
		background-color:#585858;
		width:400px;
		height:200px;
		border: 2px solid #767676;
    border-radius: 10px;
	}
	.namesubmit{
		background-color:#585858;
		margin-top:10px;
	}
	
	</style>
	
	<form method="POST" action="">
	<input type="text" name="commName" class="commName" placeholder="никнейм" value="{$userd}" readonly /><br/>
	<textarea class="textarea" name="commDescription"  placeholder="Комментария"></textarea></br>
	<input type="submit" class="namesubmit" value="Добавить кино" />
		</form>		
	
HTML;
	}


		

?>		
			</p>
			</div>	
			</button>
							

								</div>
								
											<div class="poloska_comment"></div>
												
		<?php
			
			$selectAllItems = "SELECT * FROM `commentary`  WHERE kinoid='{$kinoid}' LIMIT 5";
			if($result = mysqli_query($db, $selectAllItems)){	
						$sitem = mysqli_fetch_all($result, MYSQLI_ASSOC);
						
			}
						foreach($sitem as $sitem){
							 $descr = mb_substr($sitem['itemDecsriptions'], 0, 25);
							#$date = date("d.m.Y", $item['addDate']);
									echo <<<HTML
									<div class="newitem" style="border-left:0px solid #404040; overflow: auto;">
											<div style="float:left;">
												<div class="commentimg" style="position:relative;">
													<img src="../images/avatar.png" />
												</div>
											</div>
												
											<div class="commennnnty">
												<b style="text-shadow: 1px 1px rgb(0 0 0);">
													<a href="#">{$sitem['commName']}</a>
												</b>
												<br/>
												<br/>
												<div class="comentarii">
													<div class="comment-id-dog">
														{$sitem['commDescription']}
													</div>
												</div>
											</div>
										</div>
											<div class="poloska_comment"></div>
HTML;
						}
			?>
											
								</div>
								
					