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
    <script src="js/catalogoCuentas.js"></script>
    <script src="js/jquery-3.6.4.js"></script>
    <script src="js/notificaciones.js"></script>
    
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

        <!--BARRA DE USUARIO-->
        <div class="nav">
            <img src="img/dolar.png" class="logo">
            <i class="material-icons">arrow_drop_down</i>
            <span>Usuario</span>
            <img src="img/usuario (1).png" class="perfil">
        </div>

        <!--BARRA DE NAVEGACION-->
        <section class="nivelNavegacion">
            <a href="?o">DashBoard</a>
            <i class="material-icons">chevron_right</i>
            <a href="">Catálogo de Cuentas</a>
        </section>


        <!--TARJETA DE RESUMEN DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn" id="sectionResumenCuenta">
            
            <!--ENCABEZADO DE TARJETA (TITULO)-->
            <span class="card-title activator grey-text text-darken-4">
                Resumen de Cuentas
            </span>

             <!--CONTENIDO DE TARJETA-->
            <div id="seccionResumenCuentas">
                 <!--DATOS DE CUENTAS-->
                <span class="card-title activator grey-text text-darken-4">
                    Cuentas
                </span>
                <span class="cantidadItems">
                    <?php echo count($cuentas); ?>
                </span>

                 <!--DATOS Por elementos-->
                <?php 
                    foreach($cuentasPorElem as $ec){?>
                         <span class="card-title activator grey-text text-darken-4">
                            <?php echo $ec["elemento"]; ?>
                        </span>
                        <span class="cantidadItems">
                            <?php echo $ec["cantidad"]; ?>
                        </span>
                    <?php }?>   
            </div>
        </div>


        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn" id="sectionListCuentas">

            <!--TITULO DE TARJETA-->
            <span class="card-title activator grey-text text-darken-4">
                Cuentas
            </span>

            <!--BOTON PARA MOSTRAR FORM DE REGISTRO DE CUENTA-->
            <input type="submit" name="enviar" value="Nueva Cuenta" class="btnSubmit" id="addCuenta" />

            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/basura.png" class="ajuste disabled" id="btnEliminarCuenta"> 
               <img src="img/dibujar.png" class="ajuste disabled" id="btnModificarCuenta">
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <ul class="">
                <!--TABLA CON LISTA DE CUENTAS-->
                <table class="tableCuentas">

                <?php
                $iR = 1;
                $nameRubro = "";
                $nameCuenta = "";
                for ($i = 0; $i < count($elemsContables); $i++) {
                    $idEC = $elemsContables[$i]["id"];
                    echo "<tr class='listaMayor'>
                                <td>" . $idEC . " </td>
                                <td>" . $elemsContables[$i]['clasificacion'] . "</td>
                                <td class='extends'>
                                    <i class='material-icons btnMostrarCuenta'>expand_less</i>
                                </td>
                            </tr>";

                    for ($j = 0; $j < count($rubrosPorElm); $j++) {
                        if ($rubrosPorElm[$j]["elemento_contable"] == $idEC) {
                            $nameRubro = $idEC . ($iR);
                            $name = $idEC;
                            echo "  <tr class='rubrosCuenta " . $nameRubro . " hide-element'  name='" . $name . "'>
                                        <td>" . $nameRubro . "</td>
                                        <td>" . $rubrosPorElm[$j]['rubro'] . "</td>
                                        <td class='extends-rubro'>
                                            <i class='material-icons btnMostrarCuenta'>visibility_off</i>
                                        </td>
                                        <td class='descripcion'><span class='descripcionCuenta'>Rubro</span></td>
                                    </tr>";

                            for ($k = 0; $k < count($cuentas); $k++) {
                                $cuentaRubro = $cuentas[$k]["rubro"];
                                $cuentaElemento = $cuentas[$k]["elemento"];
                                $rubroActual = $rubrosPorElm[$j]["idRubro"];

                                //$caracter = ($k == 0) ? "&#9484;" : "&#9474;";
                                if ($cuentas[$k] == null) {
                                    continue;
                                    /*name = "codigo propio de cuenta"
                                    class = "dependencia"*/
                                }

                                if ($cuentaElemento == $idEC && $cuentaRubro == $rubroActual) {
                                    $nameCuenta = $cuentas[$k]["codigo"];
                                    $subcuenta = $subcuentas[$k]["subcuentas"];

                                    $imagen = ($subcuenta) == 0 ? "" : "visibility_off";

                                    $bold = strlen($nameCuenta)== 4 ? "rubrosCuenta":"";

                                    echo "<tr name=" . $nameRubro . " class='magictime vanishIn $bold'>
                                            <td>" . $nameCuenta . "</td>
                                            <td>" . $cuentas[$k]["nombre"] . "</td>
                                            <td class='extends-rubro'>
                                                <i class='material-icons btnMostrarCuenta'>" . $imagen . "</i>
                                            </td>
                                            <td class='descripcion'><span class='descripcionCuenta'>Cuenta</span></td> 
                                            <td class='descripcion'><span class='descripcionCuenta estado hide'>Seleccionado</span></td>
                                         </tr>";
                                    //unset($cuentas[$k]);
                                }

                            }
                            $iR++;
                        }

                    }
                    $iR = 1;
                }



                /*
                    <td class='extends-rubro'>
                     <i class='material-icons'>remove_red_eye</i>
                    </td>
                 */
                ?>
                </table>
            </ul>
            <!--<section class="panelDetalleCuentas">
               <p>
                    Cuenta Principal
               </p>
               <p>
                    Saldo Acreedor
               </p>
               <p>
                    <span class="material-icons">
                    attach_money
                    </span>
                    20 SC
                </p>
            </section>-->
        </div>


        <!--FORMULARIO DE REGISTRO DE CUENTAS-->
        <?php include "pages/formularioCuentas.php";
              include "pages/detalleCuenta.php";?>
    </section>

        <?php include "pages/notificaciones.php"; ?>
</body>
</html>