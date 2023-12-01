<?php

//Incluir liebrería PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../../vendor/autoload.php';

function enviarCorreo(Modelo $bd,Reparacion $r,$detalle, Propietario $propietario){
    $resultado = false;
    try{
        $correo = new PHPMailer(true);   
        //Confirgurar datos del servidor saliente
        $correo->isSMTP();
        $correo->Host = 'smtp.gmail.com';
        $correo->SMTPAuth = true;
        $correo->Username= 'acastellanos02@educarex.es';
        $correo->Password = 'Acs_2273';
        $correo->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
        $correo->Port=465;

        //Configuración del correo que vamos a escribir
        $correo->setFrom('acastellanos@educarex.es','Álvaro');
        $correo->addAddress($propietario->getEmail(),$propietario->getNombre());
        //Configuración del contenido del mensaje
        $correo->isHTML(true);
        $correo->Subject='Factura Reparación Nº '.$r->getId();
        $correo->Body="<h1>hola mundo</h1>";
        $correo->AltBody="<h1>hola mundo</h1>";
        //Enviar correo
        if($correo->send()){
            $resultado=true;
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
    return $resultado;
}
?>