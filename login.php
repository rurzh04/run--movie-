<?php
$db = mysqli_connect('localhost','root',"","arun");

$contents = "";

function generateCode($length=6) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
	$clen = strlen($chars) - 1;
		while(strlen($code) < $length){
				$code .= $chars[mt_rand(0, $clen)];
		}
			return $code;
}
	if($_SERVER['REQUEST_METHOD'] === "POST"){
		$insertSelect = "SELECT id, user_password FROM `soonew` 
		WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."' LIMIT 1";
		$insertQuery = mysqli_query($db, $insertSelect);
		$data = mysqli_fetch_assoc($insertQuery);
		
		
		if($data['user_password'] === md5(md5($_POST['password']))){
		// Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
		
			if(!empty($_POST['not_attach_ip'])){
				 // Если пользователя выбрал привязку к IP
				// Переводим IP в строку
			
				$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
				
				// Записываем в БД новый хеш авторизации и IP
			
				 mysqli_query($db, "UPDATE soonew SET user_hash='".$hash."' ".$insip." 
				 WHERE id='".$data['id']."'");
				
			
				 
				setcookie("id", $data['id'], time()+60*60*24*30, "/");
				setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
			
				
			}
		
		
		
		}else{
			$contents .= "Вы ввели неправильный логин/пароль";
					$contents .=   <<<HTML
					
			<form method="POST" action="">
			 <input name="login" class="loginname" type="text"><br>
			 <input name="password" class="passwordlogin" type="password"><br>
			 <input type="checkbox" class="submitname" name="not_attach_ip"><br>

			<input name="submit" class="submitname" type="submit" value="Войти">
			</form>
						
HTML;
		}
		}else{
			$contents .=   <<<HTML
			
			<style>
			
			</style>
			
	<form method="POST" action="">
			 <input name="login" class="loginname" type="text"><br/>
			 <input name="password"  class="passwordlogin" type="password"><br/>
			 <input type="checkbox" class="checkboxname" name="not_attach_ip"><br/>

			<input name="submit" type="submit" class="submitname" value="Войти">
			</form>
						

		
HTML;
		}
		
?><div class="registerlogin" style="width: 125px;">
	<div class="login">
			<button class="fbutton5login" id="myBtn">
			<span id="loginmydiv">Вход</span>
			<div id="myModal" class="modalogin">
			<div class="modal-content">
			<span class="close">&times;</span>
			<p>
		
			<?=$contents?>
					
						
			</p>
			</div>
			</div>
			</button>
			/
	</div>
	<div class="register"><a href="?action=register"><span>Регистрация</span></a></div>
	</div>		