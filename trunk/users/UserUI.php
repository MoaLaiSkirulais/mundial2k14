<?php

class UserUi
{

	public $data;
	function UserUi(){
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
				
		<form name="frmUser" method="post">
			<input name="do" value="adduser" type="hidden"><br><br>
			<table >
				<tr>
					<td>
						username
					</td>					
					<td>
						<input name="username" value="<?php echo $this->data["user"]->username?>">
					<td>
					<td>
						<input type="submit" value="Agregar Usuario">			
					</td>
				</tr>
			</table>
			
		</form><br><br>
		
		<div class="titles">
			<h3>Invitados</h3>	
		</div>
		
		<table id="tblUsers" cellpadding=3 cellspacing=0>
			
			<?php 
			//print_r ($this->data["users"]->list);
			foreach ($this->data["users"]->list as $user){?>
				<tr>
					<td style='border-top:1px solid silver'>
						<?php echo $user->username?>
					</td>
					<td style='border-top:1px solid silver'>
						<?php echo $user->tbEstado?>
					</td>
					<td style='border-top:1px solid silver'>	
						<a href="apuesta/?do=edit&hash=<?php echo $user->hash?>">link</a><br>
					</td>
				<tr>	
			<?php }?>

		</table>
	<?php
	}
}?>