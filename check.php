<?php
$textadmin = "";
$db = mysqli_connect('localhost','root',"","arun");
$content = "";

if(isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
				
		$insertSelect = "SELECT * ,INET_NTOA(user_ip) AS user_ip FROM `soonew` WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1";
		$insertQuery = mysqli_query($db, $insertSelect);
		$userdata = mysqli_fetch_assoc($insertQuery);
		 
		
	if(($userdata['id'] !== $_COOKIE['id']) or ($userdata['user_hash'] !== $_COOKIE['hash']) 
	or ($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR']) or ($userdata['user_ip']) == "0"){
		
		$content .= "что-то не робает";
		
	}else{
		$content .= "Привет ".$userdata['user_login']." Все круто!";
	}
}else{
		$content .= "Включите куки";
}



	if($_SERVER['REQUEST_METHOD'] === "POST"){
	
	$trust .= "";
	if(strlen($_POST['textadminhelp']) < 10 OR empty($_POST['textadminhelp'])) $trust .= "Не заполнина поле  или меньше 10 букв <br/>";
	if(empty($trust)){
	$addDate = mktime();
	$textAdmin = trim($_POST['textadminhelp']);
	$nikAdmin = trim($_POST['nikadminhelpMy']);
	
	$insertQuery ="INSERT INTO `complaints` (addDate, login, description) VALUES('{$addDate}', '{$nikAdmin}', '{$textAdmin}')";
			
	
	if(mysqli_query($db, $insertQuery)){
				$textadmin .= "Жалоба оправлен";
			}else{
				$textadmin .= "Ошибка Жалоба не добавлен.Информация для отладки: <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
			}
		}else{
			$textadmin .= "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
			$textadmin .= $trust;
		}
	
	}else{
		$textadmin .=  <<<HTML
						<form method="POST" action="">
						<input type="text" name="nikadminhelpMy" class="nikadminhelpMy" style="border-bottom: 1px solid #505050;" value="{$userdata['user_login']}" readonly /><br/>
						<textarea  name="textadminhelp" class="textadminhelp" placeholder="Жалоба"></textarea><br/>
						<input type="submit" class="submitnik" value="отправить" />
						</form>	
		
HTML;
	}
	$cook = $_COOKIE['id'];
	
	$selectQueryDB = "SELECT * FROM viewlater WHERE user_id='{$cook}'";
		
	$resultDB = mysqli_query($db,$selectQueryDB);
	$itemDB = mysqli_fetch_all($resultDB,MYSQLI_ASSOC);



?>
<div id="nikwrapper" >
<div class="nikplay">
	<b>Ник: rurzh <span>Online</span></b><br/><br/>
	<b>Дата регистрации: </b> 3 июля 2021 21:49<br/>
	<b>смотреть позже:</b> <a href="http://run/?action=viewlater">(<?$couname = print_r(count($itemDB))?>)</a><br/>
	<b>Группа:</b> Посетитель
</div>
<div class="nikimages">
	<div class="imagesnik"></div>
	
</div>
	<div class="nikadminhelp">
		<div class="nikzh">
		<b>Если у вас есть какие-то проблемы или вопросы пишите здесь админу:</b>
		</div>
		<button class="fbutton5zh"  value="click" onmousedown="viewDiv()">
			<span id="loginmydiv">Жалоба админу</span>
			<div id="displaynik">
			<p>
						<?=$textadmin?>
			</p>
			</div>	
			</button>
				
			</div>
			
			
	</div>
