<?php
	/*== Almacenando datos ==*/
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $clave=limpiar_cadena($_POST['login_clave']);


    /*== Verificando campos obligatorios ==*/
    if($usuario=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVE no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");
    if(mysqli_num_rows($check_user)==1){

    	$rows=$check_user->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
            echo $row["usuario_usuario"]."<br>";

            if($row['usuario_usuario']==$usuario && password_verify($clave, $row['usuario_clave'])){

                $_SESSION['id']=$row['usuario_id'];
                $_SESSION['nombre']=$row['usuario_nombre'];
                $_SESSION['apellido']=$row['usuario_apellido'];
                $_SESSION['usuario']=$row['usuario_usuario'];
                $_SESSION['rol']=$row['rol_id'];

                if(headers_sent()){
                    //Sino se envían los encabezados recargo la web con js
                    echo "<script> window.location.href='index.php?vista=home'; </script>";
                }else{
                    header("Location: index.php?vista=home");
                }

            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Usuario o clave incorrectos
                    </div>
                ';
            }
        }
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
    }
    $check_user=null;