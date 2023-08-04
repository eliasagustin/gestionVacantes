<?php
$vac_id_c=limpiar_cadena($_GET['close_vac_id']);
$check_vac = $conexion->query("SELECT * FROM vacante WHERE vacante_id='$vac_id_c'");
$check_vac = (int) mysqli_num_rows($check_vac);

//vacante_fecha_cierre
if($check_vac==1){

    // En vez de preguntar por producto deberia preguntar por postulaciones
    $fecha_actual = date("Y-m-d");
    /*== Actualizar datos ==*/
    $mysqli_stmt=conexion();
    $actualizar_usuario=$mysqli_stmt->prepare("UPDATE vacante SET vacante_fecha_cierre=? WHERE vacante_id=?");
    $actualizar_usuario->bind_param('si', $fecha_actual, $vac_id_c);
    $actualizar_usuario->execute();
    if($actualizar_usuario->affected_rows==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Vacanate Cerrada!</strong><br>
                La vacante ha sido cerrada con la fecha del corriente dia.
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se ha podido modificar la vacante.
            </div>
        ';
    }
    $actualizar_usuario=null;
    $mysqli_stmt=null;
}else{
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Compruebe el número de vacante e intentelo nuevamente.
            </div>
        ';
}
?>