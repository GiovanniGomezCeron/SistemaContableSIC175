<article class="hide seccionRegPartida">

<div class="card tarjeta tarjeta-horizontal animate__bounceIn libroDiario formularioPartida" id="sectionListCuentas">
            <article id="btnCerrarFormPartida">
                <img src="img/cerrar.png" alt="imagenCerrar" id="">
            </article>
            
            <span class="card-title activator grey-text text-darken-4">
                Modificar Transacción
            </span>

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
                <span class="advertenciaTransacción partida fechaListado fecha hide magictime vanishIn" id="fechaTrasaccion">
                    <span class="material-icons">date_range</span>
                    <span class="titulo fecha fechaListadoValor" id="fechaValor"></span> 
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
               
                <table id="tableCuentasLBM" class="listadoDeAsientos edicionPartida">
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

</article>