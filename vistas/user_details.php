<?php include "./php/breadcum.php";?>
<div class="container is-fluid mb-2">
	<?php 
    if (!isset($_GET['user_id_up'])){
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se ha capturado el usuario a modificar
        </div>
    ';
    exit();
    }
    $id = $_GET['user_id_up'];
    /*== Verificando usuario ==*/
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$id'");
    $datos = null;
    if(mysqli_num_rows($check_usuario)==1){
        $rows=$check_usuario->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row){
            $datos = $row;
        }
    }else{
        include "./inc/error_alert.php";
        exit();
    }
    $check_usuario=null;
     if($id==$_SESSION['id']){

      }else{
        // tiene que ser rol administrador
        // 1 Administrador él solo puede modificar los roles y ver sus detalles
        // El maquetado se logra con un solo formulario de modificación
        if ($_SESSION['rol']==1){

        }

        if(isset($_SESSION['rol'])&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
            ?>
            <h1 class="title">Usuarios</h1>
            <h2 class="subtitle">Detalles del usuario seleccionado</h2>

            <div class="card container p-4">
        
        <div class="form-rest mb-4 mt-2"></div>
            <table class="table is-fullwidth">
                <tr>
                    <td class="has-text-right">Nombre:</td>
                    <td class="has-text-left"><?php echo $datos['usuario_nombre']; ?></td>
                </tr>
                <tr>
                    <td class="has-text-right">Apellido:</td>
                    <td class="has-text-left"><?php echo $datos['usuario_apellido']; ?></td>
                </tr>
                <tr>
                    <td class="has-text-right">email:</td>
                    <td class="has-text-left"><?php echo $datos['usuario_email']; ?></td>
                </tr>
                <?php if(isset($datos['rol_id'])&&($datos['rol_id']==4) ){ ?>
                <tr class="has-text-centered">
                    <td  colspan="2">
                        <table class="table is-fullwidth">
                            <thead>
                                <tr class="has-text-centered">
                                    <th>Cátetdra</th>
                                    <th>Puesto</th>
                                    <th>Orden Mérito</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                

                                <?php
                                        $postu=conexion();
                                        $postu=$postu->query("SELECT * FROM postulacion WHERE usuario_id = ".$id);
                                        if(mysqli_num_rows($postu)>0){
                                            $postu=$postu->fetch_all(MYSQLI_ASSOC);
                                            foreach($postu as $row){
                                                 //ahora busco datos en tabla vacante usando vacante_id
                                                 $vac_aux=conexion();
                                                 $vac_aux=$vac_aux->query("SELECT * FROM vacante WHERE vacante_id = ".$row['vacante_id']);
                                                 $vac_aux = $vac_aux->fetch_assoc();

                                                 $mat_aux=conexion();
                                                 $mat_aux = $mat_aux->query("SELECT materia_nombre FROM materia WHERE materia_id LIKE ".$vac_aux['materia_id']);
                                                 $mat_aux = $mat_aux->fetch_assoc();


                                                ?>
                                                <tr class="has-text-centered">
                                                   
                                                <td><?php echo $mat_aux['materia_nombre']; ?></td>
                            
                                                <td><?php echo $vac_aux['vacante_nombre_puesto']; ?></td>
                                            
                                                <td><?php echo $row['postulacion_puntaje']; ?></td>
                                            
                                                <td><?php 
                                                $aux = "";
                                                if($vac_aux['vacante_fecha_cierre'] == '0000-00-00'){
                                                    echo "Abierta";
                                                }else{
                                                    echo "Cerrada";
                                                }
                                                ?></td>
                                                </tr>
                                                <?php
                                                $vac_aux=null;
                                                $mat_aux=null;
                                            }
                                                
                                        }
            
                                        $postu=null;
                                    ?>

                                
                            </tbody>
                        </table>
                    </td>
                            
                </tr>
                <?php }; ?>
                
            </table>
            
        <?php
            include "./inc/btn_back.php";
        }
     }
    //  include "./inc/btn_back.php";
     ?>
        </form>
        </div>
</div>

