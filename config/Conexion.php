<?php 
class Conexion
{
    private $conexion;

    public function __construct($host, $dbname, $user, $password)
    {
        $cadena = "mysql:host=" . $host . ";dbname=" . $dbname;

        $this->setConexion($cadena, $user, $password);
    }


    private function setConexion($cadena, $user, $password)
    {
        try {

            $this->conexion = new PDO($cadena, $user, $password);
            $con =  new PDO($cadena, $user, $password);

           
          
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getConexion(){
        return $this->conexion;
    }

    
}

?>