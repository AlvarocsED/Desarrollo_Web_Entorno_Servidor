<?php
class Modelo
{
    private $url = "mysql:host=localhost;port=3306;dbname=skills";
    private $us = "root";
    private $ps = "";
    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
function obtenerModal()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from modalidad");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $modal = new Tienda($fila['id'], $fila['modcalidad'],);
                    $resultado[] = $modal;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

?>