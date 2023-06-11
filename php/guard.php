<?php
    if (!isset($_SESSION['rol'])){
        $rol = 'Invitado';
    } else {
        require_once "main.php";
        $check_rol=conexion();
        $rol = $_SESSION['rol'];
        $check_rol=$check_rol->query("SELECT * FROM rol WHERE rol_id='$rol'");
        if($check_rol->rowCount()==1){
            $check_rol=$check_rol->fetch();
            $rol = $check_rol['rol_descripcion'];
        }
        $check_rol=null;
    }

    if(isset($_GET['vista']) || !$_GET['vista']==""){
        if(($_GET['vista']=="listar_vacantes")&&(in_array($rol, ["Invitado","Administrador","Jefe de Catedra","Responsable Administrativo","Postulante"]))){
            echo "El elemento '$rol' se encuentra en el arreglo. Ahora hay q elegir q redirigir";
        } else {
            echo "El elemento '$rol' NO se encuentra en el arreglo. Ahora hay q elegir q redirigir";
        };
    }

    // if(headers_sent()){
	// 	echo "<script> window.location.href='index.php?vista=login'; </script>";
	// }else{
	// 	header("Location: index.php?vista=login");
	// }

