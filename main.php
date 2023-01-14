	<div class="x-sort">
						<div style="font-size:15px; margin:10px 4px 0px 10px; color:#eaeaea;"><?=$content_title?></div>
							<div class="xsort-area">									
							</div>
						</div>
						<div class="dle-content">
							<div class="contentdle">
								<?php
								foreach($pagicnation as $item){
								
								include('nambe.php');
				
								}
								
		?>								
								
							
						<div class="paginationa">
											<ul class="pagination">
												<li><a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"> Предыдущая </a></li>
												<li><a href="?pageno=1">1</a></li>
												<li><a href="?pageno=2">2</a></li>
												<li><a href="?pageno=3">3</a></li>
												<li><a href="<?php if($pageno >= 3){echo '#';} else{echo "?pageno=".($pageno + 1);} ?>"> Следующая </a></li>
											</ul>	
								</div>	
							</div>
						</div>	
						