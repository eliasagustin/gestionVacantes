<?php include "./php/breadcum.php";?>
<div class="container is-fluid">
    <h1 class="title">Nuevo Usuario</h1>
    <h2 class="subtitle">Formulario alta usuario</h2>
</div>

<div class="card container ">

	<div class="form-rest mb-2 mt-4"></div>

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax p-5 mb-2 " autocomplete="off" >
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nombre:</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <div class="is-fullwidth">
                            <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Apellido:</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <div class="is-fullwidth">
                            <input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Usuario:</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <div class="is-fullwidth">
                        <input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Email</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <input class="input" type="email" name="usuario_email" maxlength="70" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Clave:</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <div class="is-fullwidth">
                        <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{4,100}" minlength="4" maxlength="100" required >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Repetir Clave:</label>
            </div>
            <div class="field-body">
                <div class="field pr-6">
                    <div class="control">
                        <div class="is-fullwidth">
                        <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{4,100}"  minlength="4" maxlength="100" required >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="rol" value="4">
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>