<?php 

//SELECCIONAR CANTIDAD DE CUENTAS TOTALES
//define("SELECT_ALL_CUENTAS","SELECT COUNT(codigo) AS cuentas FROM cuenta");

//SELECCIONAR CANTIDAD DE CUENTAS ACTIVOS
define("SELECT_CUENTAS_ACTIVOS","SELECT COUNT(codigo) AS activos FROM cuenta
WHERE elemento_contable = 1");

//SELECCIONAR CANTIDAD DE CUENTAS PASIVOS
define("SELECT_CUENTAS_PASIVOS","SELECT COUNT(codigo) AS pasivos FROM cuenta
WHERE elemento_contable = 2");

//SELECCIONAR CANTIDAD DE CUENTAS capital
define("SELECT_CUENTAS_CAPITAL","SELECT COUNT(codigo) AS capital FROM cuenta
WHERE elemento_contable = 3");

//SELECCIONAR cuentas principales
define("SELECT_CUENTAS_PRINCIPALES","SELECT c.codigo,c.nombre FROM cuenta c 
INNER JOIN subcuenta sc 
ON sc.cuentaPrincipal = c.codigo
GROUP BY c.codigo");


//SELECCIONAR cuentas secundarias
define("SELECT_CUENTAS_SECUNDARIAS","SELECT sc.cuentaPrincipal, c.codigo, c.nombre FROM cuenta c 
INNER JOIN subcuenta sc 
ON sc.cuentaSecundaria = c.codigo");

//SELECCIONAR rubros asociados
define("SELECT_RUBROS_CONTABLES","SELECT id, subtipo FROM rubro_contable");

define("SELECT_ELEMENTOS_CONTABLES","SELECT id,clasificacion FROM elemento_contable;");

//RUBROS CONTABLES POR ELEMENTO CONTABLE
define("SELECT_RUBROS_ELEMENT_CONTABLE","SELECT rc.id idRubro, rc.subtipo rubro,c.elemento_contable FROM cuenta c 
INNER JOIN rubro_contable rc  
ON rc.id = c.rubro 
GROUP BY rubro,c.elemento_contable 
ORDER BY c.elemento_contable,rubro");

//BUSCAR SUBCUENTA DE CUENTA
define("SELECT_SUBCUENTAS","SELECT rc.id idRubro, rc.subtipo rubro,c.elemento_contable FROM cuenta c 
INNER JOIN rubro_contable rc  
ON rc.id = c.rubro 
GROUP BY rubro,c.elemento_contable 
ORDER BY c.elemento_contable");

define("SELECT_ALL_CUENTAS","SELECT c.codigo codigo, sc.cuentaPrincipal cuentaPrincipal, c.nombre,rc.id rubro,ec.id elemento FROM subcuenta sc 
RIGHT JOIN cuenta c 
ON c.codigo = sc.cuentaSecundaria
INNER JOIN rubro_contable rc 
ON rc.id = c.rubro
INNER JOIN elemento_contable ec 
ON ec.id = c.elemento_contable
ORDER BY c.codigo");

define("SELECT_ALL_CUENTAS2","SELECT c.codigo codigo, c.nombre,ec.id elemento,ec.clasificacion,rc.id rubro,rc.subtipo,
(CASE (LENGTH(c.codigo)) 
  WHEN 6 THEN
   SUBSTR(c.codigo,1,4)
  WHEN 8 THEN
 	SUBSTR(c.codigo,1,6)
  WHEN 10 THEN 
    SUBSTR(c.codigo,1,8)
  END) AS cuentaPrincipal
FROM cuenta c
INNER JOIN rubro_contable rc
ON rc.id = c.rubro
INNER JOIN elemento_contable ec 
ON ec.id = c.elemento_contable
ORDER BY c.codigo,c.rubro");

define("SELECT_SUBCUENTAS_CUENTAS","SELECT c.nombre,COUNT(sc.cuentaSecundaria) subcuentas FROM subcuenta sc 
RIGHT JOIN cuenta c 
ON c.codigo = sc.cuentaPrincipal
GROUP BY c.codigo");


define("SELECT_DETAILS_CUENTA","SELECT c.codigo AS codigo, c.nombre AS nombre, ec.clasificacion AS elemento ,
rc.subtipo AS rubro, tc.tipo AS tipo, ts.tipoSaldo AS tipoSaldo, 
ec.id ec, rc.id rc , ts.idTipo ts , tc.id tc
FROM cuenta c 
INNER JOIN elemento_contable ec 
ON ec.id = c.elemento_contable
INNER JOIN rubro_contable rc 
ON rc.id = c.rubro
INNER JOIN tipo_cuenta tc 
ON tc.id = c.tipo
INNER JOIN tipo_saldo ts 
ON ts.idTipo = c.tipo_saldo
WHERE c.codigo =  ?");


define("SELECT_SALDO","SELECT idTipo,tipoSaldo FROM  tipo_saldo");

define("SELECT_TIPO","SELECT id,tipo FROM tipo_cuenta");

define("INSERT_CUENTA","INSERT INTO cuenta(codigo,nombre,elemento_contable,rubro,tipo,tipo_saldo) 
                VALUES(?,?,?,?,?,?)");

define("INSERT_SUBCUENTA","INSERT INTO subcuenta(cuentaPrincipal,cuentaSecundaria) VALUES(?,?)");

define("SELECT_CUENTAS_POR_ELM","SELECT clasificacion elemento,COUNT(c.codigo) cantidad FROM elemento_contable ec
INNER JOIN cuenta c 
ON c.elemento_contable = ec.id
GROUP BY ec.id,ec.clasificacion");

define("MODIFICAR_CUENTA","UPDATE cuenta SET codigo=?,nombre=?,elemento_contable=?,rubro=?,tipo=?,tipo_saldo=?
 WHERE codigo =");

 define("INSERT_PARTIDA","INSERT INTO partida(debe,haber,fecha,concepto,ejercicioContable) VALUES(?,?,?,?,?)");

 define("INSERT_CICLO_CONTABLE","INSERT INTO ejercicio_contable(periodo,estado) VALUES(?,?)");

 define("COMPROBAR_CICLO_CONTABLE","SELECT periodo FROM ejercicio_contable WHERE periodo =?");

 define("INSERT_DETALLE_PARTIDA","INSERT INTO detalle_partida(cuenta,saldoDebe,saldoHaber,partida,folio) VALUES(?,?,?,?,?)");

 define("PARTIDA_RECIENTE","SELECT MAX(idPartida) as partida FROM partida");

 define("OBTENER_CICLO_CONT_ACTUAL","SELECT idEjercicioContable FROM ejercicio_contable ec 
                                     INNER JOIN estado_ciclo es 
                                     ON es.idEstado = ec.estado 
                                     WHERE es.idEstado = 1");

define("LISTADO_PARTIDAS","SELECT c.codigo,p.estado,p.idPartida,c.nombre,dp.saldoDebe,dp.saldoHaber,p.fecha,p.concepto,lb.numCuenta folio FROM detalle_partida dp 
                           INNER JOIN partida p 
                           ON p.idPartida = dp.partida
                           INNER JOIN cuenta c 
                           ON dp.cuenta = c.codigo
                           INNER JOIN libro_mayor lb
                           ON lb.idLibroMayor = dp.folio
                           ORDER By dp.idDetallePartida");

define("ULTIMAS_PARTIDAS","SELECT idPartida,concepto FROM partida
                           ORDER BY fecha DESC LIMIT 5");

define("SUMA_SALDOS_PARTIDAS","SELECT SUM(debe) saldoDebe ,SUM(haber) saldoHaber FROM partida WHERE estado = 1");

define("COMPROBAR_CUENTA_LIBRO_MAYOR","SELECT idLibroMayor AS numeroCuenta FROM libro_mayor WHERE cuenta LIKE ?");

define("OBTENER_CANTIDAD_CUENTAS_MAYOR","SELECT COUNT(idLibroMayor) AS cuentas FROM libro_mayor");


define("INGRESAR_CUENTA_MAYOR","INSERT INTO libro_mayor(cuenta,numCuenta) VALUES(?,?)");

define("SELECCIONAR_ULTIMA_CUENTA_MAYOR","SELECT MAX(idLibroMayor) AS id FROM libro_mayor");

define("SELECT_PARTIDA","SELECT  p.concepto, p.fecha, dp.idDetallePartida,c.nombre,dp.cuenta,dp.saldoDebe,dp.saldoHaber,dp.folio,dp.partida FROM detalle_partida dp 
                         INNER JOIN partida p 
                         ON p.idPartida = dp.partida 
                         INNER JOIN cuenta c 
                         ON c.codigo = dp.cuenta
                         WHERE p.idPartida = (SELECT idPartida FROM partida LIMIT ?,1)");


define("BALANZA_COMPROBACION","SELECT c.codigo AS codigo, c.nombre AS cuenta, SUM(dp.saldoDebe) AS  movimientoDebe, SUM(dp.saldoHaber) AS movimientoHaber,
                               c.tipo_saldo AS tipoSaldo FROM cuenta c INNER JOIN detalle_partida dp ON c.codigo  = dp.cuenta GROUP BY c.nombre ORDER By c.nombre;");

define("EDITAR_PARTIDA","UPDATE detalle_partida SET cuenta=?, folio=?, saldoDebe = ?, saldoHaber = ? WHERE idDetallePartida = ?");

define("EDITAR_DATOS_PARTIDA","UPDATE partida SET concepto=?, debe=?,haber=?,fecha=? WHERE idPartida=?");

define("ELIMINAR_PARTIDA","UPDATE partida SET estado = 2 WHERE idPartida=?");

define("OBTENER_PARTIDA_ID","SELECT idPartida,estado FROM partida LIMIT ?,1");

//libro mayor 
define("SELECCIONAR_REGISTRO_MAYORES", "SELECT c.codigo, p.fecha, p.concepto, d.saldoDebe, d.saldoHaber FROM cuenta c INNER JOIN libro_mayor m
                                      ON c.codigo = m.cuenta INNER JOIN detalle_partida d 
                                      ON d.folio = m.idLibroMayor INNER JOIN partida p
                                      ON p.idPartida = d.partida");

//SELECCIONAR LAS CUENTAS QUE ESTEN EN MAYOR
define("SELECCIONAR_CUENTAS_MAYOR", "SELECT c.codigo, c.nombre FROM cuenta c INNER JOIN libro_mayor m ON c.codigo = m.cuenta");

define("INVENTARIO_INICIAL", "SELECT c.codigo, p.fecha, p.concepto, d.saldoDebe, d.saldoHaber
FROM cuenta c
INNER JOIN libro_mayor m ON c.codigo = m.cuenta
INNER JOIN detalle_partida d ON d.folio = m.idLibroMayor
INNER JOIN partida p ON p.idPartida = d.partida
WHERE c.codigo = '1111'
AND p.fecha = (SELECT MIN(p1.fecha) FROM partida p1)");

?>