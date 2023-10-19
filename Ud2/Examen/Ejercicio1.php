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
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Entrenamientos(25.00€)" checked="checked">Entrenamientos(25.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Partidos(25.00€)">Partidos(25.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Chandal(40.00€)">Chandal(40.00€)
        </div>
        <div>
            <input type="checkbox" name="equipaciones" id="equipaciones" value="Bolso(15.00€">Bolso(15.00€)
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
                        if($_POST['equipaciones'][0]=="Entrenamientos(25.00€)" or $_POST['opciones'][1]=="Partidos(25.00€)"){
                            echo '<h3 style="color:red;">Error:Hay que marcar entrenamiento o partido</h3>';
                            $error=true;
                        }
                    }
                    if(!isset($error)){
                        switch($_POST['equipaciones']){
                            case 'Entrenamiento(25.00€)':
                                $importe= $_POST['equipaciones']*25;
                                break;
                            case 'Partidos(25.00)':
                                $importe= $_POST['equipaciones']*25;
                                break;
                            case 'Chandal(40.00€)':
                                $importe= $_POST['equipaciones']*40;
                                break;
                            case 'Bolso':
                                $importe=$_POST['equipaciones']*15;
                                break;
                        }
                        //Subo 10%
                        if(isset($_POST['estancia']) and $_POST['estancia']==2){
                            $importe*=1.10;
                        }
                        //BAjo un 10%
                        if(isset($_POST['estancia']) and $_POST['estancia']==3){
                            $importe*=0.90;
                        }

                        echo '<h3 style="color:blue;">Error:Entrada correcta. El importe de la estancia 
                        es de '.$importe.'</h3>';
                    }
                    //Comprobando los valores del array sin usar funciones de array
                    /*if(isset($_POST['opciones'])){
                        $hayCuna = false;
                        foreach($_POST['opciones'] as $o){
                            if($o==1 or $o==2){
                                if(!$hayCuna){
                                    $hayCuna=true;
                                }
                                else{
                                    echo '<h3 style="color:red;">Error:No se puede marcar cuna y cama supletoria</h3>';
                                }
                                
                            }
                        }
                    }*/
             
            }
            
        }
    }   
    ?>
</body>
</html>
?>
</body>
</html>