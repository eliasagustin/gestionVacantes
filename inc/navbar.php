<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=home" title="Recarga página inicial">
        <img src="./img/logo.png" alt="Modulo Gestion de Vacantes" desc="Incio" width="40" height="80">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>
    
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item">
                <h1 class="title">Gestión de Vacantes</h1>
            </div>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">Actualmente estás designado con rol de "
            
            <?php require "./php/rol_consulta.php"; ?>
            "</div>
            <p class="navbar-divider"> </p>
            <div class="navbar-item">
                <div class="buttons">
                    <?php 
                        if (isset($_SESSION['rol'])){
                            echo ' <a href="index.php?vista=logout" class="button is-link is-rounded" title="Click para Desloguearse">
                                        Salir
                                    </a>';
                        } else {
                            echo ' <a href="index.php?vista=login" class="button is-link is-rounded" title="Click para Iniciar Sesión">
                                        Inicio de Sesión
                                    </a>';
                        }
                    ?>
                   
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Menu lateral -->
<div class="columns">
  <div class="column is-narrow">
    <div class="box" style="width: 200px;">
      
        <aside class="menu">
            <ul class="menu-list">
                <li><a class="is-active" href="index.php?vista=home" title="Página inicial">Inicio</a></li>
                <li><a class="is-active" href="index.php?vista=vacante" title="Página Vacantes">Vacantes</a>
                    <ul>
                        <?php
                            if (isset($_SESSION['id'])){
                                $mi_ID = $_SESSION['id'];
                                $mi_rol = $_SESSION['rol'];
                                if($mi_rol==3)
                                echo '
                                    <li><a href="index.php?vista=abrir_vacante" title="Formulario para abrir vacante">Abrir vacante</a></li>
                                ';
                            }
                        ?>
                        <li><a href="index.php?vista=listar_vacantes_abiertas" title="Sección listar vacantes abiertas solamente">Listar vacantes abiertas</a></li>

                        <?php
                            if (isset($_SESSION['id'])){
                                echo '<li><a href="index.php?vista=listar_vacantes" title="Listar vacantes con filtro avanzado">Listar vacantes</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <?php
                     if (isset($_SESSION['id'])){
                        $mi_rol = $_SESSION['rol'];
                        if($mi_rol==4)
                        echo '
                            <li><a class="is-active" href="index.php?vista=postulacion" title="Sección de postulaciones">Postulaciones</a>
                                <ul>
                                    <li><a title="Ver todas mis postulaciones" href="index.php?vista=listar_postulaciones&user_id='.$mi_rol.'">Mis postulaciones</a></li>
                                </ul>
                            </li>
                        ';
                     }
                ?>
                <li><a class="is-active" href="index.php?vista=usuarios">Usuarios</a>
                    <ul>
                        <?php
                        if (isset($_SESSION['id'])){
                            $mi_ID = $_SESSION['id'];
                            echo '
                                <li><a href="index.php?vista=user_update&user_id_up='.$mi_ID.'">Mi Usuario</a></li>
                            ';
                        }
                        ?>
                        
                        <?php 
                        if (!isset($_SESSION['rol']) || $_SESSION['rol']==1 || $_SESSION['rol']==3){
                            ?>
                            <li><a href="index.php?vista=user_new">Crear Usuario</a></li>
                            <?php }
                        ?>
                        
                        <li><a href="index.php?vista=listar_usuarios">Listar Usuario</a></li>
                    </ul>
                </li>
                <li><a class="is-active" href="index.php?vista=ayuda">Soporte</a>
                    <ul>
                        <li><a href="index.php?vista=faq">Consulta FAQs</a></li>
                        <li><a href="index.php?vista=soporte">Solicitar soporte</a></li>
                    </ul>
                </li>
        </aside>
    </div>
  </div>
  <div class="column">
<div class="box">