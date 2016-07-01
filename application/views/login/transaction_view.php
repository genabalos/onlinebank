
		<div class="container" style="width:50%; background-color: #f7f8f3;">
			
				
				<table class="table table-hover table-sm">
				<?php
				if ($query->result()){
				foreach($query->result() as $row){ ?>
					<tr>
						<td> 
							<center>
								<?php echo $row->history; ?>
							</center>
						</td>
					</tr>
				<?php }
				}else{?>
					<center>
						<?php echo $history; ?>
					</center>
				<?php } ?>
				
				
				</table>
		</div>
		
		<div class="container" style="width:50%; background-color: #f7f8f3;">
			<center>
				<?php echo $pagination; ?>
			</center>
		</div>
	
	
