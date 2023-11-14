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
    <title>Balance General</title>
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
                Balance General
            </span>           
          
            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <ul class="bloqueLbDiario cuentasER" id="bloqueLbDiario">

                <table id="listadoCuentasER">

            <?php 

                $lenActivos = count($listado1);
                $lenPasivos = count($listado2);
                $totalActivos = 0;
                $totalPasivos = 0;
                $contador = 0;?>
                
                
               
                <?php while($contador < $lenActivos || $contador < $lenPasivos){?>
                    <tr>
                    <?php
                        #imprimiendo activos
                        if($contador < $lenActivos){

                            if(isset($listado1[$contador]["codigo"])){?>
                                <td><?php echo $listado1[$contador]["nombre"];?></td>
                                <td><?php echo "$".number_format($listado1[$contador]["saldo"],2,".",",");?></td>
                                <td></td>
                    <?php 
                                $totalActivos+=$listado1[$contador]["saldo"];
                               
                            }else{?>
                                <td class="total"><?php echo $listado1[$contador][0];?></td>
                                <td></td>

                    <?php       if(isset($listado1[$contador][1])){?> 
                                    <td class="pintar2 total"><?php echo "$".number_format($listado1[$contador][1],2,".",",");?></td>
                    <?php       }else{?>
                                    <td></td>
                    <?php       }?> 
                    <?php  } 
                        }else{
                            echo "<td></td><td></td><td></td>";
                        }?>
                                
                        <td></td>

                    <?php 
                            if($contador < $lenPasivos){
                                if(isset($listado2[$contador]["codigo"])){?>
                                    <td><?php echo $listado2[$contador]["nombre"];?></td>
                                    <td><?php echo "$".number_format($listado2[$contador]["saldo"],2,".",",");?></td>
                                    <td></td>
                    <?php       
                                    $totalPasivos+=$listado2[$contador]["saldo"];
                                }else{?>

                                    <td class="total"><?php echo $listado2[$contador][0];?></td>
                                    <td></td>

                                    <?php if(isset($listado2[$contador][1])){?>
                                            <td class="pintar2 total"><?php echo "$".number_format($listado2[$contador][1],2,".",",");?></td>
                                    <?php }else{?>
                                            <td></td>
                                    <?php } ?>
                    <?php        
                                }
                            }else{
                                echo "<td></td><td></td><td></td>";
                            }?>
                    </tr>
                    
            <?php $contador++;}?>

                    <!--<tr>      
                        <td class="total">Corriente</td>
                        <td></td>
                        <td class="pintar2 total">$1,245,000</td>

                        <td></td>

                        <td class="total">Corriente</td>
                        <td></td>
                        <td class="pintar2 total">$10000</td>
                    </tr>

                   totales-->
                   <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    <tr>    
                        <td class="total">Total Activos</td>
                        <td class="total pintar">$<?php echo number_format($totalActivos,2,".",",");?></td>
                        <td></td>

                        <td></td>

                        <td class="total">Total Pasivo + Capital</td>
                        <td class="total pintar">$<?php echo number_format($totalPasivos,2,".",",");?></td>
                        <td></td>
                    </tr>
                </table>
                   
            </ul>
        </div>
    </section>
</body>
</html>