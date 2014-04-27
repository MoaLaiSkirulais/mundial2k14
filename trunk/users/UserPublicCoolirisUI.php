<?php

class UserPublicCoolirisUi
{

	public $data;
	function UserPublicCoolirisUi(){
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
			<h3>Estan jugando</h3>	
		</div>
		
		<object id="o" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
		  width="600" height="450">
			<param name="movie" value="http://apps.cooliris.com/embed/cooliris.swf" />
			<param name="allowFullScreen" value="true" />
			<param name="allowScriptAccess" value="always" />
			<param name="flashvars" value="feed=api://www.flickr.com/" />
			<embed type="application/x-shockwave-flash"
			  src="http://apps.cooliris.com/embed/cooliris.swf"
			  flashvars="feed=api://localhost/sites/mundial2k10/users/UsersMedia.php"
			  width="600" 
			  height="450"
			  allowFullScreen="true"
			  allowScriptAccess="always">
			</embed>
		</object>

	<?php
	}
}?>