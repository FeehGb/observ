
<header id="title" class="busca">
  <div class="wrap">
    <h1 class="title-pg">TÓPICOS</h1>
    <p class="title-ct"></p>
  </div>
  <div class="bars">
    <div class="wrap">
      <div class="bar-busca"></div>
    </div>
  </div>
</header>
<section id="content">
<div class="wrap">
<div id="publication">
  
  <div id="grupo-de-noticias-dois">
    <div class="titulo-grupo">Artigos encontrados</div>
    <span> </span> </div>
</div>
</section>
<script>

var $elemento			= '#publication article.destaque-comum';
var $alvo 				= '#grupo-de-noticias-dois span';
var $nome_da_tag		= '<?php echo $_GET['queryStr'];?>';
var $url				= '<?php echo $_SESSION["URL_BASE"];?>/nav/post.topico.php' 

$(window).load(function(){
	carregarComAjax(
	{
		url		: $url,
		alvo	: $alvo ,
		elemento: $elemento
	}, {
		nome_da_tag		: $nome_da_tag ,
		iniciarNo		: 0,
	});

});


$('#publication').endScroll(function ()
{
	carregarComAjax(
	{
		url		: $url,
		alvo	: $alvo ,
		elemento: $elemento,
		
		
	},{
		nome_da_tag		: $nome_da_tag ,
		iniciarNo		: $('#publication article.destaque-comum').count(),
	});
});


</script> 
