select 
	u.idUsuario AS idUsuario,
	a.tbEstado,
	u.nombre AS nombre,
	p.idApuesta AS idApuesta,
	sum(p.puntos) AS puntos 

from 

	(
	select
	p.idPartido,
	ad.idApuesta,
	case
		when ad.golesEquipo1 = p.golesEquipo1 and ad.golesEquipo2 = p.golesEquipo2 	then 3
		when p.golesEquipo1 = p.golesEquipo1 and ad.golesEquipo2 = ad.golesEquipo2 and ad.golesEquipo2 <> p.golesEquipo2 then 1
		when p.golesEquipo1 > p.golesEquipo2 and ad.golesEquipo1 > ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
		when p.golesEquipo1 < p.golesEquipo2 and ad.golesEquipo1 < ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
		when isnull(p.golesEquipo1) then NULL
	  else 0
	end AS puntos
	from partido p inner join apuestadetalle ad on ad.idPartido = p.idPartido
	) p 

	inner join apuesta a on a.idApuesta = p.idApuesta 
	inner join usuario u on u.idUsuario = a.idUsuario 

group by p.idApuesta

