<?php
require_once "main.php";
    	/*== receta datos ==*/
    $receta = "";
    if( (isset($_POST['estado'])) && ($_POST['estado']!=null) && $_POST['estado'] !="" ){
        //busqueda por estado para agregarlo a cadena
        if ($_POST['estado']=="Abierta"){
            $receta.= " vacante_fecha_cierre = '0000-00-00' AND";
        }
        if ($_POST['estado']=="Cerrada"){
            $receta.= " vacante_fecha_cierre != '0000-00-00' AND";
        }
    }
    if( (isset($_POST['vacante_materia'])) && ($_POST['vacante_materia']!=null) && $_POST['vacante_materia'] !="" ){
        //busqueda por id de materia para agregarlo a cadena
        $receta.= " materia_id = '".$_POST['vacante_materia']."' AND";
    }
    if( (isset($_POST['fecha_apertura_I'])) && ($_POST['fecha_apertura_I']!=null) && $_POST['fecha_apertura_I'] !="" ){
        //busqueda por fecha_apertura para agregarlo a cadena
        if ((isset($_POST['fecha_apertura_F'])) && ($_POST['fecha_apertura_F']!=null) && ($_POST['fecha_apertura_F'] !="") ){
            $receta.= " vacante_fecha_apertura BETWEEN '".$_POST['fecha_apertura_I']."' AND '".$_POST['fecha_apertura_F']."' AND";
        }else{
            $receta.= " vacante_fecha_apertura >= '".$_POST['fecha_apertura_I']."' AND";
        }
    } else {
        if ((isset($_POST['fecha_apertura_F'])) && ($_POST['fecha_apertura_F']!=null) && ($_POST['fecha_apertura_F'] !="") ){
            $receta.= " vacante_fecha_apertura <= '".$_POST['fecha_apertura_F']."' AND";
        }
    }



    if( (isset($_POST['fecha_cierre_I'])) && ($_POST['fecha_cierre_I']!=null) && $_POST['fecha_cierre_I'] !="" ){
        //busqueda por fecha_cierre de materia para agregarlo a cadena
        if ((isset($_POST['fecha_cierre_F'])) && ($_POST['fecha_cierre_F']!=null) && ($_POST['fecha_cierre_F'] !="") ){
            $receta.= " vacante_fecha_cierre_estipulada BETWEEN '".$_POST['fecha_cierre_I']."' AND '".$_POST['fecha_cierre_F']."' AND";
        }else{
            $receta.= " vacante_fecha_cierre_estipulada >= '".$_POST['fecha_cierre_I']."' AND";
        }
    } else {
        if ((isset($_POST['fecha_cierre_F'])) && ($_POST['fecha_cierre_F']!=null) && ($_POST['fecha_cierre_F'] !="") ){
            $receta.= " vacante_fecha_cierre_estipulada <= '".$_POST['fecha_cierre_F']."' AND";
        }
    }

    if ($receta!= ""){
        $receta = "WHERE ".$receta;
    }
    if(substr($receta, strlen($receta)-3, 3 ) == "AND"){
        $receta = substr($receta, 0, strlen($receta)-4 );
    }
    if( (isset($_POST['orden'])) && ($_POST['orden']!=null) && $_POST['orden'] !="" ){
        //busqueda por fecha_apertura para agregarlo a cadena
        $receta.= " ORDER BY ".$_POST['orden'];
    }
    if( (isset($_POST['ord'])) && ($_POST['ord']!=null) && $_POST['ord'] !="" ){
        //busqueda por fecha_cierre de materia para agregarlo a cadena
        $receta.= " ".$_POST['ord'];
    }
    if ($receta!= ""){
        //echo "Consulta= ".$receta;
    } else {
        $receta ="ORDER BY vacante_id ASC";
    }

    $tabla="";
    
    $consulta_datos="SELECT * FROM vacante ".$receta;
    //TODO filtrar las vacantes si fecha_cierre es null
    $consulta_materia="SELECT materia_nombre FROM materia ORDER BY materia_id";
    $consulta_total="SELECT vacante_id FROM vacante ".$receta;
	$conexion=conexion();

    $materia_nombre = $conexion->query($consulta_materia);
    $materia_nombre = $materia_nombre->fetch_all(MYSQLI_ASSOC);

    # Cerrar Vacante #
    if(isset( $_GET['close_vac_id']) ){
        if(($_SESSION['rol']==2) or ($_SESSION['rol']==3)){
            require_once "./php/cerrar_vacante.php";
        }
    }
    
	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetch_all(MYSQLI_ASSOC);

	$total = $conexion->query($consulta_total);
	$total = (int) mysqli_num_rows($total);

    if (isset($_POST['RId'])){
        //echo "RId= ".$_POST['RId'];
        $rol = $_POST['RId'];
     } else {
        //echo "rol ".$rol;
        if (($rol>0) && ($rol<5)){
            $consulta_rol="SELECT rol_descripcion FROM rol WHERE rol_id = '".$rol."'";
            $c_rol = $conexion->query($consulta_rol);
	        $c_rol = $c_rol->fetch_all(MYSQLI_ASSOC);
            $rol = $c_rol[0]['rol_descripcion'];
        }
     }

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>Estado</th>
                    <th>Materia</th>
                    <th>Apertura</th>
                    <th>Cierre Estipulado</th>
                    <th>Puesto</th>
                    <th>Postulaciones</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1){
		$contador=1;
		foreach($datos as $rows){
            $aux = "";
            if($rows['vacante_fecha_cierre'] == '0000-00-00'){
                $aux =  '<a class="button is-info is-active is-static is-small">Abierta</a>';
            }else{
                $aux =  '<a class="button is-warning is-active is-static is-small">Cerrada</a>';
            }
            // Por cada fila de vacantes consultar a tabla "postulacion" y llamar funcion contar filas
            // $rows['vacante_id']
            $consulta_postulaciones = "SELECT postulacion_id FROM postulacion WHERE vacante_id like ".$rows['vacante_id'];
            $consulta_postulaciones = $conexion->query($consulta_postulaciones);
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$aux.'</td>
                    <td>'.$materia_nombre[$rows['materia_id']-1]['materia_nombre'].'</td>
                    <td>'.$rows['vacante_fecha_apertura'].'</td>
                    <td>'.$rows['vacante_fecha_cierre_estipulada'].'</td>
                    <td>'.$rows['vacante_nombre_puesto'].'</td>
                    <td>'.mysqli_num_rows($consulta_postulaciones).'</td>';
            // if(($rol=="Responsable Administrativo") or ($rol=="Responsable Administrativo")){
            //     if($rows['vacante_fecha_cierre'] == '0000-00-00'){
            //         $tabla.='<td>
            //                 <a href="index.php?vista=listar_vacantes&close_vac_id='.$rows['vacante_id'].'"  class="button disable is-danger is-rounded is-small">Cerrar</a>
            //             </td>';
            //     } else {
            //         $tabla.='<td>
            //                 <a class="button is-warning is-active is-rounded is-static is-small">Cerrada</a>
            //             </td>';
            //     }
            // }
            
            $tabla.='<td>
                        <a href="index.php?vista=vacante_detallada&vacante_id='.$rows['vacante_id'].'" class="button is-success is-rounded is-small" title="Detalles de Vacante">Detalles</a>
                    </td>
                </tr>
            ';
                //TODO Terminar las vistas limitada por permiso para "listar_vacantes_abiertas.php"
                //TODO Terminar las vistas limitada por permiso agrergar boton postularse si es POSTULANTE de lo contrario el boton se esconde
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0){
		$tabla.='<p class="has-text-right">Mostrando un <strong>total de '.$total.'</strong> vacantes</p>';
	}

	$conexion=null;
	echo $tabla;

	// if($total>=1 && $pagina<=$Npaginas){
	// 	echo paginador_tablas($pagina,$Npaginas,$url,7);
	// }

