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
    <link rel="stylesheet" href="css/alerta.css">
    <link rel="stylesheet" href="css/notificaciones.css">
    
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/libroDiario.js"></script>
    <script src="js/jquery-3.6.4.js"></script>
    <title>Libro Diario</title>
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
            <a>Libro Diario</a>
        </section>

        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario listadoLibroDiario" id="sectionListCuentas">
            <span class="card-title activator grey-text text-darken-4">
               Libro Diario de San Salvador S.A de C.V
            </span>           
          
            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <ul class="bloqueLbDiario" id="bloqueLbDiario">

             <span class="card-title activator grey-text text-darken-4 peridoLbD">
               Al 31 de Diciembre de 2001
            </span>      

                <span class="advertenciaTransacción partida fecha hide magictime vanishIn" id="fechaTrasaccion">
                    <span class="material-icons">date_range</span>
                    <span class="titulo fecha" id="fechaValor"></span> 
                </span>

                
            
                <!--LISTADO DE PARTIDAS-->   
                
                    <?php 

                    $i = 0;
                    $nPartida = 1;
                    $tamanio = count($listadoPartidas);
                    $saldoDebe = 0;
                    $dia = 0;
                    $mes = 0;
                    $anio = 0;

                    $meses = [
                        "", "Enero", "Febrero", "Marzo", "Abril", "Mayo",
                        "Junio", "Julio", "Agosto", "Septiembre",
                        "Octubre", "Noviembre", "Diciembre"
                    ];

                    if ($tamanio > 0) {
                        $partidaActual = $listadoPartidas[$i]["idPartida"];

                        for ($i; $i < $tamanio; ) {
                            $fecha = $listadoPartidas[$i]["fecha"];
                            $dia = substr($fecha, 8, 9);
                            $mes = $meses[((int)(substr($fecha, 5, 7)))];
                            $anio = substr($fecha, 0, 4); ?>

                          <?php if ($listadoPartidas[$i]["estado"] == 1) { ?> 
                            <section class='sectionPartida'>

                                <span class='advertenciaTransacción partida fecha magictime vanishIn' id='fechaTrasaccion'>
                                    <span class='material-icons'>date_range</span>
                                    <span class='titulo fecha' id='fechaValor'><?php echo $dia . " de " . $mes . " de " . $anio; ?></span> 
                                 </span>

                                <span class='advertenciaTransacción partida eliminarPartida eliminarPartidaOp'>
                                    <span class='material-icons'>delete</span>
                                </span>

                                <span class='advertenciaTransacción partida editarPartida editarPartidas'>
                                    <span class='material-icons' >create</span>
                                </span>

                                 <span class='advertenciaTransacción partida editarPartida  restaurarPartida'>
                                    <span class='material-icons'>loop</span>
                                </span>

                                <span class='advertenciaTransacción partida'>
                                    <span class='material-icons'>import_contacts</span>
                                    <span class='titulo partidaTitulo'>Partida #<?php echo $nPartida; ?></span>
                                </span>

                                <table id='tableCuentasLBM' class='tablaPartidas listadoAsientos'>
                                    <thead>
                                        <tr class="encabezadoLibroDiario">
                                            <th>Código</th>
                                            <th>Cuentas</th>
                                            <th>Folio</th>
                                            <th>Debe</th>
                                            <th>Haber</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>

                        <?php 
                        while ($i < $tamanio && $partidaActual == $listadoPartidas[$i]["idPartida"]) { ?>
                                    <tr>
                                        <td class="codigoListadoLB"><?php echo $listadoPartidas[$i]["codigo"]; ?></td>
                                        <td><?php echo $listadoPartidas[$i]["nombre"]; ?></td>
                                        <td><?php echo $listadoPartidas[$i]["folio"]; ?></td>

                                <?php 
                                $saldoDebe = $listadoPartidas[$i]["saldoDebe"];
                                if ($saldoDebe == "0.00") { ?>
                                    <td></td>
                                      <td><?php echo "$" .number_format($listadoPartidas[$i]["saldoHaber"],2,".",","); ?></td>
                                    </tr>
                                <?php 
                            } else { ?>
                                        <td>$<?php echo number_format($saldoDebe,2,".",","); ?></td>
                                            <td></td>
                                        </tr>
                                <?php 
                            }
                            $i++;

                        } ?>
                                <tr id="conceptoPartida"><td colspan='5'><?php echo $listadoPartidas[$i - 1]["concepto"]; ?></td></tr>
                            </tbody>
                           </table>
                        </section>

                            <?php if ($i < $tamanio) {
                                $partidaActual = $listadoPartidas[$i]["idPartida"];
                                $nPartida++;
                            }

                        } else {
                            $i++;

                            if (($i + 1) == $tamanio) {
                                $tamanio--;
                                $partidaActual = 0;
                            }
                            if ($partidaActual != $listadoPartidas[$i]["idPartida"]) {
                                $partidaActual = $listadoPartidas[$i]["idPartida"];
                                ?>
                            <section class='sectionPartida' id="partidaEliminada">

                               

                                <span class='advertenciaTransacción partida fecha magictime vanishIn partidaEliminada' id='fechaTrasaccion'>
                                    <span class='material-icons'>delete</span>
                                    <span class='titulo fecha' id='fechaValor'><?php echo "Partida Eliminada"; ?></span> 
                                 </span>

                                
                                
                                
                                <span class='advertenciaTransacción partida eliminarPartida eliminarPartidaOp inabilitado'>
                                    <span class='material-icons'>delete</span>
                                </span>

                                <span class='advertenciaTransacción partida editarPartida editarPartidas inabilitado'>
                                    <span class='material-icons' >create</span>
                                </span>

                                <span class='advertenciaTransacción partida editarPartida  restaurarPartida'>
                                    <span class='material-icons'>loop</span>
                                </span>

                                 <span class='advertenciaTransacción partida'>
                                    <span class='material-icons'>import_contacts</span>
                                    <span class='titulo partidaTitulo'>Partida #<?php echo $nPartida; ?></span>
                                </span>
                                

                            <article>
                                 <img src="img/libroDiario/carpeta1.png" alt="icono-borrado" class="imgPartidaBorrada">
                            </article>
                        </section >
                            <?php 
                            $nPartida++;
                        }
                    }

                }
            }
            ?>
                            <!--<section class="sectionPartida">
                            <span class="advertenciaTransacción partida fecha magictime vanishIn" id="fechaTrasaccion">
                                <span class="material-icons">date_range</span>
                                <span class="titulo fecha" id="fechaValor">22 de junio de 2022</span> 
                            </span>
                            <span class="advertenciaTransacción partida">
                                <span class="material-icons">import_contacts</span>
                                <span class="titulo partidaTitulo">Partida #1</span> 
                            </span>

                            <table id="tableCuentasLBM">
                                <thead>
                                    <th>Cuentas</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cuentas por pagar</td>
                                        <td>$400</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Caja</td>
                                        <td></td>
                                        <td>$400</td>
                                    </tr>
                                    <tr><td colspan="4">Pago a proveedores en efectivo</td></tr>
                                </tbody>
                            </table>
                        </section>-->


                        <!--<section class="sectionPartida">
                            <span class="advertenciaTransacción partida fecha magictime vanishIn" id="fechaTrasaccion">
                                <span class="material-icons">date_range</span>
                                <span class="titulo fecha" id="fechaValor">22 de junio de 2022</span> 
                            </span>
                            <span class="advertenciaTransacción partida">
                                <span class="material-icons">import_contacts</span>
                                <span class="titulo partidaTitulo">Partida #2</span> 
                            </span>

                            <table id="tableCuentasLBM">
                                <thead>
                                    <th>Cuentas</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </thead>
                                <tbody>
                                   
                                    <tr>
                                        <td>Cuentas por pagar</td>
                                        <td>$400</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Caja</td>
                                        <td></td>
                                        <td>$400</td>
                                    </tr>
                                    <tr><td colspan="4">Pago a proveedores en efectivo</td></tr>
                                </tbody>
                            </table>
                        </section>

                        
                        <section class="sectionPartida">
                            <span class="advertenciaTransacción partida">
                                <span class="material-icons">import_contacts</span>
                                <span class="titulo partidaTitulo">Partida #3</span> 
                            </span>

                            <table id="tableCuentasLBM">
                                <thead>
                                    <th>Fecha</th>
                                    <th>Cuentas</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="3">22 de junio de 2022</td>
                                    </tr>
                                    <tr>
                                        <td>Cuentas por pagar</td>
                                        <td>$400</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Caja</td>
                                        <td></td>
                                        <td>$400</td>
                                    </tr>
                                    <tr><td colspan="4">Pago a proveedores en efectivo</td></tr>
                                </tbody>
                            </table>
                        </section>-->
                        
                   
               
                    <!--<section class="filaLbD">
                        <section class="sectionLbDiario fechaLbD">
                            <p>Fecha</p>
                        </section>
                        <section class="sectionLbDiario conceptoLbD">
                            <p>Concepto</p>
                        </section>
                        <section class="sectionLbDiario refLbD">
                            <p>Ref LBM</p>
                        </section>
                        <section class="sectionLbDiario debeLbD">
                            <p>Debe</p>
                        </section>
                        <section class="sectionLbDiario haberLbD">
                            <p>Haber</p>
                        </section>
                    </section>-->  
            </ul>

            <table class="tablaTotalesPartidas">
               <thead> 
                    <tr>
                        <th>TOTALES</th>
                        <th><span id="saldoDebeLbDiario">$<?php echo number_format($sumaSaldos["saldoDebe"],2,".",","); ?></span></th>
                        <th><span>$<?php echo number_format($sumaSaldos["saldoHaber"],2,".",","); ?></th>
                    </tr>
                <thead>
            </table>

        </div>


        <!--FORMULARIO DE REGISTRO DE CUENTAS-->
        <?php include "pages/formularioCuentas.php";
        include "pages/detalleCuenta.php"; ?>
    </section>

        <?php include "pages/notificaciones.php";
        include "pages/formularioPartida.php";
        include "pages/alerta.php"; ?>

    <script src="js/notificaciones.js"></script>
    <script src="js/alerta.js"></script>
</body>
</html>