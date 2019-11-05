
update stockarticulos set
stockactual = 0,
stockminimo = 0,
stockmaximo = 0
where id > 0;

delete from asignarstockagregados;
delete from stockasignaciondetalles;
delete from stockajustes;
delete from stockventas;

delete from stockasignaciones;
