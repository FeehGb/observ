<script>
$(document).ready(function(){
	$("li.dropdown").click(function (event) {
		$(this).children("ul").stop(true, false).slideToggle('fast',function()
		{
			$(this).hasClass("a-active") ? $(this).removeClass("a-active"): $(this).addClass("a-active");
		});
	});
 });
</script>

  <div class="leftmenu">
    <ul class="nav nav-tabs nav-stacked">
      <li class="nav-header">MENU NAVEGAÇÃO</li>
      <li class=""><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php"><span class=""></span> Home</a>
      <li class="dropdown"><span class=""> Biblioteca</span>
        <ul class="<?php active("biblioteca",PAGINA_ATUAL);?>">
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=biblioteca&category=artigos_cientificos">Artigos Cientificos</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=biblioteca&category=livros">Livros</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=biblioteca&category=revistas">Revistas</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=biblioteca&category=teses">Teses</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=biblioteca&category=boletins">Boletins</a></li>
        </ul>
      </li>
      <li class=""><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=noticias"><span class=""></span> Notícias</a></li>
      <li class="dropdown"><span class=""> Multimídia</span>
        <ul class="<?php active("multimidia",PAGINA_ATUAL);?>">
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=multimidia&type=imagens">Imagens</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=multimidia&type=videos">Vídeos</a></li>
          <li><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=multimidia&type=audio">Áudio</a></li>
        </ul>
      </li>
      <li class=""><a href="<?php echo $_SESSION["URL_ADM_BASE"]?>/cms.php?query=arquivos"><span class=""></span> Arquivos</a></li>
    </ul>
  </div>

