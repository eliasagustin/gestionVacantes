<?php
	require_once "../inc/session_start.php";

	require_once "main.php";
?>

    <?php
    $error = false;
    	/*== Almacenando datos ==*/
    if (!isset($_SESSION['nombre'])){
        
        if (isset($_POST['first_name'])){
            $nombre=limpiar_cadena($_POST['first_name']);
        } else {
            //Informar error
            $error = true;
        }
    }else {
        $nombre=limpiar_cadena($_SESSION['nombre']);
    }

    if (!isset($_SESSION['email'])){
        if (isset($_POST['email'])){
            $email=limpiar_cadena($_POST['email']);
        } else {
            //Informar error
            $error = true;
        }
    }else {
        $email=limpiar_cadena($_SESSION['email']);
    }



    if (!isset($_POST['mensaje'])){
        //Informar error
        // $error = true;
    }else {
        $mensaje=limpiar_cadena($_POST['mensaje']);
    }
	// $nombre=limpiar_cadena($_POST['first_name']);
	//$email=limpiar_cadena($_POST['email']);
	$telefono=limpiar_cadena($_POST['telefono']);

    //Verifico que esté las variables vengan cargadas
    //En caso de no estar cargadas me fijo si es invitado

    // $enviar_mail = true;
    
    $asunto = "Confirmación de envío del formulario de contacto";

    // Mensaje de confirmación
    $mensaje_confirmacion = "Hola $nombre,\n\nGracias por contactarnos. Hemos recibido tu mensaje con éxito.\n\nNos pondremos en contacto contigo pronto.\n\nSaludos,\nEl equipo de ejemplo";

    // Enviar el correo de confirmación al remitente
     mail($email, $asunto, $mensaje_confirmacion);

    // Enviar el mensaje de consulta al correo de destino
    // $correo_destino asignado al personal de soporte
    // mail($correo_destino, $asunto, $mensaje);

    if(!$error){
        echo '
            <div class="notification is-info is-light">
                <strong>Envío exitoso!</strong><br>
                '.$nombre.'! el mensaje se envió con éxito, y la consulta fue asignada al personal de soporte,
                <br>
                próximamente nos pondremos en contacto con vos para ayudarte.
                <br> 
                Enviamos un mensaje de confirmación a la casilla de correo que nos proporcionaste.
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo concluir el pedido de consulta, por favor inténtelo nuevamente
                <br>también puede llamarnos al 0-800-ayuda
            </div>
        ';
    }