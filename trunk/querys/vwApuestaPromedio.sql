select

	ad.idPartido, 
	e1.grupo, 
	e1.pais as pais1, 
	e2.pais as pais2, 
	ROUND(FORMAT(avg(ad.golesEquipo1),1)) as avgGolesEquipo1, 
	ROUND(FORMAT(avg(ad.golesEquipo2),1)) as avgGolesEquipo2

from apuestadetalle ad

inner join partido p on ad.idPartido=p.idPartido
inner join equipo e1 on e1.idEquipo=p.idEquipo1
inner join equipo e2 on e2.idEquipo=p.idEquipo2

group by idPartido