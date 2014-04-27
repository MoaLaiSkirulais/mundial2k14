SELECT
	u.idUsuario,
	u.nombre,
	(case when isnull(q1.apuestas) then 0 else q1.apuestas end) AS apuestas

FROM usuario u

left join

(
	SELECT a.idUsuario, count(*) as apuestas
	FROM usuario u
	left join apuesta a on a.idUsuario=u.idUsuario and a.tbEstado='P'
	group by a.idUsuario
) q1 on u.idUsuario=q1.idUsuario

