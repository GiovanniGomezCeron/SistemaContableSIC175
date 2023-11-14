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

                $ventas = $ls["5101"]["movimientoHaber"]-$ls["5101"]["movimientoDebe"];
                $rebajasVenta = $ls["4106"]["movimientoDebe"]-$ls["4106"]["movimientoHaber"];
                $devolucionesVenta = $ls["4108"]["movimientoDebe"]-$ls["4108"]["movimientoHaber"];

                $ventasNeta = $ventas - $rebajasVenta - $devolucionesVenta ;

                $compras = $ls["4104"]["movimientoDebe"]-$ls["4104"]["movimientoHaber"];
                $gastosCompra = $ls["4105"]["movimientoDebe"]-$ls["4105"]["movimientoHaber"];


                $rebajasCompra = $ls["5104"]["movimientoHaber"]-$ls["5104"]["movimientoDebe"];
                $devolucionesCompra = $ls["5105"]["movimientoHaber"]-$ls["5105"]["movimientoDebe"];


                $comprasTotales = $compras  + $gastosCompra;

                $comprasNetas = $comprasTotales - $rebajasCompra - $devolucionesCompra;

                $inventarioInicial = $ls["1111"]["movimientoDebe"]-$ls["1111"]["movimientoHaber"];
                
                $mercaderiaDisponible = $comprasNetas + $inventarioInicial;

                $inventarioFinal = 0.00;

                $costoVenta = $mercaderiaDisponible - $inventarioFinal;

                $utilidadBruta = $ventasNeta - $costoVenta; 
                
               

                $gastosAdministracion = $ls["4202"]["movimientoDebe"]-$ls["4202"]["movimientoHaber"];
                $gastosFinancieros = $ls["4301"]["movimientoDebe"]-$ls["4301"]["movimientoHaber"];
                $gastosSobreVenta = $ls["4201"]["movimientoDebe"]-$ls["4201"]["movimientoHaber"];

                $gastosOperativos = $gastosAdministracion+$gastosFinancieros+$gastosSobreVenta;

                $utilidadOperativa = $utilidadBruta - $gastosOperativos;

                $otrosGastos =  $ls["4205"]["movimientoDebe"]-$ls["4205"]["movimientoHaber"];
                $otrosProductos = $ls["5202"]["movimientoHaber"]-$ls["5202"]["movimientoDebe"];

                $utilidadAntesDeRI = $utilidadOperativa - $otrosGastos + $otrosProductos;

                $reservaLegal = $utilidadAntesDeRI * 0.07;

                $utilidadAntesDeI = $utilidadAntesDeRI - $reservaLegal;

                $utilidadNeta = $utilidadAntesDeI - $reservaLegal;
 
            ?>
                <table id="listadoCuentasER">
                    <tr>    
                        <td>(+)</td>
                        <td>Ventas</td>
                        <td>$<?php echo number_format($ventas, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Gastos operativos</td>
                        <td class="total pintar2">$<?php  echo number_format($gastosOperativos, 2,".",",");?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Rebajas sobre venta</td>
                        <td>$<?php echo number_format($rebajasVenta, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos administrativos</td>
                        <td>$<?php echo number_format($gastosAdministracion, 2,".",","); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Devoluciones sobre venta</td>
                        <td class="barraHorizontal">$<?php echo number_format($devolucionesVenta, 2,".",",") ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos financieros</td>
                        <td>$<?php echo number_format($gastosFinancieros, 2,".",","); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Ventas netas</td>
                        <td class="total">$
                            <?php 
                                echo number_format($ventasNeta, 2,".",","); 
                            ?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Gastos sobre ventas</td>
                        <td>$<?php echo number_format($gastosSobreVenta, 2,".",","); ?></td>
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
                        <td>$<?php echo number_format($compras, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad operativa</td>
                        <td class="total pintar2">$<?php echo number_format($utilidadOperativa, 2,".",","); ?></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(+)</td>
                        <td>Gastos sobre compras</td>
                        <td class="barraHorizontal">$<?php echo number_format($gastosCompra, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(-)</td>
                        <td>Otros gatos</td>
                        <td>$<?php echo number_format($otrosGastos, 2,".",","); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Compras totales</td>
                        <td class="total">$<?php echo number_format($comprasTotales, 2,".",",");?></td>
                        <td></td>
                        <td></td>
                        <td>(+)</td>
                        <td>Otros productos</td>
                        <td class="barraHorizontal">$<?php echo number_format($otrosProductos, 2,".",","); ?></td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Rebajas sobre compras</td>
                        <td>$<?php echo number_format($rebajasCompra, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad antes de reserva e impuesto</td>
                        <td class="total">$
                            <?php 
                                echo number_format($utilidadAntesDeRI, 2,".",","); 
                            ?>
                            </td>
                        <td></td>
                    </tr>

                    <tr>    
                        <td>(-)</td>
                        <td>Devoluciones sobre compras</td>
                        <td class="barraHorizontal">$<?php echo number_format($devolucionesCompra, 2,".",","); ?></td>
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
                        <td class="total">$<?php echo number_format($comprasNetas, 2,".",","); ?></td>
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
                        <td class="barraHorizontal">$<?php echo number_format($inventarioInicial, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Reserva legal</td>
                        <td class="total pintar2">$
                            <?php 
                            
                                echo number_format($reservaLegal, 2,".",",");
                            ?>
                        </td>
                        <td></td>
                    </tr>

                     <tr>    
                        <td>(=)</td>
                        <td class="total">Mercadería disponible</td>
                        <td class="total">$<?php echo number_format($mercaderiaDisponible, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td>Utilidad antes de impuesto</td>
                        <td>$
                            <?php 
                                echo number_format($utilidadAntesDeI, 2,".",",");
                            ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>(-)</td>
                        <td>Inventario final</td>
                        <td class="barraHorizontal">$<?php echo number_format($inventarioFinal, 2,".",","); ?></td>
                        <td></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Impuesto sobre la renta</td>
                        <td class="total pintar2">$
                            <?php 
                                    if($ventas> 150000) {
                                        $impuestoSobreRenta = $utilidadAntesDeI * 0.3;
                                    }else {
                                        $impuestoSobreRenta = $utilidadAntesDeI * 0.25;
                                    }

                                    echo number_format($impuestoSobreRenta, 2,".",",");
                            ?>
                        </td>
                        <td ></td>
                    </tr>

                    <tr>    
                        <td>(=)</td>
                        <td class="total">Costo de venta</td>
                        <td class="total">$<?php echo number_format($costoVenta, 2,".",",");?></td>
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
                        <td class="total pintar2">$<?php echo number_format($utilidadBruta, 2,".",","); ?></td>
                        <td></td>
                        <td>(=)</td>
                        <td class="total">Utilidad del ejercicio</td>
                        <td class="total barraHorizontal pintar">$
                            <?php 
                                echo number_format($utilidadAntesDeI - $impuestoSobreRenta, 2,".",",");
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