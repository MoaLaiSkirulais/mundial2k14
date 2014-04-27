<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<base href="<?php $local=new Local(); echo $local->getSiteBase();?>">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
	<title>Prode Mundial 2010</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="template/default.css" rel="stylesheet" type="text/css" />
	<link href="template/layout.css" rel="stylesheet" type="text/css" />
	<link href="template/subLayout.css" rel="stylesheet" type="text/css" />
	
	<style type="text/css">
		<!--
			@import url("template/layout.css");
			@import url("template/subLayout.css");
		-->
	</style>

	<!-- jquery -->
	<script src="template/js/jquery-1.4.2.min.js" type="text/javascript" ></script> 
	
	<!--jmp3 -->	
	<script src="lib/jquery/jmp3/jquery.jmp3.js" type="text/javascript" ></script>
	
	<!--tooltip -->	
	<script src="lib/jquery/jTools/jquery.tools.min.js" type="text/javascript"></script>

</head>

<body class="homepage">
	<div id="header" class="<?php if($sysController->idApp=="epson"){echo "epson";}?>">
	</div>
	<div id="menu">
		<ul>
			<!--li><a href="ranking/" accesskey="1" title="">Ranking</a></li-->
			<li><a href="apuesta/">Fixture</a></li>
			<li><a href="apuesta/?do=edit">Mi apuesta</a></li>
			<?php if($sysController->idApp=="egel"){ ?>
				<li><a href="users/?do=showPlayers">Players</a></li>				
			<?php }?>
			<li><a href="ranking/?do=show">Ranking</a></li>
			<?php if($sysController->idApp=="egel"){ ?>
				<li><a href="ranking/?do=showByYear">Fantasy</a></li>
			<?php }?>			
		</ul>
	</div>

		
	<div id="page-bg" style="border:0px solid blue">
		<div id="page-bgtop" style="border:0px solid green">
			<div id="page" class="container" style="border:0px solid red">				
