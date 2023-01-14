<?php
$allCategory =[
		1 => 'скоро',2 => '1960-1970',3 => '1970-1980',4 => '1980-1990',5 => '1990-2005',
		6 => '2000-2005',7 => '2005',8 => '2006',9 => '2007',10 => '2008',
		11 => '2009',
		12 => '2010',13 => '2011',14 => '2012',15 => '2013',16 => '2014',
		17 => '2015',18 => '2016',19 => '2017',
		20 => '2018',21 => '2019',22 => '2020',23 => '2021'
	];
		function displayallCategory($selectCat = false){
			$options = "";
			global $allCategory;
			
			foreach($allCategory as $key=>$category){
			if($selectCat and $key == $selectCat) $options .="<option value='{$key}' selected>{$category}</option>";
			else  $options .="<option value='{$key}'>{$category}</option>";
			}
			return $options;
		}
		?>