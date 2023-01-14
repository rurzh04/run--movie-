<?php

	$db = mysqli_connect('localhost','root',"","arun");

	$namefilm = "SELECT * FROM  `items` WHERE id='5'";
	$result = mysqli_query($db, $namefilm);
	$items = mysqli_fetch_assoc($result);
	
	echo "<pre>";
		var_dump($items);
	echo "</pre>";


if($_SERVER['REQUEST_METHOD'] === "POST"){
	
	$trust ='';
			if(empty($_POST['commName']) OR strlen($_POST['commName']) < 3) $trust .= "Не заполнина поле <b>Никнейм</b> или меньше 3 букв <br/>";
			if(empty($_POST['commDescription']) OR strlen($_POST['commDescription']) > 25) $trust .= "Не заполнина <b>комментария</b> поле или меньше 15 букв <br/>";
			
			if(empty($trust)){
			$addDate = mktime();
			$commName = trim($_POST['commName']);
			$commDescription = trim($_POST['commDescription']);
			$kinoid = $items['id'];
			$insertQuery ="INSERT INTO `commentary` (addDate, commName, commDescription, kinoid) VALUES('{$addDate}', '{$commName}', '{$commDescription}','{$kinoid}')";
			
			if(mysqli_query($db, $insertQuery)){
				echo   <<<HTML
	<form method="POST" action="">
	<input type="text" name="commName" class="commName" placeholder="никнейм" /><br/>
	<textarea class="textarea" name="commDescription" class="commDescription" placeholder="Комментария"></textarea></br>
	<input type="submit" value="Добавить кино" />
		</form>		
	
HTML;
			}else{
				echo  "Ошибка Комментария не добавлен.Информация для отладки: <b>MSQLERROR: ".mysqli_errno($db).", MYSQL MSG:".mysqli_error($db)."</b>";
			}
		}else{
			 echo "<b>Ошибка:</b> заполните данныx, Вы не указали <br/>";
			 echo $trust;
		}
	}else{
	echo  <<<HTML
	<form method="POST" action="">
	<input type="text" name="commName" class="commName" placeholder="никнейм" /><br/>
	<textarea class="textarea" name="commDescription"  placeholder="Комментария"></textarea></br>
	<input type="submit" value="Добавить кино" />
		</form>		
	
HTML;
	}
?>
										<button class="fbutton5" id="myBtn">
											Добавить комментарий
											<div id="myModal" class="modal">
												<div class="modal-content">
												  <span class="close">&times;</span>
												  <p>
												
								