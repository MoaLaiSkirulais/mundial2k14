<?php

class RankingUser
{

	public $username;
	public $total;
	public $order;
	public $img;
	public $powerUps;
	public $mkposibleamargo;
	public $mkposibleexcellent;
		
	function RankingUser(){
		$this->username=null;
		$this->total=null;
		$this->order=null;
		$this->img="";
		$this->powerUps="";
		$this->mkposibleamargo="";
		$this->mkposibleexcellent="";
	}

}	

//----------------

class Ranking
{

	public $list;
		
	function Ranking(){
		$this->list=array();
	}
	
	//----------------
	
	function load($idApp){
	
		$query="select * from vwRanking where idApp='$idApp'";
		//echo "<br>--" . $query;
		$result=mysql_query($query) or die(mysql_error());
		$num=mysql_numrows($result);
		
		$i=0; 
		$totalAnterior=mysql_result($result, 0, "total");; 
		$order=1;
		while ($i < $num) {
			
			$aux=new RankingUser(); 
			$aux->username=mysql_result($result, $i, "nombre");			
			$aux->total=mysql_result($result, $i, "total");
			$aux->mkposibleamargo=mysql_result($result, $i, "mkposibleamargo");
			$aux->mkposibleexcellent=mysql_result($result, $i, "mkposibleexcellent");
			$aux->total=mysql_result($result, $i, "total");
			
			for ($j = 1; $j <= mysql_result($result, $i, "qMotoraton"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/motoraton.gif'/>";
				$aux->powerUps.="<span style='color:#63990D'>L</span>";
			}
			for ($j = 1; $j <= mysql_result($result, $i, "qViejaBuena"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/vieja.gif'/>";
				$aux->powerUps.="<span style='color:#63990D'>V</span>";
			}
			for ($j = 1; $j <= mysql_result($result, $i, "qCoke"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/coke.gif'/>";
				$aux->powerUps.="<span style='color:#63990D'>C</span>";
			}
			for ($j = 1; $j <= mysql_result($result, $i, "qTriste"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/triste.gif'/>";
				$aux->powerUps.="<span style='color:#63990D'>T</span>";
			}
			for ($j = 1; $j <= mysql_result($result, $i, "qBazan"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/bazanSmall.gif'/>";
				$aux->powerUps.="<span style='color:red'>B</span>";
			}
			for ($j = 1; $j <= mysql_result($result, $i, "qViejaMala"); $j++) {
				//$aux->powerUps.="&nbsp;<img src='imgs/smallPUps/viejaMala.gif'/>";
				$aux->powerUps.="<span style='color:red'>V</span>";
			}
			
			/*
			$aux->powerUps=mysql_result($result, $i, "qBazan")
				. mysql_result($result, $i, "qCoke")
				. mysql_result($result, $i, "qViejaBuena")
				. mysql_result($result, $i, "qViejaMala")
				. mysql_result($result, $i, "qMotoraton")
			;
			*/
			
			if ($totalAnterior!=$aux->total){$order=$order+1;}
			$aux->order=$order;
			
			if ($aux->order==1){$aux->img="<img src='imgs/rank1.gif'/>"; }
			if ($aux->order==2){$aux->img="<img src='imgs/rank2.gif'/>"; }
			if ($aux->order==3){$aux->img="<img src='imgs/rank3.gif'/>"; }
			
			if ($aux->mkposibleamargo==1){$aux->mkposibleamargo="<img src='imgs/amargo.gif'/>"; }else{$aux->mkposibleamargo="";}
			if ($aux->mkposibleexcellent==1){$aux->mkposibleexcellent="<img src='imgs/excellent.gif'/>";}else{$aux->mkposibleexcellent="";}
			
			$this->list[]=$aux;			
			$i++;
			
			$totalAnterior=$aux->total;
		}
		
		$lastRank=$order;
		
		//
		$i=0; 
		foreach ($this->list as $item){			
			if ($item->order==$lastRank){$item->img="<img src='imgs/lastRank.gif'/>"; }
		}
		
		
		//print_r ($this->list);		
		return 0;
	}

}

?>
