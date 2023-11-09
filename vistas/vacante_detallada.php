<?php include "./php/breadcum.php";
?>
<div class="container is-fluid">
    <h1 class="title">Detalle de vacante</h1>
    <?php
        require_once "./php/main.php";
        require "./php/guard.php";
    $vacante_id = $_GET['vacante_id'];
    $estado_vacacante = '';
    $postulante_totales = 0;
    echo '<div class="form-rest mb-4 mt-2"></div>';
# Postularse usuario #     
if(isset($_GET['vac_id_pos']) && isset($_SESSION['rol'])){
    if($_SESSION['rol']==4){
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
if(isset($_GET['us_id_act_OM'])) {
    if(isset($_SESSION['rol'])&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
    // if(isset($_GET['vac_id_pos']) && isset($_SESSION['rol'])){

            require_once "./php/usuario_mod_ord_merito.php";
            echo '
        <div class="notification is-info is-light">
            <strong>Ejecucion Ordenada!</strong><br>
            Se ejecuta php.
        </div>
        ';
        } else {
            echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Problema de credenciales y permisos para editar Orden de Mérito.
        </div>
        ';
        
    }
}

    if(isset($_SESSION['id'])){
        $auxS = $_SESSION['id'];
    }
    $consulta_datos="SELECT * FROM vacante WHERE vacante_id LIKE $vacante_id";
    $conexion=conexion();
    $datos = $conexion->query($consulta_datos);
    if(mysqli_num_rows($datos)>0){
        $datos=$datos->fetch_all(MYSQLI_ASSOC);
        foreach($datos as $row){
            $materia_id = $row['materia_id'];
            $materia_nombre = "";
            $materias=conexion();
            $materias=$materias->query("SELECT * FROM materia WHERE materia_id LIKE $materia_id");
            if(mysqli_num_rows($materias)>0){
                $materias=$materias->fetch_all(MYSQLI_ASSOC);
                foreach($materias as $row2){
                    $materia_nombre = $row2["materia_nombre"];
                }
            }
            $materias=null;
            
            ?>
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Se solicita <?php echo $row['vacante_nombre_puesto']; ?> para la materia
                        <?php echo $materia_nombre; ?>
                    </p>
                    <?php
                    if($row['vacante_fecha_cierre'] == '0000-00-00'){
                            echo "<p class='subtitle notification is-success is-light'>
                            Vacante Abierta</p>";
                            $estado_vacacante = 'abierta';
                        } else {
                            echo "<p class='subtitle notification is-danger is-light'>
                            Vacante Cerrada</p>";
                            $estado_vacacante = 'cerrada';
                        }
                    ?>
                    
                    <div class="content">
                        Mediante el mismo hacemos una convocatoria de concurso para cubrir el puesto de <?php echo $row['vacante_nombre_puesto'];?>.
                        Esta búsqueda se encuentra estrechamente relacionada a la materia <?php echo $materia_nombre; ?>.<br>Y a continuación se detalla una descripción de la misma:
                        <br>
                        <?php echo $row['vacante_descripcion_puesto']; ?>
                        <br>
                        
                        

                        
                                

                                <?php
                                        $postu=conexion();
                                        $postu=$postu->query("SELECT * FROM postulacion WHERE vacante_id = ".$row['vacante_id']);
                                        $postulante_totales = mysqli_num_rows($postu);
                                        if(mysqli_num_rows($postu)>0){

                                            echo '<table class="table is-fullwidth">
                                                <thead>
                                                    <tr class="has-text-centered">
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th style="width: 200px;">Orden Mérito</th>
                                                        <th>CV Link</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                            $postu=$postu->fetch_all(MYSQLI_ASSOC);
                                            foreach($postu as $row4){
                                                 //ahora busco datos en tabla vacante usando vacante_id
                                                 $vac_aux=conexion();
                                                 $vac_aux=$vac_aux->query("SELECT * FROM usuario WHERE usuario_id = ".$row4['usuario_id']);
                                                 $vac_aux = $vac_aux->fetch_assoc();

                                                ?>
                                                <tr class="has-text-centered">
                            
                                                <td><?php echo $vac_aux['usuario_nombre']; ?></td>
                                            
                                                <td><?php echo $vac_aux['usuario_apellido']; ?></td>

                                                <td>
                                                    


                                                    <form action="./php/usuario_mod_ord_merito.php" method="POST" class="FormularioAjax" enctype="multipart/form-data" >
                                                        <input type="hidden" name="vacante_id" value="<?php echo $row['vacante_id']; ?>">
                                                        <input type="hidden" name="usuario_id" value="<?php echo $row4['usuario_id']; ?>">
                                                        <div class="field has-addons">
                                                            <div class="control">
                                                                <?php 
                                                                    if(isset($_SESSION['rol'])&&($estado_vacacante == 'abierta')&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
                                                                    // if($estado_vacacante == 'abierta'){
                                                                        ?>
                                                                        <input class="input" name="postulacion_puntaje" type="number" 
                                                                value="<?php if($row4['postulacion_puntaje']!=null){
                                                                        echo intval($row4['postulacion_puntaje']);
                                                                                }?>">
                                                                        <?php
                                                                    } else {
                                                                        
                                                                        echo '<figure>'.intval($row4['postulacion_puntaje']).'</figure>';
                                                                    }
                                                                ?>
                                                                
                                                            </div>
                                                            
                                                                <?php 
                                                                    if(isset($_SESSION['rol'])&&($estado_vacacante == 'abierta')&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
                                                                        echo '<div class="control"><button type="submit" class="button is-info is-rounded">Modificar</button></div>';
                                                                    }
                                                                ?>
                                                            
                                                        </div>
                                                    </form>
                                                    

                                                    </div>
                                                </td>

                                                <td><?php
                                                $ruta = 'http://localhost/Gestion_Vacantes/gestionVacantes/uploads/'.$row4['usuario_id'].'_CV.pdf';
                                                $URL='<a href="'.$ruta.'" target="_blank">ABRIR CV'.'</a>';
                                                echo $URL;?>
                                                </td>
                                                </tr>
                                                <?php
                                                $vac_aux=null;
                                            }
                                        
                                            echo '</tbody>';
                                            echo '</table>';
                                        }
            
                                        // $postu=null;
                                    ?>





                    </div>
                </div>
                    <footer class="card-footer">
                        <?php 
                            include "./inc/btn_back.php";
                        ?>
                        </div>
                    <?php
                    if($row['vacante_fecha_cierre'] == '0000-00-00'){
                        $salida = '
                                <p class="card-footer-item">
                                <span>
                                    Fecha estimada de cierre '.$row['vacante_fecha_cierre_estipulada'].'
                                </span>
                                </p>';
                    }else{
                        
                        $salida = '
                                <p class="card-footer-item">
                                <span>
                                    Cerrada el '.$row['vacante_fecha_cierre'].'
                                </span>
                                </p>';
                    }
                    if(isset($_SESSION['rol'])&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
                        // "index.php?vista=listar_vacantes&amp;close_vac_id=2"
                        
                            //Deberia preguntar si está postulado
                            // $consulta_datos_p = "SELECT * from postulacion WHERE usuario_id = $auxS and vacante_id = $vacante_id";
                            // $datos_p = $conexion->query($consulta_datos_p);
                            // if(mysqli_num_rows($datos_p)==0){
                                //postularse
                                // if($row['vacante_fecha_cierre'] == '0000-00-00'){
                                // $salida .= '
                                // <p class="card-footer-item">
                                //     <span>
                                //     <a href="index.php?vista=vacante_detallada&vac_id_pos='.$row['vacante_id'].'&vacante_id='.$row['vacante_id'].'" class="button is-primary is-rounded is-small">Postularse</a>
                                //     </span>
                                // </p>';
                                // }
                            // } else {
                                // eliminar postulación
                                if($row['vacante_fecha_cierre'] == '0000-00-00'){
                            //      $datos_p = $datos_p->fetch_all(MYSQLI_ASSOC);
                                    $salida .= '
                                        <p class="card-footer-item">
                                            <span>
                                            
                                            <a href="index.php?vista=listar_vacantes&close_vac_id='.$row['vacante_id'].'"  class="button is-danger is-rounded is-small">Cerrar vacante</a>
                                            </span>
                                        </p>';
                                }
                            // }
                        
                    }

                        if(isset($_SESSION['rol'])){
                            if($_SESSION['rol']==4){
                                //Deberia preguntar si está postulado
                                $consulta_datos_p = "SELECT * from postulacion WHERE usuario_id = $auxS and vacante_id = $vacante_id";
                                $datos_p = $conexion->query($consulta_datos_p);
                                if(mysqli_num_rows($datos_p)==0){
                                    //postularse
                                    // if($row['vacante_fecha_cierre'] == '0000-00-00'){
                                    // $salida .= '
                                    // <p class="card-footer-item">
                                    //     <span>
                                    //     <a href="index.php?vista=vacante_detallada&vac_id_pos='.$row['vacante_id'].'&vacante_id='.$row['vacante_id'].'" class="button is-primary is-rounded is-small">Postularse</a>
                                    //     </span>
                                    // </p>';
                                    // }
                                } else {
                                    // eliminar postulación
                                    if($row['vacante_fecha_cierre'] == '0000-00-00'){
                                        $datos_p = $datos_p->fetch_all(MYSQLI_ASSOC);
                                        $salida .= '
                                            <p class="card-footer-item">
                                                <span>
                                                
                                                <a aria-disabled="true" href="index.php?vista=listar_postulaciones&pos_id_del='.$datos_p[0]['postulacion_id'].'"  class="button is-danger is-rounded is-small">Eliminar postulación</a>
                                                </span>
                                            </p>';
                                    }
                                }
                            }
                        }
                    echo $salida;
                    
                    ?>
                    
                </footer>
            </div>

            <?php
        }
    }
    $datos=null;    
    ?>
</div>