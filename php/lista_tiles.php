<?php
    if (!isset($_SESSION['rol'])){
        $rol = 'Invitado';
    } else {
        require_once "main.php";
        $check_rol=conexion();
        $rol = $_SESSION['rol'];
        $user_id=$_SESSION['id'];
        $check_rol=$check_rol->query("SELECT * FROM rol WHERE rol_id='$rol'");
        if(mysqli_num_rows($check_rol)==1){
            $rows=$check_rol->fetch_all(MYSQLI_ASSOC);
            $rol = $rows[0]['rol_descripcion'];
        }
        $rows=null;
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
                                        "Genera una lista de las vacantes, con detalles y en el que se puede setear filtro. La funcion cerrar vacante está desactivada.",
                                        "Genera planilla de todos los usarios del sistema, en la misma podrás modificar permisos, modificar datos y eliminar usuario del usuario si se selecciona alguno.",
                                        "En base a un campo de texto y seleccionar un campo se podrá realizar una busqueda en la base usuarios, luego podrás modificarlo/eliminar datos del usuario buscado.",
                                        "En la misma podrás actualizar, crear o eliminar FAQs y datos de interés."],
                ];
            break;
            //TODO acordarse si es invitado eliminar el boton POSTULARSE de "Listar Vacantes Abiertas"
            case "Invitado":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas",
                                    "Consultar FAQs",
                                    "Solicitar Soporte"],
                    "link" => ["listar_vacantes_abiertas",
                                    "listar_vacantes",
                                    "home",
                                    "home"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte hasta loguearte.",
                                        "Sección para consultar las resoluciones de las preguntas más frecuentes, como crear un usuario con sus requisitos, y también podrás informarte sobre los procedimientos necesario para lograr una postulación.",
                                        "En esta sección encontrarás las información de contacto telefónico aparte del formulario email."],
                ];
            break;
            case "Postulante":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas",
                                    "Listar Vacantes",
                                    "Consultar FAQs",
                                    "Solicitar Soporte"],
                    "link" => ["listar_vacantes_abiertas",
                                    "home",
                                    "home",
                                    "home"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, usa la misma para postularte.",
                                        "Genera una lista de las vacantes, con detalles y en base a un filtro preseteado, recuerda que el boton cerrar vacante estará desabilitado.",                    
                                        "Sección para consultar las resoluciones de las preguntas más frecuentes, como crear un usuario con sus requisitos, y también podrás informarte sobre los procedimientos necesario para lograr una postulación.",
                                        "En esta sección encontrarás las información de contacto telefónico y un formulario email para contactarnos."],
                ];
            break;
            case "Responsable Administrativo":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas",
                                    "Listar Vacantes",
                                    "Abrir Vacante",
                                    "Consultar FAQs",
                                    "Solicitar Soporte"],
                    "link" => ["listar_vacantes_abiertas",
                                    "listar_vacantes",
                                    "abrir_vacante",
                                    "home",
                                    "home"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte porque te encuentras logueado como Responsable Administrativo.",
                                        "Genera una lista de las vacantes en base a un filtro, y por registro de vacantes tendrás  un boton para poder cerrar la misma.",
                                        "Usa este formulario para abrir una vacante nueva, en la misma podrás establecer las fechas, materia, puesto a cubrir y su descripción.",
                                        "Sección para consultar y modificar las resoluciones de las preguntas más frecuentes, como crear un usuario con sus requisitos, y también podrás informarte sobre los procedimientos necesario para lograr una postulación.",
                                        "En esta sección podrás consultar y modificar la información de contacto telefónico aparte del formulario email."],
                ];
            break;
            case "Jefe de Catedra":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas",
                                    "Listar Vacantes",
                                    "Consultar FAQs",
                                    "Solicitar Soporte"],
                    "link" => ["listar_vacantes_abiertas",
                                    "listar_vacantes",
                                    "home",
                                    "home"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte hasta loguearte.",
                                        "Esta sección te conducirá a una busqueda más detallada de las vacantes abiertas y cerradas, por tus permisos el boton 'cerrar vacantes' estará desabilitado.",
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
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte hasta loguearte."],
                ];
            break;
            case "Postulante":
                
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas","Listar Vacantes"],
                    "link" => ["listar_vacantes_abiertas","listar_vacantes"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, usa la misma para postularte.",
                                      "Esta sección te conducirá a una busqueda más detallada de las vacantes abiertas y cerradas, por tus permisos el boton 'cerrar vacantes' estará desabilitado."],
                ];
            break;
            case "Responsable Administrativo":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas","Listar Vacantes","Abrir Vacante"],
                    "link" => ["listar_vacantes_abiertas","listar_vacantes","abrir_vacante"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte porque te encuentras logueado como Responsable Administrativo.",
                                        "Para consultar las vacantes mediante un filtro, en la misma podrás buscar y elegir la vacante a cerrar.",
                                        "Usa este formulario para abrir una vacante nueva, en la misma podrás establecer las fechas, materia, puesto a cubrir y su descripción."],
                ];
            break;
            case "Jefe de Catedra":
                $tile_tile = [
                    "titulo" => ["Listar Vacantes Abiertas","Listar Vacantes"],
                    "link" => ["listar_vacantes_abiertas","listar_vacantes"],
                    "descripcion" => ["Siguiendo esta sección podrás consultar todas las vacantes abiertas al dia de la fecha, pero recuerda que no podrás postularte porque te encuentras logueado como Responsable Administrativo.",
                                "Esta sección te conducirá a una busqueda más detallada de las vacantes abiertas y cerradas, por tus permisos el boton 'cerrar vacantes' estará desabilitado."],
                ];
            break;
        }
    }
    if ($_GET['vista']=="postulacion"){
        switch($rol){
            case "Postulante":
                $tile_tile = [
                    "titulo" => ["Consultar mis postulaciones"],
                    "link" => ["listar_postulaciones&user_id=".$user_id],
                    "descripcion" => ["Es un listado de todas tus postulaciones activas y no activas hasta el dia de la fecha, cuenta con dos botones, uno para ver los detalles de la vacante postulada y otro boton para eliminar tu postulación.<br>
                                    Recuerda que no podrás postularte a una vacante ya cerrada.",
                                      "Esta sección te conducirá a una busqueda más detallada de las vacantes abiertas y cerradas, por tus permisos el boton 'cerrar vacantes' estará desabilitado."],
                ];
            break;
        }
    }
    if ($_GET['vista']=="usuarios"){
        switch($rol){
            case "Administrador":
                $tile_tile = [
                    "titulo" => ["Editar mi cuenta","Crear Usuario","Listado de usuarios"],
                    "link" => ["user_update&user_id_up=".$user_id,"user_new","listar_usuarios"],
                    "descripcion" => ["En editar mi cuenta, puedes cambiar tu nombre, apellido, usuario de sistema, email y hasta la clave.",
                                    "Formulario de creación para un nuevo usuario.",
                                    "Tus permisos te permiten ver detalles, modificar permismos de usuario y eliminar usuarios; accediendo mediante una lista con botones.<br>
                                    Muestra todos los usuarios del sistema. Con la excepción de la cuenta en uso."],
                ];
            break;
            case "Invitado":
                $tile_tile = [
                    "titulo" => ["Crear Usuario","Listado de usuarios"],
                    "link" => ["user_new","listar_usuarios"],
                    "descripcion" => ["Formulario de creación para un nuevo usuario.",
                                    "Permiten ver un listado de todos los usuarios del sistema."],
                ];
            break;
            case "Postulante":
                $tile_tile = [
                    "titulo" => ["Editar mi cuenta","Listado de usuarios"],
                    "link" => ["user_update&user_id_up=".$user_id,"listar_usuarios"],
                    "descripcion" => ["En editar mi cuenta, puedes cambiar tu nombre, apellido, usuario de sistema, email y hasta la clave.",
                                      "Siguiendo esta seccion tus permisos te permiten ver un listado de todos los usuarios del sistema."],
                ];
            break;
            case "Responsable Administrativo":
                $tile_tile = [
                    "titulo" => ["Editar mi cuenta","Crear Usuario", "Listado de usuarios"],
                    "link" => ["user_update&user_id_up=".$user_id, "user_new", "listar_usuarios"],
                    "descripcion" => ["En editar mi cuenta, puedes cambiar tu nombre, apellido, usuario de sistema, email y hasta la clave.",
                                    "Formulario de creación para un nuevo usuario.",
                                    "En esta sección tus permisos te permiten ver un listado de todos los usuarios del sistema."
                    ],
                ];
            break;
            case "Jefe de Catedra":
                $tile_tile = [
                    "titulo" => ["Editar mi cuenta","Listado de usuarios"],
                    "link" => ["listar_vacantes_abiertas","listar_usuarios"],
                    "descripcion" => ["En editar mi cuenta, puedes cambiar tu nombre, apellido, usuario de sistema, email y hasta la clave.",
                                "En esta sección tus permisos te permiten ver un listado de todos los usuarios del sistema."],
                ];
            break;
        }
    }
    if ($_GET['vista']=="ayuda"){
            $tile_tile = [
                "titulo" => ["Preguntas Frecuentes","Solicitar Soporte"],
                "link" => ["faq","soporte"],
                "descripcion" => ["A lo largo del tiempo hemos recopilado las preguntas y respuestas que se realizan con mayor frecuencia. haga click en el boton para dirigirte a dicha sección.",
                                  "Si te encuentras con algún problema al operar en el sistema de vacantes, deberías solicitar ayuda por nuestro formulario web."],
            ];
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
