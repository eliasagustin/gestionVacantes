<div class="card-footer-item ">
<span>
	<a href="#" class="button is-warning is-rounded btn-back is-small">Retroceder</a>
</span>


<script type="text/javascript">
    let btn_back = document.querySelector(".btn-back");

    btn_back.addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
    });
</script>