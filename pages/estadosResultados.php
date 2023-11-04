<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/fonts.googleapis.com_icon_family=Material+Icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/magic.css">
    <link rel="stylesheet" href="css/notificaciones.css">
    
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/libroDiario.js"></script>
    <script src="js/jquery-3.6.4.js"></script>
    <title>Estado de resultados</title>
</head>

<body>

     <!--BARRA LATERAL-->
     <?php include "pages/barraLateral.php"; ?>


    <!--SECCION DE CONTENIDO-->
    <!--
        BARRA DE USUARIO
        BARRA DE NAVEGACION
        TARJETA DE RESUMEN DE CUENTAS
        TARJETA DE LISTADO DE CUENTAS
        FORMULARIO DE REGISTRO DE CUENTAS
    -->
    <section class="content">

        <!--BARRA DE USUARIO
        <div class="nav">
            <img src="img/dolar.png" class="logo">
            <i class="material-icons">arrow_drop_down</i>
            <span>Usuario</span>
            <img src="img/usuario (1).png" class="perfil">
        </div>-->

        <!--BARRA DE NAVEGACION-->
        <section class="nivelNavegacion">
            <a href="?o">DashBoard</a>
            <i class="material-icons">chevron_right</i>
            <a>Estado de resultados</a>
        </section>

        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario estadoResultado listadoLibroDiario" id="sectionListCuentas">
            <span class="card-title activator grey-text text-darken-4">
                Estado de resultados
            </span>           
          
            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <ul class="bloqueLbDiario cuentasER" id="bloqueLbDiario">

            <?php 
                $i = 0;
                $saldo = 0;
                $tamanio = count($listadoCuentas);

                $ventaTotal = 0.00;
                $rebajasVenta = 0.00;
                $devolucionesVenta = 0.00;
                $ventasNeta = 0.00;

                $compras = 0.00;
                $gastosCompra = 0.00;
                $comprasTotales = 0.00;

                $rebajasCompra = 0.00;
                $devolucionesCompra = 0.00;
                $comprasNetas = 0.00;

                $inventarioInicial = $inventarioInicialQ[0]["saldoDebe"];
                $mercaderiaDisponible = 0.00;

                $inventarioFinal = 0.00;
                $costoVenta = 0.00;

                $utilidadBruta = 0.00;

                $gastosAdministracion = 0.00;
                $gastosFinancieros = 0.00;
                $gastosSobreVenta = 0.00;

                $gastosOperativos = 0.00;

                $otrosGastos = 0.00;
                $otrosProductos = 0.00;
                $utilidadOperativa = 0.00;

                $utilidadReservaImpuesto = 0.00;

                $reservaLega = 0.00;

                $utilidadAnteImpuesto = 0.00;

                $impuestoSobreRenta = 0.00;

                $utilidadEjercicio = 0.00;
    


                for($i; $i< $tamanio;) {
                    //Venta
                    switch($listadoCuentas[$i]["codigo"]) {
                        case "5101": $ventaTotal = $listadoCuentas[$i]["movimientoHaber"] - $listadoCuentas[$i]["movimientoDebe"]; break;
                        case "4106": $rebajasVenta = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4108": $devolucionesVenta = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        
                        case "4104": $compras = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4105": $gastosCompra = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        
                        case "5104": $rebajasCompra = $listadoCuentas[$i]["movimientoHaber"] - $listadoCuentas[$i]["movimientoDebe"]; break;
                        case "5105": $devolucionesCompra = $listadoCuentas[$i]["movimientoHaber"] - $listadoCuentas[$i]["movimientoDebe"]; break;
                        
                        
                        //case "1111": $inventarioInicial = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        
                        case "4202": $gastosAdministracion = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4301": $gastosFinancieros = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4201": $gastosSobreVenta = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        
                        case "4205": $otrosGastos = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "5202": $otrosProductos = $listadoCuentas[$i]["movimientoHaber"] - $listadoCuentas[$i]["movimientoDebe"]; break;
                        
                        case "4205": $otrosGastos = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4205": $otrosGastos = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;
                        case "4205": $otrosGastos = $listadoCuentas[$i]["movimientoDebe"] - $listadoCuentas[$i]["movimientoHaber"]; break;

                    }
                    $i++;
                    
                }
            
            ?>
                <table id="listadoCuentasER">
                    <tr>    
                        <td>(+)</td>
                        <td>Ventas totales</td>
                        <td>$<?php echo number_format($ventaTotal, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Gastos operativos</td>
                        <td class="total pintar2">$
                            <?php 
                                $gastosOperativos = $gastosAdministracion + $gastosFinancieros + $gastosSobreVenta;
                                echo number_format($gastosOperativos, 2);
                             ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Rebajas sobre venta</td>
                        <td>$<?php echo number_format($rebajasVenta, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos administrativos</td>
                        <td>$<?php echo number_format($gastosAdministracion, 2); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Devoluciones sobre venta</td>
                        <td class="barraHorizontal">$<?php echo number_format($devolucionesVenta, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos financieros</td>
                        <td>$<?php echo number_format($gastosFinancieros, 2); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Ventas netas</td>
                        <td class="total">$
                            <?php 
                                $ventasNeta = $ventaTotal - $rebajasVenta - $devolucionesVenta;
                                echo number_format($ventasNeta, 2); 
                            ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos sobre ventas</td>
                        <td>$<?php echo number_format($gastosSobreVenta, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr class="filaVacia">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(+)</td>
                        <td>Compras</td>                      
                        <td>$<?php echo number_format($compras, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad operativa</td>
                        <td class="total pintar2">$<?php $utilidadOperativa = $utilidadBruta - $gastosOperativos; echo number_format($utilidadOperativa, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(+)</td>
                        <td>Gastos sobre compras</td>
                        <td class="barraHorizontal">$<?php echo number_format($gastosCompra, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(-)</td>
                        <td>Otros gatos</td>
                        <td>$<?php echo number_format($otrosGastos, 2); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Compras totales</td>
                        <td class="total">$<?php $comprasTotales = $compras + $gastosCompra; echo number_format($comprasTotales, 2);?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Otros productos</td>
                        <td class="barraHorizontal">$<?php echo number_format($otrosProductos, 2); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Rebajas sobre compras</td>
                        <td>$<?php echo number_format($rebajasCompra, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad antes de reserva e impuesto</td>
                        <td class="total">$
                            <?php 
                                $utilidadReservaImpuesto = $utilidadOperativa - $otrosGastos + $otrosProductos;
                                echo number_format($utilidadReservaImpuesto, 2); 
                            ?>
                            </td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Devoluciones sobre compras</td>
                        <td class="barraHorizontal">$<?php echo number_format($devolucionesCompra, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td ></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Compras netas</td>
                        <td class="total">$<?php $comprasNetas = $comprasTotales - $rebajasCompra - $devolucionesCompra; echo number_format($comprasNetas, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                     <tr>    
                        <td>(+)</td>
                        <td>Inventario inicial</td>
                        <td class="barraHorizontal">$<?php echo number_format($inventarioInicial, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Reserva legal</td>
                        <td class="total pintar2">$
                            <?php 
                                $reservaLega = $utilidadReservaImpuesto * 0.07;
                                echo number_format($reservaLega, 2);
                            ?>
                        </td>
                        <td></td>
                    </tr>

                     <tr>    
                        <td>(=)</td>
                        <td class="total">Mercadería disponible</td>
                        <td class="total">$<?php $mercaderiaDisponible = $comprasNetas + $inventarioInicial; echo number_format($mercaderiaDisponible, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td>Utilidad antes de impuesto</td>
                        <td>$
                            <?php 
                                $utilidadAnteImpuesto = $utilidadReservaImpuesto - $reservaLega;
                                echo number_format($utilidadAnteImpuesto, 2);
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(-)</td>
                        <td>Inventario final</td>
                        <td class="barraHorizontal">$<?php echo number_format($inventarioFinal, 2); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Impuesto sobre la renta</td>
                        <td class="total pintar2">$
                            <?php 
                                    if($utilidadAnteImpuesto > 150000) {
                                        $impuestoSobreRenta = $utilidadAnteImpuesto * 0.3;
                                    }else {
                                        $impuestoSobreRenta = $utilidadAnteImpuesto * 0.25;
                                    }

                                    echo number_format($impuestoSobreRenta, 2);
                            ?>
                        </td>
                        <td ></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Costo de venta</td>
                        <td class="total">$<?php $costoVenta = $mercaderiaDisponible - $inventarioFinal; echo number_format($costoVenta, 2);?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="filaVacia">    
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(=)</td>
                        <td class="total">Utilidad bruta</td>
                        <td></td>
                        <td class="total pintar2">$<?php $utilidadBruta = $ventasNeta - $costoVenta; echo number_format($utilidadBruta, 2); ?></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad del ejercicio</td>
                        <td class="total barraHorizontal pintar">$
                            <?php 
                                $utilidadEjercicio = $utilidadAnteImpuesto - $impuestoSobreRenta;
                                echo number_format($utilidadEjercicio, 2);
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
                   

            </ul>
        </div>
    </section>
</body>
</html>