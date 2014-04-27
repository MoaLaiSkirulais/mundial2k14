select

	a.idApuesta,
	p.idPartido,
	ad.golesEquipo1,
	ad.golesEquipo2,

	(case

    when -- error inexacta
      (sign(p.golesEquipo1 - p.golesEquipo2)<>sign(ad.golesEquipo1 - ad.golesEquipo2))
        and (abs((p.golesEquipo1 - p.golesEquipo2))<>abs((ad.golesEquipo1 - ad.golesEquipo2)))
    then -1

    when -- error semiinexacta
      (sign(p.golesEquipo1 - p.golesEquipo2)<>sign(ad.golesEquipo1 - ad.golesEquipo2))
        and (abs((p.golesEquipo1 - p.golesEquipo2))=abs((ad.golesEquipo1 - ad.golesEquipo2)))
        and (p.golesEquipo1<>ad.golesEquipo2)
    then -2

    when -- error exacta
      (sign(p.golesEquipo1 - p.golesEquipo2)<>sign(ad.golesEquipo1 - ad.golesEquipo2))
        and (abs((p.golesEquipo1 - p.golesEquipo2))=abs((ad.golesEquipo1 - ad.golesEquipo2)))
        and (p.golesEquipo1=ad.golesEquipo2)
    then -3

  else 0 end) AS puntosNeg,

	(case

    when -- triste
      ((p.golesEquipo1 - p.golesEquipo2)=(ad.golesEquipo1 - ad.golesEquipo2))
        and (ad.golesEquipo1=0)
        and (p.mkTriste=1)
    then 5

    when -- todo exacta
      ((p.golesEquipo1 - p.golesEquipo2)=(ad.golesEquipo1 - ad.golesEquipo2))
        and (p.golesEquipo1 = ad.golesEquipo1)
    then 3

    when -- diferencia exacta
      ((p.golesEquipo1 - p.golesEquipo2)=(ad.golesEquipo1 - ad.golesEquipo2))
        and (p.golesEquipo1 <> ad.golesEquipo1)
    then 2

    when -- diferencia inexacta
      (sign(p.golesEquipo1 - p.golesEquipo2)=sign(ad.golesEquipo1 - ad.golesEquipo2))
        and ((p.golesEquipo1 - p.golesEquipo2)<>(ad.golesEquipo1 - ad.golesEquipo2))
    then 1

    when -- nulos para q no participen
      p.golesEquipo1 is null
    then null

   else 0 end) AS puntos

from apuesta a

	join apuestadetalle ad
		on a.idApuesta = ad.idApuesta

	join partido p
		on p.idPartido = ad.idPartido


-- where a.idApuesta=16
limit 0, 2000
;



