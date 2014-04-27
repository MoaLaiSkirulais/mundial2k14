<?php

class User
{

	public $username;
	public $idApp;
	public $hash;

	function User(){
	
		$this->username=null;
		$this->idApp=null;
		$this->hash=null;
		
	}
	
	//----------------
		
	function loadByHash($hash){
	
		$query="select * from usuario u where u.hash='" . $hash . "'";
		//echo "<br>--" . $query;
		$result=mysql_query($query) or die(mysql_error());
		$num=mysql_numrows($result);		
		if ($num==0){return -1;}
		
		$this->idApp=mysql_result($result, 0, "idApp");
		$this->username=mysql_result($result, 0, "nombre");
		$this->hash=mysql_result($result, 0, "hash");
	
	}
	
}
?>
