<?php 
class Conexion
{
    private $conexion;

    public function __construct($host, $dbname, $user, $password)
    {
        $cadena = "mysql:" . $host . ";dbname=" . $dbname;

        $this->setConexion($cadena, $user, $password);
    }


    private function setConexion($cadena, $user, $password)
    {
        try {

            $this->conexion = new PDO($cadena, $user, $password);
            $con =  new PDO($cadena, $user, $password);

           
            $con->prepare()->fetch();
           
          
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getConexion(){
        return $this->conexion;
    }

    public function cuen(){
        $sql = "SELECT codigo,nombre FROM cuenta";
        $a = ("a");
        array_search("",$a);
    
    }
}

?>