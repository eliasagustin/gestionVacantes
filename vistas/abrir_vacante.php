<?php include "./php/breadcum.php";?>
<div class="container is-fluid">
    <h1 class="title">Abrir Vacante</h1>
    <h2 class="subtitle">Formulario de creación</h2>
</div>

<?php 
    require "./php/guard.php";
    // if($rol=='Invitado'){
    //     echo '<article class="message is-warning mt-6">
    //             <div class="message-header">
    //                 <p>Error de alcance</p>
    //             </div>
    //             <div class="message-body">
    //                 No posees los permisos necesarios para abrir una vacante. En caso de no ser correcto contáctate con nuestro soporte.
    //             </div>
    //         </article>
    //         ';
    //     exit();
    // }
?>

<div class="container pb-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>
    
	<form action="./php/vacante_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
        
        <div class="field is-horizontal ">
            <div class="field-label is-normal">
                <label class="label">Materia</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="select is-fullwidth">
                        <select name="vacante_materia" required>
                        <option value="" selected="" >Seleccione una materia</option>
                            <?php
                                $materias=conexion();
                                $materias=$materias->query("SELECT * FROM materia");
                                if($materias->rowCount()>0){
                                    $materias=$materias->fetchAll();
                                    foreach($materias as $row){
                                        echo '<option value="'.$row['materia_nombre'].'" >'.$row['materia_nombre'].'</option>';
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


        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Fecha de Apertura:</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="is-fullwidth">
                            <input class="input" type="date" name="fecha_apertura" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Fecha de Cierre:</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="is-fullwidth">
                            <input class="input" type="date" name="fecha_cierre" min="<?php echo date("Y-m-d",strtotime("tomorrow"));?>" value="<?php echo date("Y-m-d",strtotime("tomorrow"));?>" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nombre del Puesto</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="select is-fullwidth">
                        <select name="vacante_puesto" required>
                        <option value="" selected="" >Seleccione puesto a cubrir</option>
                            <option>Ayudante de Cátedra</option>
                            <option>Profesor Adjunto</option>
                            <option>Profesor Titular</option>
                            <option>No Docente</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Descrip. del puesto</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <textarea class="textarea" minlength="10" maxlength="200" name="vacante_descripcion" placeholder="Desarrolla brevemente la drescripccion e incumbencias del puesto" required></textarea>
                    </div>
                </div>
            </div>
        </div>
        
		<p class="has-text-centered mt-5">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>