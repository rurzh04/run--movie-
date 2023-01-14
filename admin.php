<?php
	$title = "";
	$action = $_GET['action'];
	$act_title = "";
	$content = "";
	$searchan = "";

	include('select.php');
	include('function.php');
	
	$db = mysqli_connect('localhost','root',"","arun");
		
	
	if($db){
	if($action == "addnewitem"){
		$title = "Добавить кино";
		$act_title = "Добавление нового  на сайт";
		
		if($_SERVER['REQUEST_METHOD'] === "POST"){
			
		
			$trust ='';
			if(empty($_POST['itemName']) OR strlen($_POST['itemName']) < 3) $trust .= "Не заполнина поле <b>Имя</b> или меньше 3 букв <br/>";
			if(empty($_POST['itemCountry']) OR strlen($_POST['itemCountry']) < 5) $trust .= "Не заполнина <b>Страна</b> поле или меньше 5 букв <br/>";
			if(empty($_POST['itemDescription']) OR strlen($_POST['itemDescription']) < 15) $trust .= "Не заполнина <b>Описание</b> поле или меньше 15 букв <br/>";
			if(empty($_POST['itemGenre'])) $trust .= "Не выбран <b>Жанр</b> фильма <br/>";
			if(empty($_POST['itemCost'])) $trust .= "не выбран <b>Год</b> выпуска <br/>";
			if(empty($_POST['itemRaisal'])) $trust .= "Не выбран <b>Оценка</b> на фильм <br/>";
			if(empty($_FILES['itemMainImg']['name'])) $trust .="<b>Изображение</b> не загружон или не выбран";
			if($_FILES['itemMainImg']['name'] AND $_FILES['itemMainImg']['size'] > 10000000) $trust .="Ошибка: <b>Изображение не иожет содержат больше 5мб</b>  <br/>";
			if(!empty($_FILES['itemMainImg']['error'])) $trust .="<b>Изображение</b> не возможно";
			//if($_FILES['itemMainImg']['type'] !== 'images/png' or $_FILES['itemMainImg']['type'] !== 'images/jpg' or $_FILES['itemMainImg']['type'] !== 'images/jpeg' or $_FILES['itemMainImg']['type'] !== 'images/gif') $trust .="<b>Изображение</b> содержит только png/jpg/jpeg/gif";
			if(empty($_POST['itemMainVideo']) OR strlen($_POST['itemMainVideo']) < 3) $trust .= "Не заполнина поле <b>видио</b><br/>";
			if(empty($_POST['itemSeries'])) $trust .= "напишите пожалуста кино или сериал";
			if(empty($_POST['itemTime'])) $trust .= "напишите Продолжительность фильма";
		if(empty($trust)){
		$uploadedFile = dirname(__FILE__)."/images/";
		$mainImg = mktime()."_".$_FILES['itemMainImg']['name'];
		move_uploaded_file($_FILES['itemMainImg']['tmp_name'], $uploadedFile.$mainImg);
			
			
			$addDate = mktime();
			$itemName = trim($_POST['itemName']);
			$itemCountry = trim($_POST['itemCountry']);
			$itemDescription = trim($_POST['itemDescription']);
			$itemGenre = trim($_POST['itemGenre']);
			$itemCost = trim($_POST['itemCost']);
			$itemRaisal = trim($_POST['itemRaisal']);
			$itemMainVideo = trim($_POST['itemMainVideo']);
			$itemSeries = trim($_POST['itemSeries']);
			$itemTime = trim($_POST['itemTime']);
			
			$insertQuery ="INSERT INTO `items` (addDate, itemName, itemCountry, itemDescription, itemGenre, itemCost, itemRaisal,itemMainImg,itemMainVideo, itemSeries,itemTime) VALUES('{$addDate}', '{$itemName}', '{$itemCountry}', '{$itemDescription}', '{$itemGenre}', '{$itemCost}', '{$itemRaisal},', '{$mainImg}', '{$itemMainVideo}', '{$itemSeries}','{$itemTime}')";
			

			if(mysqli_query($db, $insertQuery)){
				$content .= "Кино добавлен, <a href='admin.php?action=allitems'>вернуться списку кино</a>";
			}else{
				$content .= "Ошибка Кино не добавлен.Информация для отладки: <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
			}
		}else{
			$content .= "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
			$content .= $trust;
		}
		}else{		
		$content .= <<<HTML
		<form method="POST" action="" enctype="multipart/form-data">
		<div class="imginput">
			<center><span class="imgclass">200 x 300</span></center>
		</div>
		<input type="text" name="itemName" class="itemName" placeholder="Название" /><br/>
		<textarea  name="itemDescription" class="itemDescription" placeholder="опишите кино"></textarea></br></br>
		<input type="text" name="itemTime" class="itemTime" placeholder="Продолжительность" /><br/>
		<input type="text" name="itemCountry" class="itemCost" placeholder="страна" /><br/>
		<input type="text" name="itemCost" class="itemCost" style="margin-top: -11px;" placeholder="Жанр" /><br/>
		<input type="number" name="itemRaisal" class="itemRaisal" placeholder="оценка" /><br/>
	
		
		
		<input type="text" name="itemMainVideo" class="itemMainVideo" placeholder="Укажите ссылку на кино" /><br/>
		<input type="text" name="itemSeries" class="itemSeries"  placeholder="Укажите сериал или кино" /><br/>

		<input type="file"  class="itemMainImg" name="itemMainImg" />
		<input type="submit" class="submit" value="Добавить кино" />
				<select name="itemGenre" class="itemGenre" multiple>
	
HTML;
		$content .= displayallCategory();
	$content .= <<<HTML
		</select><br/>
		</form>
HTML;
		}
	}elseif($action == "deleteitem"){
		$title = "Удаление кино";
		$act_title = "Удалить кино";
		$itemId = (int) $_GET['id'];
		
		if($itemId){
			if($_SERVER['REQUEST_METHOD'] == "POST" AND $_POST['like'] == 'yes'){
				$deleteQuery = "DELETE FROM `items` WHERE id='{$itemId}'";
				
				if(mysqli_query($db, $deleteQuery)){
					if(mysqli_affected_rows($db)){
						$content .= "Кино удалень  <a href='/admin.php?action=allitems'>вернуться назад</a>";
					}else{
						$content .= "Такой кино  нет в базе";
					}
				}else{
					$content .= "<b>Ошибка</b> не удалось удалить кино";
				}
			}else{
				$content .= <<<HTML
					<form method="POST" action="">
						<input type="hidden" name="like" value="yes" />
						<input type="submit" value="Потвердить удаление" />	
					</form>
HTML;
			}
		}else{
			$content .= "<b>Ошибка</b> не указан ID";
		}
		
	
	}elseif($action == "edititem"){
		$title = "Редактирование";
		$act_title = "Редактирование кино на сайт";
		$itemId = (int) $_GET['id'];
			
			if($itemId){
					$selectQuery = "SELECT * FROM `items` WHERE id='{$itemId}'";
		
		if($result = mysqli_query($db, $selectQuery)){
			$item = mysqli_fetch_assoc($result);
		
			if($item){	
				if($_SERVER['REQUEST_METHOD'] === "POST"){
				$trust ='';
			if(empty($_POST['itemName']) OR strlen($_POST['itemName'] > 3)) $trust .= "Не заполнина поле <b>Имя</b> или меньше 3 букв <br/>";
			if(empty($_POST['itemCountry']) OR strlen($_POST['itemCountry'] > 5)) $trust .= "Не заполнина <b>Страна</b> поле или меньше 5 букв <br/>";
			if(empty($_POST['itemDescription']) OR strlen($_POST['itemDescription'] > 15)) $trust .= "Не заполнина <b>Описание</b> поле или меньше 15 букв <br/>";
			if(empty($_POST['itemGenre'])) $trust .= "Не выбран <b>Год</b> фильма <br/>";
			if(empty($_POST['itemCost'])) $trust .= "не выбран <b>Жано</b> выпуска <br/>";
			if(empty($_POST['itemRaisal'])) $trust .= "Не выбран <b>Оценка</b> на фильм <br/>";
			if(empty($_FILES['itemMainImg']['name'])) $trust .="<b>Изображение</b> не загружон или не выбран";
			if($_FILES['itemMainImg']['name'] AND $_FILES['itemMainImg']['size'] > 10000000) $trust .="Ошибка: <b>Изображение не иожет содержат больше 5мб</b>  <br/>";
			if(!empty($_FILES['itemMainImg']['error'])) $trust .="<b>Изображение</b> не возможно";
			//if($_FILES['itemMainImg']['type'] !== 'images/png' or $_FILES['itemMainImg']['type'] !== 'images/jpg' or $_FILES['itemMainImg']['type'] !== 'images/jpeg' or $_FILES['itemMainImg']['type'] !== 'images/gif') $trust .="<b>Изображение</b> содержит только png/jpg/jpeg/gif";
			if(empty($_POST['itemMainVideo']) OR strlen($_POST['itemMainVideo']) < 3) $trust .= "Не заполнина поле <b>видио</b><br/>";
			if(empty($_POST['itemSeries'])) $trust .= "напишите пожалуста кино или сериал";
			if(empty($_POST['itemTime'])) $trust .= "напишите Продолжительность фильма";
				
			$uploadedFile = dirname(__FILE__)."/images/";
				$mainImg = mktime()."_".$_FILES['itemMainImg']['name'];
				move_uploaded_file($_FILES['itemMainImg']['tmp_name'], $uploadedFile.$mainImg);
				
			if(empty($trust)){
			$itemName = trim($_POST['itemName']);
			$itemCountry = trim($_POST['itemCountry']);
			$itemDescription = trim($_POST['itemDescription']);
			$itemGenre = trim($_POST['itemGenre']);
			$itemCost = trim($_POST['itemCost']);
			$itemRaisal = trim($_POST['itemRaisal']);
			$itemMainVideo = trim($_POST['itemMainVideo']);
			$itemSeries = trim($_POST['itemSeries']);
			$itemTime = trim($_POST['itemTime']);
				$updateQuery = "UPDATE 	`items` SET
				itemName='{$itemName}'
				,itemMainVideo = '{$itemMainVideo}'
				,itemCountry='{$itemCountry}'
				,itemDescription='{$itemDescription}'
				,itemGenre='{$itemGenre}'
				,itemCost='{$itemCost}'
				,itemRaisal='{$itemRaisal}'
				,itemSeries='{$itemSeries}'
				,itemTime='{$itemTime}'";
				if($mainImg) $updateQuery.=", itemMainImg='{$mainImg}'";
				
				$updateQuery .= "WHERE id='{$itemId}'";
				if(mysqli_query($db, $updateQuery)){
					$content .= "Данные сохранены <a href='admin.php?action=allitems'>спсиок всех кино</a>";
				}else{
				$content .= "Ошибка Не удалось выполнить изменине товара.Информация для отладки: <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
					
			}
			}else{
							$content .= "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
							$content .= $trust;
							
				}
				}else{
				$content .= <<<HTML
		<form method="POST" action="" enctype="multipart/form-data">
		<div class="imginput" style="background-color:#3D4952; border:none;">
			<img src="/images/{$item['itemMainImg']}" style="max-width:100%;"/>
		</div>
		<input type="text" name="itemName" class="itemName"  value="{$item['itemName']}" placeholder="Название" /><br/>
		<textarea  name="itemDescription" class="itemDescription"  placeholder="опишите кино">{$item['itemDescription']}</textarea></br></br>
			<input type="text" name="itemTime" class="itemTime" value="{$item['itemTime']}" placeholder="Продолжительность" /><br/>
		<input type="text" name="itemCountry" class="itemCost"  value="{$item['itemCountry']}" placeholder="страна" /><br/>
		<input type="text" name="itemCost" class="itemCost" value="{$item['itemCost']}" style="margin-top: -11px;" placeholder="Жанр" /><br/>
		<input type="number" name="itemRaisal" class="itemRaisal" value="{$item['itemRaisal']}" placeholder="оценка" /><br/>
	
		
		
		<input type="text" name="itemMainVideo" class="itemMainVideo" value="{$item['itemMainVideo']}" placeholder="Укажите ссылку на кино" /><br/>
		<input type="text" name="itemSeries" class="itemSeries" value="{$item['itemSeries']}" placeholder="Укажите сериал или кино" /><br/>

		<input type="file"  class="itemMainImg" name="itemMainImg" />
		<input type="submit" class="submit" value="Добавить кино" />
		<select name="itemGenre" class="itemGenre" >
	
HTML;
		$content .= displayallCategory($item['itemCategory']);
	$content .= <<<HTML
		</select><br/>
		</form>
HTML;
	
			}
			}else{
				$content .= "Товар с таким айди нету";
			
		}}else{
				$content .= "Вы не указали ID редоктирование";
			}}
	}elseif($action == "topitem"){
		$title = " посещаемость сайта";
		$act_title = " посещаемость сайта";
		
		
		/*Все фильмы*/
		$selectCount = "SELECT COUNT(itemName) as count FROM `items`";
		$result = mysqli_query($db,$selectCount);
			$items = mysqli_fetch_row($result);
		/*Все комментария*/
		$selectCountcomm = "SELECT COUNT(commName) as count FROM `commentary`";
		$resultcom = mysqli_query($db,$selectCountcomm);
			$itemcom = mysqli_fetch_row($resultcom);
		
		$content .= <<<HTML

				<div id="topadmin">
				<div class="topadmin">
		<div class="admintophow">
		<div clas="topnames">посещаемость сайта</div>
		<div class="howadminumber">0</div>
		</div>
			<div class="navigadmin">
			<center>
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
				</svg>
		   </center>
			</div>
		</div>
		<div class="topadmin">
		<div class="admintophow">
		<div clas="topnames">все фильмы сайта</div>
		<div class="howadminumber">{$items[0]}</div>
		</div>
			<div class="navigadmin">
			<center>
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-collection-play-fill" viewBox="0 0 16 16">
  <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z"/>
</svg>
		   </center>
			</div>
		</div>
		<div class="topadmin">
		<div class="admintophow">
		<div clas="topnames">комментария сайта</div>
		<div class="howadminumber">{$itemcom[0]}</div>
		</div>
			<div class="navigadmin">
			<center>
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
  <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg>
		   </center>
			</div>
		</div>
		<div class="topadmin">
		<div class="admintophow">
		<div clas="topnames">max фильмы сайта</div>
		<div class="howadminumber">1000</div>
		</div>
			<div class="navigadmin">
			<center>
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-collection-play-fill" viewBox="0 0 16 16">
  <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z"/>
</svg>
		   </center>
			</div>
			</div>
	</div>
		<div id="menutopadmin">
					<div class="topmenuadmin">
						<div class="icontepmenu">
							<div class="tepmenuname">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
							  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
							</svg>
							<p style="float:right; margin-left:5px;">Топ фильмов</p>
							</div>
						</div>
						<div class="topfilm">
						
HTML;

						$selectop = "SELECT * FROM  `items` WHERE itemRaisal='9'  LIMIT 5";
						if($resultop= mysqli_query($db, $selectop)){
							$itemtop = mysqli_fetch_all($resultop, MYSQLI_ASSOC);
						}
						foreach($itemtop as $item){
						$content .= <<<HTML
			
								<div class="topfilmcl">
									<div class="topname">
										<div class="nametopfilm">
											<div class="filmname"><span >{$item[id]}</span></div>
											<div class="filmnamenew"><span>{$item[itemName]}</span></div>
										</div>
									
									</div>
										<div class="filmringt">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
											</svg>
											<div class="filmiconname">{$item['itemRaisal']}/10</div>
										</div>
								</div>
								
HTML;
						}

				$content .= <<<HTML
						</div>
					</div>
					<div class="topmenuadmin">
					<div class="icontepmenu">
							<div class="tepmenuname">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" fill="currentColor" class="bi bi-collection-play-fill" viewBox="0 0 16 16">
  <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z"/>
</svg>
							<p style="float:right; margin-left:5px;">Последные фильмы</p>
							</div>
						</div>
						<div class="topfilm">
HTML;
						
						$selecnew = "SELECT * FROM  `items` ORDER BY id DESC LIMIT 5 ";
						if($resulnew= mysqli_query($db, $selecnew)){
							$itemnew = mysqli_fetch_all($resulnew, MYSQLI_ASSOC);
						}
						foreach($itemnew as $item){
				$content .= <<<HTML
								<div class="topfilmcl">
									<div class="topname">
										<div class="nametopfilm">
											<div class="filmname"><span >{$item['id']}</span></div>
											<div class="filmnamenew"><span>{$item['itemName']}</span></div>
										</div>
									
									</div>
										<div class="filmringt">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
											  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
											</svg>
											<div class="filmiconname">{$item['itemRaisal']}/10</div>
										</div>
												</div>
								
HTML;
						}

		$content .= <<<HTML
								</div>
					</div>
					<div class="topmenuadmin">
					<div class="icontepmenu">
							<div class="tepmenuname">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg>
							<p style="float:right; margin-left:5px;">Последные комментария</p>
							</div>
						</div>
						<div class="topfilm">
HTML;
						
						$seleccomm = "SELECT * FROM  `commentary` ORDER BY id DESC LIMIT 5 ";
						if($resulcomm= mysqli_query($db, $seleccomm)){
							$itemcomm = mysqli_fetch_all($resulcomm, MYSQLI_ASSOC);
						}
						foreach($itemcomm as $item){
							
				$content .= <<<HTML
				
						<div class="topfilmcl">
									<div class="topname">
										<div class="nametopfilm">
											<div class="filmname"><span >322</span></div>
											<div class="filmnamenew"><span>ssdasdsa</span></div>
										</div>
									
									</div>
										<div class="filmringt">
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg>
											
										</div>
								</div>
								
HTML;
						}		
	$content .= <<<HTML
								</div>
					</div>
					<div class="topmenuadmin">
					<div class="icontepmenu">
							<div class="tepmenuname">
							<svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" fill="currentColor" class="bi bi-tv" viewBox="0 0 16 16">
  <path d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM13.991 3l.024.001a1.46 1.46 0 0 1 .538.143.757.757 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.464 1.464 0 0 1-.143.538.758.758 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.464 1.464 0 0 1-.538-.143.758.758 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.46 1.46 0 0 1 .143-.538.758.758 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3h11.991zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
</svg>
							<p style="float:right; margin-left:5px;">Сериалы</p>
							</div>
						</div>
						<div class="topfilm">
HTML;

						$selectseries = "SELECT * FROM  `items` WHERE itemSeries='Сериал'  LIMIT 5";
						if($resulseries= mysqli_query($db, $selectseries)){
							$itemseries = mysqli_fetch_all($resulseries, MYSQLI_ASSOC);
						}
						foreach($itemseries as $item){
						$content .= <<<HTML
						<div class="topfilmcl">
									<div class="topname">
										<div class="nametopfilm">
											<div class="filmname"><span >{$item['id']}</span></div>
											<div class="filmnamenew"><span>{$item['itemName']}</span></div>
										</div>
									
									</div>
										<div class="filmringt">
														<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tv" viewBox="0 0 16 16">
  <path d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM13.991 3l.024.001a1.46 1.46 0 0 1 .538.143.757.757 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.464 1.464 0 0 1-.143.538.758.758 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.464 1.464 0 0 1-.538-.143.758.758 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.46 1.46 0 0 1 .143-.538.758.758 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3h11.991zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
</svg>
											<div class="filmiconname">{$item['itemRaisal']}/10</div>
										</div>
								</div>
HTML;
						}
	$content .= <<<HTML
								</div>
					</div>
			</div>
	
	
HTML;
	
		
	}elseif($action == "allitems"){
		$title = "Список всех кино";
		$act_title = "Список всех кино на сайт";
		
		$selectQuery = "SELECT * FROM `items`";
		
		if($result = mysqli_query($db, $selectQuery)){
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			
			
		$content .= <<<HTML
		<style>
		.admintitle span{
			float:left;
		}
			th{
			text-align:center;
			background-color:#313942; 
		
		}
		.itemtd{
			text-align:center;
			padding:3px;
			background-color:#313942; 
		}
		.item-action{
			text-align:center;
			font-size:18px;
		}
		.tr-content:hover{
			background-color:#464646;
		}
		.search_panel{
			background-color:#464646;	
			margin-right:15px;
		}
		.search_panel input[type=submit] {
			font-size:23px;
		float: right;
		height:40px;
		margin-top: -48px;
		background-color: #262E37;
		color:#A8A8A8;
}
		.search_panel input[type=text] {
	background-color:#4B5B6B;
	border:1px solid #4B5B6B;
	font-size:20px;
}
		</style>
	
			<table border="1px" bodercolor="#cecece" style="width:100%;">
HTML;
			$content .= <<<HTML
								<div class="tradmin">
				<tr>
				<th>ID</th>
				<th>Имя</th>
				<th>оценка</th>
				<th>Жанр</th>
				<th>страна</th>
				<th>год</th>
				<th>Действие</th>
				</tr>
				</div>
HTML;
$searchan .= <<<HTML
			<div class="search_panel" style="float:right;">
	
	  <form  method="POST" action="?action=search"  id="searchform"> 
      <input  type="text" name="search" required /> 
      <input  type="submit" name="submit" value="поиск" /> 
    </form> 
	</div>
			
HTML;

		if(!empty($items)){ //если не пуста будеть следущий
				foreach($items as $item){
					include('select.php');
						$content .= <<<HTML
						
						<tr class='tr-content'>
						<td class='itemtd'>{$item['id']}</td>
						<td class='itemtd'>{$item['itemName']}</td>
						<td class='itemtd'>{$item['itemRaisal']}</td>
						<td class='itemtd'>{$item['itemCost']}</td>
						<td class='itemtd'>{$item['itemCountry']}</td>
						<td class='itemtd'>{$items}</td>
						<td class='itemtd item-action'>
							<a href='/admin.php?action=edititem&id={$item['id']}'>
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
								  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
								</svg>
							</a>
							<a href='/admin.php?action=deleteitem&id={$item['id']}'>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
							  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
							</svg>
							</a>
						</td>
						</tr>
HTML;
				}		
		}else{
			$content .= "Базе нет кино";
		}
		
				$content .= <<<HTML
				</table>
HTML;
		}else{
			$content .="<b>Ошибка:</b> Не удалось выполнить задачу все кино из базы данных";
		}
		

	}elseif($action == "allnews"){
		$title = "список ожидающих фильмов";
		$act_title = "фильма который ожидають";
		
		$selectQuery = "SELECT * FROM `items` WHERE '1' like concat('%',`itemGenre`,'%')";
		
		if($result = mysqli_query($db, $selectQuery)){
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			
			
		$content .= <<<HTML
		<style>
		th{
			text-align:center;
			background-color:#313942; 
		
		}
		.itemtd{
			text-align:center;
			padding:3px;
			background-color:#313942; 
		}
		.item-action{
			text-align:center;
			font-size:18px;
		}
		.tr-content:hover{
			background-color:#464646;
		}
		</style>
	
			<table border="1px" bodercolor="#cecece" style="width:100%;">
HTML;
			$content .= <<<HTML
				<div class="tradmin">
				<tr>
				<th>ID</th>
				<th>Имя</th>
				<th>оценка</th>
				<th>Жанр</th>
				<th>страна</th>
				<th>год</th>
				<th>Действие</th>
				</tr>
				</div>
HTML;

		if(!empty($items)){ //если не пуста будеть следущий еще не готов редактор
				foreach($items as $item){
					include('select.php');
						$content .= <<<HTML
								<tr class='tr-content'>
						<td class='itemtd'>{$item['id']}</td>
						<td class='itemtd'>{$item['itemName']}</td>
						<td class='itemtd'>{$item['itemRaisal']}</td>
						<td class='itemtd'>{$item['itemCost']}</td>
						<td class='itemtd'>{$item['itemCountry']}</td>
						<td class='itemtd'>{$items}</td>
						<td class='itemtd item-action'>
						<a href='/admin.php?action=editsoon&id={$item['id']}'>
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
								  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
								</svg>
						</a>
							<a href='/admin.php?action=editsoon&id={$item['id']}'>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
							  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
							</svg>
							</a>
						</td>
						</tr>
						
						
HTML;
				}		
		}else{
			$content .= "Базе нет кино";
		}
		
				$content .= <<<HTML
				</table>
HTML;
		}else{
			$content .="<b>Ошибка:</b> Не удалось выполнить задачу все кино из базы данных";
		}
	}elseif($action == "allnow"){
		$title = "сериалы";
		$act_title = "сериалы";
		$selectQuery = "SELECT * FROM `items` WHERE 'Сериал' like concat('%',`itemSeries`,'%')";
		
		if($result = mysqli_query($db, $selectQuery)){
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			
			
		$content .= <<<HTML
		<style>
		th{
			text-align:center;
			background-color:#313942; 
		
		}
		.itemtd{
			text-align:center;
			padding:3px;
			background-color:#313942; 
		}
		.item-action{
			text-align:center;
			font-size:18px;
		}
		.tr-content:hover{
			background-color:#464646;
		}
		</style>
	
			<table border="1px" bodercolor="#cecece" style="width:100%;">
HTML;
			$content .= <<<HTML
				<div class="tradmin">
				<tr>
				<th>ID</th>
				<th>Имя</th>
				<th>оценка</th>
				<th>Жанр</th>
				<th>страна</th>
				<th>год</th>
				<th>Действие</th>
				</tr>
				</div>
HTML;

			if(!empty($items)){ //если не пуста будеть следущий
				foreach($items as $item){
					include('select.php');
						$content .= <<<HTML
								<tr class='tr-content'>
						<td class='itemtd'>{$item['id']}</td>
						<td class='itemtd'>{$item['itemName']}</td>
						<td class='itemtd'>{$item['itemRaisal']}</td>
						<td class='itemtd'>{$item['itemCost']}</td>
						<td class='itemtd'>{$item['itemCountry']}</td>
						<td class='itemtd'>{$items}</td>
						<td class='itemtd item-action'>
						<a href='/admin.php?action=edititem&id={$item['id']}'>
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
								  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
								</svg>
							</a>
							<a href='/admin.php?action=deleteitem&id={$item['id']}'>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
							  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
							</svg>
							</a>
						</td>
						</tr>
						
						
HTML;

				}		
		}else{
			$content .= "Базе нет кино";
		}
		
				$content .= <<<HTML
				</table>
HTML;
		}else{
			$content .="<b>Ошибка:</b> Не удалось выполнить задачу все кино из базы данных";
		}
	}elseif($action == "search"){
		
	include('searchadmin.php');
	}elseif($action == "comment"){
		$title = "все комментария";
		$act_title = "комментария";
		$selectQuery = "SELECT * FROM `commentary`";
		
		if($result = mysqli_query($db, $selectQuery)){
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
				
			
		$content .= <<<HTML
		<style>
				th{
			text-align:center;
			background-color:#313942; 
		
		}
		.itemtd{
			text-align:center;
			padding:3px;
			background-color:#313942; 
		}
		.item-action{
			text-align:center;
			font-size:18px;
		}
		.tr-content:hover{
			background-color:#464646;
		}
		
		</style>
	
			<table border="1px" bodercolor="#cecece" style="width:100%;">
HTML;
			$content .= <<<HTML
				<div class="tradmin">
				<tr>
				<th>ID</th>
				<th>Ник</th>
				<th>Кино</th>
				<th>время добавление</th>
				<th>комментария</th>
				<th>Удалить</th>
				</tr>
				</div>
HTML;
			 
			 
			
		if(!empty($items)){ //если не пуста будеть следущий
				foreach($items as $item){
					
	/*кино имя*/				
					$kinoid = $item['kinoid'];
			$selectkinoId = "SELECT * FROM `items`  WHERE id='{$kinoid}'";
			$result = mysqli_query($db,$selectkinoId);
			$sitem = mysqli_fetch_assoc($result);
			
	/*кино имя*/
					$date = date("d.m.Y", $item['addDate']);
					$descr = mb_substr($item['commDescription'], 0, 10);
						$content .= <<<HTML
						<tr class='tr-content'>
						<td class='itemtd'>{$item['kinoid']}</td>
						<td class='itemtd'>{$item['commName']}</td>
						<td class='itemtd'>{$sitem['itemName']}</td>
						<td class='itemtd'>{$date}</td>
						<td class='itemtd'>{$descr}</td>
						
						<td class='itemtd item-action'>
							<a href='/admin.php?action=deletecomm&id={$item['id']}'>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
							  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
							</svg>
							</a>
						</td>
						</tr>
HTML;
				}		
		}else{
			$content .= "Базе нет комментария";
		}
		
				$content .= <<<HTML
				</table>
HTML;
		}else{
			$content .="<b>Ошибка:</b> Не удалось выполнить задачу все комментария из базы данных";
		}
		
	}elseif($action == "deletecomm"){
		$title = "Удаление комментария";
		$act_title = "Удалить комментария";
		$itemId = (int) $_GET['id'];
		
		if($itemId){
			if($_SERVER['REQUEST_METHOD'] == "POST" AND $_POST['like'] == 'yes'){
				$deleteQuery = "DELETE FROM `commentary` WHERE id='{$itemId}'";
				
				if(mysqli_query($db, $deleteQuery)){
					if(mysqli_affected_rows($db)){
						$content .= "комментария удалень  <a href='/admin.php?action=comment'>вернуться назад</a>";
					}else{
						$content .= "Такой комментария  нет в базе";
					}
				}else{
					$content .= "<b>Ошибка</b> не удалось удалить комментария";
				}
			}else{
				$content .= <<<HTML
					<form method="POST" action="">
						<input type="hidden" name="like" value="yes" />
						<input type="submit" value="Потвердить удаление" />	
					</form>
HTML;
			}
		}else{
			$content .= "<b>Ошибка</b> не указан ID";
		}
		
	
	}else{
			$title = "Админ панель сайта";
		$act_title = "Панель админстратора";
		
		

		$content .=  <<<HTML
		<div class="adminmuch">
				<div class="muchper">
					<div class="pername">
					<span>Опубликовано фильмов</span>
					</div>
					<div class="percent">
						<span>
HTML;
					$selectCount = "SELECT COUNT(itemName) as count FROM `items`";
			$result = mysqli_query($db,$selectCount);
			$items = mysqli_fetch_row($result);
			$pro = $items[0] * 100;
			$resultpro = $pro / 1000;
			
		$content .=  <<<HTML
		{$resultpro}%</span>
					</div>
				</div>
				<div class="howpercent">
				<progress class="progress" value="{$items[0]}" max="1000"></progress>
				</div>
				<div class="howmuch">
{$items[0]}
						<span>/1000</span>
				</div>
			</div>
			
			
			<div class="modulhor">
				<div class="modname">
					<div class="namemodul">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
					  <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
					</svg>
					<p>Модули</p>
					</div>
				</div>
				<div class="modulall">
					<div class="allname">
						<div class="namecolor">
							<a href="/admin.php?action=allnews">	
							<div class="colorcenter">
								<div class="tericon">
								<center><svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-calendar2-date" viewBox="0 0 16 16">
  <path d="M6.445 12.688V7.354h-.633A12.6 12.6 0 0 0 4.5 8.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
</svg></center>
								</div>
								<div class="tername">
									<span>скоро</span>
								</div>
								</a>
							</div>
						</div>
					</div>
						<div class="allname">
						<div class="namecolor">
						<a href="/admin.php?action=comment">	
							<div class="colorcenter">
								<div class="tericon">
								<center>
					<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg>
								</center>
								</div>
								<div class="tername">
									<span>комментария</span>
								</div>
								</a>
							</div>
						</div>
					</div>
						<div class="allname">
						<div class="namecolor">
						<a href="/admin.php?action=topitem">
							<div class="colorcenter">
								<div class="tericon">
								<center>
									<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
</svg>
								</center>
								</div>
								<div class="tername">
									<span>топ</span>
								</div>
								</a>
							</div>
						</div>
					</div>
						<div class="allname">
						<div class="namecolor">
						<a href="/admin.php?action=topitem">
							<div class="colorcenter">
								<div class="tericon">
								<center>
									<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
</svg>
								</center>
								</div>
								<div class="tername">
									<span>просмотр</span>
								</div>
								</a>
							</div>
						</div>
					</div>
						<div class="allname">
						<div class="namecolor">
						<a href="/">
							<div class="colorcenter">
								<div class="tericon">
								<center>
									<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-collection" viewBox="0 0 16 16">
  <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
</svg>
								</center>
								</div>
								<div class="tername">
									<span>слайдер</span>
								</div>
								</a>
							</div>
						</div>
					</div>
					<div class="allname">
						<div class="namecolor">
						<a href="/admin.php?action=allitems">
							<div class="colorcenter">
								<div class="tericon">
								<center>
								<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
</svg>
								</center>
								</div>
								<div class="tername">
									<span>скрыть</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
HTML;
	
	}
	}else{
		$act_title = "Ошибка: нет подлючение на база данных";
	}
	
