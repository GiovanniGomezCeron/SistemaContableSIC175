<?php
    include "model/dao/DaoCuentas.php";

    function ingresoCuenta($op){
        $data = obtenerDatosCuenta();
        $daoC = new DaoCuentas(1);
           
        $daoC->ingresarCuenta($data,$op);
       /* if($op==1){
            $daoC->ingresarSubCuenta($data);
        }*/
        
        
    }

    function detalleCuenta(){
        $codigo = base64_decode($_REQUEST["codigo"]);
        $daoC = new DaoCuentas(1);
        $daoC->obtenerDetalleCuenta($codigo);
    }


    function obtenerDatosCuenta(){
        $data = file_get_contents("php://input");
        $json = json_decode($data);
        return $json;
    }
?>