select

a.idApuesta,
a.tbEstado,
a.idUsuario,
u.nombre,
f.idFicha,
q2.puntos,
q2.puntosXP

from 

apuesta a left join

	(
	select 
		q1.idApuesta,
		sum(q1.puntos) AS puntos,
		sum(q1.puntos) + sum(q1.puntosXP) AS puntosXP

	from (
		select
		p.idPartido,
		ad.idApuesta,
		case
			when ad.golesEquipo1 = p.golesEquipo1 and ad.golesEquipo2 = p.golesEquipo2 	then 3
			when p.golesEquipo1 = p.golesEquipo2 and ad.golesEquipo1 = ad.golesEquipo2 and ad.golesEquipo2 <> p.golesEquipo2 then 1
			when p.golesEquipo1 > p.golesEquipo2 and ad.golesEquipo1 > ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
			when p.golesEquipo1 < p.golesEquipo2 and ad.golesEquipo1 < ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
			when isnull(p.golesEquipo1) then NULL
		  else 0
		end AS puntos,
		case 
			when ((p.golesEquipo1 - p.golesEquipo2) = (ad.golesEquipo1 - ad.golesEquipo2)) and (p.golesEquipo1 <> p.golesEquipo2) and (ad.golesEquipo1 <> p.golesEquipo1) then 1
			else 0 
		end AS puntosXP
	
		from partido p 
		inner join apuestadetalle ad on ad.idPartido = p.idPartido
		) q1

	group by q1.idApuesta
	) q2 on a.idApuesta=q2.idApuesta

left join ficha f on f.idApuesta=a.idApuesta
inner join usuario u on u.idUsuario=a.idUsuario
