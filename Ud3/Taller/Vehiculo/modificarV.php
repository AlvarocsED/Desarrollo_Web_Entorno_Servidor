<?php
require_once '../Modelo.php';
require_once 'vehiculo.php';

function rellenarSelect(Vehiculo $v, Vehiculo $vSel){
    if($v->getCodigo()==$vSel->getCodigo()){
        return "selected='selected'";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Modificar vehículos</title>
</head>
<body>
<?php 
    $bd = new Modelo();
    if($bd!=null){        
        echo "<h1>MODIFICAR VEHÍCULO</h1>";
        include_once '../Menu.php';
        
        
        if(isset($_POST["codigo"])){
            $vSel = $bd->obtenerVehiculo($_POST["codigo"]);   
        }else{
            $vSel = $bd->obtenerPrimerVehiculo();
        }
        
        
        if(isset($_POST["modificar"])){
            if(empty($_POST["propietario"]) or empty($_POST["telefono"])){
                $mensaje = "Error, el nombre propietario y teléfono no pueden estar vacíos";
            }
            elseif(!empty($_POST["matricula"]) && 
                $_POST["matricula"]!=$vSel->getMatricula() &&
                $bd->existeMatricula($_POST["matricula"])){
                $mensaje = "Error, la matrícula ya existe";
            }
            else{
                
                $vSel->setPropietario($_POST["propietario"]);
                $vSel->setMatricula(empty($_POST["matricula"])?null:$_POST["matricula"]);
                $vSel->setColor(empty($_POST["color"])?null:$_POST["color"]);
                $vSel->setEmail(empty($_POST["email"])?null:$_POST["email"]);
                $vSel->setTelefono($_POST["telefono"]);
                
                
                $mensaje = $bd->modificarVehiculo($vSel);
            }
        }
        
        if(isset($_POST["borrar"])){
            
            if($bd->hayReparciones($vSel)){
                $mensaje = "No se puede borrar el vehículo porque hay reparaciones";
            }
            else{
                $mensaje = $bd->borrarVehiculo($vSel);
                
                
                $vSel= $bd->obtenerPrimerVehiculo();
            }
        }
        ?>
        <form action="" method="post">
        	<p>
            	<label>Código del vehículo</label><br/>
            	<select name="codigo" onchange="this.form.submit()">
            		<?php
            		
            		  $coches = $bd->obtenerVehiculos();
            		  foreach ($coches as $v){
            		      echo "<option value='".$v->getCodigo()."' ".rellenarSelect($v,$vSel).">".$v->getCodigo().
            		             "-".$v->getPropietario()."</option>";
            		  }
            		?>
            	</select>
            	
        	</p>
        	<p>
            	<label>Propietario</label><br/>
            	<input type="text" name="propietario" placeholder="Nombre del propietario" 
            	       value="<?php echo $vSel->getPropietario()?>">
        	</p>
        	<p>
            	<label>Matricula</label><br/>
            	<input type="text" name="matricula" placeholder="1234ABC" maxlength="7" 
            	       value="<?php echo $vSel->getMatricula()?>">            	
        	</p>
        	<p>
            	<label>Color</label><br/>
            	<input type="text" name="color" placeholder="color" 
            	       value="<?php echo $vSel->getColor()?>">            	
        	</p>
        	<p>
            	<label>Teléfono</label><br/>
            	<input type="tel" name="telefono" placeholder="Teléfono" 
            	       value="<?php echo $vSel->getTelefono()?>">            	
        	</p>
        	<p>
        		<input type="submit" name="modificar" value="Modificar">
        		<input type="submit" name="borrar" value="Borrar">
        	</p>
        </form>
        <?php 
        if(isset($mensaje)){
            echo "<h2 style='color:red'>$mensaje</h2>";
        }
    }
    else{
        echo "<h2 style='color:red'>Error, no hay conexión con la BD taller</h2>";
    }
?>	
	
	
</body>
</html>