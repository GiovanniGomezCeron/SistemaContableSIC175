<?php  
    include "model/dao/DaoLibroDiario.php";

    function ingresarAsiento(){

        $data = file_get_contents("php://input");
        
        $dao = new DaoLibroDiario(1);
        $dao->ingresarTrasaccion($data);
        
    }



?>