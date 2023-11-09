<div class="main-container">
	<?php
	if(isset($_SESSION['id'])){
		if ($_GET['vista'] == 'login'){
			// if(headers_sent()){
			// 	header( "refresh:3; Location: index.php?vista=home" );
			// 	}  else {
					echo "<script>
					setTimeout(function () {
						window.location.href= 'index.php?vista=home';
					 },1500);
					 </script>";
					 echo '
						<article class="message is-info">
							<div class="message-header">
								<p>Usuario Activo</p>
							</div>
							<div class="message-body">
								Serás redireccionado al inicio con el usuario actual.
							</div>
						</article>';
				// }
		};
	} else {
	?>
	<form class="box login" action="" method="POST" autocomplete="off">
		<h4 class="title is-4 has-text-centered">Modulo Gestion de Vacantes</h4>

		<div class="field">
			<label class="label">Usuario</label>
			<div class="control">
			    <input id="login_usuario" class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}"  minlength="4" maxlength="20" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label">Clave</label>
		  	<div class="control">
		    	<input id="login_clave" class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{4,100}"  minlength="4" maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered pt-4 mb-5 mt-3">
			<a type="button" class="button is-success is-rounded" href="index.php?vista=home">Invitado</a>
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>
		<hr class="navbar-divider">
		<div class="box2 has-text-centered mt-3">
			<h6 class="title is-6 has-text-centered">Rellena con usuarios ejemplo</h6>
			<hr class="navbar-divider">
			<button type="button" onclick="rellenaLogin(1)" class="button is-warning is-rounded m-2">Admin</button>
			<button type="button" onclick="rellenaLogin(2)" class="button is-warning is-rounded m-2">Pos 1</button>
			<button type="button" onclick="rellenaLogin(3)" class="button is-warning is-rounded m-2">Pos 2</button>
			<button type="button" onclick="rellenaLogin(4)" class="button is-warning is-rounded m-2">R.Adm</button>
			<button type="button" onclick="rellenaLogin(5)" class="button is-warning is-rounded m-2">J.Cat</button>
			<hr class="navbar-divider">
		</div>
		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php"; // LLamo funciones necesarias para llevar a cabo los siguientes procesos
				require_once "./php/iniciar_sesion.php";
			}
		?>
	</form>
	
	<?php 
		}
		
		require "./inc/script.php"
	?>
	
</div>

