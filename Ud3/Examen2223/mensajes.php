<?php
session_start();
if (isset($_POST['idEmp'])) {
	header("Location:login.php");
	exit();
}
$idEmp=$_SESSION['idEmp'];
$nombre=$_SESSION['nombre'];
$dni=$_SESSION['dni'];
$nombreDepartamento=$_SESSION['nombreDepartamento'];
if (isseet($_POST['cerrar'])) {
	session_destroy();
	header("Location:login.php")
}
if (isset($_POST['enviar'])) {
	$asunto=$_POST{'asunto'};
	$mensaje=$_POST['mensaje'];
	$paraDepartamento=$_POST['para'];
	if (empty($_POST[$asunto]) or empty($_POST[$mensaje])) {
		$mensajeError="El asunto o el mensaje no puede estar vacio";
	} else{
		$conexion= new mysqli('localhost', 'root', '', 'mensajes');
		if ($conexion->connect_error) {
			die("Error de conexión a la base de datos: " . $conexion->connect_error);
			$conexion->begin_transaction();
			try{
				$fechaEnvio=date('Y-m-d');
				$insertarMensaje=$conexion->prepare('')
			}
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
                <h1 style='color:red;'>Mensaje si es necesario</h1> 
            </div>    
        	<form action="mensajes.php" method="post">              	
            		<h1 style="color:blue;">Nuevo Mensaje</h1> 
            		<h2 style="color:blue;">Nombre y dni del empleado</h2>             		
            		<hr/> 
            		<div> 
                		<label for="para">Para</label><br/>           		
                        <select id="para" name="para">
                        </select>  
                    </div>  
            		<div> 
                		<label for="asunto">Asunto</label><br/>           		
                        <input type="text" id="asunto" name="asunto" size="50" maxlength="50"/>  
                    </div>
                    <div> 
                		<label for="mensaje">Mensaje</label><br/>           		
                        <input type="text" id="mensaje" name="mensaje"  size="100" maxlength="100"/>  
                    </div>                               
                    <br/><button type="submit" name="Enviar">Enviar</button>
                    <button type="submit" name="cerrar">Cerrar Sesión</button>
                    <hr/> 
            		<h1 style="color:blue;">Bandeja de Entrada</h1> 
            		<hr/>   
            		<table width="100%">
            			<tr>
            				<th align="left">Id</th>
            				<th align="left">De</th>
            				<th align="left">Para Departamento</th>
            				<th align="left">Fecha</th>
            				<th align="left">Asunto</th>
            				<th align="left">Mensaje</th>
            			</tr>
            		</table>
            		<h1 style="color:blue;">Bandeja de Salida</h1> 
            		<hr/>   
            		<table width="100%">
            			<tr>
            				<th align="left">Id</th>
            				<th align="left">Para</th>            				
            				<th align="left">Fecha</th>
            				<th align="left">Asunto</th>
            				<th align="left">Mensaje</th>
            			</tr>
            		</table>                              
      		</form>     
		      
	</body>
</html>
