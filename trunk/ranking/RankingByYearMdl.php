<?php

class RankingByYearItem
{

	public $username;
	public $total;

	function RankingByYearItem(){
		$this->username=null;
		$this->total=null;
	}

}	

//----------------

class RankingByYear
{

	public $list;
		
	function RankingByYear(){
		$this->list=array();
	}
	
	//----------------
	
	function load($idApp){
	
		$query="select * from vwrankinganio order by total desc";
		//echo "<br>--" . $query;
		$result=mysql_query($query) or die(mysql_error());
		$num=mysql_numrows($result);
		
		$i=0; 
		while ($i < $num) {
			
			$aux=new RankingByYearItem(); 
			$aux->username=mysql_result($result, $i, "anio");			
			if ($aux->username==0)
				$aux->username="no";
			$aux->total=mysql_result($result, $i, "total");

			$this->list[]=$aux;			
			$i++;

		}

		return 0;
	}

}

?>
