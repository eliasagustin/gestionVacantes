<div class="container is-fluid">
	<h1 class="title">Home</h1>
	<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?>!</h2>
	<br>
	<h2 class="subtitle">Actualemente estas designado con rol de <?php echo $_SESSION['rol']; ?></h2>
</div>

<div class="notification is-danger is-light">
    <strong>Tener especial cuidado</strong><br>cuando estoy con una session abierta y fuerzo el login -> podria reloguearme? -> debería corregir el codigo y cuando abre login si estoy logueado me debería llevar a home
</div>