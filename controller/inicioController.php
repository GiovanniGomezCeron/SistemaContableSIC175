<?php

if (!isset($_REQUEST["o"])) {
    $estadoCiclo = null;
    if (verificarPeriodo()) {
        $estadoCiclo = "desabilitado";
    }

    $ultimasPartidas = obtenerUltimasPartidas();

    include "model/dao/DaoCuentas.php";

    $dao = new DaoCuentas(0);
    $elemsContables = $dao->elementosContables();
    $rubros = $dao->rubrosContables();
    $saldos = $dao->saldoContables();
    $tipoCuenta = $dao->tipoCuenta();
    include "pages/index.php";
} else {

    $opcion = base64_decode($_REQUEST["o"]);

    switch ($opcion) {

        case "request":
            include "config/ajax.php";

            break;
        case "libroDiario":
            include "model/dao/DaoCuentas.php";

            $dao = new DaoCuentas(1);
            $cuentas = $dao->obtenerCuentas();
            include "pages/libroDiario.php";
            break;

        case "listadoLibroDiario":
            include "model/dao/DaoLibroDiario.php";
            include "model/dao/DaoCuentas.php";

            $dao = new DaoLibroDiario(1);
            $listadoPartidas = $dao->mostrarListado();
            $sumaSaldos = $dao->sumaSaldosPartidas();

            $dao = new DaoCuentas(2);
            $cuentas = $dao->obtenerCuentas();

            include "pages/listadoLibroDiario.php";
            break;

        case "catalogoCuentas":
            include "model/dao/DaoCuentas.php";

            $dao = new DaoCuentas(1);

            //cantidad de cuentas
            $cuentasPorElem = $dao->cantidadCuentasPorElm();

            //listado de cuentas
            //$cuentasPrincipales = $dao->cuentasPrincipales();
            $cuentas = $dao->obtenerCuentas();
            $elemsContables = $dao->elementosContables();
            $rubros = $dao->rubrosContables();
            $rubrosPorElm = $dao->obtenerRubrosPorElemento();

            $subcuentas = $dao->obtenerSubcuentasPorCuenta();
            $saldos = $dao->saldoContables();
            $tipoCuenta = $dao->tipoCuenta();

            include "pages/catalogoCuentas.1.php";

            break;

        case "libroMayor":
            include "model/dao/DaoLibroMayor.php";
            include "config/Conexion.php";
            include "util/querys.php";
            $dao = new DaoLibroMayor();
            $listadoLibroMayor = $dao->mostrarListadoMayor();
            $listadoCuentasMayor = $dao->listadoCuentasMayor();

            include "pages/libroMayor.php";
            break;

        case "balanzaComprobacion":
            include "model/dao/DaoPartida.php";
            include "config/Conexion.php";
            include "util/querys.php";
            $dao = new DaoPartida();
            $listadoCuentas = $dao->obtenerBalanzaComprobacion();
            include "pages/balanzaComprobacion.php";

            break;

        case "estadoResultados":
            include "model/dao/DaoPartida.php";
            include "config/Conexion.php";
            include "util/querys.php";
            $dao = new DaoPartida();
            $listadoCuentas = $dao->obtenerBalanzaComprobacion();
            $inventarioInicialQ =  $dao->obtenerInventarioInicial();

            include "pages/estadosResultados.php";
            break;

        default:
            $estadoCiclo = null;
            if (verificarPeriodo()) {
                $estadoCiclo = "desabilitado";
            }
            $ultimasPartidas = obtenerUltimasPartidas();
            include "model/dao/DaoCuentas.php";

            $dao = new DaoCuentas(0);
            $elemsContables = $dao->elementosContables();
            $rubros = $dao->rubrosContables();
            $saldos = $dao->saldoContables();
            $tipoCuenta = $dao->tipoCuenta();
            include "pages/index.php";
    }
}


function verificarPeriodo()
{
    include "model/dao/DaoEjercicioContable.php";
    $dao = new DaoEjercicioContable();
    return $dao->comprobarCicloContable();
}


function obtenerUltimasPartidas()
{
    include "model/dao/DaoPartida.php";
    $dao = new DaoPartida();
    return $dao->buscarUltimasPartidas();
}
