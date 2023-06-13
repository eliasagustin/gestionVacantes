<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){
        echo 'Deberia empezar la busqueda porque encontró que el campo busqueda es igual a "'.$busqueda.'"'; 

        /* no se usa
		$consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%'))";
        */
	}else{
        
        //Lo saco porque no tengo SESSION['id']
		$consulta_datos="SELECT * FROM vacante ORDER BY vacante_id ASC LIMIT $inicio,$registros";
        $consulta_materia="SELECT materia_nombre FROM materia ORDER BY materia_id";
		$consulta_total="SELECT COUNT(vacante_id) FROM vacante";
		
	}

	$conexion=conexion();

    $materia_nombre= $conexion->query($consulta_materia);
    $materia_nombre = $materia_nombre->fetchAll();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Materia</th>
                    <th>Puesto</th>
                    <th>Fecha Apertura</th>
                    <th>Fecha Cierre Estipulada</th>
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
					<td>'.$contador.'</td>
                    <td>'.$materia_nombre[$rows['materia_id']-1]['materia_nombre'].'</td>
                    <td>'.$rows['vacante_nombre_puesto'].'</td>
                    <td>'.$rows['vacante_fecha_apertura'].'</td>
                    <td>'.$rows['vacante_fecha_cierre_estipulada'].'</td>
                    <td>
                        <a href="index.php?vista=vacante_detallada&vacante_id='.$rows['vacante_id'].'" class="button is-success is-rounded is-small">Más detalles</a>
                    </td>
                </tr>
            ';//TODO Terminar vista detallada q solo muestra los datos de una determinada vacante
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
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}