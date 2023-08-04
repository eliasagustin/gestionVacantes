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
     if($id==$_SESSION['id']){ ?>
		<h1 class="title">Mi cuenta</h1>
		<h2 class="subtitle">Actualizar datos de mi cuenta</h2>
        <div class="card container p-4">
        
        <div class="form-rest mb-4 mt-2"></div>

        <form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

            <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required >
            
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombres</label>
                        <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_nombre']; ?>" >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Apellidos</label>
                        <input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_apellido']; ?>" >
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Usuario</label>
                        <input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required value="<?php echo $datos['usuario_usuario']; ?>" >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Email</label>
                        <input class="input" type="email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>" >
                    </div>
                </div>
            </div>
            <br><br>
            <p class="has-text-centered">
                SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si NO desea actualizar la clave deje los campos vacíos.
            </p>
            <br>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Clave</label>
                        <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Repetir clave</label>
                        <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                    </div>
                </div>
            </div>
            <p class="has-text-centered">
                <button type="submit" class="button is-success is-rounded">Actualizar</button>
            </p>
        </form>
    </div>

	<?php }else{ 
        // tiene que ser rol administrador
        // 1 Administrador él solo puede modificar los roles y ver sus detalles
        // El maquetado se logra con un solo formulario de modificación
        if ($_SESSION['rol']==1){
            ?>
            <h1 class="title">Usuarios</h1>
            <h2 class="subtitle">Actualizar permisos de usuario</h2>

            <div class="card container p-4">
        
        <div class="form-rest mb-4 mt-2"></div>

            <form action="./php/usuario_actualizar_permisos.php" method="POST" class="FormularioAjax" autocomplete="off" >

                <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required >
                <input type="hidden" name="r_id" value="<?php echo $_SESSION['rol']; ?>" required >

                <p class="has-text-centered">Se ha seleccionado al usuario <?php echo $datos['usuario_nombre']; ?>, y su rol se describe en el siguiente combo box. </p>
                
                <div class="field  pt-4">
                    <div class="field-body ">
                        <div class="field has-addons has-addons-centered">
                            <div class="control">
                                <div class="select is-fullwidth">
                                <select name="rol_ID" required>
                                <?php
                                        $roles=conexion();
                                        $roles=$roles->query("SELECT * FROM rol");
                                        if(mysqli_num_rows($roles)>0){
                                            $roles=$roles->fetch_all(MYSQLI_ASSOC);
                                            foreach($roles as $row){
                                                if ($datos['rol_id']==$row["rol_id"]){
                                                    echo '<option value="'.$row["rol_id"].'" selected>'.$row["rol_descripcion"].'</option>';
                                                }else {
                                                    echo '<option value="'.$row["rol_id"].'" >'.$row["rol_descripcion"].'</option>';
                                                }
                                                
                                            }
                                        }
                                        $roles=null;
                                    ?>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="has-text-centered">Abra el desplegable, seleccione uno nuevo rol, luego haga click el boton "actualizar rol".</p>
                <br>
                <p class="has-text-centered">
                    <button type="submit" class="button is-success is-rounded">Actualizar rol</button>
                </p>
            </form>
        </div>
        <?php
        }
     } 
     include "./inc/btn_back.php";
     ?>
</div>

