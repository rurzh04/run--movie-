<?php
$db = mysqli_connect('localhost','root',"","arun");
	
	$selecthori = "SELECT * FROM `items` LIMIT 12";
	
		
	if($resulti = mysqli_query($db,$selecthori)){
		$itemi = mysqli_fetch_all($resulti, MYSQLI_ASSOC);
		
		foreach($itemi as $itemi){
			$content .= <<<HTML
			<li><a href="/?action=item&id={$itemi['id']}"><img src="../images/{$itemi['itemMainImg']}"  /></a></li>
			
HTML;
		}
		
	}else{
		$content .= "select нету";
	}

?>

<html>
<head>
 <meta charset="UTF-8" />
 <title><?=$title?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="stylesheet" href="css/work.css?v=3">
     
</head>
<body>
 
 <div id="carousel" class="carousel">
	  <button class="arrow prev">⇦</button>
    <div class="gallery">
      <ul class="images">
	  <?=$content?>
		</ul>
</div>
<button class="arrow next">⇨</button>
  </div>
<script type="text/javascript"src="js/work1.js?v=9"></script>
</body>
</html>
