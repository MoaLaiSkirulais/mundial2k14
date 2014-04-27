<?php

class RankingByYearUi
{

	public $data;
	function RankingByYearUi(){
		$this->data=array();
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
		
		<span id="rankingByYearMusic" class="mp3">fantasy.mp3</span>
		
		<table id="tblRank" style="width:300px" cellpadding=3 cellspacing=0>
			
			<?php 
			//print_r ($this->data["users"]->list);
			foreach ($this->data["users"]->list as $user){?>
				<tr>

					<td style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->username?>
					</td>
					<td class="tdPuntos" style='border-bottom:1px solid silver' valign="bottom">
						<?php echo $user->total?>
					</td>
				<tr>	
			<?php }?>

		</table>
	<?php
	}
}?>