<?php
require_once( "../config.php" );

$iniciarNo = isset( $_POST[ 'iniciarNo' ] ) ? $_POST[ 'iniciarNo' ] : '0';

$clause = $_POST[ 'categoria' ] != "" ? "WHERE bib_categoria = '" . $_POST[ 'categoria' ] . "' ORDER BY bib_id DESC LIMIT " . $iniciarNo . "," . MOSTRAR_NO_MAXIMO: "ORDER BY bib_id DESC LIMIT " . $iniciarNo . "," . MOSTRAR_NO_MAXIMO;
$r = DB__query::__SELECT( "observ_biblioteca", "*", $clause );

if ( DB__query::$num_row >= 1 ):

	$field = ( array_keys( $r[ data ][ output ][ 0 ] ) );


for ( $j = "0"; $j <= DB__query::$num_row; $j++ ):


	if ( $j == DB__query::$num_row ):
		$divPub = true;
	?>
	<div id="divPub" class="">
		<?php 

					endif;

			endfor;


	for ($i = "0"; $i < DB__query::$num_row; $i++):
	
		$DB_query->catch_($field, $i);
		$quantidadeArticle = is_numeric($quantidadeArticle);
		

	  ?>
		<article>
			<header>
				<div class="info">
					<abbr class="published">
						<?php echo date("d/m/Y - H:i" , strtotime($bib_data));?> </abbr> - Por
					<abbr class="autor">
						<?php echo $bib_user;?> </abbr>
				</div>
				<div class="post-categ <?php echo $bib_categoria ;?>"></div>
				<div class="title-content">
					<h1>
						<?php echo $bib_titulo;?> </h1>
				</div>
				<div class="sub-title-content">
					<h2>
						<?php echo $bib_subtitulo;?> </h2>
				</div>
				<div class="autor-creditos">
					<?php echo $bib_credito;?>
				</div>
				<div class="img-content">
					<?php if($bib_img){?>
					<img src="<?php echo $_SESSION[" URL_BASE "];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE "];?>/uploads/biblioteca/imagens/<?php echo $bib_img;?>&w=500&h=200"/>
					<?php }?>
				</div>
			</header>
			<div class="entry-content">
				<p>
					<?php echo $bib_resumo;?> </p>
			</div>
			<div class="social"></div>
			<div class="download">
				<div class="ic-down"><span class="SegoeUILight">Matéria completa</span>
				</div>
				<?php if($bib_files){ $arqExt = explode('.', $bib_files);?>
				<a href="<?php echo $_SESSION[" URL_BASE "];?>/uploads/biblioteca/arquivos/<?php echo end($arqExt)?>/<?php echo $bib_files?>" target="_blank" class="<?php echo strtolower(end($arqExt))?>">#</a>
				<?php }?>
			</div>
		</article>
		<?php endfor;
	  	else:
			exit();
		endif;
		echo $divPub == true? '</div>':'';	
	   ?>