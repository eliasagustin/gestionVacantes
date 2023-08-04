<?php include "./php/breadcum.php"; ?>
<br>
<div class="container is-fluid">
	<?php if (!isset($_SESSION['rol'])){
			echo '<h2 class="subtitle">Actualemente no estás logeado! y debido a nuestra política de permisos, la experiencia y funcionalidad en nuestro nuevo módulo denominado "Gestión de Vacantes" será reducida.
			<br> Para desbloquear funciones dirígete al login apretando el boton arriba a la derecha.</h2>';
		}else {
			echo "<h2 class='subtitle'>Bienvenido ".$_SESSION['nombre']." ".$_SESSION['apellido']."!, Espero que disfrutes al máximo la experiencia en nuestro nuevo módulo denominado 'Gestión de Vacantes'.</h2>";
		}
	?>
	
</div>
<br>
<article class="message is-warning">
  <div class="message-header">
    <p>Recordar, arreglar bug</p>
  </div>
  <div class="message-body">
   Cuando estoy con una session abierta y fuerzo el login -> podria reloguearme? -> debería corregir el codigo y cuando abre login si estoy logueado me debería llevar a home.
  </div>
</article>

<br>
<?php require "./php/lista_tiles.php"; ?>