<?php
require_once("../../config.php");

		$iniciarNo 			= isset($_POST['iniciarNo'])		?	$_POST['iniciarNo']  			: '0';	
		$r = DB__query::__SELECT("observ_noticias", "*", "ORDER BY not_id DESC LIMIT ".$iniciarNo.",".MOSTRAR_NO_MAXIMO );
		
		if (DB__query::$num_row >= 1):
			$field = (array_keys($r[data][output][0]));
			for ($i = "0"; $i < DB__query::$num_row; $i++):
				$DB_query->catch_($field, $i);
	  
	  ?>
       <article id="<?php echo $articleID;?>" class="noticias">
       <input type="button" class="red-button remover"  	data-id="<?php echo $not_id;?>"	data-acao="REMOVER" value="REMOVER">
        <header>
          <div class="info"> <abbr class="published"> <?php echo date("d/m/Y - H:i" , strtotime($not_data));?> </abbr> - Por <abbr class="autor"> <?php echo $not_user;?> </abbr> </div>
          <div class="title-content">
            <h1> <a  href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=noticias&slug=<?php echo $not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2> <?php echo $not_subtitulo;?> </h2>
          </div>
          <div class="autor-creditos"><?php echo $not_credito;?></div>
          <div class="img-content">
            <?php if($not_img){?>
            <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?><?php echo empty($slug)?"&w=500&h=200":"&w=690&h=425"?>" />
            <?php }?>
          </div>
        </header>
        <div class="entry-content"> <?php echo empty($slug)?  str_truncate($not_content, 300)."<a href='".$_SESSION["URL_ADM_BASE"]."/cms.php?query=noticias&slug=".$not_slug."'><b> [ ... ]</b></a>":$not_content; ?> </div>
        <div class="social"></div>
        
      </article>
      <?php 
	  		endfor;
		else:
		 	exit();
		endif;
	  
	  ?>

