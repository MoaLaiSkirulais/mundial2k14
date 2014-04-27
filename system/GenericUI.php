<?php

class GenericUi
{

	public $data;
	function GenericUi(){
		$this->data=null;
	}
	
	//----------------

	function display(){

		global $sysController;
		?>
		
		<h3><?php echo $sysController->msg?></h3>
		
	<?php
	}
}?>