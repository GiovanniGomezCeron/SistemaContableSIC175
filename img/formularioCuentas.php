<section id="seccionFormCuenta" class="hide animate__bounceIn">
    <section class="formCuentaStn">
        <p class="tituloCuentas">
            <img src="img/cerrar.png" class="btnCerrar" id="btnCerrarFormCuenta">
        </p>

        <section class="sectionImageFormCuenta">
            <img src="img/documento.png" alt="" class="imgForm">
            <p>Nueva Cuenta</p>
        </section>


        <form action="" method="post" class="formCuenta" id="form">
            <section>
                <label for="cuenta">Nombre de Cuenta
                    <input type="text" name="cuenta" id="cuenta" class="cuenta" />
                </label>

                <label for="codigoCuenta">Código de Cuenta
                    <input type="text" name="cuenta" id="codigoCuenta" class="cuenta" />
                </label>
            </section>

            <section>
                <label for="tipoCuenta">Tipo de Cuenta
                    <select name="tipoCuenta" id="tipoCuenta" class="selectForms">
                        <option value="1">Principal</option>
                        <option value="2">Al Detalle</option>
                    </select>
                </label>

                <label for="clasificacionCuenta">Tipo de Elemento
                    <select name="clasificacionCuenta" id="clasificacionCuenta" class="selectForms">
                        <?php foreach($elemsContables as $e){?>
                            <option value="<?php echo $e["id"]?>"><?php echo $e["clasificacion"]?></option>
                        <?php }?>
                    </select>
                </label>
            </section>

            <label class="tipoRubro">Tipo de Rubro</label>
            <section>
                <section class="rubroSection">
                    <label for="rCorriente">Corriente</label>
                    <input type="radio" checked="checked" value="Corriente" id="rCorriente" name="tipo">
                    <label for="rCorriente" class="btnRadio"></label>
                </section>

                <section class="rubroSection">
                    <label for="rNoCorriente">No Corriente</label>
                    <input type="radio" value="NoCorriente" id="rNoCorriente" name="tipo">
                    <label for="rNoCorriente" class="btnRadio"></label>
                </section>

            </section>

               <section>
                <label for="tipoCuenta">Tipo de Saldo
                    <select name="tipoCuenta" id="tipoCuenta" class="selectForms">
                        <option value="1">Principal</option>
                        <option value="2">Al Detalle</option>
                    </select>
                </label>

                <label for="clasificacionCuenta">Nivel
                    <select name="clasificacionCuenta" id="clasificacionCuenta" class="selectForms">
                        <?php foreach($elemsContables as $e){?>
                            <option value="<?php echo $e["id"]?>"><?php echo $e["clasificacion"]?></option>
                        <?php }?>
                    </select>
                </label>
            </section>

            <input type="submit" id="btnEnviarFormCuenta" name="enviar" value="Agregar Cuenta" class="btnSubmit" />
        </form>
    </section>
</section>