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
                foreach ($cuentasPorElem as $ec) { ?>
                         <span class="card-title activator grey-text text-darken-4">
                            <?php echo $ec["elemento"]; ?>
                        </span>
                        <span class="cantidadItems">
                            <?php echo $ec["cantidad"]; ?>
                        </span>
                    <?php 
                } ?>   
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
                $contador = 0;          //cuenta la cantidad de cuentas por iteración
                $contadorRubro = 1;    //cuenta la cantidad de rubros
                $len = count($cuentas);//cantidad de cuentas
                $codigoAnterior = 10;  //guarda longitud de codigo de cuenta anterior

                //recorriendo todos los elementos contables
                for ($i = 0; $i < count($elemsContables); $i++) {
                    $elementoContableActual = $elemsContables[$i]["clasificacion"];?>

                         <tr class='listaMayor'>
                                <td><?php echo $elemsContables[$i]["id"]; ?></td>
                                <td><?php echo $elemsContables[$i]["clasificacion"]; ?></td>
                                <td class="extends">
                                    <i class="material-icons btnMostrarCuenta">expand_less</i>
                                </td>
                          </tr>

                    <?php 
                    $rubroActual = $cuentas[$contador]["subtipo"];
                    $codigoRubroActual = $elemsContables[$i]["id"].$contadorRubro;

                    //recorriendo todos los rubros siempre y cuando sean el mismo elem contable 
                    while ($elementoContableActual == $cuentas[$contador]["clasificacion"]) { ?>

                            <tr class="rubrosCuenta hide-element">
                                <td><?php echo $codigoRubroActual; ?></td>
                                <td><?php echo $rubroActual; ?></td>
                                <td class='extends-rubro'>
                                    <i class='material-icons btnMostrarCuenta'>visibility_off</i>
                                </td>
                                <td class='descripcion'><span class='descripcionCuenta'>Rubro</span></td>
                            </tr>
                        
                        <?php 
                        $imagen = "";
                        while ($rubroActual == $cuentas[$contador]["subtipo"]) {
                                $codigoCuenta = $cuentas[$contador]["codigo"];
                                $bold = strlen($codigoCuenta) == 4 ? "rubrosCuenta" : "";
                                
                                if($codigoAnterior < strlen($cuentas[$contador]["codigo"])){
                                    $imagen = "visibility_off";
                                    $codigoAnterior = $cuentas[$contador]["codigo"];
                                }
                            ?>

                            <tr class="magictime vanishIn <?php echo $bold;?>">
                                <td><?php echo  $codigoCuenta;?></td>
                                <td><?php echo $cuentas[$contador]["nombre"];?></td>
                                <td class='extends-rubro'>
                                    <i class='material-icons btnMostrarCuenta'><?php echo $imagen;?></i>
                                </td>
                                <td class='descripcion'><span class='descripcionCuenta'>Cuenta</span></td> 
                               
                                <td class='descripcion'><span class='descripcionCuenta estado hide'>Seleccionado</span></td>
                                
                            </tr>
                        <?php 
                            
                            $contador++; 
                            if($contador==$len){
                                goto end;
                            }
                        }
                        $rubroActual = $cuentas[$contador]["subtipo"];
                        $contadorRubro++;
                        $codigoRubroActual = $elemsContables[$i]["id"].($contadorRubro);
                    }
                    $contadorRubro=1;
                }
                end:?>    
    
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
        include "pages/detalleCuenta.php"; ?>
    </section>

        <?php include "pages/notificaciones.php"; ?>
</body>
</html>