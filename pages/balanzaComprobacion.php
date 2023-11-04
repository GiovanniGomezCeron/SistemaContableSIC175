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
    <title>Balanza de comprobación</title>
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
            <a>Balanza de comprobación</a>
        </section>

        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario listadoLibroDiario" id="sectionListCuentas">
            <span class="card-title activator grey-text text-darken-4">
               Balanza de comprobación
            </span>           
          
            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <ul class="bloqueLbDiario" id="bloqueLbDiario">
            <!--LISTADO DE PARTIDAS-->   
                
                    <?php 

                    $i = 0;
                    $saldo = 0;
                    $tamanio = count($listadoCuentas);

                    $movDebe = 0; $movHaber = 0;
                    $salDebe = 0; $salHaber = 0;
                   
                    if($tamanio>0){?>
    
                            <section class='sectionPartida'>

                                <table id='tableCuentasLBM' class='balanza tablaPartidas listadoAsientos'>
                                    <thead>
                                        <tr class="encabezadoLibroDiario" >
                                            <th rowspan="2" class="cuentasBalanza" id="cuentaConceptoL">Cuentas</th>
                                            <th colspan="2">Movimientos</th>
                                            <th colspan="2" class="ultimo">Saldos</th>
                                        </tr>
                                        <tr class="encabezadoLibroDiario">
                                            <th class="encabezadoSaldo deudorPrimero">Deudor</th>
                                            <th class="encabezadoSaldo">Acreedor</th>
                                            <th class="encabezadoSaldo">Deudor</th>
                                            <th class="encabezadoSaldo">Acreedor</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                        <?php 
                            while ($i < $tamanio) {?>
                                    <tr>
                                        <td><?php echo $listadoCuentas[$i]["cuenta"];?></td>
                                        <?php  $movimientoDebe  = $listadoCuentas[$i]["movimientoDebe"];
                                               $movimientoHaber = $listadoCuentas[$i]["movimientoHaber"];
                                        ?>
                                        <td><?php echo "$".$movimientoDebe;?></td>
                                        <td><?php echo "$".$movimientoHaber;?></td>
                                        <?php 
                                                if($movimientoDebe > $movimientoHaber){
                                                    $saldo = $movimientoDebe - $movimientoHaber;
                                                        echo "<td>$$saldo</td>
                                                              <td>$0.00</td>";
                                                              $salDebe += $saldo;

                                                }else if($movimientoHaber > $movimientoDebe){
                                                    $saldo = $movimientoHaber - $movimientoDebe;
                                                        echo "<td>$0.00</td>
                                                              <td>$$saldo</td>";
                                                              $salHaber += $saldo; 
                                                }else{
                                                        echo "<td>$0.00</td>
                                                              <td>$0.00</td>";
                                                }  
                                            $movDebe  += $movimientoDebe;
                                            $movHaber += $movimientoHaber;
                            $i++;
                        }
                    }?>

                    <tr id="conceptoPartida" class="pieBalanza">
                        <td><b>TOTALES</b></td>
                        <td><?php echo  "$".$movDebe;?></td>
                        <td><?php echo  "$".$movHaber;?></td>
                        <td><?php echo  "$".$salDebe;?></td>
                        <td ><?php echo "$".$salHaber;?></td>
                    </tr>
                                
                </table>
            </ul>
        </div>


        <!--FORMULARIO DE REGISTRO DE CUENTAS-->
        <?php include "pages/formularioCuentas.php";
        include "pages/detalleCuenta.php"; ?>
    </section>

        <?php include "pages/notificaciones.php";?>

    <script src="js/notificaciones.js"></script>
</body>
</html>