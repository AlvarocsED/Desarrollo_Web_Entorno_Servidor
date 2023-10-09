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
            <input type="checkbox" name="nºHabitaciones" id="nºHabitaciones">1
            <input type="checkbox" name="nºHabitaciones" id="nºHabitaciones">2
            <input type="checkbox" name="nºHabitaciones" id="nºHabitaciones">3
        </div>
        <div>
            <label for="precio">Introduzca precio</label>
            <input type="number" name="precio" id="precio">
        </div>
    </form>
</body>
</html>