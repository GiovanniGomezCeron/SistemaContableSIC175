<?php  

class DaoLibroDiario{

    private $cn;
    public function __construct($param){
        
        include "util/querys.php";
        try{
            if($param==1){
                include "config/Conexion.php";
                $this->cn = (new Conexion("localhost","data_sic","root",""))->getConexion(); 
            }

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function ingresarTrasaccion($data){
        include "model/dao/DaoPartida.php";
        include "model/dao/DaoDetallePartida.php";
        include "model/dao/DaoLibroMayor.php";

        try{
           
            $transaccion = json_decode($data);
            $cuentas = $transaccion->cuentas;

        
           $dao = new DaoPartida();
           $daoDP = new DaoDetallePartida();

           $daoMayor = new DaoLibroMayor();
           
           $idPartida = $dao->ingresarPartida($transaccion);

           $folio = 0;

            foreach ($cuentas as $item) {
        

                $folio = $daoMayor->obtenerFolio($item);
               
               /*$numCuenta = $daoMayor->comprobarCuenta($item[0]);

               if($numCuenta == false ){
                    $cantidadCuenta = $daoMayor->cantidadCuentasMayor();
                    $folio = $daoMayor->ingresarCuenta($item[0],($cantidadCuenta+1));
                }else{
                    $folio = $numCuenta[0];
                }*/

              $daoDP->ingresarDetallePartida($item,$idPartida,$folio);

           }
                   
           echo json_encode("Partida Ingresada!");

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function mostrarListado(){
        include "model/dao/DaoDetallePartida.php";

        try{
            $dao  = new DaoDetallePartida();
           return $dao->obtenerDetallePartida();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function sumaSaldosPartidas(){
        try{
            include "model/dao/DaoPartida.php";
            $dao = new DaoPartida();
            return $dao->sumaSaldoPartidas();
        }catch(PDOException $e){

        }
    }

}



?>