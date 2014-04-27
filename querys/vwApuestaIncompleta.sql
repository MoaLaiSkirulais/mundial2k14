select

a.idApuesta, 
a.idUsuario, 
a.tbEstado,
u.nombre, 
totalDetalleNull

from apuesta a

left join
	(
	select	idApuesta, count(*) as totalDetalleNull
	from apuestadetalle a
	where isnull(golesEquipo1) or isnull(golesEquipo2)
	group by idApuesta
	) q1

on q1.idApuesta=a.idApuesta
inner join usuario u on u.idUsuario=a.idUsuario
where tbEstado='P'

order by idUsuario