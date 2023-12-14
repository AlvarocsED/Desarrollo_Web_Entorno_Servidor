<?php
session_start();
require_once 'Modelo.php';
if (isset($_POST['acceder'])) {
    $idEmpleado=$_POST['usuario'];
    $dni=$_POST['ps'];
    if (empty($idEmpleado) or empty($dni)) {
        $mensajeError='Tienes que introducir el ID del empleado y la ps';
        $modelo=new Modelo();
        $autenticado=$modelo->login($idEmpleado, $dni);
        if ($autenticado) {
            $empleado=$modelo->obtenerEmpleado($idEmpleado);
            $_SESSION['empleado']=$empleado;
            header("Location: mensajes.php");
            exit();
        } else{
            $mensajeError = "El Id de Empleado o la contraseña son incorrectos.";
        }
    }
}
?>
<!doctype html>
<html>
      <head>
        <meta charset="utf-8">
        <title>Examen 22_23</title>
       </head>
     <body>     	
 			<div> 
                <h1 style='color:red;'>mostrar mensaje si es necesario</h1> 
            </div>    
        	<form action="login.php" method="post">              	
            		<h1>Login</h1>    
            		<div> 
                		<label for="usuario">Id de Empleado</label><br/>           		
                        <input type="text" id="usuario" name="usuario"/>  
                    </div>
                    <div> 
                        <label for="ps">Contraseña</label><br/>                           
                        <input type="password" id="ps"   name="ps"/>      
                    </div>                               
                    <br/><button type="submit" name="acceder">Acceder</button>                        
      		</form>           
	</body>
</html>