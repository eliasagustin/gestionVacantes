<?php
    /*== Almacenando datos ==*/
    $pos_id=limpiar_cadena($_GET['pos_id_del']);
    $user_id=limpiar_cadena($_SESSION['id']);
    /*== Verificando usuario ==*/
    # Busco y valido usuario #
    
    # Busco y valido postulacion a eliminar #
    
    $conexion=conexion();
    // $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");
    
    $check_pos = $conexion->query("SELECT * FROM postulacion WHERE usuario_id=$user_id and postulacion_id=$pos_id");
	$check_pos = (int) mysqli_num_rows($check_pos);

    if($check_pos==1){
        $eliminar_pos=$conexion->prepare("DELETE FROM postulacion WHERE postulacion_id=?");

        $eliminar_pos->bind_param("i",$pos_id);
        $eliminar_pos = $eliminar_pos->execute();

        if($eliminar_pos){
            echo '
                <div class="notification is-info is-light">
                    <strong>POSTULACION ELIMINADA!</strong><br>
                    La postulacion fue eliminada con exito!
                </div>
            ';
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar la postulación, por favor intente nuevamente.
                </div>
            ';
        }
        $eliminar_pos=null;

    } else {
        echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar la postulación, por favor intente nuevamente.
                </div>
            ';
    }
    $check_pos = null;
?>