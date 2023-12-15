<?php
class Modelo{
    private string $url='mysql:host=localhost;port=3306;dbname=GIMNASIO';
    private string $us = 'root';
    private string $ps = 'root';

    private $conexion=null;

    function __construct()
    {
        try{
            $this->conexion = new PDO($this->url,$this->us,$this->ps);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

/**
 * Get the value of conexion
 */
public function getConexion()
{
    return $this->conexion;
}

/**
 * Set the value of conexion
 */
public function setConexion($conexion): self
{
    $this->conexion = $conexion;

    return $this;
}
?>