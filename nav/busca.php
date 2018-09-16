<header id="title" class="busca">
  <div class="wrap">
    <h1 class="title-pg">BUSCA</h1>
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
  <div id="cabecalho-da-busca">
    <ul class="filtros">
    <li class="<?php active("",$_GET[tipo]);?>">
        <div> <a href="<?php echo $_SESSION["URL_BASE"]?>/busca/?q=<?php echo $_GET[q];?>&tipo=" >Todos</a> </div>
      </li>
      <li class="<?php active("noticias",$_GET[tipo]);?>">
        <div> <a href="<?php echo $_SESSION["URL_BASE"]?>/busca/?q=<?php echo $_GET[q];?>&tipo=noticias" >notícias</a> </div>
      </li>
      <li class="<?php active("biblioteca",$_GET[tipo]);?>">
        <div> <a href="<?php echo $_SESSION["URL_BASE"]?>/busca/?q=<?php echo $_GET[q];?>&tipo=biblioteca" >biblioteca</a> </div>
      </li>
    </ul>
  </div>
  <div id="grupo-de-noticias-dois">
    <div class="titulo-grupo">Artigos encontrados</div>
    <span> </span> </div>
</div>
</section>

<script>

var $elemento			= '#publication article.destaque-comum';
var $alvo 				= '#grupo-de-noticias-dois span';
var $categoria 			= '<?php echo $_GET['queryStr'];?>';
var $url				= '<?php echo $_SESSION["URL_BASE"];?>/nav/post.busca.php' 

$(window).load(function(){
	carregarComAjax(
	{
		url		: $url,
		alvo	: $alvo ,
		elemento: $elemento
	}, {
		categoria		: $categoria ,
		iniciarNo		: 0,
		q 				: "<?php echo $_GET[q];?>",
		tipo			: "<?php echo $_GET[tipo]?>"
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
		categoria		: $categoria ,
		iniciarNo		: $('#publication article.destaque-comum').count(),
		q 				: "<?php echo $_GET[q];?>",
		tipo			: "<?php echo $_GET[tipo]?>"
	});
});


</script> 
