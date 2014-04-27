SELECT
	u.idUsuario,
	u.nombre,
	(case when isnull(q1.apuestas) then 0 else q1.apuestas end) AS apuestas,
	(case when isnull(q2.apuestasC) then 0 else q2.apuestasC end) AS apuestasC

FROM usuario u

left join

(
	SELECT a.idUsuario, count(*) as apuestas
	FROM usuario u
	left join apuesta a on a.idUsuario=u.idUsuario
	group by a.idUsuario
) q1 on u.idUsuario=q1.idUsuario

left join

(
	SELECT a.idUsuario, count(*) as apuestasC
	FROM usuario u
	left join apuesta a on a.idUsuario=u.idUsuario and a.tbEstado='C'
	group by a.idUsuario
) q2 on u.idUsuario=q2.idUsuario
