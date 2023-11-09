<?php
require_once 'Pieza/pieza.php';

class Modelo{
    
    private $conexion;

    const URL='mysql:host=localhost;port=3307;dbname=taller';
    const USUARIO='root';
    const PS='root';

    function __construct(){
        try {
            //Establecer conexión con la BD
            $this->conexion = new PDO(Modelo::URL,Modelo::USUARIO,Modelo::PS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    public function insertarPieza(Reparacion $r, Pieza $p,$c){
        $resultado = false;
        try {
            
            $this->conexion->beginTransaction();
            
            
            
            $encontrado = false;
            foreach ($r->getPiezas() as $pi){
                if($pi->getPieza()->getCodigo()==$p->getCodigo()){
                    $encontrado = true;
                }
            }
            if($encontrado){
                
                $consulta = $this->conexion->prepare("update piezareparacion 
                    set cantidad = cantidad + ? 
                    where reparacion = ? and pieza = ?");
                $params = array($c,$r->getId(),$p->getCodigo());
                $consulta->execute($params);
            }
            else{
                
                $consulta = $this->conexion->prepare("insert into piezareparacion 
                              values (?,?,?,?)");
                $params = array($r->getId(),$p->getCodigo(),$p->getPrecio(),$c);
                $consulta->execute($params);
            }
            
            
            $consulta = $this->conexion->prepare("update pieza 
                           set stock=stock - ? 
                           where codigo = ?");
            $params = array($c,$p->getCodigo());
            $consulta->execute($params);
            
            
            $this->conexion->commit();
            $resultado = true;
        } catch (PDOException $e) {
            
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPiezas(){
        //Devuelve un array de objetos Pieza
        $resultado = array();
        try {
            //Ejecutamos consulta
            $datos = $this->conexion->query('select * from pieza');
            if($datos!==false){
                //Recorrer los datos para crear objetos Pieza
                while($fila=$datos->fetch()){
                    //Creamos Pieza
                    $p = new Pieza();
                    $p->setCodigo($fila['codigo']);
                    $p->setClase($fila['clase']);
                    $p->setDescripcion($fila['descripcion']);
                    $p->setPrecio($fila['precio']);
                    $p->setStock($fila['stock']);
                    //Añadir pieza al arrry resultado
                    $resultado[]=$p;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function obtenerPieza($codigo){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from pieza where codigo = ?");
            $params = array($codigo);
            $consulta->execute($params);
            if($fila=$consulta->fetch()){
                $resultado = new Pieza();
                $resultado->setCodigo($fila["codigo"]);
                $resultado->setClase($fila["clase"]);
                $resultado->setDescripcion($fila["descripcion"]);
                $resultado->setPrecio($fila["precio"]);
                $resultado->setStock($fila["stock"]);
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function crearReparacionConPieza(Vehiculo $coche,Pieza $pieza,$cantidad){
        $resultado  = -1;
        try {
            
            $this->conexion->beginTransaction();
            
            $consulta = $this->conexion->prepare(
                "insert into reparacion values (null,?,curtime(),0,false)");
            $params = array($coche->getCodigo());
            $ok=$consulta->execute($params);
            if($ok){
                
                $resultado = $this->conexion->lastInsertId();
                
                $consulta = $this->conexion->prepare(
                    "insert into piezareparacion values (?,?,?,?)");
                $params = array($resultado,$pieza->getCodigo(),$pieza->getPrecio(),$cantidad);
                $ok = $consulta->execute($params);
                if($ok){
                    
                    $consulta = $this->conexion->prepare("update pieza
                           set stock=stock - ?
                           where codigo = ?");
                    $params = array($cantidad,$pieza->getCodigo());
                    $ok=$consulta->execute($params);
                    if($ok){
                        $this->conexion->commit();
                    }
                    else{
                        
                        $this->conexion->rollBack();
                    }
                }
                else{
                    
                    $this->conexion->rollBack();
                }
            }            
          
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function obtenerReparacion($codigo){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                "select * from reparacion as r inner join vehiculo as v
                    on r.coche = v.codigo
                    where coche = ? and pagado = false order by id desc limit 1");
            $params = array($codigo);
            $consulta->execute($params);
            if($fila=$consulta->fetch()){
                $resultado = new Reparacion();
                $resultado->setId($fila["id"]);
                
                
                $v = new Vehiculo();
                $v->setCodigo($codigo);
                $v->setMatricula($fila["matricula"]);
                $v->setColor($fila["color"]);
                $v->setTelefono($fila["telefono"]);
                $v->setPropietario($fila["nombrePropietario"]);
                $resultado->setCoche($v);
                
                $resultado->setFecha($fila["fechaHora"]);
                $resultado->setTiempo($fila["tiempo"]);
                $resultado->setPagado($fila["pagado"]);
                
                
                $consulta = $this->conexion->prepare(
                    "select * from reparacion as r inner join piezareparacion as pr 
                                on r.id = pr.reparacion 
                                inner join pieza as p on pr.pieza= p.codigo 
                              where r.id = ?");
                $params=array($resultado->getId());
                $consulta->execute($params);
                $piezas = array();
                while($fila=$consulta->fetch()){
                    
                    $pr = new PiezaReparacion();
                    $pr->setRep($resultado);
                    $pr->setCantidad($fila["cantidad"]);
                    $pr->setImporte($fila["importe"]);
                    // Objeto pieza
                    $p = new Pieza();
                    $p->setCodigo($fila["pieza"]);
                    $p->setClase($fila["clase"]);
                    $p->setDescripcion($fila["descripcion"]);
                    $p->setPrecio($fila["precio"]);
                    $p->setStock($fila["stock"]);
                    $pr->setPieza($p);
                    
                    $piezas[]=$pr;                    
                }
                $resultado->setPiezas($piezas);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function existeMatricula($matricula){
        $resultado = true;
        try {
            $consulta = $this->conexion->prepare("select * from vehiculo where matricula = ?");
            $params = array($matricula);
            $consulta->execute($params);
            if(!$consulta->fetch()){
                $resultado = false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function hayReparciones(Vehiculo $vSel){
        $resultado = true;
        try {
            $consulta = $this->conexion->prepare("select * from reparacion where coche = ?");
            $params = array($vSel->getCodigo());
            $consulta->execute($params);
            if(!$consulta->fetch()){
                $resultado = false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function borrarVehiculo($vSel){
        $resultado = "Error, al borrar el vehículo";
        try {
            $consulta = $this->conexion->prepare("delete from vehiculo where codigo = ?");
            $params = array($vSel->getCodigo());
            $numReg = $consulta->execute($params);
            if($numReg){
                $resultado = "Vehículo borrado";
            }
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }
    public function modificarVehiculo($vSel){
        $resultado = "Error, al modificar el vehículo";
        try {
            $consulta = $this->conexion->prepare("update vehiculo set 
                nombrePropietario = ?, matricula = ?, color = ?,
                telefono = ?, email = ? 
                where codigo = ?");
            $params = array($vSel->getPropietario(), $vSel->getMatricula(),$vSel->getColor(),
                            $vSel->getTelefono(), $vSel->getCodigo());
            $numReg = $consulta->execute($params);
            if($numReg){
                $resultado = "Vehículo modificado";
            }
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $resultado;
    }
    public function obtenerVehiculo($codigo){
        $resultado=null;
        try {
            $consulta = $this->conexion->prepare("select * from vehiculo where codigo = ?");
            $params = array($codigo);
            $consulta->execute($params);
            if($fila=$consulta->fetch()){
                $resultado = new Vehiculo();
                $resultado->setCodigo($fila["codigo"]);
                $resultado->setPropietario($fila["nombrePropietario"]);
                $resultado->setMatricula($fila["matricula"]);
                $resultado->setColor($fila["color"]);
                $resultado->setTelefono($fila["telefono"]);
                
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return  $resultado;
        
    }
    public function obtenerPrimerVehiculo(){
        $resultado=null;
        try {
            $datos = $this->conexion->query("select * from vehiculo order by codigo limit 1");
            if($fila=$datos->fetch()){
                $resultado = new Vehiculo();
                $resultado->setCodigo($fila["codigo"]);
                $resultado->setPropietario($fila["nombrePropietario"]);
                $resultado->setMatricula($fila["matricula"]);
                $resultado->setColor($fila["color"]);
                $resultado->setTelefono($fila["telefono"]);
                
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return  $resultado;
        
    }
    public function crearVehiculo(Vehiculo $v){
        $resultado=-1;
        try {
            
            $consulta = $this->conexion->prepare("insert into vehiculo values (null,?,?,?,?,?)");
            
            $params = array($v->getPropietario(),$v->getMatricula(),
                            $v->getColor(),$v->getTelefono());
            
            $numCoches = $consulta->execute($params);
            if($numCoches){
                
                $resultado=$this->conexion->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    public function obtenerVehiculos(){
        $resultado=array();
        try {
            
            $datos = $this->conexion->query("select * from vehiculo order by codigo");
            
            while($fila=$datos->fetch()){
                $v = new Vehiculo();
                $v->setCodigo($fila["codigo"]);
                $v->setPropietario($fila["nombrePropietario"]);
                $v->setMatricula($fila[2]); 
                $v->setColor($fila[3]);
                $v->setTelefono($fila["telefono"]);
                $resultado[]=$v; .
            }
            
        } catch (PDOException $e) {
            $e->getMessage();
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