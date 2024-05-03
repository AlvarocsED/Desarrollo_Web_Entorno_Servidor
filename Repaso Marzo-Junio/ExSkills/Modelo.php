<?php
class Modelo{
    private string $url='mysql:host=localhost;port=3306;dbname=mensajes';
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
    }
    function obtenerModalidad(){
        $resultado=array();
        try{
            $consulta = $this->conexion->query('SELECT * from modalidad');
            if($consulta->execute()){
                while($fila=$consulta->fetch()){
                    $resultado[]=new Modalidad($fila['id'],$fila['modalidad']);                   
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerAlumnoModalidad($modalidadElegida){
        $resultado=array();
        try{
            $consulta = $this->conexion->query('SELECT * from alumno where modalidad = (select id from modalidad where modalidad ='$modalidadElegida);
            if($consulta->execute()){
                while($fila=$consulta->fetch()){
                    $resultado[]=new Alumno($fila['nombre   ']);                   
                }
            }
        }catch(PDOException $e){
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
?>