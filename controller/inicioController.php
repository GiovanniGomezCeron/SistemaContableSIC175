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
                $array = null;
                foreach($listadoCuentas as $item){
                    $array[$item["codigo"]] = array("cuenta"=>$item["cuenta"],
                                                "movimientoDebe"=>$item["movimientoDebe"],
                                                "movimientoHaber"=>$item["movimientoHaber"]
                                               );
                }
                $ls = $array;
                $inventarioInicialQ =  $dao->obtenerInventarioInicial();
                include "pages/estadosResultados.php";
            break;

        case "balanceGeneral":
                include "model/dao/DaoPartida.php";
                include "config/Conexion.php";
                include "util/querys.php";

                $dao = new DaoPartida();

                $activos = $dao->activosFinales();
                $pasivos = $dao->pasivosCapitalFinales();

                $totalesRActivos = $dao->totalesRubroActivo();
                $totalesRPasivos = $dao->totalesRubroPasivo();

                //lista de rubro agrupado por nombre de cuenta
                $totalesActivos = $dao->totalesActivosPorRubro();
                $totalesPasivos = $dao->totalesPasivosPorRubro();

                $totalesRActivos = obtenerSaldosRubros($totalesRActivos,$totalesActivos);
                $totalesRPasivos = obtenerSaldosRubros($totalesRPasivos,$totalesPasivos);

                $listado1 = crearBalanceGeneral($activos,$totalesRActivos);
                $listado2 = crearBalanceGeneral($pasivos,$totalesRPasivos);
                
               
                include "pages/balanceGeneral.php";
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

function crearBalanceGeneral($elemento,$rubros){
    
   $listado = array();
   $len = count($elemento);
   $contador = 0;
   $contadorRubro = 0;

    if(count($rubros) > 0){

        $rubroActual    = "";
        $elementoActual = "";
        $text = "";

        while($contador < $len){
            if($elementoActual != $elemento[$contador]["clasificacion"]){
                $elementoActual = $elemento[$contador]["clasificacion"];
                array_push($listado,array(""));
                array_push($listado,array($elementoActual));
            }

            if($rubroActual != $elemento[$contador]["rubro"]){
                $rubroActual = $elemento[$contador]["rubro"];
                array_push($listado,array($rubroActual,$rubros[$contadorRubro]["saldo"]));
                $contadorRubro++;

            }
            if($rubroActual==$elemento[$contador]["rubro"]){
                array_push($listado,$elemento[$contador]);
                
            }
            $contador++;
        }
    }
    return $listado;
}

function obtenerSaldosRubros($listaInicial,$listaSaldos){

    if(count($listaInicial) > 0){

        $saldo = 0;
        $contadorRubro = 0; 

        $rubroActual = $listaInicial[0]["subtipo"];

        for($i=0; $i<count($listaSaldos); $i++){

            if($rubroActual != $listaSaldos[$i]["subtipo"]){

                #cambiando el saldo del rubro
                $listaInicial[$contadorRubro]["saldo"] = $saldo;

                #obteniendo el nuevo rubro
                $rubroActual = $listaSaldos[$i]["subtipo"];

                #iniciando el saldo en 0
                $saldo = 0;
            }

            $saldo+=$listaSaldos[$i]["saldo"];
           
        }

        return $listaInicial;
    }
    


}