?>


<html>
<head>
 <meta charset="UTF-8" />
 <title><?=$title?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
 <link rel="stylesheet" href="css/style.css?v=60">
</head>
<body>
			<div id="wrapperadmin">
	
			
		<!--wrapper-->
	
	
	 
	 
<div class="conteneradmin">
		 <div class="admin-horizontal">
		 		<div class="admintoch" style="	margin-top:42px;"></div>
			<div class="admintitle">
				<span><?=$act_title?></span>
				<?=$searchan?>
			</div>
			<div class="titlename"></div>
			
				<?=$content?>
		
			
					
			
	
			
			
		 </div>		 
		 <div class="horleft">
			<div class="horizontaladmin"></div>
			
			<div class="admintoch" style="	margin-top:45px;"></div>
				
			<div id="adminlink">
			<a href="/">
				<p>run.com</p>
				<div class="glyphicon glyphicon-menu-left">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
					</svg>
				</div>
			</div>
			<div class="adminicon">
				<div class="iconleft">	
					<a href="#">
						<div class="leftnac">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
							  <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/>
							</svg>
							<p>
						настройка
						</p>
						</div>	
					</a>
				</div>
				<div class="iconright">
						<a href="#">
						<div class="leftnac">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
					  <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
					</svg>
							<p>
						модули
						</p>
						</div>	
					</a>
				</div>
				</div>
				<div id="menuadmin">
					<div class="adminame">
							<div class="menuicon">
												<a href="/admin.php">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
								  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
								</svg>
								<p>
								Админ-панель
								</p>
													</a>
							</div>
								<div class="menuicon">
												<a href="#">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
						  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
						</svg>
								<p>
								Публикация
								</p>
													</a>
							</div>
							<div class="menuicon">
												<a href="/">
						<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
						</svg>
								<p>
								Главная сайта
								</p>
													</a>
							</div>
							<div class="menuicon">
												<a href="/admin.php?action=addnewitem">
						<svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
						  <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
						</svg>
								<p>
								Добавить
								</p>
													</a>
							
							</div>
							<div class="menuicon">
												<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
				  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
				</svg>
								<p style="    padding-right: 50px;margin: -2px 15px 5px 0px;">
								Все категория
								</p>
													</a>
							
							<div class="menucategory">
							<ul>
										<li><a href="/admin.php?action=allitems">Все фильмы</a></li>
										<li><a href="/admin.php?action=allnow">Все сериалы</a></li>
										<li><a href="/admin.php?action=comment">Все комментария</a></li>
							</ul>
									</div>
							</div>
							<div class="menuicon" style="	margin:25px 0px -20px 25px;">
												<a href="/admin.php?action=topitem">
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
								  <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
								</svg>
								<p >
								 посещаемость сайта
								</p>
													</a>
							</div>

					
					</div>
				</div>
			</div>
		 </div>
</div>		
							
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html> 