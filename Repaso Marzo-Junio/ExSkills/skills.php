<?php
require_once 'Modelo.php';

$bd = new Modelo();
if($bd->getConexion()==null){
	$mensaje = 'Error, no hay conexión con la bd';
}
session_start();
if (isset($_POST['selModalidad'])) {
    $modalidadSeleccionada = $_POST['modalidad'];
    $_SESSION['modalidad'] = $modalidadSeleccionada;
    if (isset($_SESSION['modalidad'])) {
        $modalidadSeleccionada = $_SESSION['modalidad'];
        bd->obtenerAlumnosModalidad();  
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
    <?php if (!isset($_SESSION['alumno']) && isset($_SESSION['modalidad'])) : ?>
        <!-- Sección de Alumno: solo visible si no hay alumno seleccionado y hay modalidad seleccionada -->
    <form action="skills.php" method="post">
        <div>
            <h1 style='color:blue;'>Modalidad</h1>
            <label for="tienda">Modalidad</label><br />

            <select name="modalidad">
            <?php
			$modalidad = $bd->obtenerModalidad();
			foreach($modalidades as $m){
			echo '<option value="'.$m->getId().'">'.$m->getModalidad().'</option>';	
			}
			?>

            </select>
            <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
        </div>
        <div>
            <h1 style='color:blue;'>Alumno</h1>
            <label for="tienda">Alumno</label><br />
            <select name="alumno">
            <?php
			$alumnomodalidad = $bd->obtenerAlumnoModalidad();
			foreach($alumno as $a){
			echo '<option value="'.$a->getId().'">'.$a->getNombre().'</option>';	
			}
			?>
            </select>
            <button type="submit" name="selAlumno">Seleccionar Alumno</button>
        </div>
        <div>
            <h1 style='color:blue;'>Corrección</h1>
            <h2 style='color:green;'>Modalidad Seleccionada - Nombre Alumno - Nota:X (Provisional)
                <button type="submit" name="cambiarM">Cambiar Modalidad</button>
                <button type="submit" name="cambiarA">Cambiar Alumno</button>
            </h2>
            <table>
                <tr>
                    <td><label for="prueba">Prueba</label><br /></td>
                    <td><label for="puntos">Puntos</label><br /></td>
                    <td><label for="comentario">Comentario</label></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <select id="prueba" name="prueba">

                        </select>
                    </td>
                    <td><input id="puntos" type="number" name="puntos" value="1" /></td>
                    <td><input id="comentario" type="text" name="comentario" placeholder="Comentario" /></td>
                    <td><button type="submit" name="guardar">Guardar</button></td>
                </tr>
            </table>
        </div>
        <div>
            <h1 style='color:blue;'>Calificaciones del alumno</h1>
            <table border="1" rules="all" width="50%">
                <tr>
                    <td><b>Prueba</b></td>
                    <td><b>Puntos Asignados</b></td>
                    <td><b>Puntos Obtenidos</b></td>
                    <td><b>Comentario</b></td>
                </tr>

            </table>
            <button type="submit" name="finalizar">Finalizar Corrección</button>
        </div>
    </form>
    <?php if (isset($_SESSION['alumno'])) : ?>
        <!-- Sección de Corrección y calificaciones: solo visible si hay un alumno seleccionado -->
        <div>
            <h1 style='color:blue;'>Corrección y calificaciones</h1>
        </div>
</body>
</html>