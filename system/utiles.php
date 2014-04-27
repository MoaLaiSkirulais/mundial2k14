<?php
include 'config.php';
include 'local/localSettings.php';
include 'utilesDb.php';

//---------------------------------------------
// connecta a la db siempre con admin user
//---------------------------------------------
//mysql_connect("localhost", "root", "");
//@mysql_select_db("beijing2k8") or die( mysql_error());

mysql_connect("localhost", "wi720494", "70691706");
@mysql_select_db("wi720494_beijing2k8") or die( mysql_error());

//mysql_connect($mySql_servername, $mySql_username, $mySql_password);
//@mysql_select_db($mySql_database) or die( mysql_error());

//---------------------------------------------
// inicia-resume session - valida user login 
//---------------------------------------------
session_start();
function login(){
	if (!isset($_SESSION["idUsuario"])) {
		if ($tbSeccion!="login")
			header("location:login.php");
	}
}

//---------------------------------------------
// inicia globales
//---------------------------------------------


//------------------------------------
//functions
//------------------------------------
function myHeader(){?>

	<style>	
		body {font-size:10px; font-family:verdana; background-color:dimmgray;}
		td {font-size:10px; font-family:verdana}
		.tbl1 {border-right:1px solid gray; background-color:#B64C4D; font-weight:bold; color:white;}

		td.tdH {border-top:1px solid gray; background-color:#ED2E1C; font-weight:bold; color:white;}
		td.tdT {border-top:0px solid gray; background-color:dimmgray ; font-weight:bold; color:white;}
		td.td1 {border-top:1px solid gray; background-color:white;}
		td.td2 {border-top:1px solid gray; background-color:#F9F9F9;}
		td.td3 {border-top:1px solid gray; background-color: #F71670; color:white }
		td.td3A {border-top:1px solid gray; background-color:#F9F9F9;  font-weight:bold;}
		td.td4 {border-top:1px solid gray; background-color: #F9F9F9; }

		.searchBox
		{
			Border-Right: #003399 1px Solid; Border-Top: #003399 1px Solid; Font-Size: 11px; Border-Left: #003399 1px Solid; Width: 130px; Color: #003399; Border-Bottom: #003399 1px Solid; Font-Family: Tahoma, Helvetica, Arial, Verdana, Sans-Serif; Height: 19px; Background-Color: #Ffffff
		}
	</style>

	<title>A p e r t u r a   2 0 0 7   -   A F A </title>
	<body style="margin:0px">
	<table class=tbl1 width=700px  border=0 cellpadding=0 cellspacing=0 >
		<tr>
			<td class=tdH colspan=2>
				<table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td>
							<table>
								<tr>
									<td class=tdH style="border:0px; background-color:#F9F9F9; color:black">
									<img src="imgs/logo.gif"></img>									
									</td>
								</tr>
							</table>
						<td>
					</tr>
					<tr>
						<td align=right><table><tr><td class=tdH style="border:0px"><?php links()?></td></tr></table>
					</tr>
				</table>
			</td>
		</tr>						
		<tr>
			<td class=td3 colspan=2>
				<table width=100%>
					<tr>
						<td>
							<table>
								<tr>
									<td style="color:white">
										<!--a style="color:white" href="index.html">Home</a>  
										| <a style="color:white" href="listaApuesta.php?accion=modi">Mis Jugadas</a>  
										| <a style="color:white" href="rankingCompletoXP.php">Ranking</a> 
										| <a style="color:white" href="fixture.php">Fixture</a> 
										| <a style="color:white" href="reglamento.php">Reglamento</a--> 
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table align=right >
								<tr>
									<!--td align=right>
										<?php if (isset($_SESSION["nombre"])){?>
											<a style="color:white" href="logout.php">Logout <?php echo $_SESSION["nombre"]?></a>	
										<?php }
										else{?>
											<a style="color:white" href="login.php">Login</a> 
										<?php }?>
									</td-->
								</tr>	
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr height=10px><td colspan=2 class=tdT></td></tr>
		<tr>
			<td width=600px valign=top class=tdT>
	<?php 
}

function userInfo($idUsuario){
	$query="select * from usuario where idUsuario=" . $idUsuario;
	$result=mysql_query($query);
	if (mysql_numrows($result)==1)
		$nombre=mysql_result($result,0,"nombre");
	else
		$nombre="usuario no valido";

	echo "usuario:". $nombre;
}

function formatoDateTime($keDateTime){

	$arr=explode(" ", $keDateTime);
	$dFecha = explode("-", $arr[0]);
	$anio=$dFecha[0]; $mes=$dFecha[1]; $dia=$dFecha[2];
	$dHora = explode(":", $arr[1]);
	$hora=$dHora[0]; $minutos=$dHora[1];
	$str=$dia . "/" . $mes . "/" . $anio ." " . $hora . ":" . $minutos;
	return $str;
}

function strEstadoApuestaOld($keEstado){

	if ($keEstado='P') return "PENDIENTE PAGO";
	if ($keEstado='A') return "PAGADO";
	if ($keEstado='C') return "CANCELADO";

}

function strEstadoApuesta($idFicha){

	if (is_null($idFicha)) 
		return "POR EL HONOR";
	else
		return "<b>POR EL POZO!</b>";
}

function imgEstadoApuesta($idFicha){

	if (is_null($idFicha)) 
		return "imgs/raton.jpg";
	else
		return "imgs/gold.jpg";
}

function validaUsuarioApuesta($idUsuario, $idApuesta){

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


function validaRonda($idPartido, $rondaCorte){

	if ($_SESSION["idUsuario"]==1)
		return true;

	$sql="select * from partido where idPartido=" . $idPartido . " and ronda>" . $rondaCorte;
	$num=mysql_numrows(mysql_query($sql));
	if ($num==1)
		return true;
	else{
		if ($tbSeccion!="login")
			return false;
			//header("location:/CA2007/login.php");
	}
}

function mkFin(){
	 global $mkFin;
	 return $mkFin;
}

function myFooter(){?>
			</td>
			<td valign=top width=100px class=td3 >
				<?php awards();?>
			</td>
		</tr>
		
		<tr>
			<td class=tdH style="background-color:#F9F9F9; color:black" colspan=2><br>
				<table border=1>
					<tr><td><img src="imgs/coke.gif" style="border:1px solid gray"></img></td><td><b>Coke:</b> se activa si acierta => +2</td></tr>
					<tr><td><img src="imgs/bazanSmall.gif" style="border:1px solid gray"></img></td><td><b>Bazán:</b> se activa si erra -> -2</td></tr>
					<tr><td><img src="imgs/vieja.gif" style="border:1px solid gray"></img></td><td><b>Vieja:</b> se activa siempre: acierta => x3 | erra => x(-3)</td></tr>
					<tr><td><img src="imgs/motoraton.gif" style="border:1px solid gray"></img></td><td><b>Laucha:</b> se activa si acierta => x5</td></tr>
					<tr><td><img src="imgs/excellent.gif" style="border:1px solid gray"></img></td><td><b>Excellent:</b> Si acierta los 3 => +6</td></tr>
					<tr><td><img src="imgs/amargo.gif" style="border:1px solid gray"></img></td><td><b>Amargo:</b> Si erra los 3 => -6</td></tr>
					<tr><td><img src="imgs/hyena.gif" style="border:1px solid gray"></img></td><td><b>Hiena:</b> Solo en Basquet, si apuesta derrota de USA y acierta => +7, pero si erra => -3</td></tr>
					<tr><td><img src="imgs/usa.gif" style="border:1px solid gray"></img></td><td><b>Wallaby:</b> Ganador de liga wallaby => +7</td></tr>
				</table><br>
				<table border=1>
					<tr><td colspan=2 >Futbol: acierta exacto=>+3</td></tr>
					<tr><td colspan=2>Futbol: acierta dif=>+2</td></tr>
					<tr><td colspan=2>Futbol: acierta resultado=>+1</td></tr>
					<tr><td colspan=2>Basquet: acierta resultado=>+2</td></tr>
					<tr><td colspan=2>WPolo: acierta resultado=>+1</td></tr>
					<tr><td colspan=2><b>Maximo sin Bonus:</b> 252</td></tr>
					<tr><td colspan=2><b>Maximo por Bonus Positivo:</b> +75</td></tr>
					<tr><td colspan=2><b>Maxima por Bonus Negativo:</b> -59</td></tr>
				</table><br><br>
			</td>
		</tr>
		<tr><td class=tdH colspan=2 align=right><a href="admin.php">-----</a></td></tr><tr>
	</table>
	
	<?php mysql_close();
}

function awards(){?>
		<table width=100%>
			<tr><td style="color:white;">
					<b>AWARDS</b></td></tr>
			<tr>
				<td width="100" height="87" style="color:white">Gran Campeon<br>
					<img src="imgs/nn.jpg" id="img1"></img>

				</td>
			<tr>
			<tr>
				<td width="100" height="87">


				</td>
			<tr>
		</table>	
	
<?php }


function links(){?>

	<table cellpadding=0 cellspacing=0>
		<tr>
			<td style="color:white">
				<a style="color:white" href="http://futbolneto.blog.com">FutbolNeto!</a> | 
				<a style="color:white" href="http://prodemundial.30mb.com/">Prode Mundial 2006</a> |
				<a style="color:white" href="http://ca2007.100webspace.net/">Copa America 2007</a> 
			</td>
		</tr>
	</table>

<?php }?>
