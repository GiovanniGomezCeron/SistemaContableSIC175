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
    <script src="js/libroDiario.js"></script>
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
            <a href="">Libro Diario</a>
        </section>

        <!--TARJETA DE LISTADO DE CUENTAS-->
        <div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario" id="sectionListCuentas">
            <span class="card-title activator grey-text text-darken-4">
                Registro de transacciones 
            </span>
          
            <section class="panelCuentas">
               <img src="img/configuraciones.png" class="ajuste" id="btnAjustes"> 
               <img src="img/informacion1.png" class="ajuste disabled" id="btnDetalleCuenta"> 
            </section>

            <section id="elementosTransacion">
                <section>
                    <label class="lblCuentasListado">Cuenta</label>
                    <label class="lblCuentasListado">Monto</label>
                </section>

                <section>
                    <section class="entradaCuentas">
                        <select id="cuentasListado">
                            <?php foreach ($cuentas as $c) { ?>
                                <option value="<?php echo $c["codigo"]; ?>"><?php echo $c["nombre"]; ?></option> 
                            <?php 
                        } ?>
                        </select>
                    </section>
                    <section class="entradaCuentas">
                        <label>$</label>
                        <input type="text" id="montoOperar" class="entradaCuentas">
                    </section>
                </section>
                <section>

                    <label class="lblCuentasListado">Tipo de operación</label>
                    <label class="lblCuentasListado">Fecha</label>
                </section>

                    <!--<section class="entradaCuentas">-->
                    <section>
                        <section class="entradaCuentas">
                            <section class="rubroSection">
                                <label for="rCorriente">Cargar</label>
                                    <input type="radio" checked="checked" value="Cargar" class="btnCargar" id="rCorriente" name="tipo">
                                <label for="rCorriente" class="btnRadio "></label>
                            </section>

                            <section class="rubroSection">
                                <label for="rNoCorriente">Abonar</label>
                                <input type="radio" value="Abonar" class="btnAbonar" id="rNoCorriente" name="tipo">
                                <label for="rNoCorriente" class="btnRadio"></label>
                            </section>
                        </section>
                    
                        <section class="entradaCuentas">
                            <input type="date" id="fechaTransaccion" class="fechaTransaccion"/>
                            <span class="material-icons btnFecha" id="seleccionarFecha">keyboard_return</span>
                        </section>
                    </section>
                    <!--</section>-->

               
                    <section class="entradaCuentas">
                    </section>
                    <section class="entradaCuentas">
                        <input type="submit" value="save" id="asentar" class="material-icons"/>
                    </section>
                   
                
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
              
                 
                 <span class="advertenciaTransacción partida">
                    <span class="material-icons">import_contacts</span>
                    <span class="titulo partidaTitulo">Partida #1</span> 
                </span>

                <!--TABLA CON LISTA DE CUENTAS-->
                        <br></br>
               
                <table id="tableCuentasLBM" class="listadoDeAsientos">
                    <thead>
                        <th>Código</th>
                        <th>Cuentas</th>
                        <th class="columnaDebe">Debe</th>
                        <th class="columnaHaber">Haber</th>
                        <th colspan="2">Operaciones</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
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

            
             <section class="entradaCuentas concepto">
                    <label class="lblConcetoTransaccion" for="conceptoTransaccion">Concepto:</label>
                    <input type="text" id="conceptoTransaccion" class="conceptoTransaccion"/>
            </section>

            <section class="seccionSaldos">
                    <article class="saldo">
                        Saldos
                    </article>
                   <article class="debe" id="saldoDebeGlobal">
                        $0.00
                   </article>
                   <article class="haber" id="saldoHaberGlobal">
                         $0.00
                   </article>
            </section>
            

              <!--BOTON PARA MOSTRAR FORM DE REGISTRO DE CUENTA-->
              <input type="submit" name="enviar" value="Guardar transacción" class="btnTransaccion" id="addCuenta" />

        </div>


        <!--FORMULARIO DE REGISTRO DE CUENTAS-->
        <?php include "pages/formularioCuentas.php";
        include "pages/detalleCuenta.php"; ?>
    </section>

        <?php include "pages/notificaciones.php"; ?>

    <script src="js/notificaciones.js"></script>
</body>
</html>