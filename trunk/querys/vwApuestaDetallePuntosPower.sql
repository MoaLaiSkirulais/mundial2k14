SELECT

  apb.idApuesta,
  apb.idPartido,
  apb.puntos,
  apb.golesEquipo1,
  apb.golesEquipo2,

  (case

    when -- bazan
      apb.puntos=0 and p.mkBazan=1
    then -2

    when -- coke
      apb.puntos>0 and p.mkCoke=1
    then apb.puntos+2

    when -- vieja
      apb.puntos>0 and p.mkVieja=1
    then apb.puntos*3

    when -- vieja
      apb.puntos=0 and p.mkVieja=1
    then apb.puntosNeg*3

    when -- laucha
      apb.puntos>0 and p.mkVieja=1
    then apb.puntos*4

    when -- laucha
      apb.puntos=0 and p.mkVieja=1
    then apb.puntosNeg*4


   else puntos end) AS puntosPower


FROM vwapuestadetallepuntosbase apb

	join partido p
		on p.idPartido = apb.idPartido

-- where idApuesta=16;
