<?php

class RankingUi
{

	public $data;
	function RankingUi(){
		$this->data=array();
		$this->data["user"]=null;
		$this->data["users"]=null;
	}
	
	//----------------

	function display(){
	
		global $sysController;
		?>
		<script src="ranking/scripts.js" type="text/javascript"></script>
		
		<div class="titles">
			<?php echo $sysController->msg?>
		</div>
		
		<!--span id="external" class="mp3">jump.mp3</span-->
		
		<!--object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/M9BNoNFKCBI&hl=es_ES&fs=1&autoplay=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/M9BNoNFKCBI&hl=es_ES&fs=1&autoplay=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object><br><br-->
		
		<table id="tblRank" cellpadding=3 cellspacing=0>
			
			<?php 
			//print_r ($this->data["users"]->list);
			foreach ($this->data["users"]->list as $user){?>
				<tr>
				
					<td style='border-bottom:1px solid silver'>
						<?php echo $user->img?>
					</td>					
					<td style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->order?>
					</td>
					<td style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->username?>
					</td>
					<td class="tdPuntos" style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->total?>
					</td>
					<td class="tdPuntos" style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->mkposibleamargo?>
					</td>
					<td class="tdPuntos" style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->mkposibleexcellent?>
					</td>
					<td style='border-bottom:1px solid silver' valign="bottom">
						<a href='apuesta/?do=view&username=<?php echo $user->username?>'>[ver apuesta]</a>
					</td>
					<td class="powerUps" style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->powerUps?>
					</td>
				<tr>	
			<?php }?>

		</table>
	<?php
	}
}?>