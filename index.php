<?php	
	$action= $_GET['action'];
	$content = "";
	$content_title = "";
	$error = "";
	$db = mysqli_connect('localhost','root',"","arun");
	
	
	include('function.php');
	
		
		
	
	if($action === 'news'){
		$act_title .= "Новые фильмы";
		$content_title .= "Новые фильмы";
	

	$tmpFile = 'main.php';
	}elseif($action === 'comment'){
		$act_title .= "Добавить комментария";
		$content_title .= "Добавить комментария";	
				if($db){
			$selectcomms = "SELECT * FROM `commentary`";
			
			if($result = mysqli_query($db, $selectcomms)){
				$allcommItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
			}else{
				$error .= "<b>Ошибка запроса в базу:</b> не могу получить список товаров";
			}
		}else{
			$error .= "<b>Ошибка:</b> Нет подключение к базе данных";
		}
	$tmpFile = 'comment.php';	
	}elseif($action === 'viewlater'){
		$act_title .= "смотреть позже";
		$content_title .= "смотреть позже";
		
	$tmpFile = 'viewlater.php';
	}elseif($action === 'category'){
		$act_title .= "категория фильмов";
		$content_title .= "категория фильмов";
		
	$tmpFile = 'category.php';
	}elseif($action === 'series'){
		$act_title .= "категория фильмов";
		$content_title .= "категория фильмов";
			
	$tmpFile = 'trname.php';
	}elseif($action === 'genre'){
		$act_title .= "Жанр фильма";
		$content_title .= "Жанр фильма";
		
	$tmpFile = 'genre.php';
	}elseif($action === 'country'){
		$act_title .= "страна фильма";
		$content_title .= "страна фильма";
		 
		
	$tmpFile = 'country.php';
	}elseif($action === 'register'){
		$act_title .= "Регистрация нового пользователя";
		$content_title .= "Регистрация нового пользователя";
		 
		 
		
	$tmpFile = 'register.php';
	}elseif($action === 'check'){
		$act_title .= "Регистрация нового пользователя";
		$content_title .= "Регистрация нового пользователя";
		 
		 
		
	$tmpFile = 'check.php';
	}
	elseif($action === 'years'){
		$act_title .= "Жанр фильма";
		$content_title .= "Жанр фильма";
		
	$tmpFile = 'years.php';
	}elseif($action ==='series'){
		$act_title .= "сериал";
	$content_title .= "сериал";
	
	$tmpFile = 'series.php';
	
	}elseif($action === 'item'){
		$act_title .= "смотреть фильмов";
		$content_title .= "смотреть фильмов";
		
		if($db){
			$itemId = (int) $_GET['id'];
			
			if($itemId){
				$selectItem = "SELECT * FROM `items` WHERE id='{$itemId}'";
				if($result = mysqli_query($db, $selectItem)){
					$item = mysqli_fetch_assoc($result);
					include('select.php');
				if($item){	
					$act_title = $item['itemName'];
					$content_title = $item['itemName']."<a href='/admin.php?action=edititem&id={$item['id']}' target='_Blank'><span class='glyphicon glyphicon-edit gly-edit-item'></span></a>";
				
				}else{
						$error .= "Товара с таким ID нет";
					}
				}else{
					$error .= "<b>Ошибка:</b> Не удалось выполнить запроса на получение записи и базы";
				}
			}else{
				$error .= "<b>Ошибка:</b> не указан ID товара";
			}
		}else{
			$error .= "<b>Ошибка:</b> Нет подключение к базе данных";
		}
		
	$tmpFile = 'watch.php';	
		}elseif($action === 'search'){
		$act_title .= "поиск фильмов";
		$content_title .= "поиск фильмов";
		
		
		
	$tmpFile = 'search.php';	
	}else{
		$title = "Главная страница";
		$content_title .= "Топ за последнии дня";
		
		if($db){
			$selectAllItems = "SELECT * FROM `items`";
			
			if($result = mysqli_query($db, $selectAllItems)){	
			if(isset($_GET['pageno'])){
			$pageno = $_GET['pageno'];
		}else{
			$pageno = 1;
		}
		$size_page = 5;
		$offset = ($pageno-1) * $size_page;
			$sql = "SELECT * FROM `items` ORDER BY id DESC LIMIT $offset, $size_page";
			$res_data = mysqli_query($db, $sql);
			for($pagicnation = []; $row = mysqli_fetch_array($res_data, MYSQLI_ASSOC); $pagicnation[] = $row);

			}else{
				$error .= "Ошибка не могу получить данные";
			}
		}else{
			$error .= "Ошибка: нет подлючения на база данных";
		}

		$tmpFile = 'main.php';
	}
	include('tepmlate.php');
?>

