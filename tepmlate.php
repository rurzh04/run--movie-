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
	if(isset($_POST['submit'])){
		$insertSelect = "SELECT id, user_password, user_login FROM `soonew` WHERE user_login='".mysqli_real_escape_string($db, $_POST['login'])."' LIMIT 1";
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
				setcookie("log", $data['user_login'], time()+60*60*24*30, "/");
				setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
			$vxod = "Вход";
			$contents .= <<<HTML
				<span id="loginmydivs" >{$vxod}</span>
HTML;
				if(!empty($_COOKIE['log'])){
				$nikname .= <<<HTML
				<td  class="item">
				<a href="http://run/?action=check">
				<span class="name">{$_COOKIE['log']}</span>
				</a>
				</td>
HTML;
			}

			
			}
		
		
		
		}else{
			$vxod = "Вход";
			$contents .= "Вы ввели неправильный логин/пароль";
			if(!empty($_COOKIE['log'])){
				$nikname .= <<<HTML
				<td  class="item">
				<a href="http://run/?action=check">
				<span class="name">{$_COOKIE['log']}</span>
				</a>
				</td>
HTML;
			}
					$contents .=   <<<HTML
					
			<button class="fbutton5login" id="myBtns">
		<span id="loginmydiv" >{$vxod}</span>
			<div id="myModals" class="modalogin">
			<div class="modal-content">
			<span class="closes">&times;</span>
			<p>
			<div class="formnik">
	<form method="POST" action="">
			 <input name="login" class="loginname" type="text"><br/>
			 <input name="password"  class="passwordlogin" type="password"><br/>
			 <input type="checkbox" class="checkboxname" style="margin: 10px 0px 5px 90px;"  name="not_attach_ip"><br/>
			<input name="submit" type="submit" class="submitname" value="Войти" style="margin: 0px 70px 0px 0px;">
			</form>
			</div>
			</p>
			</div>
			</div>
			</button>
						
HTML;
		}
		}else{
			$vxod = "Вход";
			if(!empty($_COOKIE['log'])){
				$nikname .= <<<HTML
				<td  class="item">
				<a href="http://run/?action=check">
				<span class="name">{$_COOKIE['log']}</span>
				</a>
				</td>
HTML;
			}
			$contents .=   <<<HTML
			
			<style>
			
			</style>
			<button class="fbutton5login" id="myBtns">
			<span id="loginmydiv" >{$vxod}</span>
			<div id="myModals" class="modalogin">
			<div class="modal-content">
			<span class="closes">&times;</span>
			<p>
			<div class="formnik">
	<form method="POST" action="">
			 <input name="login" class="loginname" type="text"><br/>
			 <input name="password"  class="passwordlogin" type="password"><br/>
			 <input type="checkbox" class="checkboxname" style="margin: 10px 0px 5px 90px;"  name="not_attach_ip"><br/>
			<input name="submit" type="submit" class="submitname" value="Войти" style="margin: 0px 70px 0px 0px;">
			</form>
			</div>
			</p>
			</div>
			</div>
			</button>
		
HTML;
		}
		
?>
<html>
<head>
 <meta charset="UTF-8" />
 <title><?=$act_title ?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://bootswatch.com/3/paper/bootstrap.css" crossorigin="anonymous">
 
 <link rel="stylesheet" href="css/style.css?v=61">
</head>
<body>
	<!--topmenu-->
	<div id="topline">
	<div class="main_menu">
	<a href="/">
	<img src="../images/run1.png"  width="91px"/>
	</a>
	</div>
	
	<div class="search_panel" style="margin-right:163px;     margin-top:-30px;">
	  <form  method="POST" action="?action=search"  id="searchform"> 
      <input  type="text" name="search" required> 
      <input  type="submit" name="submit" value="поиск"> 
    </form> 
	</div>

			<div class="registerlogin" style="width: 125px;">
	<div class="login">
			
		
			<?=$contents?>
					
						
			
			/
	</div>
	<div class="register"><a href="?action=register"><span>Регистрация</span></a></div>
	</div>	
	
	
	<div class="deep"></div>
	<!--topmenu-->
			<div id="wrapper">
	<!--deepnavigation-->
		<div class="deepnavigation">
		<table class="menu">
			<tbody>
				<tr >
					<td  class="item">
				<a href="/" >
				<span class="name" style="color:#7b7b7b;">Главная</span>
				</a>
				</td>
				<td  class="item">
				<a href="/">
				<span class="name">новинки</span>
				</a>
				</td>
				<td  class="item">
				<a href="/">
				<span class="name">подборка</span>
				</a>
				</td>
				<td  class="item">
				<a href="/?action=series&cinema=4pw">
				<span class="name">фильмы</span>
				</a>
				</td>
				<td  class="item">
				<a href="/?action=series&series=4pw">
				<span class="name">сериалы</span>
				</a>
				</td>
				<td  class="item">
				<a href="/?action=country&multfilmy=lpw">
				<span class="name">мультики</span>
				</a>
				</td>
				<?=$nikname?>
				</tr>
			</tbody>
		</table>
		</div>
	<!--deepnavigation-->
		
		<!--wrapper-->
		<?php
		include('horizontal.php');
		?>
		<!--right-content-->
		<div class="contener">
			<div class="contener2">
					<div class="content" >
						<?php		
						include($tmpFile);
						?>
					</div>
					
					<!--left-content-->
					<div id="left-content">
					<div class="left-news">
					Панель навигации:
						<div class="main">
							НОВЫЙ МИР
						</div>
					</div>
						<div class="leftblok_contener2">
						
					<?php
						include('topline.php');
					?>
			</div>
			<div class="poloska_bloka"></div>
			<div style="padding: 7px 20px; position: relative; border-bottom: 1px solid #3f413f;">
					<i style="font-size: 15px;">Скоро будет на сайте</i>
					</div>
					<!--свежий сайта-->
					<div class="mimiserblock">
						<ul>
							<?php
								include('soonsite.php');
							?>
							
						</ul>
					</div>
					<div style="padding: 7px 20px; position: relative; border-bottom: 1px solid #3f413f;">
					<i style="font-size: 15px;">Обновления сериалов </i>
					<a href="/?action=newseries&allQuerys" style="font-size:13px; float:right;">все сериалы</a>
					</div>
				
				<!--обновление сайта сериалы-->
				<div class="mimiser">
					<ul>
					<?php
							include('newseries.php');
						?>
					</ul>
				</div>
				<div style="padding: 7px 20px; position: relative; border-bottom: 1px solid #3f413f;">
					<i style="font-size: 15px;">Последние комментарии</i>
					</div>
					
					<div class="sb-cont">
						<ul class="last-comments">
						 <?php
							include('readcomm.php');
						?>
							
						</ul>
					</div>
			</div>
		
	 </div>
		
		<!--content-->
	


	</div>
<script type="text/javascript"src="/js/corusel.js?v=2"></script>
<script type="text/javascript"src="/js/jquery.js?v=3"></script>
<script type="text/javascript"src="js/work1.js?v=9"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html> 