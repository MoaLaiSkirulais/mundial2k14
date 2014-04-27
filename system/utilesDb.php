<?php 
//$root='c:/wamp/www/sites/mundial2k10/';
$root=$_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/';

$sqlInterno="select u.idUsuario, a.idApuesta,a.fecha ,u.nombre, a.tbEstado, f.idFicha from apuesta a inner join usuario u on u.idUsuario = a.idUsuario left join ficha f on f.idApuesta=a.idApuesta and f.tbEstado='A'";
$vwApuesta=" (" . $sqlInterno . ") q1";

//-------------------------

$vwUsuario= file_get_contents($root . "/querys/vwUsuario.sql", False);
$vwUsuario=" (" . $vwUsuario . ") q1 ";

//-------------------------

$vwRankingCompleto= file_get_contents($root . "/querys/vwRankingCompleto.sql", False);
$vwRankingCompleto=" (" . $vwRankingCompleto. ") q1 ";

//-------------------------

$sqlInterno="select `p`.`idPartido` AS `idpartido`,`p`.`fecha` AS `fecha`,`e1`.`nombre` AS `nombre1`,`e2`.`nombre` AS `nombre2`,`p`.`golesEquipo1` AS `golesEquipo1`,`p`.`golesEquipo2` AS `golesEquipo2`, `e1`.`nombre` AS `apodo1`,`e2`.`nombre` AS `apodo2`, 1 as ronda, p.mkBazan from ((`partido` `p` join `equipo` `e1` on((`e1`.`idEquipo` = `p`.`idEquipo1`))) join `equipo` `e2` on((`e2`.`idEquipo` = `p`.`idEquipo2`)))";
$vwPartido=" (" . $sqlInterno . ") q1";

//-------------------------

$vwApuestaPromedio= file_get_contents($root . "/querys/vwApuestaPromedio.sql", False);
$vwApuestaPromedio=" (" . $vwApuestaPromedio . ") q1 ";

//-------------------------

$sqlInterno="select `a`.`idUsuario` AS `idUsuario`,`p`.`idPartido` AS `idPartido`,`ad`.`idApuesta` AS `idApuesta`,(case when ((`ad`.`golesEquipo1` = `p`.`golesEquipo1`) and (`ad`.`golesEquipo2` = `p`.`golesEquipo2`)) then 3 when ((`p`.`golesEquipo1` = `p`.`golesEquipo1`) and (`ad`.`golesEquipo2` = `ad`.`golesEquipo2`) and (`ad`.`golesEquipo2` <> `p`.`golesEquipo2`)) then 1 when ((`p`.`golesEquipo1` > `p`.`golesEquipo2`) and (`ad`.`golesEquipo1` > `ad`.`golesEquipo2`) and ((`ad`.`golesEquipo2` <> `p`.`golesEquipo2`) or (`ad`.`golesEquipo1` <> `p`.`golesEquipo1`))) then 1 when ((`p`.`golesEquipo1` < `p`.`golesEquipo2`) and (`ad`.`golesEquipo1` < `ad`.`golesEquipo2`) and ((`ad`.`golesEquipo2` <> `p`.`golesEquipo2`) or (`ad`.`golesEquipo1` <> `p`.`golesEquipo1`))) then 1 when isnull(`p`.`golesEquipo1`) then NULL else 0 end) AS `puntos` from ((`partido` `p` join `apuestadetalle` `ad` on((`ad`.`idPartido` = `p`.`idPartido`))) join `apuesta` `a` on((`a`.`idApuesta` = `ad`.`idApuesta`)))";
$vwPuntos=" (" . $sqlInterno . ") ";

//-------------------------

$vwRanking= file_get_contents($root . "/querys/vwRanking.sql", False);
$vwRanking=" (" . $vwRanking . ") q1 ";

//-------------------------

$sqlInterno="select `a`.`idApuesta` AS `idApuesta`,`p`.`idPartido` AS `idPartido`,`p`.`fecha` AS `fecha`,`p`.`idEquipo1` AS `idEquipo1`,`p`.`idEquipo2` AS `idEquipo2`,`p`.`golesEquipo1` AS `golesFinalEquipo1`,`p`.`golesEquipo2` AS `golesFinalEquipo2`,`ad`.`golesEquipo1` AS `golesEquipo1`,`ad`.`golesEquipo2` AS `golesEquipo2`,`e1`.`pais` AS `pais1`,`e2`.`pais` AS `pais2` from ((((`apuesta` `a` join `apuestadetalle` `ad` on((`a`.`idApuesta` = `ad`.`idApuesta`))) join `partido` `p` on((`p`.`idPartido` = `ad`.`idPartido`))) join `equipo` `e1` on((`e1`.`idEquipo` = `p`.`idEquipo1`))) join `equipo` `e2` on((`e2`.`idEquipo` = `p`.`idEquipo2`)))";
$vwApuestaDetalle=" (" . $sqlInterno . ") ";

