<?php include "./php/breadcum.php";?>
<div class="container is-fluid">
    <h1 class="title">Listado de Vacantes Abiertas</h1>
</div>

<div class="container pb-6 pt-6">  
<?php
        require_once "./php/main.php";

        # Eliminar usuario #
        /*
        if(isset($_GET['user_id_del'])){
            require_once "./php/usuario_eliminar.php";
        }
        */
        # Seteo las variables necesarias para que funcione el paginador, luego lo llamo #
        if(!isset($_GET['page'])){ // consulto si viene pag iniciada
            $pagina=1;              //la inicio
        }else{
            $pagina=(int) $_GET['page'];  // guardo el numero de pagina en la variable $pagina
            if($pagina<=1){             //me fijo que no venga en negativo
                $pagina=1;              //si viniera en negativo la seteo en 1
            }
        }

        $pagina=limpiar_cadena($pagina);  //por las dudas de vunerabilidad la limpio
        $url="index.php?vista=listar_vacantes_abiertas&page=";
        $registros=15; //        <==== Seteo la cantidad de registros por pag, que se van a mostrar
        $busqueda="";

        # Paginador usuario #
        require_once "./php/vacantes_lista.php";
    ?>
</div>