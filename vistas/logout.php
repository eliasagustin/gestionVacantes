<?php
	if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
		// session isn't started
		//session_start();
		echo "<script> window.location.href='index.php?vista=home'; </script>";
		exit;
	} else {
		session_destroy();
		//session_unset();
		if(headers_sent()){
			echo "<script>
			setTimeout(function () {
				window.location.href= 'index.php?vista=home';
			 },2000);
			 </script>";
			 echo '
	<article class="message is-info">
  <div class="message-header">
    <p>Mensaje de Información</p>
  </div>
  <div class="message-body">
  	Serás redireccionado al inicio con rol de Invitado.
  </div>
</article>';
		}
	}
	