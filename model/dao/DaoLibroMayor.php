<?php 

class DaoLibroMayor
{

    private $cn;
    public function __construct()
    {
        try {
            $this->cn = (new Conexion("localhost", "data_sic", "root", ""))->getConexion();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function comprobarCuenta($cuenta)
    {

        try {
            $stm = $this->cn->prepare(COMPROBAR_CUENTA_LIBRO_MAYOR);
            $stm->bindValue(1, $cuenta);
            $stm->execute();
            $res = $stm->fetch();
            if ($res) {
                return $res;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function cantidadCuentasMayor()
    {
        try {
            $stm = $this->cn->query(OBTENER_CANTIDAD_CUENTAS_MAYOR);
            $stm->execute();
            $res = $stm->fetch();
            return $res[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ingresarCuenta($cuenta, $correlativo)
    {

        //echo "hols";
        //echo $cuenta."<br>".$correlativo;

        try {
            $stm = $this->cn->prepare(INGRESAR_CUENTA_MAYOR);
            $stm->bindValue(1, $cuenta);
            $stm->bindValue(2, $correlativo);
            $stm->execute();

            $stm = $this->cn->query(SELECCIONAR_ULTIMA_CUENTA_MAYOR);
            $stm->execute();

            return $stm->fetch()[0];
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function obtenerFolio($cuenta)
    {

        try {

            $folio = 0; 
                //mandar array a este método
            $numCuenta = $this->comprobarCuenta($cuenta[0]);

            if ($numCuenta == false) {
                $cantidadCuenta = $this->cantidadCuentasMayor();

                $folio = $this->ingresarCuenta($cuenta[0], ($cantidadCuenta + 1));
            } else {

                $folio = $numCuenta[0];
            }
            return $folio;

        } catch (PDOException $e) {
            echo $e->getMessage()();
        }
    }


  //Listado de libro mayor
    public function mostrarListadoMayor()
    {
        try {
            $stm = $this->cn->query(SELECCIONAR_REGISTRO_MAYORES);
            $stm->execute();

            return $stm->fetchAll();
        } catch (PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

//Obtiene el listado del encabezado de los mayores
    public function listadoCuentasMayor()
    {
        try {
            $stm = $this->cn->query(SELECCIONAR_CUENTAS_MAYOR);
            $stm->execute();

            return $stm->fetchAll();

        } catch (PDOException $e) {
        }
    }

}
?>