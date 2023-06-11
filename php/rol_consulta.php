<?php
    if (!isset($_SESSION['rol'])){
        echo 'Invitado';
    } else {
        require_once "main.php";
        $check_rol=conexion();
        $rol_id = $_SESSION['rol'];
        $check_rol=$check_rol->query("SELECT * FROM rol WHERE rol_id='$rol_id'");
        if($check_rol->rowCount()==1){
            $check_rol=$check_rol->fetch();
            echo $check_rol['rol_descripcion'];
        }
        $check_rol=null;
    }