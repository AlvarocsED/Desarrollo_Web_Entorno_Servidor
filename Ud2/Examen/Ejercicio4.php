<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="numJ">Nº de jugador</label>
        </div>
        <div>
            <input type="number" name="numJ" id="numJ">
        </div>
        <div>
            <label for="nombre">Nombre y apellidos</label>
        </div>
        <div>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre y apellidos del jugador">
        </div>
        <div>
        <label for="fNac">Fecha de nacimiento</label>
        </div>
        <div>
            <input type="date" name="fNac" id="fNac" value=<?php echo date('d-m-Y')?> placeholder="dd-mm-aaaa">
        </div>
        <div>
            <label for="categ">Selecciona Categoria</label>
        </div>
        <div>
            <select name="categ" id="categ">
                <option value="Benjamin">Benjamín</option>
                <option value="Alevin">Alevín</option>
                <option value="Infantil">Infantil</option>
                <option value="Cadehe">Cadete</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
                </select>
        </div>
        <div>
            <label for="tipo">Tipo de Categoria</label>
        </div>
        <div>
            <input type="radio" name="tipo" id="tipo" value="Masculino" checked="checked">Masculino
            <input type="radio" name="tipo" id="tipo" value="Femenino">Femenino
            <input type="radio" name="tipo" id="tipo" value="Mixta">Mixta
        </div>
        <div>
        <label for="compe">Selecciona la Competicion</label>
        </div>
        <div>
            <input type="checkbox" name="categ" id="categ" value="Primera">Primera
        </div>
        <div>
            <input type="checkbox" name="categ" id="categ" value="Segunda A">Segunda A
        </div>
        <div>
            <input type="checkbox" name="categ" id="categ" value="Segunda B">Segunda B
        </div>
        <div>
            <input type="checkbox" name="categ" id="categ" value="Tercera">Tercera
        </div>
        <div>
            <label for="equipaciones">Equipaciones y Extras</label>
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Entrenamientos(25.00)" checked="checked">Entrenamientos(25.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Partidos(25.00)">Partidos(25.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Chandal(40.00)">Chandal(40.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Bolso(15.00)">Bolso(15.00€)
        </div>
        <div>
            <input type="submit" name="enviar" id="enviar">
            <input type="reset" name="limpiar" id="limpiar" value="Limpiar">
            <input type="submit" name="verJugadores" id="verJugadores" value="Ver Jugadores">
        </div>
        </form>
<?php
    if (isset($_POST["verJugadores"])) {
        
        $jugadores = [];
        $archivo = 'jugadores.txt';
        if (file_exists($archivo)) {
            $lineas = file($archivo);
            foreach ($lineas as $linea) {
                $datos = explode(';', $linea);
                $jugadores[] = new Jugador($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], explode(',', $datos[6]), explode(',', $datos[7]));
            }

           
            echo '<h2>Lista de Jugadores</h2>';
            echo '<table border="1">';
            echo '<tr><th>Nº de jugador</th><th>Nombre</th><th>Apellidos</th><th>Fecha de Nacimiento</th><th>Categoría</th><th>Tipo de Categoría</th><th>Competiciones</th><th>Equipaciones</th></tr>';
            foreach ($jugadores as $jugador) {
                echo '<tr>';
                echo '<td>' . $jugador->numero . '</td>';
                echo '<td>' . $jugador->nombre . '</td>';
                echo '<td>' . $jugador->apellidos . '</td>';
                echo '<td>' . $jugador->fechaNacimiento . '</td>';
                echo '<td>' . $jugador->categoria . '</td>';
                echo '<td>' . $jugador->tipoCategoria . '</td>';
                echo '<td>' . implode(', ', $jugador->competiciones) . '</td>';
                echo '<td>' . implode(', ', $jugador->equipaciones) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "No hay jugadores registrados.";
        }
    }
    ?>
</body>
</html>





