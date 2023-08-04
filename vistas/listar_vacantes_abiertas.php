<?php include "./php/breadcum.php";?>
<div class="container is-fluid">
    <h1 class="title">Listado de Vacantes Abiertas</h1>
</div>
<?php 
    require "./php/guard.php";
    
?>
<div class="container pb-4 pt-4">  
<?php
        require_once "./php/main.php";

        # Postularse usuario #     
        if(isset($_GET['vac_id_pos']) && isset($_SESSION['rol'])){
            if($_SESSION['rol']==4){
                // echo 'vac_id_pos '.$_GET['vac_id_pos'];
                require_once "./php/usuario_postularse.php";
            } else {
                echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Problema de credenciales y permisos para postularse.
            </div>
            ';
            }
        }
        
        # Seteo las variables necesarias para que funcione el PAGINADOR, luego lo llamo #
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
        $registros=10; //        <==== Seteo la cantidad de registros por pag, que se van a mostrar
        $busqueda="";

        # Paginador usuario #
        require_once "./php/vacantes_lista.php";
    ?>
</div>