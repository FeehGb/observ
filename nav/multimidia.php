<header id="title" class="multimidia">
  <div class="wrap">
    <h1 class="title-pg">GALERIA</h1>
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
    <div id="publication">
    	<aside id="global">
			<h4>ALBUMS</h4>
            <?php
            	$r = DB__query::__SELECT("observ_albuns","album_name");
				if (DB__query::$num_row >= 1):
					for ($i = "0"; $i < DB__query::$num_row; $i++):
						$DB_query->catch_('album_name', $i);
						
						?>
						<a class="album" href="<?php echo $_SESSION["URL_BASE"];?>/multimidia/galeria/<?php echo $album_name;?>"><?php echo $album_name;?></a>
						
						<?php
						
					endfor;
				
				endif;
			?>
    	</aside>
    <div id="exhibitions">
    <div class="am-container" id="am-container">
<script>

var $elemento			= '#publication';
var $alvo 				= '#am-container';
var $url 				= "<?php echo $_SESSION["URL_BASE"];?>/nav/post.galeria.php";

$(window).load(function(){
	carregarComAjax(
	{
		url			: $url ,
		alvo		: $alvo ,
		elemento	: $elemento
		
	}, {
		album		: "<?php echo $_GET["queryStr2"];?>"
		
	});

});

$('#publication').endScroll(function ()
{
	carregarComAjax(
	{
		url			: $url,
		alvo		: $alvo ,
		elemento	: $elemento,
		
		
	},{
		iniciarNo	: $('#am-container a').count(),
		album		: "<?php echo $_GET["queryStr2"];?>"
	});
	
});

	var boxInitialize = function(){
    try {
        if (!Shadowbox.initialized) {
            Shadowbox.init({
				skipSetup: true,
				overlayColor:"#000",
				overlayOpacity:"0.4",
				language: 'pt',
				players:  ['img'],
				
			});
            Shadowbox.initialized = true;
        } else {
            Shadowbox.clearCache();
            Shadowbox.setup();
        }
    } catch(e) {
        try {
            Shadowbox.init({
				skipSetup: true,
				overlayColor:"#000",
				overlayOpacity:"0.4",
				language: 'pt',
				players:  ['img'],
				
			});
        } catch(e) {};
    }
};
$(window).load(function(){
	boxInitialize();
})


</script>

    </div>
    </div>
  </div>
</section>
