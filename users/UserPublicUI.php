<?php

class UserPublicUi
{

	public $data;
	function UserPublicUi(){
		$this->data=array();
		$this->data["user"]=null;
		$this->data["users"]=null;
	}
	
	//----------------

	function display(){
	
		global $sysController;
		?>
		
		<div class="titles">
			<?php echo $sysController->msg?>
		</div>
		
		<div class="titles">
			<h3>Pedile un acceso a cami kabro o dum :3</h3>
		</div>
		
		<table cellpadding=5px cellspacing=0 width="500px">
			<tr>
			<?php
			$i=0;
			foreach ($this->data["users"]->list as $user){
				$i++;
				if (($i % 12)==0) {echo "</tr><tr>";}
				?>
				<td>
					<img style="border:1px solid silver" width="50px" height="50px" 
					src="http://www.egelforum.net/forum/avatars/amigos/<?php echo $user->username?>.gif"
					title="<?php echo $user->username?>"></img>
				</td>
			<?php }?>
			</tr>
		</table>
	<?php
	}
}?>