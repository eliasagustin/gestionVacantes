<div class="container is-fluid mb-4">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
</div>

<div class="card container m-2 p-2">  
    <?php
        require_once "./php/main.php";

        # Eliminar usuario #
        if(isset( $_GET['user_id_del']) ){
            require_once "./php/usuario_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=listar_usuarios&page=";
        $registros=15;
        $busqueda="";

        # Paginador usuario #
        require_once "./php/usuario_lista.php";
    ?>
</div>