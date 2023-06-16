<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	$materia=limpiar_cadena($_POST['vacante_materia']);
	$fecha_apertura=limpiar_cadena($_POST['fecha_apertura']);
	$fecha_cierre=limpiar_cadena($_POST['fecha_cierre']);
	$puesto=limpiar_cadena($_POST['vacante_puesto']);
	$descripcion=limpiar_cadena($_POST['vacante_descripcion']);

	/*== Verificando campos obligatorios ==*/
    if($materia=="" || $fecha_apertura=="" || $fecha_cierre=="" || $puesto=="" || $descripcion==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Se han encontrados campos obligatorios sin completar.
            </div>
        ';
        exit();
    }

    if (strtotime($fecha_cierre)<=strtotime($fecha_apertura)){
        echo'
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La fecha de cierre debe ser mayor que la fecha de apertura.
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
   if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{3,70}",$materia)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El formato del campo Materia no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9\-]{10,10}",$fecha_apertura)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La fecha de apertura no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }
    if(verificar_datos("[0-9\-]{10,10}",$fecha_cierre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La fecha de cierre no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$puesto)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El campo nombre del puesto no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$&^#\-\/%@ ]{10,200}",$descripcion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La descripción del puesto no coincide con el formato solicitado, es menor que 10 o supera el limite de 200.
            </div>
        ';
        exit();
    }


    /*== Verificando materia ==*/
    $check_materia=conexion();
    $check_materia=$check_materia->query("SELECT materia_id FROM materia WHERE materia_nombre like '$materia'");
    if(mysqli_num_rows($check_materia)==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La materia ingresada no existe en nuestra BD, por favor elija otra.
            </div>
        ';
        exit();
    }else{
        $check_materia=$check_materia->fetch_all(MYSQLI_ASSOC);
    }

    /*== Verificando Nombre del puesto ==*/
    if(!in_array($puesto, ["Ayudante de Cátedra","Profesor Adjunto","Profesor Titular","No Docente"])){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El puesto propuesto no existe, por favor elija otro.
            </div>
        ';
        exit();
    };

	/*== Guardando datos ==*/
    $guardar_vacante=conexion();
    $mysqli_stmt=$guardar_vacante->prepare("INSERT INTO vacante(vacante_nombre_puesto,vacante_descripcion_puesto,vacante_fecha_apertura,vacante_fecha_cierre_estipulada,materia_id) 
    VALUES(?,?,?,?,?)");
    //echo $check_materia[0]['materia_id'];
    $mysqli_stmt->bind_param("ssssi", $puesto, $descripcion, $fecha_apertura,$fecha_cierre,$check_materia[0]['materia_id']);
    $guardar_vacante = $mysqli_stmt->execute();

    
    if($guardar_vacante){
        echo '
            <div class="notification is-info is-light">
                <strong>Registro exitoso!</strong><br>
                Vacante registrada con exito, recuerde que la misma será visible cuando la fecha actual sea mayor o igual que la fecha de apertura.
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar la vacante, por favor inténtelo nuevamente.
            </div>
        ';
    }
   
    $guardar_vacante=null;