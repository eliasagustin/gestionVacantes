
<?php

//$_SESSION['rol']; //TODO Agregar un guard para redirigir a home, solo si detecta que el rol no tiene acceso a esta SECCION
include "./php/breadcum.php";?>
<div class="container is-fluid">
    <h1 class="title">Listado de Vacantes</h1>
</div>


<!-- <div class="container pb-6 pt-6"> -->
<?php
    require_once "./php/main.php";
    require "./php/guard.php";

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
    $url="index.php?vista=listar_vacantes&page=";
    $registros=10; //        <==== Seteo la cantidad de registros por pag, que se van a mostrar
    $busqueda="";

    # Paginador usuario #
    //$rol = $_SESSION['rol'];
?>
<form action="./php/vacantes_lista_avanzada.php" method="POST" class="FormularioAjax" enctype="multipart/form-data" >
    <div class="columns pt-4">
        <div class="column">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="estado">Estado</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                            <select name="estado" id="estado">
                                <option value="" selected="Abierta" ></option>
                                <option value="Abierta">Abierta</option>
                                <option value="Cerrada">Cerrada</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal ">
                <div class="field-label is-normal">
                    <label class="label" for="vacante_materia">Materia</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                            <select name="vacante_materia" id="vacante_materia">
                                <option value="" selected="" ></option>
                                <?php
                                    $materias=conexion();
                                    $materias=$materias->query("SELECT * FROM materia");
                                    if(mysqli_num_rows($materias)>0){
                                        $materias=$materias->fetch_all(MYSQLI_ASSOC);
                                        foreach($materias as $row){
                                            echo '<option value="'.$row['materia_id'].'" >'.$row['materia_nombre'].'</option>';
                                        }
                                    }
                                    $materias=null;
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="fecha_apertura_I">Apertura desde:</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="is-fullwidth">
                                <input class="input" type="date" name="fecha_apertura_I" id="fecha_apertura_I" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="fecha_cierre_I">Cierre desde:</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="is-fullwidth">
                                <input class="input" type="date" name="fecha_cierre_I" id="fecha_cierre_I" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="column">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="fecha_apertura_F"> a </label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="is-fullwidth">
                                <input class="input" type="date" name="fecha_apertura_F" id="fecha_apertura_F" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="fecha_cierre_F"> a </label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="is-fullwidth">
                                <input class="input" type="date" name="fecha_cierre_F" id="fecha_cierre_F" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php

        ?>
        <div class="column">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="orden">Ordenado por</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="orden" id="orden" required>
                                    <option value="vacante_id" selected>Vacante id</option>
                                    <option value="vacante_nombre_puesto">Puesto</option>
                                    <option value="vacante_fecha_apertura">Fecha Apertura</option>
                                    <option value="vacante_fecha_cierre_estipulada">F. Cierre Estipulado</option>
                                    <option value="vacante_fecha_cierre">Fecha Cierre</option>
                                    <option value="materia_id">Materia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="ord" >Orden</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                            <select name="ord" id="ord" required>
                                <option value="ASC" selected>Ascendente</option>
                                <option value="DESC">Descendente</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="has-text-right mb-5">
        <input type="hidden" id="custId" name="RId" value="<?php echo $rol;?>">
        <button type="submit" class="button is-info is-rounded" title="Aplicar filtro/s" >Filtrar</button>&nbsp;&nbsp;
    </p>
</form>
    <div class="form-rest">
            
        <?php $rol = $_SESSION['rol'];
        require_once "./php/vacantes_lista_avanzada.php";?>
    </div>
</div>