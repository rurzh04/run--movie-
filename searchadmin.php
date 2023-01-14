<?php
$title = "{$item[itemName]}";
		$act_title = "поиск";
		
		
	$searchan .= <<<HTML
			<div class="search_panels" style="float:right;">
	
	  <form  method="POST" action="?action=search"  id="searchform"> 
      <input  type="text" name="search" class="searchadmincss" required /> 
      <input  type="submit" name="submit" class="submitadmincss" value="поиск" /> 
    </form> 
	</div>
			
HTML;
$content .= <<<HTML
		<style>
		.admintitle span{
			float:left;
		}
			th{
			text-align:center;
			background-color:#313942; 
		
		}
		.search_panels{	
			margin-right:15px;
		}
		.submitadmincss{
			border:1px solid #4B5B6B;
			font-size:22px;
			float: right;
			height:34px;
			margin-top:0px;
			background-color:#262E37;
		color: #A8A8A8;
}
		.searchadmincss {
	background-color:#4B5B6B;
	border:1px solid #4B5B6B;
	font-size:20px;
	width:200px;
}

		</style>
HTML;
		
$content .= <<<HTML
<table border="1px" bodercolor="#cecece" style="width:100%;">
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
		
		if(isset($_POST['submit'])){
		$search = explode(" ",$_POST['search']);
		$count = count($search);
		$array = array();
		$i = 0;
		foreach($search as $key){
			$i++;
			if($i < $count){
				$array[] = " CONCAT(`itemName`) LIKE '%".$key."%' OR "; 
			}else{
				$array[] = " CONCAT(`itemName`) LIKE '%".$key."%'";
			}
			$sqls = "SELECT * FROM `items` WHERE".implode("", $array);

			 	$querys = mysqli_query($db,$sqls);
				
		}
			}
			
	
								while($item = mysqli_fetch_assoc($querys)){
							include('nambeadmin.php');
								}
								
	
			
	$content .= <<<HTML
							</table>
		
HTML;
?>
