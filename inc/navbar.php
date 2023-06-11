<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=home">
        <img src="./img/logo.png" alt="Modulo Gestion de Vacantes" width="40" height="80">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>
        <!-- TODO cambiar links del menu -->
    
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item">
                <h1 class="title">Gestión de Vacantes</h1>
            </div>
            <!--
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Usuarios</a>                      

                <div class="navbar-dropdown">
                    <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Categorías</a>   

                <div class="navbar-dropdown">
                    <a href="index.php?vista=category_new" class="navbar-item">Nueva</a>    
                    <a href="index.php?vista=category_list" class="navbar-item">Lista</a>    
                    <a href="index.php?vista=category_search" class="navbar-item">Buscar</a>    
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Productos</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=product_new" class="navbar-item">Nuevo</a>   
                    <a href="index.php?vista=product_list" class="navbar-item">Lista</a>    
                    <a href="index.php?vista=product_category" class="navbar-item">Por categoría</a>  
                    <a href="index.php?vista=product_search" class="navbar-item">Buscar</a>    
                </div>
            </div>
            -->
        </div>

        <div class="navbar-end">
            <div class="navbar-item">Actualmente estás designado con rol de "
            
            <?php require "./php/rol_consulta.php"; ?>
            "</div>
            <hr class="navbar-divider">
            <div class="navbar-item">
                <div class="buttons">
                    <?php 
                        if (isset($_SESSION['rol'])){
                            echo ' <a href="index.php?vista=logout" class="button is-link is-rounded">
                                        Salir
                                    </a>';
                        } else {
                            echo ' <a href="index.php?vista=login" class="button is-link is-rounded">
                                        Log In
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
                <li><a class="is-active" href="index.php?vista=home">Inicio</a></li>
                <li><a class="is-active" href="index.php?vista=vacante">Vacantes</a>
                    <ul>
                        <li><a href="index.php?vista=abrir_vacante">Abrir vacante</a></li>
                        <li><a href="index.php?vista=listar_vacantes_abiertas">Listar vacantes abiertas</a></li>
                        <li><a href="index.php?vista=listar_vacantes">Listar vacantes</a></li>
                    </ul>
                </li>
                <li><a class="is-active" href="index.php?vista=postulacion">Postulaciones</a>
                    <ul>
                        <li><a>Mis postulaciones</a></li>
                    </ul>
                </li>
                <li><a class="is-active">Usuarios</a>
                    <ul>
                        <li><a>Crear Usuario</a></li>
                        <li><a>Listar Usuario</a></li>
                    </ul>
                </li>
                <li><a class="is-active">Soporte</a>
                    <ul>
                        <li><a>Consulta FAQs</a></li>
                        <li><a>Solicitar soporte</a></li>
                    </ul>
                </li>
        </aside>
    </div>
  </div>
  <div class="column">
    <div class="box">