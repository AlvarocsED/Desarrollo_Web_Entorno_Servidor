 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <h1>Viendo las estancias guardadas</h1>
    <?php
    $archivoestancia='estancias.txt';
    if (file_exists($archivoEstancias)) {
        +$estancias = file($archivoEstancias, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($estancias as $estancia) {
            $datos = explode(';', $estancia);
            list($dni, $nombre, $tipoHabitacion, $tipoEstancia, $noches, $cuna, $supletoria, $pagoEfectivo) = $datos;
            $pago = $pagoEfectivo === '1' ? 'Efectivo' : 'Tarjeta';

            echo "<li>";
            echo "DNI: $dni, Nombre: $nombre, Habitación: $tipoHabitacion, Estancia: $tipoEstancia, Noches: $noches, Cuna: " . ($cuna === '1' ? 'Sí' : 'No') . ", Supletoria: " . ($supletoria === '1' ? 'Sí' : 'No') . ", Pago: $pago";
            echo "</li>";
        }
    } else {
        echo "No hay estancias registradas.";
    }

    ?>
 </body>
 </html>