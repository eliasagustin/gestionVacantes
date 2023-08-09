<?php include "./php/breadcum.php";?>
<div class="container is-fluid mb-4">
    <h1 class="title">Postulaciones</h1>
    <h2 class="subtitle">Lista mis postulaciones</h2>
</div>

<div class="card container m-2 p-2">  
    <?php
        require_once "./php/main.php";

        # Eliminar postulacion #
        if(isset( $_GET['pos_id_del']) ){
            require_once "./php/postulacion_eliminar.php";
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
        $url="index.php?vista=listar_postulaciones&page=";
        $registros=10;
        $busqueda="";

        # Paginador usuario #
        require_once "./php/postulacion_lista.php";
    ?>
</div>