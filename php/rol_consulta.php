<?php
    if (!isset($_SESSION['rol'])){
        echo 'Invitado';
    } else {
        require_once "main.php";
        $check_rol=conexion();
        $rol_id = $_SESSION['rol'];
        $check_rol=$check_rol->query("SELECT * FROM rol WHERE rol_id='$rol_id'");
        if(mysqli_num_rows($check_rol)==1){
            $rows=$check_rol->fetch_all(MYSQLI_ASSOC);
            //$check_rol=$check_rol->fetch();
            echo $rows[0]['rol_descripcion'];
        }
        $check_rol=null;
    }