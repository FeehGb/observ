<?php
require_once("../config.php");

		$complementoDaClausula = !empty($_POST['filtrarPor']) ? "WHERE not_type='".$_POST['filtrarPor']."'":"";
		$iniciarNo 	= isset($_POST['iniciarNo']) ? $_POST['iniciarNo'] : '0';	
		
		
		$r = DB__query::__SELECT("observ_noticias", "*, DATE_FORMAT(not_data,'%Y-%m-%d') AS unique_data", $complementoDaClausula." ORDER BY exb_checkbox,not_id DESC LIMIT ".$iniciarNo.",".MOSTRAR_NO_MAXIMO );
		if (DB__query::$num_row >= 1):
			
			$field = (array_keys($r[data][output][0]));
			$data_temp = "";
			for ($i = "0"; $i < DB__query::$num_row; $i++):
				$DB_query->catch_($field, $i);	
				
	  ?>
      
      <article class="destaque-comum">
      	<?php
			if($data_temp != $unique_data)
			{	
				$data_temp = $unique_data;
				?>
				<div class="data-published"><?php echo date("d-m-Y" , strtotime($data_temp));?></div>
				<?php 
			}
		?>
        
        <header><div class="info">Publicado as <abbr class="published"> <?php echo date("H\h:i" , strtotime($not_data));?> </abbr> </div>
        <div class="img-content">
              <?php if($not_img){?>
              <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/noticias/imagens/<?php echo $not_img;?>&w=70&h=70" /></a>
              <?php }?>
            </div>
		
          <div class="title-content">
            <h1> <a  href="<?php echo $noticia_url_base."".$not_slug;?>"> <?php echo $not_titulo;?> </a> </h1>
          </div>
          <div class="sub-title-content">
            <h2> <?php echo $not_subtitulo;?> </h2>
          </div>

       
        </header>

      </article>
      <?php 
	  		endfor;
		
		else:
		 	exit();
		endif;
	  
	  ?>

