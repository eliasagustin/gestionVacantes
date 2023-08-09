<?php 

if(isset($_GET['vista']) || !$_GET['vista']==""){
    echo '<nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
<ul>';
    switch($_GET['vista']){
        // case "home":
        //     echo '<li class="is-active"><a href="index.php?vista=home">Inicio</a></li>';
        //     break;
        case "postulacion":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=postulacion">Postulaciones</a></li>';
            break;
        case "listar_postulaciones":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=postulacion">Postulaciones</a></li>';
            echo '<li class="is-active"> Mis Postulaciones</li>';
            break;
        case "vacante":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=vacante">Vacantes</a></li>';
            break;
        case "listar_vacantes_abiertas":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=vacante">Vacantes</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=listar_vacantes_abiertas">Listar vacantes abiertas</a></li>';
            break;
        case "listar_vacantes":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=vacante">Vacantes</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=home">Listar vacantes</a></li>';
            break;
        case "abrir_vacante":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=vacante">Vacantes</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=home">Abrir Vacante</a></li>';
            break;
        case "vacante_detallada":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=vacante">Vacantes</a></li>';
            echo '<li class="is-active">Detalle vacante</li>';
            break;
        case "user_new":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=usuarios">Usuarios</a></li>';
            echo '<li class="is-active">Crear Usuario</li>';
            break;
        case "usuarios":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active">Usuarios</li>';
            break;
        case "user_update":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=usuarios">Usuarios</a></li>';
            echo '<li class="is-active">Editar mi cuenta</li>';
            break;
        case "listar_usuarios":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=usuarios">Usuarios</a></li>';
            echo '<li class="is-active">Listado de usuarios</li>';
            break;
        case "ayuda":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active">Ayuda</li>';
            break;
        case "faq":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=ayuda">Ayuda</a></li>';
            echo '<li class="is-active">FAQs</li>';
            break;
        case "soporte":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li><a href="index.php?vista=ayuda">Ayuda</a></li>';
            echo '<li class="is-active">Solicitar Soporte</li>';
            break;
    }
echo '  </ul>
</nav>';
}

// Función de PHP para refrescar la página actual
function refrescarPagina() {
    // Redireccionar a la página actual (en este caso, index.php)
    header("Location: ".$_SERVER['PHP_SELF']);
    exit; // Asegurarse de que el script termine aquí para evitar problemas con el redireccionamiento
}
