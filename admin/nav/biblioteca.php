<header id="title" class="biblioteca">
  <div class="wrap">
    <h1 class="title-pg">BIBLIOTECA</h1>
    <p class="title-ct"></p>
  </div>
  <div class="bars">
    <div class="wrap">
      <div class="bar-biblioteca"></div>
    </div>
  </div>
</header>
<nav id="categ">
  <div class="wrap">
    <ul>
      <li id="cient" class="<?php active("artigos_cientificos",CATEGORIA);?>"> <a title="Artigos cientificos" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=artigos_cientificos"></a></li>
      <li id="book"  class="<?php active("livros",CATEGORIA);?>"> <a title="Livros" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=livros"></a></li>
      <li id="revis" class="<?php active("revistas",CATEGORIA);?>"> <a title="Revistas" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=revistas"></a></li>
      <li id="tese"  class="<?php active("teses",CATEGORIA);?>"> <a title="Teses" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=teses"></a></li>
      <li id="boletim" class="<?php active("boletins",CATEGORIA);?>"> <a  title="Boletins" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=boletins"></a></li>
      <li id="outros" class="<?php active("outros",CATEGORIA);?>"> <a  title="Outros" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=demais_publicacoes"></a></li>
    </ul>
  </div>
</nav>
<section id="content">
  <div class="wrap">
    <div id="publication" class="biblioteca">
      <?php if(CATEGORIA):?>
      <article id="post-" class="ekr-s45-s">
        <form name="form" id="form-biblioteca-" action="<?php echo $_SESSION["URL_ADM_BASE"];?>/addons/management/handler.content.php" method="POST" enctype="multipart/form-data">
          <input type="button" name="atualizar" class="white-button" id="CRIAR" 	data-acao="CRIAR"	data-id=""  	value="CONCLUIR">
          <input type="button"  name="remover"  class="red-button remover"  					data-acao="REMOVER"			data-id=""	 	value="REMOVER">
          <fieldset>
            <header>
              <div class="post-categ sem-categoria"></div>
              <div class="title-content">
                <h1>
                  <input type="text" name="form_titulo" id="form_titulo" placeholder="Título"  data-id="" value="">
                </h1>
              </div>
              <div class="sub-title-content">
                <h2>
                  <input type="text" name="form_subtitulo" id="form_subtitulo" placeholder="Sub-Título" value="">
                </h2>
              </div>
              <div class="img-content">
                <label for="form_img" class="iFile ">Escolha uma imagem</label>
                <input type="file" name="_IMG_" class="inFile" id="form_img" value="">
              </div>
            </header>
            <div class="entry-content" id="div-textarea-"> Escreva aqui o resumo da matéria </div>
            <div class="autor">
              <input type="text" name="form_credito" id="form_credito" placeholder="Autor" value="">
            </div>
            <div class="tag">
              <input type="text" name="form_tags" id="form_tags" placeholder="Insira palavras chaves, Exemplo: Cigarro, Produção, Dia Internacional do Fumo" value="<?php echo $bib_tags;?>">
            </div>
            <div class="social"></div>
            <div class="download">
              <label for="form_file" class="aFile">ESCOLHA UM ARQUIVO <br />
              </label>
              <input type="file" name="FILE" class="aFile" id="form_file" />
            </div>
          </fieldset>
          <div class="how_exb">
            <div class="exb_label">Selecione como deve ser exibido a postagem</div>
            <div class="checkbox">
              <p class="check_dtq">
                <input type="checkbox" id="dtq_checkbox-<?php echo $not_id;?>" <?php echo $checked == "1" ?"checked":"";?> name="check_dtq" value="true">
                <label for="dtq_checkbox-<?php echo $not_id;?>">Destaque Slideshow</label>
              </p>
              <p class="exb_checkbox">
                <input type="checkbox" id="exb_checkbox-<?php echo $not_id;?>" <?php echo $exb_checkbox == "1" ?"checked":"";?> name="exb_checkbox" value="true">
                <label for="exb_checkbox-<?php echo $not_id;?>">Apenas registro</label>
              </p>
            </div>
          </div>
        </form>
      </article>
      <?php endif;?>
    </div>
  </div>
</section>
<script>
tinyMCExec('');

var $elemento			= '#publication article';
var $alvo 				= '#publication';
var $categoria 			= '<?php echo CATEGORIA ?>';
var $url				= '<?php echo $_SESSION["URL_ADM_BASE"];?>/nav/post.biblioteca.php' 

$(window).load(function(){
	
	
	carregarComAjax(
	{
		url		: $url,
		alvo	: $alvo ,
		elemento: $elemento
	}, {
		categoria		: $categoria ,
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
		
	}, {
		categoria		: $categoria ,
		iniciarNo		: $('#publication article').count(),
	});
});

</script> 
