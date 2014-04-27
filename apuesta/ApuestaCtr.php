<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/apuesta/ApuestaMdl.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/apuesta/ApuestaUI.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/apuesta/ApuestaViewUI.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/system/GenericUI.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/apuesta/UserMdl.php');

class ApuestaCtr
{

	function ApuestaCtr(){

	}
	
	//------------------------------------------------------------------------------------------------------------------------------------------------
	
	function control(){
	
		global $sysController;
	
		if (isset($_POST["do"])){
			$do=$_POST["do"];
		}else{
			if (isset($_GET["do"])){
				$do=$_GET["do"];
			}else{
				$do="fixture";
			}
		}
		
		//echo "<br>--" . $sysController->getHash();
		if (isset($_GET["hash"])){
			$sysController->setHash($_GET["hash"]);
		}
		
		//echo "<br>--" . $do;
		
		if ($do=="fixture")
			$this->fixture();
			
		if ($do=="edit")
			$this->editApuesta();
			
		if ($do=="view")
			$this->viewApuesta();

		if ($do=="save")
			$this->saveApuesta();

	}
	
	//------------------------------------------------------------------------------------------------------------------------------------------------
	
	function fixture(){
		
		global $sysController;
		
		$user=new User();
		$res=$user->loadByHash($sysController->getHash());
		
		if ($res!=0){
			
			$ui=new GenericUI();
			$sysController->msg="<h3 style='margin-bottom:400px'>Solicita un link valido para participar o bien utiliza el que te fue entregado.</h3>";
			$sysController->ui=$ui;	
			return;
			
		}

		$sysController->idApp=$user->idApp;
		$sysController->msg="<h1>Fixture</h1>";
	
		$apuesta=new Apuesta();
		$apuesta->loadByUsername("fixture");
		$apuesta->modFixture=" style='display:none' ";
		
		$ui=new ApuestaUI();
		$ui->data=$apuesta;
		$sysController->ui=$ui;

	}
	
	//------------------------------------------------------------------------------------------------------------------------------------------------
	
	function editApuesta(){
		
		global $sysController;
		
		$user=new User();
		$res=$user->loadByHash($sysController->getHash());
		
		if ($res!=0){
			
			$ui=new GenericUI();
			$sysController->msg="<h3 style='margin-bottom:400px'>Solicita un link valido para participar o bien utiliza el que te fue entregado.</h3>";
			$sysController->ui=$ui;
			return;
		} 
				
		$sysController->idApp=$user->idApp;
		
		$apuesta=new Apuesta();
		$apuesta->loadByUsername($user->username);
		
		//tbEstado check
		if ($apuesta->tbEstado!="A"){
		
			$apuesta->modApuestaAbierta=" style='display:none' ";
			$sysController->msg="<h1>Apuesta - Bienvenido " . $apuesta->username . "!!</h1><br>
								<h3 style='margin-bottom:10px'>La apuesta esta Cerrada.<br>Espere al comienzo del torneo.</h3>";
			
		} else {
				
			$apuesta->modApuestaCerrada=" style='display:none' ";
			$sysController->msg="<h1>Apuesta - Bienvenido " . $apuesta->username . "!!</h1><br>
								Una vez que guardes la apuesta no podes modificarla. El torneo empieza un dia antes del mundial. En ese momento va a publicar el ranking.";
			
		}
		
		$ui=new ApuestaUI();
		$ui->data=$apuesta;
		$sysController->ui=$ui;
	}
	
	//------------------------------------------------------------------------------------------------------------------------------------------------
	
	function viewApuesta(){
		
		global $sysController;
		
		$user=new User();
		$res=$user->loadByHash($sysController->getHash());
		
		if ($res!=0){
			
			$ui=new GenericUI();
			$sysController->msg="<h3 style='margin-bottom:400px'>Solicita un link valido para participar o bien utiliza el que te fue entregado.</h3>";
			$sysController->ui=$ui;
			return;
		} 
				
		$sysController->idApp=$user->idApp;
		
		//load
		if (isset($_GET["username"])){
			$username=$_GET["username"];
		} else {
			echo "<br>username?";
			exit(); 
		}
		
		$apuesta=new Apuesta();
		$apuesta->loadByUsername($username);
		$apuesta->protectView();

		$sysController->msg="<h1>Apuesta de " . $apuesta->username . "!!</h1><br>";

		$ui=new ApuestaViewUI();
		$ui->data=$apuesta;
		$sysController->ui=$ui;

	}
	
	//------------------------------------------------------------------------------------------------------------------------------------------------

	function saveApuesta(){
		
		//echo "<br>--saveApuesta";
		global $sysController;

		//hash check
		$user=new User();
		$res=$user->loadByHash($sysController->getHash());
		if ($res!=0){
			echo "<br>Invalid hash";
			exit(); 
		}
		
		//save
		$apuesta=new Apuesta();
		$res=$apuesta->loadByUsername($user->username);
		
		$arrParam=array();		
		foreach ($_POST["golesEquipo1"] as $key => $value){

			$golesEquipo1=$_POST["golesEquipo1"][$key]; 
			$golesEquipo2=$_POST["golesEquipo2"][$key]; 
			$idPartido=$key;
			
			$arrParam[]=array("idPartido" => $key, 
				"golesEquipo1" => $_POST["golesEquipo1"][$key], 
				"golesEquipo2" => $_POST["golesEquipo2"][$key]);
			
		}
		
		//echo "<br>" . $apuesta->tbEstado;
		//if ($apuesta->tbEstado=="A"){ //control de closed
			$res=$apuesta->save($arrParam);
		//}
		
		$this->editApuesta(); //esto pq no tengo sysMessage de session

	}

}
?>