//-------------------------

$sqlInterno=
"select `a`.`idApuesta` AS `idApuesta`,`p`.`idPartido` AS `idPartido`,`p`.`fecha` AS `fecha`,`p`.`idEquipo1` AS `idEquipo1`,`p`.`idEquipo2` AS `idEquipo2`,`p`.`golesEquipo1` AS `golesFinalEquipo1`,`p`.`golesEquipo2` AS `golesFinalEquipo2`,`ad`.`golesEquipo1` AS `golesEquipo1`,`ad`.`golesEquipo2` AS `golesEquipo2`,`e1`.`pais` AS `pais1`,`e2`.`pais` AS `pais2`,(case when ((`ad`.`golesEquipo1` = `p`.`golesEquipo1`) and (`ad`.`golesEquipo2` = `p`.`golesEquipo2`)) then 3 when ((`p`.`golesEquipo1` = `p`.`golesEquipo1`) and (`ad`.`golesEquipo2` = `ad`.`golesEquipo2`) and (`ad`.`golesEquipo2` <> `p`.`golesEquipo2`)) then 1 when ((`p`.`golesEquipo1` > `p`.`golesEquipo2`) and (`ad`.`golesEquipo1` > `ad`.`golesEquipo2`) and ((`ad`.`golesEquipo2` <> `p`.`golesEquipo2`) or (`ad`.`golesEquipo1` <> `p`.`golesEquipo1`))) then 1 when ((`p`.`golesEquipo1` < `p`.`golesEquipo2`) and (`ad`.`golesEquipo1` < `ad`.`golesEquipo2`) and ((`ad`.`golesEquipo2` <> `p`.`golesEquipo2`) or (`ad`.`golesEquipo1` <> `p`.`golesEquipo1`))) then 1 when isnull(`p`.`golesEquipo1`) then NULL else 0 end) AS `puntos` from ((((`apuesta` `a` join `apuestadetalle` `ad` on((`a`.`idApuesta` = `ad`.`idApuesta`))) join `partido` `p` on((`p`.`idPartido` = `ad`.`idPartido`))) join `equipo` `e1` on((`e1`.`idEquipo` = `p`.`idEquipo1`))) join `equipo` `e2` on((`e2`.`idEquipo` = `p`.`idEquipo2`)))";
//$vwApuestaDetallePuntos=" (" . $sqlInterno . ") q1";

//-------------------------

$vwApuestaDetallePuntos= file_get_contents($root . "/querys/vwApuestaDetallePuntos.sql", False);
$vwApuestaDetallePuntos=" (" . $vwApuestaDetallePuntos . ") q1 ";

//-------------------------

function spNuevaApuesta($idUsuario){

	$sql="select count(*) as cantidad from apuesta where idUsuario=$idUsuario";
	$result=mysql_query($sql) or die("mal");
	$cantidadApuestas=mysql_result($result, 0, "cantidad");

	if ($cantidadApuestas>=2){
		return;
	}

	$sql="insert into apuesta(idUsuario, fecha, tbEstado) values($idUsuario, now(), 'P')";
	mysql_query($sql) or die(mysql_error());
	$sql="select max(idApuesta) from apuesta";
	$result=mysql_query($sql) or die(mysql_error());
	$max=mysql_result($result,0,0);
	$sql="insert into apuestadetalle(idApuesta, idPartido) select $max as idApuesta, idPartido from partido";
	mysql_query($sql) or die(mysql_error());
}

//-------------------------

function spFichaApuesta($idUsuario, $idApuesta){

	//verifica q el usuario sea el dueño de la apuesta
	$sql="select * from apuesta a where a.idApuesta=$idApuesta and a.idUsuario=$idUsuario";
	$result=mysql_query($sql) or die(mysql_error());
	$num=mysql_numrows($result);
	if ($num==0){
		echo "No corresponde idUsuario <--> idApuesta ;D";
		return;
	}

	//determina liga o desliga
	$sql="select * from ficha f where f.idApuesta=$idApuesta";
	$result=mysql_query($sql) or die(mysql_error());
	$num=mysql_numrows($result);

	if ($num==0){ //liga
		
		//obtiene ficha disponible
		$sql="select * from ficha f where f.idUsuario=$idUsuario and isnull(f.idApuesta)";
		$result2=mysql_query($sql) or die(mysql_error());
		$num2=mysql_numrows($result2);

		if ($num2>0){ //liga
			$ficha=mysql_result($result2,0,"idFicha");
			$sql="update ficha set idApuesta=$idApuesta where idFicha=$ficha";
			mysql_query($sql) or die(mysql_error());
		}
	}

	if ($num==1){ //desliga
		$sql="update ficha set idApuesta=NULL where idApuesta=$idApuesta";
		//echo "<br>" . $sql . "<br>";
		mysql_query($sql) or die(mysql_error());
	}
}
?>
