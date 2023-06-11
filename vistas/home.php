<!-- <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
  <ul>
    <li><a href="index.php?vista=home">Inicio</a></li>
    <li><a href="#">Documentation</a></li>
    <li><a href="#">Components</a></li>
    <li class="is-active"><a href="#" aria-current="page">Breadcrumb</a></li>
  </ul>
</nav> -->
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
<?php require "./php/lista_tiles.php"; ?>

<br>

<article class="message is-info">
  <div class="message-header">
    <p>Crear las vistas faltantes, (las otras vistas están fuera de alcance)</p>
  </div>
  <div class="message-body">
  	<ul>
		<li>"Inicio" Agregar vision "Jefe de Catedra" "Postulante" "Responsable Administrativo"</li>
		<li>"Vacantes"  Agregar vision "Jefe de Catedra" "Postulante" "Responsable Administrativo"</li>
		<li>"Postulaciones"  <-- No hace falta</li> 
	</ul>
   Se adaptan los Tiles al rol actual que tiene la session. Debajo de los Tiles, se explica que la seccion en forma general, y 
   describe cada tile mostrado.
  </div>
</article>

<article class="message is-warning">
  <div class="message-header">
    <p>Recordar, arreglar bug</p>
  </div>
  <div class="message-body">
   Cuando estoy con una session abierta y fuerzo el login -> podria reloguearme? -> debería corregir el codigo y cuando abre login si estoy logueado me debería llevar a home.
  </div>
</article>