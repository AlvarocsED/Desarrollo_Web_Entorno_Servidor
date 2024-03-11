<?php
class Cita
{
    private $id, $cliente,$tiempoEstimado,$importe,$pagado;
    private $fechaHora;

    function __construct($id, $cliente,$fechaHora,$tiempoEstimado,$importe,$pagado)
    {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->fechaHora=$fechaHora;
        $this->tiempoEstimado = $tiempoEstimado;
        $this->importe = $importe;
        $this->pagado = $pagado;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of tiempoEstimado
     */ 
    public function getTiempoEstimado()
    {
        return $this->tiempoEstimado;
    }

    /**
     * Set the value of tiempoEstimado
     *
     * @return  self
     */ 
    public function setTiempoEstimado($tiempoEstimado)
    {
        $this->tiempoEstimado = $tiempoEstimado;

        return $this;
    }

    /**
     * Get the value of importe
     */ 
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */ 
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get the value of pagado
     */ 
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set the value of pagado
     *
     * @return  self
     */ 
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get the value of fechaHora
     */ 
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set the value of fechaHora
     *
     * @return  self
     */ 
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }
}