<?php

    $peticion = isset($_REQUEST["a"]) ? base64_decode($_REQUEST["a"]) : "";
    
    if(!empty($peticion)){
        switch($peticion){
            case "detalleCuenta":
            include "config/fnCatalogoCuentas.php";
               
                detalleCuenta();
            break;

            case "ingresoCuenta":
                include "config/fnCatalogoCuentas.php";
                ingresoCuenta(1);
            break;

            case "modificarCuenta":
                include "config/fnCatalogoCuentas.php";
                ingresoCuenta(2);
                break;

            case "ingresoAsiento":
                include "config/fnLibroDiario.php";
                ingresarAsiento();
                break;
            
            case "inicioCicloContable":
                include "model/dao/DaoEjercicioContable.php";
                $dao = new DaoEjercicioContable();
                $dao->iniciarCicloContable();
                break;

            case "consultarPartida":
                include "model/dao/DaoPartida.php";
                include "config/Conexion.php";
                include "util/querys.php";

                $dao = new DaoPartida();

                $code =base64_decode($_REQUEST["code"]);
                $code = (int) $code;
               
                echo json_encode($dao->seleccionarPartida($code));

            break;

            case "editarAsiento":
                    include "model/dao/DaoPartida.php";
                    include "config/Conexion.php";
                    include "util/querys.php";
                    $dao = new DaoPartida();

                    $data = file_get_contents("php://input");
                    $dao->editarPartida(json_decode($data));
            break;

            case "eliminarPartida":
                    include "model/dao/DaoPartida.php";
                    include "config/Conexion.php";
                    include "util/querys.php";
                    $nPartida = base64_decode($_REQUEST["code"]);
                   
                    $dao = new DaoPartida();
                    $dao->eliminarPartida($nPartida);

                    echo json_encode("Operación exitosa");

            break;
        }
    }

    

  

?>