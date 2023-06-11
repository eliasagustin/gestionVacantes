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
    $tile_tile = [];
    if ($_GET['vista']=="home"){
        switch($rol){
            case "Administrador":
                $tile_tile = [
                    "titulo" => ["Crear Usuarios",
                                    "Listar Vacantes",
                                    "Listar Usuarios",
                                    "Buscar Usuario",
                                    "Consultar FAQs"],
                    "link" => ["home",
                                    "listar_vacantes",
                                    "home",
                                    "home",
                                    "home"],
                    "descripcion" => ["Esta sección te conducirá a un formulario para crear un nuevo usuario.",
                                        "Genera una lista de las vacantes, con detalles y en base a un filtro preseteado",
                                        "Genera planilla de todos los usarios del sistema, en la misma podrás modificar permisos, modificar datos y eliminar usuario del usuario si se selecciona alguno.",
                                        "En base a un campo de texto y seleccionar un campo se podrá realizar una busqueda en la base usuarios, luego podrás modificarlo/eliminar datos del usuario buscado.",
                                        "En la misma podrás actualizar, crear o eliminar FAQs y datos de interés."],
                ];
            break;
            case "Invitado":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas",
                                    "Consultar FAQs",
                                    "Solicitar Soporte"],
                    "link" => ["listar_vacantes_abiertas",
                                    "home",
                                    "home"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte hasta loguearte",
                                        "Sección para consultar las resoluciones de las preguntas más frecuentes, como crear un usuario con sus requisitos, y también podrás informarte sobre los procedimientos necesario para lograr una postulación.",
                                        "En esta sección encontrarás las información de contacto telefónico aparte del formulario email."],
                ];
            break;
        }
    }
    
    if ($_GET['vista']=="vacante"){
        switch($rol){
            case "Administrador":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes"],
                    "link" => ["listar_vacantes"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, recuerda que por politicas de seguridad solo tienes acceso a la creación/modificación/eliminación de los usuarios."],
                ];
            break;
            case "Invitado":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas"],
                    "link" => ["listar_vacantes_abiertas"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte hasta loguearte"],
                ];
            break;
        }
    }
    echo'
        <hr class="navbar-divider">
        <br>
        <div class="tile is-ancestor">
        ';
    for($i_aux =0; $i_aux < count($tile_tile['titulo']); $i_aux++){
        echo '
        <a class="tile is-parent" href="index.php?vista='.$tile_tile['link'][$i_aux].'">
        <article class="tile is-child box centrar">
            <p class="subtitle" is-justify-content-center">
            <br>'.$tile_tile['titulo'][$i_aux].'</p><br>
        </article>
    </a>';
    }
    echo '
        </div>
        <hr class="navbar-divider">
        ';
    for($i_aux =0; $i_aux < count($tile_tile['titulo']); $i_aux++){
            echo '
                <article class="message">
                <div class="message-header">
                    <p>'.$tile_tile['titulo'][$i_aux].'</p>
                </div>
                <div class="message-body">
                    '.$tile_tile['descripcion'][$i_aux].'
                </div>
                </article>
                ';
    }
