<?php
class Modelo{
    private string $url='mysql:host=localhost;port=3306;dbname=McDaw';
    private string $us = 'root';
    private string $ps = '';

    private $conexion=null;

    function __construct()
    {
        try{
            $this->conexion = new PDO($this->url,$this->us,$this->ps);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }
    public function obtenerTiendas()
    {
        $tiendas = array();

        try {
            $stmt = $this->conexion->query("select codigo, nombre, telefono from tienda");
            $tiendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $tiendas;
    }
}


    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
    }
}
?>