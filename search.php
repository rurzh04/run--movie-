	<div class="x-sort">
						<div style="font-size:15px; margin:10px 4px 0px 15px; color:#eaeaea;"><?=$content_title?></div>
							<div class="xsort-area">									
							</div>
						</div>
						<div class="dle-content">
							<div class="contentdle">
							
								<?php
								
	
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
							include('nambe.php');
								}
	
					
									?>
							</div>
						</div>		

	
	
