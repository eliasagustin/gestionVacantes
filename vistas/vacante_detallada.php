<?php include "./php/breadcum.php";
?>
<div class="container is-fluid">
    <h1 class="title">Detalle de vacante</h1>
    <?php
        require_once "./php/main.php";
        require "./php/guard.php";
    $vacante_id = $_GET['vacante_id'];
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
                        } else {
                            echo "<p class='subtitle notification is-danger is-light'>
                            Vacante Cerrada</p>";
                        }
                    ?>
                    
                    <div class="content">
                        Mediante el mismo hacemos una convocatoria de concurso para cubrir el puesto de <?php echo $row['vacante_nombre_puesto'];?>.
                        Esta búsqueda se encuentra estrechamente relacionada a la materia <?php echo $materia_nombre; ?>.<br>Y a continuación se detalla una descripción de la misma:
                        <br>
                        <?php echo $row['vacante_descripcion_puesto']; ?>
                    </div>
                </div>
                <footer class="card-footer">
                <p class="card-footer-item">
                <span>
                    Fecha estimada de cierre <?php echo $row['vacante_fecha_cierre_estipulada']; ?>
                </span>
                </p>
                </footer>
            <?php
        }
    }
    $datos=null;    
    ?>
</div>