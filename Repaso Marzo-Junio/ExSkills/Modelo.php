<?php
require_once 'Modalidad.php';
//Faltaba el require de ALumno
require_once 'Alumno.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=skills';
    private string $us = 'root';
    private string $ps = '';

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
        //Se inicaliza con array vacío
        //$resultado = array($modalidadElegida);
        $resultado = array();
        try {
            //No es query sino prepare
            //$consulta = $this->conexion->query('SELECT * from alumno where modalidad = ?');
            $consulta = $this->conexion->prepare('SELECT * from alumno where modalidad = ?');
            $params = array($modalidadElegida->getId());
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
        //Solamente devuelve o null o una modalidad, nunca un array
        //$resultado = array($idModalidad);
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * FROM modalidad WHERE id = ?');
            //No $idModalidad no es un objeto sin no un int ya que viene de $_POST
            //
            $params = array($idModalidad);
            if ($consulta->execute($params)) {
                //De haber algo, solamente hay 1
                //
                if ($fila = $consulta->fetch()) {
                    $resultado = new Modalidad(
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
    function obtenerPrueba($idPrueba)
    {
        $resultado=null;
        try {
            $consulta = $this->conexion->prepare('SELECT * FROM prueba WHERE id = ?');
            $params=array($idPrueba);
            if ($consulta->execute($params)){
            if ($fila = $consulta->fetch()){
                $resultado=new Prueba(
                    $fila['id'],
                    $fila['modalidad'],
                    $fila['fecha'],
                    $fila['descripcion'],
                    $fila['puntuacion']
                );
            }
            }
        }
        return $resultado;
    }
    public function agregarCorreccion($idAlumno, $idPrueba, $puntos, $comentario)
    {
        $resultado=array();
        try {
            $consulta = $this->conexion->prepare('INSERT INTO correccion (alumno, prueba, puntos, comentario) VALUES (?, ?, ?, ?)');
            $params=array($idAlumno, $idPrueba, $puntos, $comentario);
            if ($consulta->execute($params)){

            }
        }
    }
            // 
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
