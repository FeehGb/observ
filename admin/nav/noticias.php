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
<div id="publication">
<?php
	if(isset($_GET['slug'])):
		$acao = "CRIAR";
		if($_GET['slug'] != "cadastrar-nova-noticia"): 
			$acao = "EDITAR";
			$r 		= DB__query::__SELECT("observ_noticias", "*", "WHERE not_slug = '".$_GET['slug']."' ORDER BY not_id DESC LIMIT 0,1" );
	 		
			if (DB__query::$num_row >= 1):
				$field 	= (array_keys($r[data][output][0]));
				$DB_query->catch_($field);
			endif;		
		endif;
			?>
<script>tinyMCExec('<?php echo $not_id;?>');</script>
<article id="single" class="noticias">
  <form name="form" id="form-noticias-<?php echo $not_id;?>" action="<?php echo $_SESSION["URL_ADM_BASE"];?>/addons/management/handler.content.php" method="POST" enctype="multipart/form-data">
    <input type="button" name="atualizar"class="white-button" id="<?php echo $acao?>" 	data-acao="<?php echo $acao?>"	data-id="<?php echo $not_id;?>"  value="CONCLUIR">
    <input type="button"  name="remover"  class="red-button remover"  					data-acao="REMOVER"	data-id="<?php echo $not_id;?>"	 value="REMOVER">
    <fieldset>
      <header>
        <div class="title-content">
          <h1>
            <input type="text" name="form_titulo" id="form_titulo" placeholder="Título" data-id="<?php echo $not_id;?>" value="<?php echo $not_titulo ;?>" >
          </h1>
        </div>
        <div class="sub-title-content">
          <h2>
            <input type="text" name="form_subtitulo" id="form_subtitulo" placeholder="Sub-Título" value="<?php echo $not_subtitulo;?>">
          </h2>
        </div>
        <div class="img-content">
          <label for="form_img-<?php echo $not_id;?>" class="iFile <?php echo $source?>"<?php if(isset($not_img)):?> style="background-image:url(<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?>&w=690&h=425); background-repeat:no-repeat"<?php endif;?>>Escolha uma imagem</label>
          <input type="file" name="_IMG_" class="inFile" id="form_img-<?php echo $not_id;?>" value="">
        </div>
      </header>
      <div class="entry-content" id="div-textarea-<?php echo $not_id;?>">
        <?php if(isset($not_content)): echo $not_content; else: ?>
        Escreva aqui a notícia
        <?php endif;?>
      </div>
      <div class="autor">
        <input type="text" name="form_credito" id="form_credito" placeholder="Autor" value="<?php echo $not_credito;?>">
      </div>
      <div class="social"></div>
      <div class="tag">
        <input type="text" name="form_tags" id="form_tags" placeholder="Insira palavras chaves, Exemplo: Cigarro, Produção, Dia Internacional do Fumo" value="<?php echo $not_tags;?>">
      </div>
      <div class="how_exb">
      <div class="exb_label">Selecione como deve ser exibido a postagem</div>
        <div class="not_type">
          <select  size="" id="form_type" name="form_type">
            <option value ="artigo-comum" <?php echo $not_type == "" || "artigo-comum" ?"selected":"";?>>Artigo Comum</option>
            <option value ="artigo-principal" <?php echo $not_type ==  "artigo-principal" ?"selected":"";?>>Artigo Principal</option>
            <option value ="artigo-principal-dois" <?php echo $not_type == "artigo-principal-dois" ?"selected":"";?>>Artigo Principal Dois</option>
            <option value ="artigo-destaque" <?php echo $not_type == "artigo-destaque" ?"selected":"";?>>Artigo Destaque</option>
          </select>
        </div>
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
    </fieldset>
  </form>
</article>
<?php
			
		endif;
	?>
