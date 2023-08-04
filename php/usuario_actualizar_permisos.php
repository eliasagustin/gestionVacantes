<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

    /*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['usuario_id']);
    $rol_id_adm=limpiar_cadena($_POST['r_id']);
    $rol_id=limpiar_cadena($_POST['rol_ID']);

    if ($rol_id_adm!=1){
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El sistema se econtró con un problema de permisos.
        </div>
    ';
    exit();
    }
    /*== Verificando usuario ==*/
	$check_usuario=conexion();
	$check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");
    $datos = null;
    if(mysqli_num_rows($check_usuario)<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$rows=$check_usuario->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
            $datos = $row;
        }
    }
    $check_usuario=null;


    /*== Actualizar datos ==*/
    $mysqli_stmt=conexion();
    $actualizar_usuario=$mysqli_stmt->prepare("UPDATE usuario SET rol_id=? WHERE usuario_id=?");
    $actualizar_usuario->bind_param('ii', $rol_id, $id);
    $actualizar_usuario->execute();
    if($actualizar_usuario->affected_rows==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PERMISO DE USUARIO ACTUALIZADO!</strong><br>
                El usuario se actualizo con exito.
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el usuario, por favor intente nuevamente.
            </div>
        ';
    }
    $actualizar_usuario=null;