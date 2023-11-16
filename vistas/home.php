<?php include "./php/breadcum.php"; ?>
<p>
<div class="container is-fluid">
	<?php if (!isset($_SESSION['rol'])){
			echo '<h1>Trabajo Ingredor Cátedra Entornos Gráficos</h1>
            <h2 class="subtitle">Actualmente no estás logeado! y debido a nuestra política de permisos, la experiencia y funcionalidad en nuestro nuevo módulo denominado "Gestión de Vacantes" será reducida.</h2>
<h3>Para desbloquear funciones dirígete al login apretando el boton arriba a la derecha.</h3>';
		}else {
			echo "<h1>Trabajo Ingredor Cátedra Entornos Gráficos</h1>
            <h2 class='subtitle'>Bienvenido ".$_SESSION['nombre']." ".$_SESSION['apellido']."!, Espero que disfrutes al máximo la experiencia en nuestro nuevo módulo denominado 'Gestión de Vacantes'.</h2>";
		}
	?>
	
</div>
<p>
<?php require "./php/lista_tiles.php"; ?>