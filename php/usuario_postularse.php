<?php
    require_once "main.php";
	/*== Almacenando datos ==*/
    $vac_id_pos=limpiar_cadena($_GET['vac_id_pos']);
	$id_postulante=limpiar_cadena($_SESSION['id']);
    $error_postulacion = false;

    /*== Verificando información necesaria ==*/
    if($vac_id_pos=="" || $id_postulante==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Se ha perdido información para completar el proceso.
            </div>
        ';
        $error_postulacion = true;
    }

    /*== Verificar ID vancante (Si la vacante existe) ==*/
    $datos_vacantes = null;
    $vacante_id=conexion();
    $vacante_id=$vacante_id->query("SELECT * FROM vacante WHERE vacante_id like '$vac_id_pos'");
    if(mysqli_num_rows($vacante_id)==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La vacante seleccionada no existe en nuestra BD, por favor elija otra.
            </div>
        ';
        $error_postulacion = true;
    } else { 
        $vacante_id=$vacante_id->fetch_all(MYSQLI_ASSOC);
        foreach($vacante_id as $row){
            $datos_vacantes = $row;
        }
    }
    $vacante_id = null;
    /*== Verificar vacante_fecha_cierre ==*/
    // Si la vacante está cerrada no debería poder postularse
    if($datos_vacantes['vacante_fecha_cierre'] != '0000-00-00'){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La vacante seleccionada fue cerrada el '.$datos_vacantes['vacante_fecha_cierre'].'.
            </div>
        ';
        $error_postulacion = true;
    }
    
    /*== Verificar existencia de id_postulante y que el rol sea postulante ==*/
    $datos_postulante = null;
    $postulante=conexion();
    $postulante=$postulante->query("SELECT * FROM usuario WHERE usuario_id like '$id_postulante'");
    if(mysqli_num_rows($postulante)==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en nuestra BD, por favor elija otra.
            </div>
        ';
        $error_postulacion = true;
    } else { 
        $postulante=$postulante->fetch_all(MYSQLI_ASSOC);
        foreach($postulante as $row){
            $datos_postulante = $row;
        }

    }
    $postulante = null;
    if($datos_postulante['rol_id']!=4){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario que desea postularse, no tiene el rol para hacerlo.
            </div>
        ';
        $error_postulacion = true;
    }

    /*== Verificar que no exista una postulacion con una misma id_postulante y vacantet_id ==*/
    // Si la postulación existe
    $datos_postulacion = null;
    $postulacion=conexion();
    $postulacion=$postulacion->query("SELECT postulacion_id FROM postulacion WHERE usuario_id like '$id_postulante' and vacante_id like '$vac_id_pos' ");
    $postulacion = (int) mysqli_num_rows($postulacion);
    if($postulacion>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Ya fue generada una postulación en esta vacante desde tu usuario.
            </div>
        ';
        $error_postulacion = true;
    }
    $postulacion = null;

    /*== Generar consulta para crear nueva postulación ==*/
    if($error_postulacion==false){
        $fecha_actual = date("Y-m-d");
        $new_p=conexion();
        $mysqli_stmt=$new_p->prepare("INSERT INTO postulacion( usuario_id, vacante_id, postulacion_fecha) VALUES (?,?,?)");
        $mysqli_stmt->bind_param("iis", $id_postulante, $vac_id_pos, $fecha_actual);
        $new_p = $mysqli_stmt->execute();

        if($new_p){
            echo '
                <div class="notification is-info is-light">
                    <strong>Te has postulado exitosamente!</strong><br>
                    Registro exitoso, recuerde que luego de la fecha de cierre se actualizará el puntaje.
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
    }