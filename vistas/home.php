<div class="container is-fluid">
	<h2 class="subtitle">Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!, espero puedas disfrutar la experiencia en el nuevo modulo llamado "Gestión de Vacantes".</h2>
</div>
<br>

<div class="tile is-ancestor">
  <a class="tile is-parent">
    <article class="tile is-child box">
		<br>
    	<p class="subtitle">Listar Vacantes</p>
		<br>
    </article>
  </a>
  <a class="tile is-parent">
    <article class="tile is-child box">
		<br>
		<p class="subtitle">Mis Postulaciones</p>
		<br>
	</article>
  </a>
  <a class="tile is-parent">
    <article class="tile is-child box">
		<br>
		<p class="subtitle">Consultar FAQs</p>
		<br>
	</article>
  </a>
  <a class="tile is-parent">
    <article class="tile is-child box">
		<br>
		<p class="subtitle">Solicitar Soporte</p>
		<br>
	</article>
  </a>
</div>

<br>
<div class="notification is-danger is-light">
    <strong>Tener especial cuidado</strong><br>cuando estoy con una session abierta y fuerzo el login -> podria reloguearme? -> debería corregir el codigo y cuando abre login si estoy logueado me debería llevar a home
</div>