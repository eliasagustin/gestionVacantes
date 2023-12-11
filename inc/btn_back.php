<div class="card-footer-item ">
<span>
	<a href="#" class="button is-warning is-rounded btn-back is-small" title="Volver atrás">Retroceder</a>
</span>
<?php
$idPostulante = null;
if(isset($auxS)){
    $idPostulante = $auxS;
};
?>

<script type="text/javascript">

    function guard(){
        let salida = false;
        let myStr = (document.referrer);
        if (myStr.includes("pos_id_del")){
            let myStr2 = myStr.split('&pos_id_del');
            // location.replace("http://localhost/Gestion_Vacantes/gestionVacantes/index.php?vista=listar_postulaciones");
            location.replace($_SERVER['PHP_HOST'].'/index.php?vista=listar_postulaciones');
            salida = true;
        }
        if (myStr.includes("close_vac_id")){
            let myStr2 = myStr.split('&close_vac_id');
            // location.replace("http://localhost/Gestion_Vacantes/gestionVacantes/index.php?vista=listar_vacantes");
            location.replace($_SERVER['PHP_HOST'].'/index.php?vista=listar_vacantes');
            salida = true;
        }
        if(window.location.href.includes("user_update")){
            // location.replace("http://localhost/Gestion_Vacantes/gestionVacantes/index.php?vista=usuarios");
            location.replace($_SERVER['PHP_HOST'].'/index.php?vista=usuarios');
            salida = true;
        };
        if(window.location.href.includes("abrir_vacante")){
            // location.replace("http://localhost/Gestion_Vacantes/gestionVacantes/index.php?vista=vacante");
            location.replace($_SERVER['PHP_HOST'].'/index.php?vista=vacante');
            salida = true;
        }
        if(window.location.href.includes("&close_vac_id")){
            // location.replace("http://localhost/Gestion_Vacantes/gestionVacantes/index.php?vista=listar_vacantes");
            location.replace($_SERVER['PHP_HOST'].'/index.php?vista=listar_vacantes');
            salida = true;
        };
        return salida;        
    }
    
    // String(document.referrer)
    
    // if(from.contains){console.log(from);}
    // from = document.referrer.split('pos_id_del');
     
    /*console.log(from[0]+'user_id='+<?php //echo $idPostulante;?>);*/

    let btn_back = document.querySelector(".btn-back");

    btn_back.addEventListener('click', function(e){
        if (!guard()){
            e.preventDefault();
            window.history.back();
        }
    });
</script>