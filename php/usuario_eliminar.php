<?php
require_once "main.php";
	/*== Almacenando datos ==*/
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    /*== Verificando usuario ==*/
    $conexion=conexion();
    // $check_usuario=$check_usuario->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");
    
    $check_usuario = $conexion->query("SELECT usuario_id FROM usuario WHERE usuario_id='$user_id_del'");
	$check_usuario = (int) mysqli_num_rows($check_usuario);

    if($check_usuario==1){

        // En vez de preguntar por producto deberia preguntar por postulaciones
    	
        $eliminar_usuario=$conexion->prepare("DELETE FROM usuario WHERE usuario_id=?");

        $eliminar_usuario->bind_param("i",$user_id_del);
        $eliminar_usuario = $eliminar_usuario->execute();

        if($eliminar_usuario){
            echo '
                <div class="notification is-info is-light">
                    <strong>¡USUARIO ELIMINADO!</strong><br>
                    Los datos del usuario se eliminaron con exito
                </div>
            ';
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor intente nuevamente
                </div>
            ';
        }
        $eliminar_usuario=null;
    
        // $check_productos=conexion();
    	// $check_productos=$check_productos->query("SELECT usuario_id FROM producto WHERE usuario_id='$user_id_del' LIMIT 1");

    	// if($check_productos->rowCount()<=0){
    		
	    // 	$eliminar_usuario=conexion();
	    // 	$eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");

	    // 	$eliminar_usuario->execute([":id"=>$user_id_del]);

	    // 	if($eliminar_usuario->rowCount()==1){
		//         echo '
		//             <div class="notification is-info is-light">
		//                 <strong>¡USUARIO ELIMINADO!</strong><br>
		//                 Los datos del usuario se eliminaron con exito
		//             </div>
		//         ';
		//     }else{
		//         echo '
		//             <div class="notification is-danger is-light">
		//                 <strong>¡Ocurrio un error inesperado!</strong><br>
		//                 No se pudo eliminar el usuario, por favor intente nuevamente
		//             </div>
		//         ';
		//     }
		//     $eliminar_usuario=null;
    	// }else{
    	// 	echo '
	    //         <div class="notification is-danger is-light">
	    //             <strong>¡Ocurrio un error inesperado!</strong><br>
	    //             No podemos eliminar el usuario ya que tiene productos registrados por el
	    //         </div>
	    //     ';
    	// }
    	// $check_productos=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO que intenta eliminar no existe
            </div>
        ';
    }
    $check_usuario=null;