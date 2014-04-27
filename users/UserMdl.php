<?php

class User
{

	public $username;
	public $hash;
	public $tbEstado;
		
	function User(){
		$this->username=null;
		$this->hash=null;
		$this->tbEstado=null; //P=Pendiente C=Cerrado
	}
	
	//----------------
	
	function load($username){
	
		$query="select * from usuario where nombre='" . $username . "'";
		//echo "<br>--" . $query;
		$result=mysql_query($query) or die(mysql_error());
		$num=mysql_numrows($result);
		
		if ($num==1){
			$this->username=$username;
			$this->hash=mysql_result($result, 0, "hash");
		}
		return 0;
	}

	//----------------
	
	function add($username, $hash){
	
		global $sysController;
	
		$this->load($username);		
		if ($this->username!=null){

			$local=new Local(); 
			$msg="Jugate un prode!\n" . $local->getSiteBase() . "apuesta/?do=edit&hash=" . $this->hash;
			
			$sysController->msg.=
				"<h3>El usuario ya existe, link de acceso:<br>
				<textarea rows=2 cols=70 class='accesoUsuario'>" . $msg . "</textarea>";
		}

		if ($this->username==null){

			$sql="call addUser('" . $username . "')";
			//echo "<br>" . $sql;
			$result=mysql_query($sql) or die(mysql_error());
			$this->load($username);
			
			if ($hash=="wili"){$hash="epson";}
			if ($hash=="superchalo"){$hash="egel";}
			
			$sql="update usuario set idApp='$hash' where nombre='$username'";
			//echo "<br>" . $sql;
			$result=mysql_query($sql);

			$local=new Local(); 
			$msg="Jugate un prode!\n" . $local->getSiteBase() . "apuesta/?do=edit&hash=" . $this->hash;
			
			$sysController->msg.=
				"<h3>Se agrego el usuario, link de acceso:<br>
				<textarea rows=2 cols=70 class='accesoUsuario'>" . $msg . "</textarea>";
			
		}
		return 0;
	}
	
}

//----------------

class Users
{

	public $list;
		
	function Users(){
		$this->list=array();
	}
	
	//----------------
	
	function load($idApp, $tbEstado){
	
		if ($tbEstado==null){
			$tbEstado="'A', 'C', 'P'";
		}else{
			$tbEstado="'" . $tbEstado . "'";
		}

		$query="select * from vwusuario where idApp='$idApp' and tbEstado 
			in ($tbEstado) order by nombre";
		//echo "<br>--" . $query;
		$result=mysql_query($query) or die(mysql_error());
		$num=mysql_numrows($result);
		
		$i=0;
		while ($i < $num) {
			
			$aux=new User(); //parece no generar mucha sobrecarga
			$aux->username=mysql_result($result, $i, "nombre");			
			$aux->hash=mysql_result($result, $i, "hash");
			$aux->tbEstado=mysql_result($result, $i, "tbEstado");
			if ($aux->tbEstado=='P'){$aux->tbEstado='Pendiente';}
			if ($aux->tbEstado=='C'){$aux->tbEstado='Cerrado';}
			if ($aux->tbEstado=='A'){$aux->tbEstado='Abierta';}

			$this->list[]=$aux;
			$i++;
		}
		//print_r ($this->list);		
		return 0;
	}

}

?>
