<section class="barraLateral">
    <!-- Barra de esquina - titulo material -->
    <div class="nav">
        <p>SIC175</p>
    </div>

    <!-- Menu de barra lateral-->
    <ul>
        <!-- Item Dasboard-->
        <li class="animate__bounceIn">
            <img src="img/panel-de-administrador.png">
            <a href="">DashBoard</a>
        </li>


        <!-- Item Catalogo de cuentas-->
        <li class="itemList animate__bounceIn">
            <img src="img/libreta-de-depositos.png">
            <a>Catálogo de cuentas</a>

            <!-- Sección de subnivel-->
            <section class="subnivel animate__bounceIn hide">
                <li>
                    <i class="material-icons">play_arrow</i>
                    </i>
                    <a href="?o=<?php echo base64_encode("catalogoCuentas"); ?>">Ver Catalogo</a>
                </li>
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a id="addCuenta">Agregar Cuenta</a>
                </li>
            </section>
        </li>


        <!-- Item Libro diario-->
        <li class="itemList animate__bounceIn">
            <img src="img/libro-de-diario.png">
            <a>Libro Diario</a>
             <!-- Sección de subnivel-->
             <section class="subnivel animate__bounceIn hide">
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a href="?o=<?php echo base64_encode("libroDiario");?>">Registrar transacciones</a>
                </li>
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a href="?o=<?php echo base64_encode("listadoLibroDiario");?>" id="addCuenta">Ver libro diario</a>
                </li>
            </section>
        </li>


        <!-- Item Libro Mayor-->
        <li class="animate__bounceIn itemList">
            <img src="img/libro-mayor.png">
            <a href="?o=<?php echo base64_encode("libroMayor");?>">Libro Mayor</a>
            <!-- Sección de subnivel
            <section class="subnivel animate__bounceIn hide">
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a href="?o=<?php echo base64_encode("libroMayor");?>">Ver Libro Mayor</a>
                </li>
            </section>-->
        </li>

        <!-- Item Balanza de comprobación-->
        <li class="animate__bounceIn">
            <img src="img/calcular.png">
            <a href="?o=<?php echo base64_encode("balanzaComprobacion");?>">Balanza de Comprobación</a>
        </li>

         <!-- Item Estado de resultado-->
         <li class="itemList animate__bounceIn">
            <img src="img/contabilidad.png">
            <a>Estado de Resultado</a>
            <!-- Sección de subnivel-->
            <section class="subnivel animate__bounceIn hide">
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a href="?o=<?php echo base64_encode("estadoResultados");?>">Estado de resultados</a>
                </li>
                <li>
                    <i class="material-icons">play_arrow</i>
                    <a href="?o=<?php echo base64_encode("listadoLibroDiario");?>" id="addCuenta">Estado de Costos</a>
                </li>
            </section>
        </li>

        <!-- Item Balance General-->
        <li class="animate__bounceIn">
            <img src="img/hoja-de-balance.png">
            <a href="">Balance General</a>
        </li>


        <!-- Item de ajustes-->
        <li class="animate__bounceIn">
            <img src="img/ajustes.png">
            <a href="">Mantenimiento</a>
        </li>
    </ul>
</section>