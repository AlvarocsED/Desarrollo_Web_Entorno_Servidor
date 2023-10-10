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
    <label for="tipo_vivienda">Selecciona el tipo de vivienda</label>
       <select id="tipo_vivienda" name="tipo_vivienda">
       <option value="1">Adosado</option>
       <option value="2">Unifamiliar</option>
       <option value="3">Piso</option>
        </div>
       </select>
       <div>
       <label for="zona">Selecciona la zona</label>
       <select id="zona" name="zona">
        <option value="1">Centro</option>
        <option value="2">Periferia</option>
        </div>
        </select>
        <div>
            <label for="direccion">Introouce la direccion</label>
            <input type="text" name="direccion" id="direccion">
        </div>
        <div>
            <label for="nºHabitaciones">Selecciona el nº de habitaciones</label>
            <input type="radio" name="nºHabitaciones" id="nºHabitaciones" checked="checked" value="1">1
            <input type="radio" name="nºHabitaciones" id="nºHabitaciones" value="2">2
            <input type="radio" name="nºHabitaciones" id="nºHabitaciones" value="3">3
        </div>
        <div>
            <label for="precio">Introduzca precio</label>
            <input type="number" name="precio" id="precio">
        </div>
        <div>
            <label for="tamanio">Tamaño</label>
            <input type="number" name="tamanio" id="tamanio">
        </div>
        <div>
            <label for="extras">Selecciona los extras que necesites</label>
            <input type="checkbox" name="extras" id="extras">Garaje
            <input type="checkbox" name="extras" id="extras">Trastero
            <input type="checkbox" name="extras" id="extras">Piscina
        </div>
        <div>
            <label for="observaciones">Observacione</label>
        </div>
        <div>
            <textarea name="observaciones" id="observaciones" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="Guardar vivienda">
        </div>
    </form>
    <?php
if($_SERVER["REQUEST_METHOD"] =="post"){
    $tipo_vivienda=$_POST["tipo_vivienda"];
    $zona=$_POST["zona"];
    $direccion=$_POST["direccion"];
    $habitaciones=$_POST["habitaciones"];
    $precio=$_POST["precio"];
    $tamaño=$_POST["tamaño"];
    $extras=implode(", ", $_POST["extras"]);
    $observaciones=$_POST["observaciones"];
    if(empty($tipo_vivienda) or empty($zona) or empty($direccion) && empty($habitaciones) &% empty($tamaño)){
        echo 'Todos los campos son obligatorios excepto las observaciones y los extras';
    }else{
        $casa=new claseInmobiliaria($tipo_vivienda, $zona, $direccion, $habitaciones, $precio, $tamaño, $extras, $observaciones);
        $casa=implode(";", claseInmobiliaria->guardar);
        file_put_contents("viviendas.txt", $casa, "/n", FILE_APPEND);
        echo 'Vivienda creada correctamente';
    }
}
?>
</body>
</html>