<?php
class Inmobiliaria{
    private string $tipo_vivienda;
    private string $zona;
    private string $direccion;
    private int $habitaciones;
    private double $precio;
    private double $tamaño;
    private string $extras;
    private string $observaciones;

    public function __constructor($tipo_vivienda,$zona,$direccion,$habitaciones,$precio,$tamaño,$extras,$observaciones){
        $this->tipo_vivienda=$tipo_vivienda;
        $this->zona=$zona;
        $this->direccion=$direccion;
        $this->habitaciones=$habitaciones;
        $this->precio=$precio;
        $this->tamaño=$tamaño;
        $this->extras=$extras;
        $this->observaciones=$observaciones;
    }
    

    /**
     * Get the value of tipo_vivienda
     */ 
    public function getTipo_vivienda()
    {
        return $this->tipo_vivienda;
    }

    /**
     * Set the value of tipo_vivienda
     *
     * @return  self
     */ 
    public function setTipo_vivienda($tipo_vivienda)
    {
        $this->tipo_vivienda = $tipo_vivienda;

        return $this;
    }

    /**
     * Get the value of zona
     */ 
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set the value of zona
     *
     * @return  self
     */ 
    public function setZona($zona)
    {
        $this->zona = $zona;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of habitaciones
     */ 
    public function getHabitaciones()
    {
        return $this->habitaciones;
    }

    /**
     * Set the value of habitaciones
     *
     * @return  self
     */ 
    public function setHabitaciones($habitaciones)
    {
        $this->habitaciones = $habitaciones;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of tamaño
     */ 
    public function getTamaño()
    {
        return $this->tamaño;
    }

    /**
     * Set the value of tamaño
     *
     * @return  self
     */ 
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;

        return $this;
    }

    /**
     * Get the value of extras
     */ 
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Set the value of extras
     *
     * @return  self
     */ 
    public function setExtras($extras)
    {
        $this->extras = $extras;

        return $this;
    }

    /**
     * Get the value of observaciones
     */ 
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     *
     * @return  self
     */ 
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
?>