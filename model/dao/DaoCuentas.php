<?php



class DaoCuentas
{
    public $conexion;


    public function __construct($param)
    {
        try {
            if($param==1){
                include "config/Conexion.php";
                include "util/querys.php";
            }   

            $this->conexion = new Conexion("localhost", "data_sic", "root", "");
            $this->conexion = $this->conexion->getConexion();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

  
    public function obtenerCuentas()
    {
        try {
            $statement = $this->conexion->query(SELECT_ALL_CUENTAS2);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function cantidadCuentas()
    {
        try {
            $statement = $this->conexion->query(SELECT_ALL_CUENTAS);
            return $statement["cuentas"];
        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function cantidadCuentasPorElm()
    {
        try {
            $statement = $this->conexion->query(SELECT_CUENTAS_POR_ELM);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function cuentasPrincipales()
    {
        try {
            $statement = $this->conexion->query(SELECT_CUENTAS_PRINCIPALES);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function elementosContables()
    {
        try {
            $statement = $this->conexion->query(SELECT_ELEMENTOS_CONTABLES);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function rubrosContables()
    {
        try {
            $statement = $this->conexion->query(SELECT_RUBROS_CONTABLES);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function obtenerRubrosPorElemento()
    {
        try {
            $statement = $this->conexion->query(SELECT_RUBROS_ELEMENT_CONTABLE);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function buscarSubCuentas($idCuentaPrincipal)
    {
        try {
            $statement = $this->conexion->query(SELECT_CUENTAS_CAPITAL);
            return $statement->fetch()["capital"];

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function obtenerSubcuentasPorCuenta()
    {
        try {
            $statement = $this->conexion->query(SELECT_SUBCUENTAS_CUENTAS);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    
    public function saldoContables()
    {
        try {
            $statement = $this->conexion->query(SELECT_SALDO);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function tipoCuenta()
    {
        try {
            $statement = $this->conexion->query(SELECT_TIPO);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }


    public function ingresarCuenta($data,$op)
    {
        try {
            $sql = INSERT_CUENTA;
            if($op==2){
               $sql = MODIFICAR_CUENTA;
               $sql.=$data->codigo;
            }
            $response = ["resultado"=>1];
            $statement = $this->conexion->prepare($sql);
            $statement->bindValue(1,$data->codigo);
            $statement->bindValue(2,$data->nombre);
            $statement->bindValue(3,$data->tipoElemento);
            $statement->bindValue(4,$data->rubro);
            $statement->bindValue(5,$data->tipoCuenta);
            $statement->bindValue(6,$data->saldo);

            if($statement->execute()){
                $response = ["resultado"=>0];
            }
            echo json_encode($response);

        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }

    public function ingresarSubCuenta($data)
    {
        try {
            $statement = $this->conexion->prepare(INSERT_SUBCUENTA);

            $statement->bindValue(1,$data->cuentaPrincipal);
            $statement->bindValue(2,$data->codigo);
            $statement->execute();

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function obtenerDetalleCuenta($code)
    {
        try {
            $statement = $this->conexion->prepare(SELECT_DETAILS_CUENTA);
            $statement->bindParam(1, $code);
            $statement->execute();
            if($data = $statement->fetch()){
                echo json_encode($data);
            }
            return null;

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function modificarCuenta($data)
    {
        try {
            $statement = $this->conexion->query(SELECT_ALL_CUENTAS);
            return $statement->fetchAll();

        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

}