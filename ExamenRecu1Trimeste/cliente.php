<?php
class Cliente
{
    private $codigo, $nombre,$numTinte;
    private $nif, $telefono,$email;

    function __construct($codigo,$nif, $nombre,$numTinte,$telefono,$email)
    {
        $this->codigo = $codigo;
        $this->nif = $nif;
        $this->nombre=$nombre;
        $this->numTinte = $numTinte;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of numTinte
     */ 
    public function getNumTinte()
    {
        return $this->numTinte;
    }

    /**
     * Set the value of numTinte
     *
     * @return  self
     */ 
    public function setNumTinte($numTinte)
    {
        $this->numTinte = $numTinte;

        return $this;
    }

    /**
     * Get the value of nif
     */ 
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set the value of nif
     *
     * @return  self
     */ 
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}