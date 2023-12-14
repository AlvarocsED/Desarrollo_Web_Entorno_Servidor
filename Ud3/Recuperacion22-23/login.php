<!doctype html>
<html>
      <head>
        <meta charset="utf-8">        
        <title>Recuperaci�n T3 22_23</title>
       </head>
     <body>
 			<div> 
                <h1 style='color:red;'>Mensaje si es necesario</h1> 
            </div>    
        	<form action="login.php" method="post">              	
            		<h1>SuperGim</h1>    
            		<div> 
                		<label for="usuario">Usuario</label><br/>           		
                        <input type="text" id="usuario" name="usuario"/>  
                    </div>
                    <div> 
                        <label for="ps">Contraseña</label><br/>                           
                        <input type="password" id="ps"   name="ps"/>      
                    </div>                               
                    <br/><button type="submit" name="acceder">Acceder</button>                        
      		</form>   
            <?php
            if (isset($_POST['acceder'])) {
                 // Obtener los datos del formulario
        $usuario = $_POST['usuario'] ?? '';
        $contrasena = $_POST['ps'] ?? '';

        // Validar los datos
        if (empty($usuario) || empty($contrasena)) {
            echo '<div style="color:red;">Por favor, ingrese usuario y contraseña.</div>';
        } else {
            // Validar credenciales
            if ($usuario == 'admin' && $contrasena == 'admin') {
                // Redirigir al usuario administrador a crearCliente.php
                header('Location: crearCliente.php');
                exit();
            } else {
                // Simular autenticación para usuarios clientes (verifica si el DNI coincide con la contraseña)
                $modelo = new Modelo();
                $conexion = $modelo->getConexion();

                // ¡Importante! Este código es vulnerable a SQL injection. Deberías implementar consultas preparadas para mayor seguridad.
                $consulta = $conexion->prepare('SELECT * FROM cliente WHERE usuario = ? AND dni = ?');
                $consulta->execute([$usuario, $contrasena]);
                $cliente = $consulta->fetch(PDO::FETCH_ASSOC);

                if ($cliente) {
                    // Verificar si el cliente está dado de baja
                    if ($cliente['baja'] == false) {
                        // Redirigir al usuario cliente a misActividades.php
                        header('Location: misActividades.php');
                        exit();
                    } else {
                        echo '<div style="color:red;">El usuario cliente está dado de baja.</div>';
                    }
                } else {
                    echo '<div style="color:red;">Usuario o contraseña incorrectos.</div>';
                }
            }
        }
    }
            ?>        
	</body>
</html>