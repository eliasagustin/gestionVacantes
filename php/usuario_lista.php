<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($_SESSION['id'])){
		$mi_id = $_SESSION['id'];
	} else {
		$mi_id = 0;
	}
	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$mi_id."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$mi_id."') AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM usuario WHERE usuario_id!='".$mi_id."' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id!='".$mi_id."'";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetch_all(MYSQLI_ASSOC);

	$total = $conexion->query($consulta_total);
	$total = (int) mysqli_num_rows($total);

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
		<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" summary="Tabla de los usuarios del sistema módulo de gestión de vacantes">
			<thead>
				<tr class="has-text-centered">
					<th scope="col">ID</th>
					<th scope="col">Nombres</th>
					<th scope="col">Apellidos</th>
					<th scope="col">Usuario</th>
					<th scope="col">Email</th>';

	if(isset($_SESSION['rol'])&&($_SESSION['rol']==1)){ // 1 - Administrador
		$tabla.='<th colspan="2">Opciones</th>
		';
	}
	if(isset($_SESSION['rol'])&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
		$tabla.='<th colspan="2">Opciones</th>
		';
	}
	$tabla.='
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
					<td scope="row">'.$rows['usuario_id'].'</td>
                    <td>'.$rows['usuario_nombre'].'</td>
                    <td>'.$rows['usuario_apellido'].'</td>
                    <td>'.$rows['usuario_usuario'].'</td>
                    <td>'.$rows['usuario_email'].'</td>
					';
			if(isset($_SESSION['rol'])&&($_SESSION['rol']==1)){
				$tabla.='		
                    <td>
                        <a href="index.php?vista=user_update&user_id_up='.$rows['usuario_id'].'" class="button is-success is-rounded is-small">Permisos</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&user_id_del='.$rows['usuario_id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
            	';
			}
			if(isset($_SESSION['rol'])&&(($_SESSION['rol']==2) or ($_SESSION['rol']==3)) ){ // 2 - Jefe Cátedra | 3 - Responsable Administrativo
				$tabla.='		
                    <td>
                        <a href="index.php?vista=user_details&user_id_up='.$rows['usuario_id'].'" class="button is-success is-rounded is-small" title="Abrir detalles del usuario">Detalles</a>
                    </td>
            	';
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
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}