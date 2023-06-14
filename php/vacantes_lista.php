

<?php
require_once "main.php";
    	/*== receta datos ==*/
if(isset($_POST['estado'])){
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
        //$receta.= $_POST['fecha_apertura_I'].";<br>";
        $receta.= " vacante_fecha_apertura >= '".$_POST['fecha_apertura_I']."' AND";
    }
    if( (isset($_POST['fecha_cierre_I'])) && ($_POST['fecha_cierre_I']!=null) && $_POST['fecha_cierre_I'] !="" ){
        //busqueda por fecha_cierre de materia para agregarlo a cadena
        // $receta.= $_POST['fecha_cierre_I'].";<br>";
        $receta.= " vacante_fecha_cierre_estipulada >= '".$_POST['fecha_cierre_I']."' AND";
    }
    if( (isset($_POST['fecha_apertura_F'])) && ($_POST['fecha_apertura_F']!=null) && $_POST['fecha_apertura_F'] !="" ){
        //busqueda por fecha_apertura para agregarlo a cadena
        // $receta.= $_POST['fecha_apertura_F'].";<br>";
        $receta.= " vacante_fecha_apertura =< '".$_POST['fecha_apertura_F']."' AND";
    }
    if( (isset($_POST['fecha_cierre_F'])) && ($_POST['fecha_cierre_F']!=null) && $_POST['fecha_cierre_F'] !="" ){
        //busqueda por fecha_cierre de materia para agregarlo a cadena
        // $receta.= $_POST['fecha_cierre_F'].";<br>";
        $receta.= " vacante_fecha_cierre_estipulada =< '".$_POST['fecha_cierre_F']."' AND";
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
    // if ($receta!= ""){
    //     echo "Consulta= ".$receta;
    // }
     //echo date("Y-m-d");
    $tabla="";
        //Lo saco porque no tengo SESSION['id']
        
		$consulta_datos="SELECT * FROM vacante ".$receta;
		// $consulta_datos="SELECT * FROM vacante WHERE vacante_fecha_apertura >= '2023-06-12' ORDER BY vacante_id ASC";
        //TODO filtrar las vacantes si fecha_cierre es null
        $consulta_materia="SELECT materia_nombre FROM materia ORDER BY materia_id";
		$consulta_total="SELECT COUNT(vacante_id) FROM vacante";
		
	$conexion=conexion();

    $materia_nombre= $conexion->query($consulta_materia);
    $materia_nombre = $materia_nombre->fetchAll();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	//$Npaginas =ceil($total/$registros);

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

	if($total>=1){
		$contador=1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$rows['vacante_id'].'</td>
                    <td>'.$materia_nombre[$rows['materia_id']-1]['materia_nombre'].'</td>
                    <td>'.$rows['vacante_nombre_puesto'].'</td>
                    <td>'.$rows['vacante_fecha_apertura'].'</td>
                    <td>'.$rows['vacante_fecha_cierre_estipulada'].'</td>
                    <td>
                        <a href="index.php?vista=vacante_detallada&vacante_id='.$rows['vacante_id'].'" class="button is-success is-rounded is-small">Más detalles</a>
                    </td>
                </tr>
            ';
                //TODO Terminar vista detallada q solo muestra los datos de una determinada vacante
                //TODO Terminar las vistas limitatda por permiso para "listar_vacantes_abiertas.php"
                //TODO Terminar las vistas limitatda por permiso agrergar boton postularse si es POSTULANTE de lo contrario el boton se esconde
                //TODO Maquetar formulario listar_vacantes.php
                //TODO Crear funcion q dado un vacante_id devuelve si esta está abierta o cerrada
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

}else{
    

    $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
        
        //Lo saco porque no tengo SESSION['id']
		$consulta_datos="SELECT * FROM vacante ORDER BY vacante_id ASC LIMIT $inicio,$registros";
        //TODO filtrar las vacantes si fecha_cierre es null
        $consulta_materia="SELECT materia_nombre FROM materia ORDER BY materia_id";
		$consulta_total="SELECT COUNT(vacante_id) FROM vacante";
		
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
            ';
                //TODO Terminar vista detallada q solo muestra los datos de una determinada vacante
                //TODO Terminar las vistas limitatda por permiso para "listar_vacantes_abiertas.php"
                //TODO Terminar las vistas limitatda por permiso agrergar boton postularse si es POSTULANTE de lo contrario el boton se esconde
                //TODO Maquetar formulario listar_vacantes.php
                //TODO Crear funcion q dado un vacante_id devuelve si esta está abierta o cerrada
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
}