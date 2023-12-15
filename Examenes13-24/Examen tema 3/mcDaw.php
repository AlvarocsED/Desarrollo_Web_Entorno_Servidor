<?php
require_once 'Modelo.php';

$bd = new Modelo();
if($bd->getConexion()==null){
	$mensaje = 'Error, no hay conexión con la bd';
}
session_start();
if (isset($_POST['tienda'])) {
    $_SESSION['tienda'];   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1 style='color:red;'>Mensajes</h1>
    </div>
    <form action="mcDaw.php" method="post">
        <div>
            <h1 style='color:blue;'>Tienda</h1>
            <label for="tienda">Tienda</label><br />
            <select name="tienda">
                <option name="tienda" value="Navalmoral de la Mata"></option>
                <option name="tienda" value="Caceres 1"></option>
                <option name="tienda" value="Plasencia 1"></option>                
            </select>
            <button type="submit" name="selTienda">Seleccionar tienda</button>
        </div>
        <div>
            <h1 style='color:blue;'>Añade productos a la cesta</h1>
            <h2 style='color:green;'>Datos Tienda: Nombre - Teléfono
                <button type="submit" name="cambiar">Cambiar Tienda</button>
            </h2>
            <table>
                <tr>
                    <td><label for="producto">Producto</label><br /></td>
                    <td><label for="cantidad">Cantidad</label><br /></td>
                    <td>Añadir a la cesta</td>
                </tr>
                <tr>
                    <td>
                        <select id="producto" name="producto">
                    
                        </select>
                    </td>
                    <td><input id="cantidad" type="number" name="cantidad" value="1"/></td>
                    <td><button type="submit" name="agregar">+</button></td>
                </tr>
            </table>            
        </div>
        <div>
            <h1 style='color:blue;'>Contenido de la cesta</h1>
            <table  border="1"  rules="all"  width="25%">
                <tr>
                    <td><b>Producto</b></td>
                    <td><b>Cantidad</b></td>
                    <td><b>Precio</b></td>
                </tr>
                
            </table>   
            <button type="submit" name="crearPedido">Crear Pedido</button>         
        </div>
        <button type="submit" name="cambiar" value="Cambiar tiends"></button>
    </form>
    <?php
$infoTienda=$_SESSION['tienda'];
echo 'Datos Tienda: ' .$infoTienda;
if (isset($_POST['cambiar'])) {
    session_destroy();
    header('location: mcDaw,php');
    if (isset($_POST['crearPedido'])) {
        
    }
}
?>
</body>
</html>
