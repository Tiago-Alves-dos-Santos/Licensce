<div class="load-page" id="load-page">
    <img src="{{asset('img/load-page.gif')}}" alt="">
    <h1 class="text-white">Carregando...</h1>
</div>
<script>
    let height = $("body").height();
    if(height > 0){
        $("#load-page").height(height);
    }
</script>