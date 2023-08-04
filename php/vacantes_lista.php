<?php
require_once "main.php";

	// echo '$_SESSION[id]'.$_SESSION['id'].' ,$_SESSION[rol]'.$_SESSION['rol'];

    	/*== receta datos ==*/
    $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
		$consulta_datos="SELECT * FROM vacante WHERE vacante_fecha_cierre = '0000-00-00' ORDER BY vacante_id ASC LIMIT $inicio,$registros";
        //TODO filtrar las vacantes si fecha_cierre es null
        $consulta_materia="SELECT materia_nombre FROM materia ORDER BY materia_id";
		$consulta_total="SELECT vacante_id FROM vacante WHERE vacante_fecha_cierre = '0000-00-00'";
		
	$conexion=conexion();
	$postulaciones= [];
	if(isset($_SESSION['rol'])){
		if($_SESSION['rol']==4){
			// Consulto sus postulaciones realizadas por el usurio de la session
			$consulta_p = "SELECT vacante_id FROM postulacion WHERE usuario_id like ".$_SESSION['id'];
			$postulaciones = $conexion->query($consulta_p);
			if (mysqli_num_rows($postulaciones)!=0){
				$postulaciones = $postulaciones->fetch_all(MYSQLI_ASSOC);
				$postulaciones = array_column($postulaciones, 'vacante_id');
			} else {
				$postulaciones= [];
			};
			
			// echo var_dump($postulaciones);
			// echo var_dump(array_column($postulaciones, 'vacante_id'));
		}
	}
    $materia_nombre = $conexion->query($consulta_materia);
	$materia_nombre = $materia_nombre->fetch_all(MYSQLI_ASSOC);

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetch_all(MYSQLI_ASSOC);

	$total = $conexion->query($consulta_total);
	$total = (int) mysqli_num_rows($total);

	$Npaginas =ceil($total/$registros);
	
	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Materia</th>
                    <th>Puesto</th>
                    <th>Apertura</th>
                    <th>Cierre Estipulado</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){

			$tabla.='
				<tr class="has-text-centered" >
                <td>'.$rows['vacante_id'].'</td>
                    <td>'.$materia_nombre[$rows['materia_id']-1]['materia_nombre'].'</td>
                    <td>'.$rows['vacante_nombre_puesto'].'</td>
                    <td>'.$rows['vacante_fecha_apertura'].'</td>
                    <td>'.$rows['vacante_fecha_cierre_estipulada'].'</td>';
			if(isset($_SESSION['rol'])){
				if($_SESSION['rol']==4){
					if(!in_array($rows['vacante_id'], $postulaciones)){
						$tabla.='<td>
								<a href="index.php?vista=listar_vacantes_abiertas&vac_id_pos='.$rows['vacante_id'].'" class="button is-info is-rounded is-small">Postularse</a>
							</td>';
					} else {
						$tabla.='<td>
						<a class="button is-warning is-active is-rounded is-static is-small">Presentada</a>
						</td>';
					}
				}
			} 
			$tabla.='<td>
                        <a href="index.php?vista=vacante_detallada&vacante_id='.$rows['vacante_id'].'" class="button is-success is-rounded is-small">Detalles</a>
                    </td>
                </tr>
            ';
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
		$tabla.='<p class="has-text-right">Mostrando las vacantes <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}
