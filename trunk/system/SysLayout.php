<?php

class SysLayout
{

	function SysLayout(){
	}
	
	//-------------------------

	public function header(){
		global $sysController;
		include $_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/template/header.php';
		
	}
	
	//-------------------------

	public function footer(){
		global $sysController;
		include $_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/template/footer.php';
	}
	
	//-------------------------
	
	public function awardPanel(){?>
	
		<div id="powerUps">
			<h3>Puntos</h3>
			<table border=0 cellpadding=10>
				<tr>
					<td colspan=3>
						Acierta resultado exacto => +3<br>
						Acierta resultado y diferencia de goles => +2<br>
						Acierta resultado inexacto => +1
					</td>
				</tr>
			</table>
			
			<h3>PowerUps</h3>
			<table border=0 cellpadding=2>
			
				<tr>
					<td><img src="imgs/coke.gif"></img></td>
					<td class="fecha">Coke (15)</td><td>Se activa si acierta => +2</td>
				</tr>
				
				<tr>
					<td><img src="imgs/bazanSmall.gif"></img></td>
					<td class="fecha">Bazan (15)</td><td>Se activa si erra => -2</td>
				</tr>
							
				<tr>
					<td><img src="imgs/vieja.gif"></img></td>
					<td class="fecha">Vieja (4)</td><td>Se activa siempre: Acierta => x3 | Erra => x(-3)</td>
				</tr>
				
				<tr>
					<td><img src="imgs/motoraton.gif"></img></td>
					<td class="fecha">Laucha (2)</td><td>Se activa si acierta => x4</td>
				</tr>
				
				<tr>
					<td><img src="imgs/excellent.gif"></img></td>
					<td class="fecha">Excellent (3)</td><td>Si acierta los 3 partidos => +7</td>
				</tr>
				
				<tr>
					<td><img src="imgs/amargo.gif"></img></td>
					<td class="fecha">Amargo (3)</td><td>Si erra los 3 partidos => -7</td>
				</tr>
				
				<tr>
					<td><img src="imgs/triste.gif"></img></td>
					<td class="fecha">Triste (7)</td><td>Si acierta 0 a 0 => +5</td>
				</tr>
				
				<tr>
					<td><img src="imgs/hyena.gif"></img></td>
					<td class="fecha">Hiena (3)</td><td>Apuesta que no gana Brasil y acierta => +7. Si erra => -3</td>
				</tr>
				
			</table>
		</div>	
	<?php 
	}
}?>