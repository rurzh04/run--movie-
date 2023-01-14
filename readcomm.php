<?php
	$error = "";
	$db = mysqli_connect('localhost','root',"","arun");
			if($db){
			$selectAllItems = "SELECT * FROM `commentary`";
			
			if($result = mysqli_query($db, $selectAllItems)){	
			if(isset($_GET['pageno'])){
			$pageno = $_GET['pageno'];
		}else{
			$pageno = 1;
		}
		$size_page = 5;
		$offset = ($pageno-1) * $size_page;
			$sqlcomm = "SELECT * FROM `commentary` ORDER BY id DESC LIMIT $offset, $size_page ";
			$res_data = mysqli_query($db, $sqlcomm);
			for($pagiccomm = []; $row = mysqli_fetch_array($res_data, MYSQLI_ASSOC); $pagiccomm[] = $row);

			}else{
				$error .= "Ошибка не могу получить данные";
			}
		}else{
			$error .= "Ошибка: нет подлючения на база данных";
		}
						foreach($pagiccomm as $sitem){
							 $descr = mb_substr($sitem['itemDecsriptions'], 0, 25);
							#$date = date("d.m.Y", $item['addDate']);
					echo <<<HTML
						<li>
						<span class="last-comments__user">
							<span class="last-comments__user_avatar">
							<img src="../images/avatar.png" />
							</span>
								<span class="last-comments__info"> 
									<span class="last-comments__info_title " style="margin-left:5px;">
										<a href="/">{$sitem['commName']}</a>
									</span>
								</span>
						</span>
						<p class="last-comments__comment">
						{$sitem['commDescription']}
						</p>
						</li>
HTML;
							 }
?>

