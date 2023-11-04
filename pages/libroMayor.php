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
    <script src="js/jquery-3.6.4.js"></script>
    <title>Libro Mayor</title>
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

        <!--BARRA DE NAVEGACION-->
        <section class="nivelNavegacion">
            <a href="?o">DashBoard</a>
            <i class="material-icons">chevron_right</i>
            <a href="">Libro Mayor</a>
        </section>

        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario listadoLibroDiario" id="sectionListCuentas">
            <span class="card-title activator grey-text text-darken-4">
                Libro Mayor
            </span>

            <section class="panelCuentas">
                <img src="img/configuraciones.png" class="ajuste" id="btnAjustes">
                <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta">
            </section>

            <ul class="bloqueLbDiario" id="bloqueLbDiario">
                <span class="advertenciaTransacción partida fecha hide magictime vanishIn" id="fechaTrasaccion">
                    <span class="material-icons">date_range</span>
                    <span class="titulo fecha" id="fechaValor"></span>
                </span>

                <br></br>
                <span class="advertenciaTransacción hide magictime vanishIn" id="advertenciaTransaccion">
                    <!--<span class="material-icons">error</span>-->
                    <span class="material-icons"></span>
                    <span class="titulo"></span>
                </span>

            <?php
                $i = 0;
                $tamanio = count($listadoCuentasMayor);
                $nPartida = 1;

                $meses = [
                    "", "Enero", "Febrero", "Marzo", "Abril", "Mayo",
                    "Junio", "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ];

                $banderaDebe = 5;
                $banderaDeudora = 5;
                ?>

                <!--LISTADO DE PARTIDAS-->

                <?php for ($i; $i < $tamanio; ) { ?>

                    <section class="sectionPartida">

                        <span class="advertenciaTransacción partida" id="codigoCuentaLBM">
                            <span class="material-icons">code</span>
                            <span class="titulo partidaTitulo"><?php echo $listadoCuentasMayor[$i]["codigo"] ?></span>
                        </span>

                        <span class='advertenciaTransacción partida fecha magictime vanishIn cuentaLBM' id='fechaTrasaccion'>
                            <span class='material-icons'>account_balance</span>
                            <span class='titulo fecha' id='fechaValor'><?php echo $listadoCuentasMayor[$i]["nombre"] ?></span>
                        </span>

                        <span class='advertenciaTransacción partida fecha magictime vanishIn cuentaLBM' id='numeroCuentaLBM'>
                            <span class='material-icons'>account_balance</span>
                            <span class='titulo fecha' id='fechaValor'>Cuenta <?php echo $nPartida; ?></span>
                        </span>

                        <table id="tableCuentasLBM">
                            <thead>
                                <tr class="encabezado">
                                    <th class="esquinaLT">Folio</th>
                                    <th>Fecha</th>
                                    <th>Detalle</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                    <th class="esquinaTR">Saldo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $tamanioMayor = count($listadoLibroMayor);

                                $contador = 0;
                                $contadorRegistros = 0;
                                $totalDebe = 0.00;
                                $totalHaber = 0.00;

                                $totalDeudor = 0.00;
                                $totalAcreedor = 0.00;

                                $saldoAcreedor = 0.00;
                                $saldoDeudor = 0.00;

                                for ($contador; $contador < $tamanioMayor; ) {
                                    if ($listadoCuentasMayor[$i]["codigo"] == $listadoLibroMayor[$contador]["codigo"]) {
                                        $fecha = $listadoLibroMayor[$contador]["fecha"];
                                        $dia = substr($fecha, 8, 9);
                                        $mes = $meses[((int)(substr($fecha, 5, 7)))];
                                        $anio = substr($fecha, 0, 4);

                                        ?>
                                        <tr>
                                            <!-- columna ref partida-->
                                            <td><?php echo ($contadorRegistros + 1); ?></td>

                                             <!-- columna fecha de asiento-->
                                            <td><?php echo $dia . " de " . $mes . " de " . $anio; ?></td>

                                             <!-- columna concepto asiento-->
                                            <td><?php echo $listadoLibroMayor[$contador]["concepto"]; ?></td>


                                            <?php if ($listadoLibroMayor[$contador]["saldoDebe"] != "0.00") { ?>

                                             <!-- columna saldo debe-->
                                                <td class="saldos">$
                                                    <?php
                                                    echo $listadoLibroMayor[$contador]["saldoDebe"];
                                                    $banderaDebe = 1;
                                                    $mostrar = 0;

                                                    if ($banderaDebe == 1 && $banderaDeudora == 1) {
                                                        $saldoDeudor += $listadoLibroMayor[$contador]["saldoDebe"];
                                                        $banderaDeudora = 1;
                                                    } else if ($banderaDebe == 1 && $banderaDeudora == 0) {
                                                        $banderaDeudora = 0;
                                                        if ($listadoLibroMayor[$contador]["saldoDebe"] > $saldoAcreedor) {
                                                            $saldoDeudor = $listadoLibroMayor[$contador]["saldoDebe"] - $saldoAcreedor;
                                                            $saldoAcreedor = 0.00;
                                                            $banderaDeudora = 1;
                                                        } else {
                                                            $saldoAcreedor -= $listadoLibroMayor[$contador]["saldoDebe"];
                                                            $mostrar = 1;
                                                            $banderaDeudora = 0;
                                                        }
                                                    } else if ($contadorRegistros == 0) {
                                                        
                                                        $saldoDeudor = $listadoLibroMayor[$contador]["saldoDebe"];
                                                        $banderaDeudora = 1;
                                                    }

                                                    ?>


                                                </td>

                                                <!--columna saldo haber-->
                                                <td class="saldos">
                                                    $ <?php echo $listadoLibroMayor[$contador]["saldoHaber"]; ?>
                                                </td>

                                                 <!-- columna saldos-->
                                                <td class="saldos">$ <?php echo number_format($saldoDeudor, 2); ?></td>

                                                <?php
                                                if ($mostrar == 1) {
                                                    ?>
                                                    <td class="saldos">$ <?php echo number_format($saldoAcreedor, 2); ?></td>
                                                    <?php
                                                        $mostrar = 0;
                                                } else {
                                                ?>

                                                    <td class="saldos">$ <?php echo $listadoLibroMayor[$contador]["saldoHaber"]; ?></td>

                                                    <?php 
                                                }
                                        } else { ?>
                                                <td class="saldos">$ <?php echo "hola3".$listadoLibroMayor[$contador]["saldoDebe"]; ?></td>
                                                <td class="saldos">
                                                    $
                                                    <?php echo "hola4".$listadoLibroMayor[$contador]["saldoHaber"];
                                                    $banderaDebe = 0;
                                                    $mostrar = 0;

                                                    if ($banderaDebe == 0 && $banderaDeudora == 0) {
                                                        $saldoAcreedor += $listadoLibroMayor[$contador]["saldoHaber"];
                                                        $banderaDeudora = 0;
                                                    } else if ($banderaDebe == 0 && $banderaDeudora == 1) {
                                                        if ($listadoLibroMayor[$contador]["saldoHaber"] > $saldoDeudor) {
                                                            $saldoAcreedor = $listadoLibroMayor[$contador]["saldoHaber"] - $saldoDeudor;
                                                            $saldoDeudor = 0.00;
                                                            $banderaDeudora = 0;
                                                        } else {
                                                            $saldoDeudor -= $listadoLibroMayor[$contador]["saldoHaber"];
                                                            $saldoAcreedor = 0.0;
                                                            $mostrar = 1;
                                                        }
                                                    } else if ($contadorRegistros == 0) {
                                                        
                                                        $saldoAcreedor = $listadoLibroMayor[$contador]["saldoHaber"];
                                                        $banderaDeudora = 0;
                                                    }


                                                    ?>
                                                </td>
                                                <?php
                                                if ($mostrar == 1) {
                                                    ?>
                                                    <td class="saldos">$ <?php echo "hola5".number_format($saldoDeudor, 2); /*$banderaDeudora = 1;*/ ?></td>
                            
                                                <?php

                                            } else {
                                                ?>
                                                    <td class="saldos">$ <?php echo "hola6".$listadoLibroMayor[$contador]["saldoDebe"]; ?></td>
                                                <?php

                                            }
                                            ?>
                                                <td class="saldos">$ <?php echo "hola7".number_format($saldoAcreedor, 2); ?></td>

                                            <?php 
                                        } ?>



                                        </tr>


                                <?php $contadorRegistros++;
                                $totalDebe += $listadoLibroMayor[$contador]["saldoDebe"];
                                $totalHaber += $listadoLibroMayor[$contador]["saldoHaber"];

                                $totalDeudor += $saldoDeudor;
                                $totalAcreedor += $saldoAcreedor;

                            }

                            $contador++;
                        }
                        $banderaDebe = 5;
                        $banderaDeudora = 5;
                        ?>

                                <tr class="totalesLBM">
                                    <td colspan="3" class="esquinaBL">TOTALES</td>
                                    <td class="saldos">$ <?php echo number_format($totalDebe, 2); ?></td>
                                    <td class="saldos">$ <?php echo number_format($totalHaber, 2); ?></td>
                                    <td class="saldos esquinaBR">$ <?php echo number_format($totalDeudor, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>




                <?php
                $i++;
                $nPartida++;
                    //$contador = 0;
                $contadorRegistros = 0;
            } ?>

            </ul>
        </div>
    </section>

</body>

</html>