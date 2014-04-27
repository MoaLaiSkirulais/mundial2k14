<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/local/Local.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/system/utilesDb.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/system/SysLayout.php');

class SysController
{

	public $sysLayout;
	public $ui;
	public $msg;
	public $hash;

	function SysController(){
		$this->ui=null;
		$this->sysLayout=new SysLayout();
		$this->msg="";
		$this->hash="";
		//$this->SITE_BASE="http://www.moalais.com.ar/sites/mundial2k10/";
	}
	
	//-------------------------

	public function start(){

		$this->initDb();
		//$this->sysLayout->header();

	}

	//-------------------------

	public function setHash($hash){
		$_SESSION["hash"]=$hash;
	}

	//-------------------------

	public function getHash(){
		if (isset($_SESSION["hash"])){
			return $_SESSION["hash"];
		}else{ 
			return "";
		}	
	}

	//-------------------------

	public function end(){
		//$this->sysLayout->footer();
	}

	//-------------------------

	public function initDb(){
	
		$local=new Local();
		mysql_connect($local->getServer(), $local->getUser(), $local->getPassword());
		@mysql_select_db($local->getDbName()) or die( mysql_error());

	}

	//-------------------------

	public function checkLogin(){

		if (!isset($_SESSION["idUsuario"])) {
			if ($tbSeccion!="login")
				header("location:login.php");
		}

	}

	//-------------------------

	function getUserInfo($idUsuario){

		$query="select * from usuario where idUsuario=" . $idUsuario;
		$result=mysql_query($query);
		if (mysql_numrows($result)==1)
			$nombre=mysql_result($result, 0, "nombre");
		else
			$nombre="usuario no valido";

		return "usuario:". $nombre;
	}

	//-------------------------

	public function formatDateTime($keDateTime){

		$arr=explode(" ", $keDateTime);
		$dFecha = explode("-", $arr[0]);
		$anio=$dFecha[0]; $mes=$dFecha[1]; $dia=$dFecha[2];
		$dHora = explode(":", $arr[1]);
		$hora=$dHora[0]; $minutos=$dHora[1];
		$str=$dia . "/" . $mes . "/" . $anio ." " . $hora . ":" . $minutos;
		
		return $str;
	}
	
	//-------------------------

	public function formatShortDate($keDateTime){

		$arr=explode(" ", $keDateTime);
		$dFecha = explode("-", $arr[0]);
		$anio=$dFecha[0]; $mes=$dFecha[1]; $dia=$dFecha[2];
		$dHora = explode(":", $arr[1]);
		$hora=$dHora[0]; $minutos=$dHora[1];
		$str=$dia . "/" . $mes . "/" . $anio;
		
		return $str;
	}
	
	//-------------------------

	public function formatDayDateTime($keDateTime){
		
		$arr=explode(" ", $keDateTime);
		
		$dFecha = explode("-", $arr[0]);
		$anio=$dFecha[0]; 
		$mes=$dFecha[1]; 
		$dia=$dFecha[2];
		
		$dHora = explode(":", $arr[1]);
		$hora=$dHora[0]; 
		$minutos=$dHora[1];
		
		//$str=$dia . "/" . $mes . "/" . $anio ." " . $hora . ":" . $minutos;
		$str=$dia . "/" . $mes ." " . $hora . ":" . $minutos;
		
		$dias=array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
		$diaSemana=date("N", mktime(0, 0, 0, $mes, $dia, $anio));
		$diaSemana=$dias[$diaSemana-1];
		$str=$diaSemana . " " . $str;
		//echo "<p>" . ;
		
		return $str;
	}

	//-------------------------

	public function validaUsuarioApuesta($idUsuario, $idApuesta){

		if ($idApuesta==0) 
			return true;

		if ($_SESSION["idUsuario"]==1) 
			return true;
		
		$sql="select * from apuesta where idApuesta=" . $idApuesta . " and idUsuario=" . $idUsuario;
		$num=mysql_numrows(mysql_query($sql));
		if ($num==1)
			return true;
		else{
			if ($tbSeccion!="login")
				return false;
				//header("location:/CA2007/login.php");
		}
	}

	//-------------------------

	public function mkFin(){

		 global $mkFin;
		 return $mkFin;
	}

}?>