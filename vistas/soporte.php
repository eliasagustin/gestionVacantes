
<div class="container is-fluid">
<?php
		require_once "./php/main.php";
	?>
    <h1 class="title">Formulario de contacto</h1>
    <br>
    <h2 class="subtitle">Rellena el siguiente formulario para poder ayudarte/asesorarte</h2>
</div>
<hr>
	<div class="form-rest mb-6 mt-6"></div>

<form action="./php/enviar_email.php"  method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >

<div class="field is-horizontal ">
    <div class="field-label is-normal">
        <label class="label">Nombre</label>
    </div>
    <div class="field-body">
        <div class="field is-narrow">
            <div class="control">
                <div class="is-fullwidth">
                  <input class="input" type="text" size=36 name="first_name" placeholder="Ingrese su nombre" <?php if (!isset($_SESSION['rol'])){
                                                                                                                    echo 'value=""';
                                                                                                                  }else {
                                                                                                                    echo "value=\"".$_SESSION['nombre']. "\" disabled";
                                                                                                                  }
                                                                                                                ?> required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="field is-horizontal ">
    <div class="field-label is-normal">
        <label class="label">E-mail</label>
    </div>
    <div class="field-body">
        <div class="field is-narrow">
            <div class="control">
                <div class="is-fullwidth">
                  <input class="input" type="email" size=36 name="email" placeholder="Ingrese su correo electrónico" <?php if (!isset($_SESSION['rol'])){
                                                                                                                    echo 'value=""';
                                                                                                                  }else {
                                                                                                                    echo "value=\"".$_SESSION['email'] . "\" disabled";
                                                                                                                  }
                                                                                                                ?> required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="field is-horizontal ">
    <div class="field-label is-normal">
        <label class="label">Teléfono (opc)</label>
    </div>
    <div class="field-body">
        <div class="field is-narrow">
            <div class="control">
                <div class="is-fullwidth">
                  <input class="input" type="tel" size=36 name="telefono" placeholder="Ingrese su telefono">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Mensaje</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <textarea class="textarea" minlength="10" maxlength="250" name="mensaje" placeholder="Desarrolle su consulta en 250 caracteres max." required></textarea>
                    </div>
                </div>
            </div>
        </div>
        
		<p class="has-text-centered mt-5">
			<button type="submit" class="button is-info is-rounded">Enviar</button>
		</p>
	</form>