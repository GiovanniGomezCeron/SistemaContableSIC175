<?php

class DaoPartida
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


    public function ingresarPartida($data){
        try {
            $statement = $this->conexion->prepare(INSERT_PARTIDA);

            $statement->bindValue(1, $data->saldoDebe);
            $statement->bindValue(2, $data->saldoHaber);
            $statement->bindValue(3, $data->fecha);
            $statement->bindValue(4,$data->concepto);

            $idPeriodo = (int)($this->buscarCicloActual())->idEjercicioContable;

            $statement->bindValue(5, $idPeriodo);
    
            $statement->execute();

            $statement = $this->conexion->query(PARTIDA_RECIENTE);

            $statement->execute();
            
            return $statement->fetch()[0];


        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function buscarCicloActual(){
        try {
            $statement = $this->conexion->prepare(OBTENER_CICLO_CONT_ACTUAL);

            $statement->execute();

            return $statement->fetchObject();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function buscarUltimasPartidas(){
        try {
            $statement = $this->conexion->prepare(ULTIMAS_PARTIDAS);

            $statement->execute();

            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function sumaSaldoPartidas(){
        try {
            $statement = $this->conexion->prepare(SUMA_SALDOS_PARTIDAS);

            $statement->execute();

            return $statement->fetch();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function seleccionarPartida($idPartida){
       
        try {
            $statement = $this->conexion->prepare(SELECT_PARTIDA);

            $statement->bindValue(1,$idPartida,PDO::PARAM_INT);

            $statement->execute();

            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editarPartida($data){
        include "model/dao/DaoLibroMayor.php";
        try{
            $cuentas = $data->cuentas;
            $daoMayor = new DaoLibroMayor();
           
            $partida = $data->partida;

           foreach($cuentas as $item){

                $folio = $daoMayor->obtenerFolio($item);

                if($item[3]==0){
                    include "model/dao/DaoDetallePartida.php";
                    $dao = new DaoDetallePartida();
                    $dao->ingresarDetallePartida($item,$partida,$folio);

                }  else{
                    $stm = $this->conexion->prepare(EDITAR_PARTIDA); //stmt
                    $stm->bindValue(1,$item[0],PDO::PARAM_STR); //cuenta
                    $stm->bindValue(2,$folio,PDO::PARAM_INT);//folio
                    $stm->bindValue(3,$item[1]); //saldoDebe
                    $stm->bindValue(4,$item[2]); //saldoHaber
                    $stm->bindValue(5,$item[3],PDO::PARAM_INT);     //partida
                    $stm->execute();
                    
                }
                
        }

        $stm = $this->conexion->prepare(EDITAR_DATOS_PARTIDA);
        $stm->bindValue(1,$data->concepto,PDO::PARAM_STR);
        $stm->bindValue(2,$data->saldoDebe);
        $stm->bindValue(3,$data->saldoHaber);
        $stm->bindValue(4,$data->fecha);
        $stm->bindValue(5,$partida);
        $stm->execute();

        echo json_encode("Operación exitosa!");

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    //UPDATE detalle_partida SET cuenta=?, folio=?, saldoDebe = ?, saldoHaber = ? 
    //WHERE idDetallePartida = ?
    
    }

    public function obtenerBalanzaComprobacion(){
        try{
             $stm = $this->conexion->query(BALANZA_COMPROBACION);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }


    public function totalesRubroActivo(){
        try{
             $stm = $this->conexion->query(TOTALES_RUBRO_ACTIVO);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function totalesActivosPorRubro(){
        try{
             $stm = $this->conexion->query(SELECCIONAR_TOTAL_ACTIVO_RUBRO);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function totalesPasivosPorRubro(){
        try{
             $stm = $this->conexion->query(SELECCIONAR_TOTAL_PASIVO_RUBRO);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function totalesRubroPasivo(){
        try{
             $stm = $this->conexion->query(TOTALES_RUBRO_PASIVO);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function activosFinales(){
        try{
             $stm = $this->conexion->query(OBTENER_ACTIVOS_FINALES);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function pasivosCapitalFinales(){
        try{
             $stm = $this->conexion->query(OBTENER_PASIVOS_CAPITAL_FINALES);
             $stm->execute();
            
             return $stm->fetchAll();

        }catch(PDOException $e){
            $e->getMessage();
        }
    }

    public function eliminarPartida($id){
        try {
            $statement = $this->conexion->prepare(OBTENER_PARTIDA_ID);
            $statement->bindValue(1,$id,PDO::PARAM_INT);
            $statement->execute();

            $id = $statement->fetchObject()->idPartida;

            $statement = $this->conexion->prepare(ELIMINAR_PARTIDA);
            $statement->bindValue(1,$id);
            $statement->execute();

           
        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function obtenerInventarioInicial()
    {
        try {
            $stm = $this->conexion->query(INVENTARIO_INICIAL);
            $stm->execute();

            return $stm->fetchAll();

        } catch (PDOException $e) {
        }
    }
}
