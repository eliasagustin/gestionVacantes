
<div class="container is-fluid">
<?php
		require_once "./php/main.php";
        include "./php/breadcum.php";
	?>
    <h1 class="title">Formulario de contacto</h1>
    <br>
    <p class="subtitle">Rellena el siguiente formulario para poder ayudarte/asesorarte</p>
</div>
<div class="form-rest mb-6 mt-6"></div>

<form action="./php/enviar_email.php"  method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >

<div class="field is-horizontal ">
    <div class="field-label is-normal">
        <label for="first_name" class="label">Nombre</label>
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
                                                                                                                ?> 
                         pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" title="Ingrese un nombre de 3 a 40 caracteres alfabéticos" required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="field is-horizontal ">
    <div class="field-label is-normal">
        <label for="email" class="label">E-mail</label>
    </div>
    <div class="field-body">
        <div class="field is-narrow">
            <div class="control">
                <div class="is-fullwidth">
                  <input class="input" type="email" size=36 name="email" maxlength="70" title="Ingrese un email válido de máximo 70 caracteres" placeholder="Ingrese su correo electrónico" <?php if (!isset($_SESSION['rol'])){
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
        <label for="telefono" class="label">Teléfono (opc)</label>
    </div>
    <div class="field-body">
        <div class="field is-narrow">
            <div class="control">
                <div class="is-fullwidth">
                  <input class="input" type="tel" size=36 name="telefono" placeholder="Ingrese su telefono" title="Ingrese su telefono usando caracteres alfanuméricos (opcional)">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="field is-horizontal">
    <div class="field-label is-normal">
        <label for="mensaje" class="label">Mensaje</label>
    </div>
    <div class="field-body">
        <div class="field">
            <div class="control">
                <textarea class="textarea" minlength="10" maxlength="250" name="mensaje" placeholder="Desarrolle su consulta en 250 caracteres max." title="Ingrese un mensaje de minimo 25 a 250 caracteres" required></textarea>
            </div>
        </div>
    </div>
</div>

<p class="has-text-centered mt-5">
    <button type="submit" class="button is-info is-rounded">Enviar</button>
</p>
</form>