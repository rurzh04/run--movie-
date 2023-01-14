<?php
session_start();
	$db = mysqli_connect('localhost','root',"","arun");
		if($_SERVER['REQUEST_METHOD'] === "POST"){
			$trust = "";
			
		if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))$trust .= "Логин может состоять только из букв английского алфавита и цифр";
		if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)$trust .= "Логин должен быть не меньше 3-х символов и не больше 30";
				if(empty($_POST['name']))	$trust .= "Вы не ввели капчу";
				if($_SESSION['captch'] != $_POST['name']) $trust .= "Вы ввели не правильную капчу";
				
		  $query = mysqli_query($db, "SELECT id FROM `soonew` WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0) $trust .= "Пользователь с таким логином уже существует в базе данных";
				if(empty($trust)){
					
						$login = $_POST['login'];
						$password = md5(md5(trim($_POST['password'])));
			
						$insertQuery ="INSERT INTO `soonew` (user_login, user_password) VALUES('{$login}', '{$password}')";
								
					if(mysqli_query($db, $insertQuery)){
											
						
						
					}else{
							$contentname .= "Ошибка <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
					}
					
				}else{
					$contentname .= "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
					$contentname .= $trust;
					
							// Настройка скрипта
$charCount = 5; // количество символов в ключе

// Генерируем секретный ключ
$captch_chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

$chars = strlen($captch_chars);

for($i = 1; $i <= $charCount; $i++){
$secret .= $captch_chars{rand(0, $chars)};
}

$_SESSION['captch'] = $secret;

		$contentname .= <<<HTML
		
	<div class="formregister">
	<form method="POST" action="">
 <span>Логин:</span><input name="login" class="loginregister" type="text"><br>
 <span>Пароль:</span><input name="password" class="passwordregister" type="password"><br>
 <span >Введите код</span>  <img src='capth_enginge.php' /></br>
<span> с картинки:</span><input type='text' name='name' class="kapregicter"  /><br/>
<input name="submit" type="submit" class="submitregister"  value="Отправить" />
</form>
				</div>	
				<div class="boderegister"></div>
HTML;
				}
	
		}else{		
		// Настройка скрипта
$charCount = 5; // количество символов в ключе

// Генерируем секретный ключ
$captch_chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

$chars = strlen($captch_chars);

for($i = 1; $i <= $charCount; $i++){
$secret .= $captch_chars{rand(0, $chars)};
}

$_SESSION['captch'] = $secret;

		$contentname .= <<<HTML
		<div class="registername">
	<b>Здравствуйте, уважаемый посетитель нашего сайта!</b>
	<br/>
	<b style="font-size:13px;">Регистрация на нашем сайте позволит Вам быть его полноценным участником. Вы сможете добавлять новости на сайт, оставлять свои комментарии, просматривать скрытый текст и многое другое.
</b>
<br/>
<b style="font-size:13px;">В случае возникновения проблем с регистрацией, обратитесь к <a href="#">администратору</a> сайта.</b>
	</div>
	<div class="formregister">
	<form method="POST" action="">
 <span>Логин:</span><input name="login" class="loginregister" type="text"><br>
 <span>Пароль:</span><input name="password" class="passwordregister" type="password"><br>
 <span >Введите код</span>  <img src='capth_enginge.php' /></br>
<span> с картинки:</span><input type='text' name='name' class="kapregicter"  /><br/>
<input name="submit" type="submit" class="submitregister"  value="Отправить" />
</form>
				</div>	
				<div class="boderegister"></div>
HTML;
	}
?>
	<div class="x-sort">
						<div style="font-size:18px; margin:10px 4px 0px 10px;  color: #dadada; float: none;"><?=$content_title?></div>
							<div class="xsort-area">									
							</div>
						</div>
		
				<?=$contentname?>

