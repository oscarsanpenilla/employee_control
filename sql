
// 1
SELECT site,ocupation,name, SUM(hours_day) AS hours, work_for_rate, SUM(hours_day)*work_for_rate AS total
FROM events
WHERE date BETWEEN '2018-07-01' AND '2018-07-14' AND paid_by='Rafael'
GROUP BY name
ORDER BY site,ocupation,name


//2
SELECT name,bank_info, SUM(hours_day)*work_for_rate AS total
FROM events
WHERE date BETWEEN '2018-07-01' AND '2018-07-14' AND paid_by='Rafael'
GROUP BY name
ORDER BY name


//nombres
SELECT DISTINCT name
FROM events
WHERE site='Triumph' AND date BETWEEN '2018-07-01' AND '2018-07-14'

//fechas
SELECT DISTINCT date
FROM events
WHERE site='Triumph' AND date BETWEEN '2018-07-01' AND '2018-07-14'


//horas por dia
SELECT name, date,hours_day
FROM events
WHERE site='Triumph' AND date BETWEEN '2018-07-01' AND '2018-07-14'


//total horas
SELECT name, SUM(hours_day) AS total
FROM events
WHERE site='Triumph' AND date BETWEEN '2018-07-01' AND '2018-07-14'
GROUP BY name


//semana corriente
SELECT *
FROM week_a
WHERE week_start<='2018-07-29' AND week_end>='2018-07-29'

//juntando tablas
SELECT users.id,events.name,users.bank_info
FROM events
INNER JOIN users ON events.id = users.id
WHERE date BETWEEN '2018-07-15' AND '2018-07-28' AND site='Vancouver House'
GROUP BY users.id

//bank Deposits resumen
SELECT users.name,users.bank_info,SUM(hours_day)*users.work_for_rate AS total
FROM events
JOIN users ON events.id = users.id
WHERE date BETWEEN '2018-07-15' AND '2018-07-28' AND users.bank_info!='' AND site='Vancouver House'
GROUP BY users.bank_info
