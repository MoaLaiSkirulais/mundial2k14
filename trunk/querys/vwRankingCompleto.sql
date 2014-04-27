select 

	a.tbEstado,
	a.idApuesta AS idApuesta,
	f.idFicha,
	u.idUsuario,
	u.nombre,
	r1.puntos + r1.puntosXP as puntos

from 

apuesta a 
inner join usuario u on u.idUsuario = a.idUsuario 
inner join 

(
	select
	ad.idApuesta,
	sum(case
	when ad.golesEquipo1 = p.golesEquipo1 and ad.golesEquipo2 = p.golesEquipo2 then 3
	when p.golesEquipo1 = p.golesEquipo2 and ad.golesEquipo1 = ad.golesEquipo2 and ad.golesEquipo2 <> p.golesEquipo2 then 1
	when p.golesEquipo1 > p.golesEquipo2 and ad.golesEquipo1 > ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
	when p.golesEquipo1 < p.golesEquipo2 and ad.golesEquipo1 < ad.golesEquipo2 and (ad.golesEquipo2 <> p.golesEquipo2 or ad.golesEquipo1 <> p.golesEquipo1) then 1
	when isnull(p.golesEquipo1) then 0
	else 0
	end) AS puntos,

	sum(case 
	when ((p.golesEquipo1 - p.golesEquipo2) = (ad.golesEquipo1 - ad.golesEquipo2)) and (p.golesEquipo1 <> p.golesEquipo2) and (ad.golesEquipo1 <> p.golesEquipo1) then 1
	else 0 end) AS puntosXP

	from partido p inner join apuestadetalle ad on ad.idPartido = p.idPartido 
	where 1=1
	group by ad.idApuesta
) r1 on a.idApuesta=r1.idApuesta


left join ficha f on f.idApuesta=a.idApuesta