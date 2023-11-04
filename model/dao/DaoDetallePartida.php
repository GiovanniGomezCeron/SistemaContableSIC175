<?php

class DaoDetallePartida
{
    public $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new Conexion("localhost", "data_sic", "root", "");
            $this->conexion = $this->conexion->getConexion();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function ingresarDetallePartida($item,$partida,$folio){
        try {

               $cuenta = (int)$item[0];
               $saldoDebe = $item[1];
               $saldoHaber = $item[2];

               $statement = $this->conexion->prepare(INSERT_DETALLE_PARTIDA);
               $statement->bindValue(1,$cuenta);
               $statement->bindValue(2,$saldoDebe);
               $statement->bindValue(3,$saldoHaber);
               $statement->bindValue(4,$partida);
               $statement->bindValue(5,$folio);

               $statement->execute();
    

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function obtenerDetallePartida(){
        try {
                $stm = $this->conexion->prepare(LISTADO_PARTIDAS);
                $stm->execute();

                return $stm->fetchAll();    

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

}
