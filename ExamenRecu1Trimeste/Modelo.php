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
    function obtenerClientes()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from cliente");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $tienda = new clinte($fila['codigo'], $fila['nombre'], $fila['nif'], $fila['numTinte'], $fila['telefono'], $fila['email']);
                    $resultado[] = $cliente;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }


    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of us
     */ 
    public function getUs()
    {
        return $this->us;
    }

    /**
     * Set the value of us
     *
     * @return  self
     */ 
    public function setUs($us)
    {
        $this->us = $us;

        return $this;
    }
    /**
     * Get the value of ps
     */ 
    public function getPs()
    {
        return $this->ps;
    }

    /**
     * Set the value of ps
     *
     * @return  self
     */ 
    public function setPs($ps)
    {
        $this->ps = $ps;

        return $this;
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
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
    }
?>