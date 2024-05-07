<?php
require_once 'Modelo.php';

$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = 'Error, no hay conexión con la bd';
}
session_start();
if (isset($_POST['selModalidad'])) {
    $modalidadElegida = $bd->obtenerModalidad($_POST['modalidad']);
    $_SESSION['alumnos'] = $bd->obtenerAlumnoModalidad($modalidadElegida);

    /* Tienes que guardar en la sesión todos los datos de la modalidad.*/
    //$modalidadSeleccionada = $_POST['modalidad'];
    //$_SESSION['modalidad'] = $modalidadSeleccionada;
    $_SESSION['modalidad'] = $bd->obtenerModalidad($_POST['modalidad']);
}
    if (isset($_POST['selAlumno'])) {
        $idAlumno = $_POST['alumno'];
        foreach ($_SESSION['alumnos'] as $alumno) {
            if ($alumno->getId() == $idAlumno) {
                $_SESSION['alumnoElegido'] = $alumno;
            }
        }
    }
//Este if sobra ya que tanto la modalidad como los alumnos los tratas directamente
//cuando necesitas trabajar con ellos.
/*if (isset($_SESSION['modalidad'])) {
    $modalidadSeleccionada = $_SESSION['modalidad'];
    $bd->obtenerAlumnosModalidad();
}*/
?>
<!DOCTYPE html>
<html lang="en">

<headº>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1 style='color:red;'>Mensajes</h1>
    </div>

    <form action="skills.php" method="post">
        <?php if (!isset($_SESSION['modalidad'])) { ?>
            <!-- Sección de Alumno: solo visible si no hay alumno seleccionado y hay modalidad seleccionada -->
            <div>
                <h1 style='color:blue;'>Modalidad</h1>
                <label for="tienda">Modalidad</label><br />

                <select name="modalidad">
                    <?php
                    $modalidades = $bd->obtenerModalidades();
                    foreach ($modalidades as $m) {
                        echo '<option value="' . $m->getId() . '">' . $m->getModalidad() . '</option>';
                    }
                    ?>

                </select>
                <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
            </div>
        <?php } else { ?>
             <!-- if para saber si NO hay alumno seleccionado -->
            <div>
                <h1 style='color:blue;'>Alumno</h1>
                <label for="tienda">Alumno</label><br />
                <select name="alumno">
                    <?php
                    //Falta indicar el arguento modalidad
                    $alumnomodalidad = $bd->obtenerAlumnoModalidad($_SESSION['modalidad']);
                    foreach ($alumno as $a) {
                        echo '<option value="' . $a->getId() . '">' . $a->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selAlumno">Seleccionar Alumno</button>
            </div>
            <!-- FIN de if para saber si NO hay alumno seleccionado -->
        <?php } ?>
        <!-- if para saber si hay alumno seleccionado -->
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
        <!-- Sección de Corrección y calificaciones: solo visible si hay un alumno seleccionado -->
        <div>
            <h1 style='color:blue;'>Corrección y calificaciones</h1>
        </div>
        <!-- FIN if para saber si hay alumno seleccionado -->
    </form>

</body>

</html>