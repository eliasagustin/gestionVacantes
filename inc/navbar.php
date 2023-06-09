<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=home">
        <img src="./img/logo.png" width="40" height="80">
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
            <h1 class="title">Gestión de Vacantes</h1>
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
            <div class="navbar-item">
                <div class="buttons">
                    <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>

                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
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
                <li><a class="is-active">Inicio</a></li>
                <a class="is-active">Vacantes</a>
                <li><a class="is-active">Abrir vacante</a>
                    <ul>
                        <li><a>Listar vacantes abiertas</a></li>
                        <li><a>Listar vacantes</a></li>
                    </ul>
                </li>
                <li><a class="is-active">Postulaciones</a>
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