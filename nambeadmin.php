
<?php
		$content .= <<<HTML
		<style>
		.admintitle span{
			float:left;
		}
			th{
			text-align:center;
			background-color:#313942; 
		
		}
		.itemtd{
			text-align:center;
			padding:3px;
			background-color:#313942; 
		}
		.item-action{
			text-align:center;
			font-size:18px;
		}
		.tr-content:hover{
			background-color:#464646;
		}
		.search_panel{
			background-color:#464646;	
			margin-right:15px;
		}
		.search_panel input[type=submit] {
			font-size:23px;
		float: right;
		height:40px;
		margin-top: -48px;
		background-color: #262E37;
		color:#A8A8A8;
}
		.search_panel input[type=text] {
	background-color:#4B5B6B;
	border:1px solid #4B5B6B;
	font-size:20px;
}
		</style>
	
			
HTML;
			



						$content .= <<<HTML
						
						<tr class='tr-content'>
						<td class='itemtd'>{$item['id']}</td>
						<td class='itemtd'>{$item['itemName']}</td>
						<td class='itemtd'>{$item['itemRaisal']}</td>
						<td class='itemtd'>{$item['itemCost']}</td>
						<td class='itemtd'>{$item['itemCountry']}</td>
						<td class='itemtd'>{$items}</td>
						<td class='itemtd item-action'>
							<a href='/admin.php?action=edititem&id={$item['id']}'>
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
								  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
								</svg>
							</a>
							<a href='/admin.php?action=deleteitem&id={$item['id']}'>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
							  <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
							</svg>
							</a>
						</td>
						</tr>
HTML;
				
		
		

			
?>