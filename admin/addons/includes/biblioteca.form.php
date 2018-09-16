
<form name="form" id="form-<?php echo $origem;?>-<?php echo $bib_id;?>" action="<?php echo $_SESSION["URL_ADM_BASE"];?>/addons/management/handler.content.php" method="POST" enctype="multipart/form-data">
  <input type="button" name="atualizar" class="white-button" id="EDITAR" 	data-acao="EDITAR"		data-id="<?php echo $bib_id;?>"  	value="CONCLUIR">
  <input type="button"  name="remover"  class="red-button remover"  		data-acao="REMOVER"		data-id="<?php echo $bib_id;?>"	 	value="REMOVER">
  <fieldset>
    <header>
      <div class="post-categ <?php echo $bib_categoria?>"></div>
      <div class="title-content">
        <h1>
          <input type="text" name="form_titulo" id="form_titulo" placeholder="Título"  data-id="<?php echo $bib_id;?>" value="<?php echo $bib_titulo ;?>">
        </h1>
      </div>
      <div class="sub-title-content">
        <h2>
          <input type="text" name="form_subtitulo" id="form_subtitulo" placeholder="Sub-Título" value="<?php echo $bib_subtitulo;?>">
        </h2>
      </div>
      <div class="img-content">
        <label for="form_img-<?php echo $bib_id;?>" class="iFile <?php echo $source?>" 
           style="background-image:url(<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/biblioteca/imagens/<?php echo $bib_img;?>&w=500&h=200);  background-repeat:no-repeat">Escolha uma imagem</label>
        <input type="file" name="_IMG_" class="inFile" id="form_img-<?php echo $bib_id;?>" value="">
      </div>
    </header>
    <div class="entry-content" id="div-textarea-<?php echo $bib_id;?>"> <?php echo $bib_resumo; ?> </div>
    <div class="autor">
      <input type="text" name="form_credito" id="form_credito" placeholder="Autor" value="<?php echo $bib_credito;?>">
    </div>
    <div class="tag">
      <input type="text" name="form_tags" id="form_tags" placeholder="Insira palavras chaves, Exemplo: Cigarro, Produção, Dia Internacional do Fumo" value="<?php echo $bib_tags;?>">
    </div>
    <div class="social"></div>
    <div class="download">
      <label for="form_file-<?php echo $bib_id;?>" class="aFile">ESCOLHA UM ARQUIVO <br />
        Atual: <?php echo $bib_files?></label>
      <input type="file" name="FILE" class="aFile" id="form_file-<?php echo $bib_id;?>" />
    </div>
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
  </fieldset>
</form>
