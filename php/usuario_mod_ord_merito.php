<?php
    require_once "main.php";
    // == Almacenando datos ==
    $v_id=limpiar_cadena($_POST['vacante_id']);
    $u_id=limpiar_cadena($_POST['usuario_id']);
    $pp=limpiar_cadena($_POST['postulacion_puntaje']);
    $error_modificacion = false;

    // == Verificando información necesaria ==
    if($v_id=="" || $u_id==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Se ha perdido información para completar el proceso.
            </div>
        ';
        $error_modificacion = true;
    }

    // == Verificar ID vancante (Si la vacante existe) ==
    $datos_vacantes = null;
    $vacante_id=conexion();
    $vacante_id=$vacante_id->query("SELECT * FROM vacante WHERE vacante_id like '$v_id'");
    if(mysqli_num_rows($vacante_id)==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La vacante seleccionada no existe en nuestra BD, por favor elija otra.
            </div>
        ';
        $error_modificacion = true;
    } else { 
        $vacante_id=$vacante_id->fetch_all(MYSQLI_ASSOC);
        foreach($vacante_id as $row){
            $datos_vacantes = $row;
        }
    }
    $vacante_id = null;

        // == Verificar vacante_fecha_cierre == Si la vacante está cerrada no debería poder cambiar orden de merito
    if($datos_vacantes['vacante_fecha_cierre'] != '0000-00-00'){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error en politicas!</strong><br>
                La vacante seleccionada fue cerrada el '.$datos_vacantes['vacante_fecha_cierre'].'.
                <br >No se pueden modificar la orden de merito una vez cerrada la vacante.
            </div>
        ';
        $error_modificacion = true;
    }

    // == Verificar existencia de u_id y que el rol sea postulante ==
    $datos_postulante = null;
    $postulante=conexion();
    $postulante=$postulante->query("SELECT * FROM usuario WHERE usuario_id like '$u_id'");
    if(mysqli_num_rows($postulante)==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en nuestra BD, por favor elija otra.
            </div>
        ';
        $error_modificacion = true;
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
                El usuario al que desea ingresar la Orden de Merito, no tiene el rol para hacerlo.
            </div>
        ';
        $error_modificacion = true;
    }

    // == Generar consulta para crear nueva postulación ==
    if($error_modificacion==false){
        //$fecha_actual = date("Y-m-d");
        $guardar_usuario=conexion();
                                                                                    //WHERE usuario_id = $auxS and vacante_id = $vacante_id"
        $mysqli_stmt = $guardar_usuario->prepare("UPDATE postulacion SET postulacion_puntaje=? WHERE usuario_id=? and vacante_id =?");
        /* BK: always check whether the prepare() succeeded */
        if ($mysqli_stmt === false) {
        trigger_error($this->mysqli->error, E_USER_ERROR);
        return;
        }
        $mysqli_stmt->bind_param('iii', $pp, $u_id, $v_id);

        $guardar_usuario = $mysqli_stmt->execute();

        if($guardar_usuario){
            echo '
                <div class="notification is-success is-light">
                    <strong>Campo editado correctamente!</strong><br>
                    La orden de merito se ha modificado correctamente.
                </div>
            ';
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo registrar la modificacion de la orden de merito, por favor inténtelo nuevamente.
                </div>
            ';
        }
    }
    echo("<meta http-equiv='refresh' content='3'>");
    

        /*

    
    

    // == Verificar que no exista una postulacion con una misma id_postulante y vacantet_id ==
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
        $error_modificacion = true;
    }
    $postulacion = null;

    // == Generar consulta para crear nueva postulación ==
    if($error_modificacion==false){
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
    */