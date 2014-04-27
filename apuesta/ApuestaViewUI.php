<?php

class ApuestaViewUi
{

	public $data;
	function ApuestaView(){
		$this->data=null;
	}
	
	//----------------

	function display(){

		global $sysController;
		?>
		<script src="apuesta/scripts.js" type="text/javascript"></script>
		
		<div class="titles">
			<?php echo $sysController->msg?>
		</div>

		<span id="external" class="mp3">soldan.mp3</span>
		
		<table id="tblApuesta" cellpadding="2" cellspacing="0" border="0">
			<tr>
				<td></td>
				<td class="equipoL"></td>
				<td class="tdGoles">apuesta</td>
				<td class="tdFinal">final</td>
				<td class="tdPuntos">puntos</td>
				<td class="tdFinal">final</td>
				<td class="tdGoles">apuesta</td>
				<td class="equipo"></td>
				<td class="powerUps"><b>PowerUps</b> (ver al pie)</td>
			</tr>

			<?php foreach ($this->data->partidos as $partido){?>
				
				<?php echo $partido->modNuevaFecha?>
				<tr>
					
					<td class="fecha">							
						<?php echo $partido->fecha?>			
					</td>
						
					<td class="equipoL">
						<?php echo $partido->nombre1?>
						<img class="flagIco" src="imgs/flags/<?php echo $partido->idEquipo1?>.gif"></img>
					</td>

					<td class="tdGoles">
						<span><?php echo $partido->golesEquipo1?></span>
					</td>
						
					<td class="tdFinal">
						<?php echo $partido->golesFinalEquipo1?>
					</td>
					
					<td class="tdPuntos">
						<?php echo $partido->puntos?>
					</td>
					
					<td class="tdFinal">
						<?php echo $partido->golesFinalEquipo2?>
					</td>
						
					<td class="tdGoles">
						<span><?php echo $partido->golesEquipo2?></span>								
					</td>

					<td class="equipo">
						<img class="flagIco" src="imgs/flags/<?php echo $partido->idEquipo2?>.gif"></img>
						<?php echo $partido->nombre2?>							
					</td>

					<td class="powerUps">
						<?php if ($partido->mkCoke==1){?>
							<img class="powerUp" src="imgs/coke.gif" title="COKE: Si acierta el resultado del partido suma dos puntos extras (+2)"/>
						<?php }?>
						<?php if ($partido->mkBazan==1){?>
							<img class="powerUp" src="imgs/bazanSmall.gif" title="BAZAN: Si falla el resultado delpartido resta dos puntos (-2)"></img>
						<?php }?>
						<?php if ($partido->mkVieja==1){?>
							<img class="powerUp" src="imgs/vieja.gif" title="VIEJA: Si acierta el resultado del partido, triplica los puntos (x3) Si falla triplica negativo x(-3)"></img>
						<?php }?>
						<?php if ($partido->mkMotoraton==1){?>
							<img class="powerUp" src="imgs/motoraton.gif" title="LAUCHA: Si acierta el resultado del partido, cuadriplica los puntos (x4)"></img></img>
						<?php }?>
						<?php if ($partido->mkExcellent>=1){?>
							<img class="powerUp" src="imgs/excellent.gif" title="EXCELLENT: Si acierta los 3 partidos suma siete puntos extras (+7)"></img>
						<?php }?>
						<?php if ($partido->mkAmargo>=1){?>
							<img class="powerUp" src="imgs/amargo.gif" title="AMARGO: Si falla los 3 partidos resta siete puntos (-7)"></img>
						<?php }?>
						<?php if ($partido->mkUsa>=1){?>
							<img class="powerUp" src="imgs/usa.gif" title="Coke - Si acierta resultado suma dos puntos (+2)"></img>
						<?php }?>
						<?php if ($partido->mkHyena>=1){?>
							<img class="powerUp" src="imgs/hyena.gif" title="HIENA: Apuesta que Brasil pierde o empata, si acierta suma siete (+7). Si erra resta tres (-3)"></img>
						<?php }?>
						<?php if ($partido->mkTriste>=1){?>
							<img class="powerUp" src="imgs/triste.gif" title="TRISTE: Apuesta a empate 0 a 0, si acierta suma cinco puntos extras (+5)"></img>
						<?php }?>
					</td>					
				</tr>					
			<?php
			}
		?>
		</table>
			
	<?php
	$sysController->sysLayout->awardPanel();
	}
}?>

