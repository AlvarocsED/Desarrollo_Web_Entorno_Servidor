<?php
class Jugador
{
    public int $numero;
    public string $nombre;
    public string $fechaNacimiento;
    public string $categoria;
    public $tipoCategoria;
    public string $competiciones;
    public string $equipaciones;

    public function __construct($numero, $nombre, $apellidos, $fechaNacimiento, $categoria, $tipoCategoria, $competiciones, $equipaciones)
    {
        $this->numero = $numero;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->categoria = $categoria;
        $this->tipoCategoria = $tipoCategoria;
        $this->competiciones = $competiciones;
        $this->equipaciones = $equipaciones;
    }

    public function datosJugador()
    {
        $datos = [
            $this->numero,
            $this->nombre,
            $this->fechaNacimiento,
            $this->categoria,
            $this->tipoCategoria,
            $this->competiciones,
            implode(',', $this->equipaciones),
        ];
        return implode(';', $datos);
    }
}
?>
    <?php
function rellenarSelected($campo, $item, $opcionPorDefecto){
    if(isset($_POST[$campo])){
        if($_POST[$campo]==$item){
            echo 'selected = "selected"';
        }
    }
    elseif($opcionPorDefecto){
        echo 'selected = "selected"';
    }
}
function rellenarRadio($campo, $item, $opcionPorDefecto){
    if(isset($_POST[$campo])){
        if($_POST[$campo]==$item){
            echo 'checked = "checked"';
        }
    }
    elseif($opcionPorDefecto){
        echo 'checked = "checked"';
    }
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
        </div>
        </form>
        <?php
        if(isset($_POST['enviar'])){
            if(empty($_POST['numJ']) or empty($_POST['nombre'])  or empty($_POST['fNac']) or empty($_POST['categ']) or empty($_POST['categ']or empty($_POST['tipo'])) or empty($_POST['equipaciones'])){
                echo '<h3 style="color:red;">Error:Todos los campos son obligatorios</h3>';
            }
            else{
                if(isset($_POST['tipo']) and $_POST['tipo']=='Mixta' and $_POST['categ']=='Benjamin' and $_POST['categ']=='Alevin'){
                    echo '<h3 style="color:red;">Error:Tipo de categoria mixta disponible solo para categorias alevín y benjamín</h3>';
                }
                else{
                    if(isset($_POST['equipaciones']) and isset($_POST['equipaciones'][1])){
                        if($_POST['equipaciones'][0]=="Entrenamientos(25.00)" or $_POST['equipaciones'][1]=="Partidos(25.00)"){
                            echo '<h3 style="color:red;">Error:Hay que marcar entrenamiento o partido</h3>';
                            $error=true;
                        }
                    }
                    if(!isset($error)){
                        $importe=0;
                        foreach($equipaciones as $equipacion){
                         switch($_POST[$equipacion]){
                            case 'Entrenamientos(25.00)':
                                $importe+=25;
                                break;
                            case 'Partidos(25.00)':
                                $importe+=25;
                                break;
                            case 'Chandal(40.00)':
                                $importe+=40;
                                break;
                            case 'Bolso(15.00)':
                                $importe+=15;
                                break;
                        }
                        
                    }echo '<h3 style="color:blue;">Datos correctos. El importe total gastado es '.$importe.'euros</h3>';
             
            }
            
        }
    }
    if (empty($error)) {
        $jugador = new Jugador($numero, $nombre, $apellidos, $fechaNacimiento, $categoria, $tipoCategoria, $competiciones, $equipaciones);
    
        
        $archivo = 'jugadores.txt';
        $jugadorDatos = $jugador->datosJugador();
    
        if (file_put_contents($archivo, $jugadorDatos)) {
            echo "Datos guardados con éxito.";
        } else {
            echo "Error al guardar los datos.";
        }
    }
       
    ?>
</body>
</html>
</body>
</html>