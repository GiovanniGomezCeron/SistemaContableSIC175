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
    <script src="js/notificaciones.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
</head>

<body>

    <!-- Barra Lateral-->
    <?php include "pages/barraLateral.php"; ?>


    <!--SECCION DE CONTENIDO-->
    <!--BARRA DE USUARIO
        BARRA DE NAVEGACION
        TARJETA DE INFORMACION ACTIVOS
        TARJETA DE INFORMACION PASIVOS
        TARJETA DE INFORMACION CAPITAL
        TARJETA DE INFORMACION UTILIDAD
        TARJETA DE ULTIMOS MOVIMIENTOS        
        FORMULARIO DE REGISTRO DE CUENTAS
    -->

    <!--SECCION DE CONTENIDO-->
    <section class="content animate__bounceIn">

        <!--Barra de usuario--> 
        <div class="nav">
            <img src="img/dolar.png" class="logo">
            <i class="material-icons">arrow_drop_down</i>
            <span>Usuario</span>
            <img src="img/usuario (1).png" class="perfil">

        </div>

        <!-- Barra de navegación-->
        <section class="nivelNavegacion">
            <a href="inicioController.php?o=">DashBoard</a>
        </section>

        <!-- Tarjeta de Cuentas-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="image activator" src="img/documento.png">
            </div>
            <div>
                <span class="card-title activator grey-text text-darken-4">
                    Cuentas
                </span>
                <span class="cantidadItems">
                    15
                </span>
            </div>
        </div>

        <!-- Tarjeta de Activos-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="image activator" src="img/activo.png">
            </div>
            <div>
                <span class="card-title activator grey-text text-darken-4">
                    Activos
                </span>

                <span class="cantidadMonto">
                    $500,000
                </span>
            </div>
        </div>

        <!-- Tarjeta de Pasivos-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="image activator" src="img/responsabilidad.png">
            </div>
            <div>
                <span class="card-title activator grey-text text-darken-4">
                    Pasivos
                </span>
                <span class="cantidadMonto">
                    $500,000
                </span>
            </div>
        </div>

        <!-- Seccino de resumen de cuentas-->
        <div class="card tarjeta tarjeta-horizontal resumenCuentas animate__bounceIn">
            
            <span>Resumen de cuentas</span>

            <section class="seccionContent">
                <section class="tipoElemento">
                    <section>
                        <span>Activo</span>
                    </section>
                  
                    <section>
                        <span>14</span>
                    </section> 
                </section>

                <section class="tipoElemento">
                    <section>
                        <span>Pasivo</span>
                    </section>
                   
                    <section>
                        <span>14</span>
                    </section> 
                </section>

                <section class="tipoElemento">
                    <section>
                        <span>Patrimonio</span>
                    </section>
                   
                    <section>
                        <span>14</span>
                    </section> 
                </section>

                <section class="tipoElemento">
                    <section>
                        <span>Patrimonio</span>
                    </section>
                    >
                    <section>
                        <span>14</span>
                    </section> 
                </section>

                <section class="tipoElemento">
                    <section>
                        <span>Cuentas de resultado deudoras</span>
                    </section>
                    <img src="img/index/categorias.png" />
                    <section>
                        <span>14</span>
                    </section> 
                </section>

            
            </section>

        </div>

        <!-- secciond de operaciones-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn" id="movimientos">
          <section class="menubar">

              <span class="lastTranstions itemOperacion activated" role="ultimaTransaccion">
                  <img src="img/index/transaccion.png" class="lastTransImg"/>
                  Últimas transacciones
                </span>

              <span class="itemOperaciones itemOperacion" role="operaciones">
                <img src="img/index/operacion.png" class="lastTransImg"/>
                  Operaciones
                </span>

              <span class="itemOperaciones"> 
                  <span class="nOperaciones">2</span>
                  Advertencias
              </span>

              <span>
                  <span class="nAvisos">9</span>
                  Avisos 
              </span>

          </section>

          <section class="content-main">

          <section class="lastestTrasactions ultimaTransaccion  animate__bounceIn" id="ultimasTransacciones">
             <table class="tablaUltimasTransacciones">

             <?php 
                $i = 1;
                foreach($ultimasPartidas as $item){?>
                    <tr>
                            <td><?php echo $i.". ".$item["concepto"]?></td>
                            <td>
                                <span class="advertenciaTransacción partida">
                                    <span class="material-icons">import_contacts</span>
                                    <span class="titulo partidaTitulo">Partida #<?php echo $item["idPartida"];?></span> 
                                </span>
                        </td>
                    </tr>
                <?php 
                        $i++;
                    }?>
            
             </table>
           </section>
        
          <section class="operaciones hide animate__bounceIn">

                <span class="advertenciaTransacción operacion fecha startCicloCont <?php echo $estadoCiclo;?>" id="fechaTrasaccion">
                        <span class="material-icons">open_in_new</span>
                        <span class="titulo fecha" id="fechaValor">Apertura ciclo contable 2023</span> 
                </span>

                <span class="advertenciaTransacción operacion descripcion" id="fechaTrasaccion">
                        <span class="material-icons">done_all</span>
                        <span class="titulo fecha" id="fechaValor">El ciclo ha iniciado</span> 
                </span>


                
                 <span class="advertenciaTransacción operacion fecha" id="fechaTrasaccion">
                        <span class="material-icons">power_settings_new</span>
                        <span class="titulo fecha" id="fechaValor">Cierre ciclo contable 2023</span> 
                </span>
                <span class="advertenciaTransacción operacion descripcion" id="fechaTrasaccion">
                        <span class="material-icons">do_not_disturb</span>
                        <span class="titulo fecha" id="fechaValor">El ciclo no puede cerrar aún</span> 
                </span>
          </section>


          </section>
        </div>

        <!--FORMULARIO DE CUENTAS-->
       <?php include "formularioCuentas.php" ?>
       <?php include "pages/notificaciones.php";?>
    </section>
</body>








</html>