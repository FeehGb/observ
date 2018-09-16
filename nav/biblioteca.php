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
			<li id="cient" class="<?php active(" artigos_cientificos ",$_GET['queryStr']);?>"> <a title="Artigos cientificos" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/artigos_cientificos"></a>
			</li>
			<li id="book" class="<?php active(" livros ",$_GET['queryStr']);?>"> <a title="Livros" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/livros"></a>
			</li>
			<li id="revis" class="<?php active(" revistas ",$_GET['queryStr']);?>"> <a title="Revistas" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/revistas"></a>
			</li>
			<li id="tese" class="<?php active(" teses ",$_GET['queryStr']);?>"> <a title="Teses" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/teses"></a>
			</li>
			<li id="boletim" class="<?php active(" boletins ",$_GET['queryStr']);?>"> <a title="Boletins" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/boletins"></a>
			</li>
			<li id="outros" class="<?php active(" outros ",$_GET['queryStr']);?>"> <a title="Outros" href="<?php echo $_SESSION[" URL_BASE "];?>/<?php echo $current_page;?>/demais_publicacoes"></a>
			</li>
		</ul>
	</div>
</nav>
<section id="content">
	<div class="wrap">
		<div id="publication" class="biblioteca">


			<?php
			$clause = $_GET[ 'queryStr' ] != "" ? "WHERE bib_categoria = '" . $_GET[ 'queryStr' ] . "' ORDER BY bib_id DESC LIMIT 0," . MOSTRAR_NO_MAXIMO: "ORDER BY bib_id DESC LIMIT 0," . MOSTRAR_NO_MAXIMO;
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

			for ( $i = "0"; $i < DB__query::$num_row; $i++ ):

				$DB_query->catch_( $field, $i );

			if ( $bib_files != "" ) {
				$arqExt = explode( '.', $bib_files );
				$arqExt = end( $arqExt );

				$LINK = $_SESSION[ "URL_BASE" ] . "/uploads/biblioteca/arquivos/" . $arqExt . "/" . $bib_files;
			} else {
				$LINK = "#";
				$arqExt = "";
			}



			?>

				<article class="ekr-s45-s">
					<header>
						<div class="info">
							<abbr class="published">
								<?php echo date("d/m/Y - H:i" , strtotime($bib_data));?> </abbr> - Por
							<abbr class="autor">
								<?php echo $bib_user;?> </abbr>
						</div>
						<div class="post-categ <?php echo $bib_categoria ;?>"></div>
						<div class="title-content">
							<h1> <a href="<?php echo $LINK; ?>" target="_blank" class="<?php echo strtolower($arqExt)?>"><?php echo $bib_titulo;?></a> </h1>
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
						<?php if($bib_files != ""):?>
						<a href="<?php echo $LINK; ?>" target="_blank" class="<?php echo strtolower($arqExt); ?>">#</a>
						<?php endif; ?>
					</div>
				</article>





				<?php endfor;
			
	  	else:
			exit();
		endif;
							
			echo $divPub == true? '</div>':'';				
	   ?>





			</div>
		</div>
</section>
<script>
	var $elemento = '#publication article';
	var $alvo = '#publication';
	var $categoria = '<?php echo $_GET['
	queryStr '];?>';
	var $url = '<?php echo $_SESSION["URL_BASE"];?>/nav/post.biblioteca.php'



	$( '#publication' ).endScroll( function ( event ) {


		var retorno = carregarComAjax( {
			url: $url,
			alvo: $alvo,
			elemento: $elemento,


		}, {
			categoria: $categoria,
			iniciarNo: $( '#publication article' ).count(),

		} );

		console.log( retorno )
	} );
</script>