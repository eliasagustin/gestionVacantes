<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($_SESSION['id'])){
		$mi_id = $_SESSION['id'];
		$consulta_datos="SELECT * FROM postulacion WHERE usuario_id='".$mi_id."' ORDER BY postulacion_id ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(postulacion_id) FROM postulacion WHERE usuario_id='".$mi_id."'";
		
	}

    $conexion=conexion();

	$datos = $conexion->query($consulta_datos);
    $total = (int) mysqli_num_rows($datos);
	$datos = $datos->fetch_all(MYSQLI_ASSOC);

	$Npaginas =ceil($total/$registros);

    $tabla.='
		<div class="table-container">
			<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
				<thead>
					<tr class="has-text-centered">
						<th>id</th>
						<th>Estado</th>
                        <th>Nombre Busqueda</th>
						<th>Fecha Postulacion</th>
						<th colspan="2">Opciones</th>
					</tr>
				</thead>
				<tbody>
		';

    if($total>=1 && $pagina<=$Npaginas){
        $contador=$inicio+1;
        $pag_inicio=$inicio+1;
        $v_estado = null;
        foreach($datos as $rows){
            $tabla.='
                <tr class="has-text-centered" >
                    <td>'.$rows['postulacion_id'].'</td>';
                    $vacI = $rows['vacante_id'];
                    $consulta_datos_vac = "SELECT * FROM vacante WHERE vacante_id LIKE $vacI";
                    $datosV = $conexion->query($consulta_datos_vac);
                    $datosV = $datosV->fetch_all(MYSQLI_ASSOC);
                    foreach($datosV as $rowV){
                        if($rowV['vacante_fecha_cierre'] == '0000-00-00'){
                            $v_estado = true;
                            $tabla.= "<td><p class='notification is-success is-light is-small p-1'>
                            Vacante Abierta</p></td>";
                        } else {
                            $v_estado = false;
                            $tabla.="<td><p class='notification is-danger is-light p-1'>
                            Vacante Cerrada</p></td>";
                        }
                        $tabla.= '<td>'.$rowV['vacante_nombre_puesto'].'</td>';
                    }
            $tabla.='
                    <td>'.$rows['postulacion_fecha'].'</td>
                    ';
            if(isset($_SESSION['rol'])&&($_SESSION['rol']==4)){
                $tabla.='
                    <td>
                        <a href="index.php?vista=vacante_detallada&vacante_id='.$rows['vacante_id'].'" class="button is-success is-rounded is-small">Detalles</a>
                    </td>';
                    if($v_estado==true){
                        $tabla.='
                        <td>
                            <a href="index.php?vista=listar_postulaciones&pos_id_del='.$rows['postulacion_id'].'"  class="button is-danger is-rounded is-small">Eliminar</a>
                        </td>';
                    }
            }
            $tabla.='
                </tr>';
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

    if($total>0 && $pagina<=$Npaginas){
        $tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
    }

    $conexion=null;
    echo $tabla;

    if($total>=1 && $pagina<=$Npaginas){
        echo paginador_tablas($pagina,$Npaginas,"",7);
    }
?>