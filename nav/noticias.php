<?php define(QUERY_STRING,addslashes($_GET['queryStr']))?>
<header id="title" class="noticias">
  <div class="wrap">
    <h1 class="title-pg">NOTÍCIAS</h1>
    <p class="title-ct"></p>
  </div>
  <div class="bars">
    <div class="wrap">
      <div class="bar-noticias"></div>
    </div>
  </div>
</header>
<section id="content">
<div class="wrap">
<?php
   	if($_SESSION['USER_AUTHORIZED']):
	?>
<a href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=noticias&slug=cadastrar-nova-noticia" style="text-align: center;width: 250px !important;display: block;margin-bottom:15px;" class="white-button"> CRIAR NOVA NOTÍCIA</a>
<?php
   	endif;
	?>
<div id="publication">
  <aside id="global">
    <div class="facebook_aside">
      <div class="fb-like-box" data-href="https://www.facebook.com/observatoriodomundodotabaco" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="false"></div>
    </div>
    <div class="twitter_aside"> <a class="twitter-timeline" data-dnt="true" data-theme="dark" data-link-color="#19CF86" href="https://twitter.com/obsertabaco">Tweets by obsertabaco</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script> </div>
  </aside>
  <?php
  	
	switch(($_GET['queryStr'])):
		case "":
		?>
  <div id="grupo-de-noticias">
    <div id="grupo-de-noticias-destaques">
      <?php
	  
			$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_type='artigo-principal' ORDER BY not_id DESC LIMIT 0,1" );
			if (DB__query::$num_row >= 1):
				$field = (array_keys($r[data][output][0]));
				$DB_query->catch_($field);

			?>
      <article class="ekr-s45-s destaque destaque-principal" >
        <header>
          <div class="title-content">
            <h1> <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2><?php echo $not_subtitulo; ?></h2>
          </div>
        </header>
      </article>
      <?php 
			endif;
		$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_type='artigo-destaque' AND (not_id % 2 = 0) ORDER BY not_id DESC LIMIT 0,4" );
			if (DB__query::$num_row >= 1):
			
			
				$field = (array_keys($r[data][output][0]));
				for ($i = "0"; $i < DB__query::$num_row; $i++):
					$DB_query->catch_($field,$i);

			?>
      <article class="ekr-s45-s destaque destaque-principal-secundario" >
        <header>
          <div class="img-content">
            <?php if($not_img){?>
            <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?>&w=120&h=150" /></a>
            <?php }?>
          </div>
          <div class="title-content">
            <h1> <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2><?php echo $not_subtitulo; ?></h2>
          </div>
        </header>
      </article>
      <?php 
	  endfor;
			endif;
	?>
    </div>
    <div id="grupo-de-noticias-destaques-dois">
      <?php
			

			$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_type='artigo-principal-dois' ORDER BY not_id DESC LIMIT 0,1" );
			if (DB__query::$num_row >= 1):
				$field = (array_keys($r[data][output][0]));
				$DB_query->catch_($field);

			?>
      <article class="ekr-s45-s destaque destaque-principal" >
        <header>
          <div class="title-content">
            <h1> <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2><?php echo $not_subtitulo; ?></h2>
          </div>
        </header>
      </article>
      <?php 
			endif;
		$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_type='artigo-destaque' AND (not_id % 2 = 1)  ORDER BY not_id DESC LIMIT 0,4" );
			if (DB__query::$num_row >= 1):
			
			
				$field = (array_keys($r[data][output][0]));
				for ($i = "0"; $i < DB__query::$num_row; $i++):
					$DB_query->catch_($field,$i);

			?>
      <article class="ekr-s45-s destaque destaque-principal-secundario" >
        <header>
          <div class="img-content">
            <?php if($not_img){?>
            <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?>&w=120&h=150" /></a>
            <?php }?>
          </div>
          <div class="title-content">
            <h1> <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2><?php echo $not_subtitulo; ?></h2>
          </div>
        </header>
      </article>
      <?php 
	  endfor;
			endif;
	?>
    </div>
  </div>
  <div id="grupo-de-noticias-dois">
    <div class="titulo-grupo">Outras notícias <a class="button-simple" href="<?php echo $_SESSION["URL_BASE"];?>/busca/?q=&tipo=noticias">Veja mais</a></div>
    <span>
    <?php 
	$mostrarTodosOsPost = true;
	$filtrarPor = "artigo-comum";?>
    </span> </div>
  <?php 
		
  		break;
		default:
			$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_slug = '".QUERY_STRING."' ORDER BY not_id DESC LIMIT 0,1" );
				if (DB__query::$num_row >= 1):
					$field = (array_keys($r[data][output][0]));
					$DB_query->catch_($field);
		  ?>
  <article id="single" class="<?php echo $current_page?>">
    <header>
      <div class="info"> <abbr class="published">Publicado <?php echo date("d/m/Y - H:i" , strtotime($not_data));?> </abbr> <!--- Por <abbr class="autor"> <?php echo $not_user;?> </abbr>--> 
      </div>
      <div class="title-content">
        <h1> <?php echo $not_titulo;?> </h1>
      </div>
      <div class="sub-title-content">
        <h2> <?php echo $not_subtitulo;?> </h2>
      </div>
      <div class="autor-creditos"><?php echo $not_credito;?></div>
      <div class="social">
        <div class="tw-like"><a href="https://twitter.com/share" class="twitter-share-button"  data-via="obsertabaco" data-related="obsertabaco" data-text="<?php echo str_truncate($not_titulo,100);?>…">Tweet</a></div>
        <div class="fb-like" data-layout="standard" data-action="like" data-show-faces="true" data-width="400" data-share="true"></div>
      </div>
      <div class="img-content">
        <?php if($not_img):?>
        <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?>&w=690&h=425" />
        <?php endif;?>
      </div>
    </header>
    <div class="entry-content"> <?php echo $not_content; ?> </div>
    <div class="tags"> <abbr class="topico">Topicos:</abbr>
      <?php 
		$tags = array();
		$tags = !empty($not_tags)? explode(",",$not_tags):"";
			
		if(count($tags) > 1){
			
			foreach($tags as $tag)
			{
				$link[] = '<a href="'.$_SESSION["URL_BASE"].'/topico/'.trim($tag).'">'.trim($tag).'</a>';
			}
			echo implode(", ",$link);
		}
		?>
    </div>
    <div class="comentarios"> <span class="n-c">Comentários</span>
      <div class="numero_comentarios">
        <fb:comments-count href="<?php echo $noticia_url_base."".$not_slug;?>"></fb:comments-count>
      </div>
      <div class="fb-comments" data-href="<?php echo $noticia_url_base."".$not_slug;?>" data-numposts="10" data-colorscheme="light" data-width = "640px"></div>
    </div>
  </article>
  <?php
		  endif;
		break;
	endswitch;

		?>
</div>
</section>
<?php if($mostrarTodosOsPost == true):?>
<script>

var $elemento			= '#publication article.destaque-comum';
var $alvo 				= '#grupo-de-noticias-dois span';
var $categoria 			= '<?php echo QUERY_STRING;?>';
var $url				= '<?php echo $_SESSION["URL_BASE"];?>/nav/post.noticias.php' 

$(window).load(function(){
	carregarComAjax(
	{
		url		: $url,
		alvo	: $alvo ,
		elemento: $elemento
	}, {
		categoria		: $categoria ,
		iniciarNo		: 0,
		filtrarPor		: "<?php echo $filtrarPor;?>",
		noticia_url_base: "<?php echo $noticia_url_base;?>"
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
		filtrarPor		: "<?php echo $filtrarPor;?>",
	});
});


</script>
<?php endif; ?>
