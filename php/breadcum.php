<?php 

if(isset($_GET['vista']) || !$_GET['vista']==""){
    echo '<nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
<ul>';
    switch($_GET['vista']){
        case "home":
            echo '<li class="is-active"><a href="index.php?vista=home">Inicio</a></li>';
            break;
        case "postulacion":
            echo '<li><a href="index.php?vista=home">Inicio</a></li>';
            echo '<li class="is-active"><a href="index.php?vista=postulacion">Postulaciones</a></li>';
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
    }
echo '  </ul>
</nav>';
}
