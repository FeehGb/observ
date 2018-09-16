<?php
require_once("../config.php");
			

			$iniciarNo 	= isset($_POST[iniciarNo]) ? $_POST[iniciarNo] : '0';
			
			$q = preg_replace("/[\"'%()@$.!&?_: #\/-]/","", $_POST['q']);
			
			if(!empty($_POST[tipo])){
				
				$suflixo 	= $_POST[tipo] == "noticias"?"not_":"bib_";
				$r 			= DB__query::__SELECT("observ_".$_POST[tipo], "*,DATE_FORMAT(observ_".$_POST[tipo].".".$suflixo."data,'%Y-%m-%d') as unique_data", "WHERE ".$suflixo."titulo LIKE '%".$_POST['q']."%' ORDER BY ".$suflixo."data DESC LIMIT ".$iniciarNo.",".MOSTRAR_NO_MAXIMO );		
				
			}else{
				
				$r			= DB__query::__SELECT( "observ_noticias", "
					
							observ_noticias.not_titulo as titulo,
							observ_noticias.not_subtitulo as subtitulo,
							observ_noticias.not_img as imagem,
							observ_noticias.not_slug as link,
							observ_noticias.not_type as categoria,
							observ_noticias.not_data as data,
							observ_noticias.exb_checkbox as exb,
							DATE_FORMAT(observ_noticias.not_data,'%Y-%m-%d') as unique_data
										
							", "WHERE not_titulo LIKE '%".$q."%' UNION (SELECT 
							
							observ_biblioteca.bib_titulo as titulo,
							observ_biblioteca.bib_subtitulo as subtitulo,
							observ_biblioteca.bib_img as imagem,
							observ_biblioteca.bib_files as link ,
							observ_biblioteca.bib_categoria as categoria,
							observ_biblioteca.bib_data as data,
							observ_biblioteca.exb_checkbox as exb,
							DATE_FORMAT(observ_biblioteca.bib_data,'%Y-%m-%d') as unique_data
		
							FROM observ_biblioteca WHERE bib_titulo LIKE '%".$q."%') ORDER BY exb,unique_data DESC  LIMIT ".$iniciarNo.",".MOSTRAR_NO_MAXIMO); 
						
			}
			
			if (DB__query::$num_row>= 1):
			
				$field = (array_keys($r[data][output][0]));
				$data_temp = "";
				for ($i = "0"; $i < DB__query::$num_row; $i++):
					$DB_query->catch_($field,$i);
					
					if($_POST[tipo]){
						$categoria	= $not_type;
						$link		= $not_slug;
						
						if(($_POST[tipo]) != "noticias")
						{
							$categoria	= $bib_categoria;
							$link		= $bib_files;
							
						}
						
						$titulo 	= $GLOBALS[$suflixo."titulo"];
						$subtitulo	= $GLOBALS[$suflixo."subtitulo"];
						$imagem		= $GLOBALS[$suflixo."img"];
						$data 		= $GLOBALS[$suflixo."data"];
					}
					
					$url 		= $noticia_url_base."".$link; 
					$dtq_fonte 	= "noticias"; 
					$allow 		= array("artigos_cientificos","livros","revistas","teses","boletins","outros"); 
					
					if(in_array($categoria,$allow)) { 
						if($link){ 
							$arqExt = explode('.', $link); 
							$url = $_SESSION["URL_BASE"]."/uploads/biblioteca/arquivos/". end($arqExt)."/".$link; }else {$url = "#";} 
							$dtq_fonte = "biblioteca"; 
						}
					
			
					

			?>
      <article class="destaque-comum" >
      <?php
	  		
			if($data_temp != $unique_data)
			{	
				$data_temp = $unique_data;
				?>
				<div class="data-published"><?php echo date("d-m-Y" , strtotime($data_temp));?></div>
				<?php 
			}
		?>
        <header>
       
       <!-- <div class="img-content">
              <?php if($imagem){?>
              <a  href="<?php echo $url?>"> <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/<?php echo $dtq_fonte?>/imagens/<?php echo $imagem;?>&w=70&h=70" /></a>
              <?php }?>
            </div>-->
			<div class="info">Publicado em <abbr class="published"> <?php echo date("H\h:i" , strtotime($data));?> </abbr> </div>
          <div class="title-content">
            <h1> <a target="_blank" href="<?php echo $url?>"> <?php echo $titulo;?> </a> </h1>
          </div>
           <div class="sub-title-content">
            <h2> <?php echo $subtitulo;?> </h2>
          </div>
           
        </header>
      </article>
      <?php 
	  endfor;
			endif; ?>

