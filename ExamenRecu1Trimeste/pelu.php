<?php
require_once 'Modelo.php';
$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = "Error, no hay conexión con la bd";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conEstilo</title>
</head>

<body>
    <div>
        <h1 style='color:red;'>Mensajes</h1>
    </div>
    <form action="skills.php" method="post">
        <div>
            <h1 style='color:blue;'>Selecciona Cliente</h1>
            <label for="cliente">Cliente</label><br />

            <select name="cliente">
            <?php
                    $clientes = $bd->obtenerClientes();
                    foreach ($xclientes as $m) {
                        echo '<option value="' . $m->getNombre() . '</option>';
                    }
                    ?>
            </select>
            <button type="submit" name="selCliente">Seleccionar</button>
        </div>
        <div>
            <h1 style='color:blue;'>Citas</h1>
            <div>
                <h3 style='color:green;'>Crear Cita</h3>
                <label for="fecha">Fecha/Hora</label><br />
                <input name="fecha"  type="date" />
                <input name="hora"  type="time" />
                <button type="submit" name="crearCita">Crear Cita</button>
            </div>
            <div>
                <h3 style='color:green;'>Seleccionar Cita</h3>
                <select name="cita">
                
                </select>
                <button type="submit" name="selCita">Seleccionar Cita</button>
            </div>
            
        </div>
        <div>
        <h2 style='color:green;'>Cita Seleccionada - Nombre Cliente - Id Cita Fecha Cita - Pendiente/Pagada
                <button type="submit" name="cambiarM">Cambiar Cliente</button>
                <button type="submit" name="cambiarA">Cambiar Cita</button>
            </h2>
        </div>
        <div>
            <h1 style='color:blue;'>Servicios</h1>
            <h3 style='color:green;'>Añadir Servicio</h3>
            <table>
                <tr>
                    <td><label for="tipoServicio">Tipo de Servicio</label><br /></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <select id="tipoServicio" name="tipoServicio">

                        </select>
                    </td>
                    <td><button type="submit" name="guardar">Añadir</button></td>
                </tr>
            </table>
        </div>
        <div>
            <h3 style='color:green;'>Servicios</h3>
            <table border="1" rules="all" width="50%">
                <tr>
                    <td><b>Descripción</b></td> 
                    <td><b>Precio</b></td>
                    <td><b>Duración</b></td>
                </tr>

            </table>
        </div>
    </form>
</body>

</html>