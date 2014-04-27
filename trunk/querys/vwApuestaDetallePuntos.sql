SELECT

	adp.idApuesta,
	adp.idPartido,

	p.fecha,
	p.idEquipo1,
	p.idEquipo2,
	p.golesEquipo1 AS golesFinalEquipo1,
	p.golesEquipo2 AS golesFinalEquipo2,

	p.mkCoke,
	p.mkBazan,
	p.mkVieja,
	p.mkMotoraton,
	p.mkExcellent,
	p.mkAmargo,
	p.mkUsa,
	p.mkHyena,
	p.mkTriste,
	p.tbEvento,

	adp.golesEquipo1,
	adp.golesEquipo2,
	e1.nombre AS nombre1,
	e2.nombre AS nombre2,

	adp.puntos,
	adp.puntosPower


FROM vwapuestadetallepuntospower adp

	join partido p
		on p.idPartido = adp.idPartido

	join equipo e1
		on e1.idEquipo = p.idEquipo1

	join equipo e2
		on e2.idEquipo = p.idEquipo2