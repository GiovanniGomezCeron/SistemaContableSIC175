<?php

class DaoEjercicioContable{
    private $cn;
    public function __construct(){
        try{
            include "config/Conexion.php";
            include "util/querys.php";

            $this->cn = (new Conexion("localhost","data_sic","root",""))->getConexion();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function iniciarCicloContable(){
        try{
            $stm = $this->cn->prepare(INSERT_CICLO_CONTABLE);

            $periodo = (int) (date("Y"));
            $stm->bindValue("1",$periodo);
            $stm->bindValue("2",1);
            $stm->execute();

            echo json_encode("Exito");
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function comprobarCicloContable(){
        try{
            $stm = $this->cn->prepare(COMPROBAR_CICLO_CONTABLE);

            $periodo = (int) (date("Y"));

            $stm->bindParam("1",$periodo);

            $stm->execute();

           if($stm->fetch()){
               return true;

           }else{
               return false;
           }
            
        }catch(PDOException $e){

        }
    }
}

?>