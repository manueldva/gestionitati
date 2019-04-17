DELIMITER $$

CREATE PROCEDURE `INF_SUM_articuloscontratos_SP`(cliente_id int, clientedireccion_id int)
BEGIN
	select sum(ca.cantidad) cantidad, a.descripcion articulo, a.id articulo_id  from contratos c
	inner join contratoarticulos ca on c.id = ca.contrato_id
	inner join clientes cli on c.cliente_id = cli.id
	inner join articulos a on ca.articulo_id = a.id
	where c.cliente_id = cliente_id and c.clientedireccion_id = clientedireccion_id and c.estado = 1 and cli.estado = 1
	group by a.descripcion, a.id;

END $$

DELIMITER ;