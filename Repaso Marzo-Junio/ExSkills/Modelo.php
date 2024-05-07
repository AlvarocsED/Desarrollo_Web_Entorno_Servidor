<?php
require_once 'Modalidad.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=skills';
    private string $us = 'root';
    private string $ps = 'root';

    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function obtenerModalidades()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from modalidad');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Modalidad($fila['id'], $fila['modalidad']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerAlumnoModalidad($modalidadElegida)
    {
        $resultado = array($modalidadElegida);
        try {
            $consulta = $this->conexion->query('SELECT * from alumno where modalidad = ?');
            $params = array($modalidadElegida->id);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Alumno(
                        $fila['id'],
                        $fila['nombre'],
                        $fila['id'],
                        $fila['modalidad'],
                        $fila['puntuacion'],
                        $fila['finalizado']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerModalidad($idModalidad)
{
    $resultado= array($idModalidad);
    try {
        $consulta = $this->conexion->prepare('SELECT * FROM modalidad WHERE id = ?');
        $params=array($idModalidad->id);
        if ($consulta->execute($params)){
            while ($fila = $consulta->fetch()){
                $resultado[] = new Modalidad(
                    $fila['id'],
                    $fila['modalidad']
                );
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
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
}
