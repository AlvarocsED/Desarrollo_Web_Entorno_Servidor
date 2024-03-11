<?php
class Cliente
{
    private $cita, $servicio,$importe;
    

    function __construct($cita,$servicio, $importe)
    {
        $this->cita = $cita;
        $this->servicio = $servicio;
        $this->importe=$importe;
    }


    /**
     * Get the value of cita
     */ 
    public function getCita()
    {
        return $this->cita;
    }

    /**
     * Set the value of cita
     *
     * @return  self
     */ 
    public function setCita($cita)
    {
        $this->cita = $cita;

        return $this;
    }

    /**
     * Get the value of servicio
     */ 
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set the value of servicio
     *
     * @return  self
     */ 
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

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
}