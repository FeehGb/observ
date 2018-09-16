<?php date_default_timezone_set('America/Sao_Paulo');?>
<script>
    $(document).ready(function (e) {
		$(".slider-loader").html("<div class='load wraping'>Carregando</div>");
	
		
        var Main = Main || {};
		
        $(window).load(function () {
			$("#main-image").slider();	
			
            $("a.scroll").click(function () {
                $($(this).data('alvo')).animatescroll({
                    easing: "easeInOutExpo",
                    scrollSpeed: 1250,
                    padding: 79,
                    element: "html,body"
                });
            });


         



            $(window).scroll(function () {

                $("article").each(function (index, element) {

                    var offset = $(this).offset().top - 80;
                    var sibling = $(this).next();
                    var scrollset = $(window).scrollTop();

                    if (scrollset >= offset && scrollset < sibling.offset().top - 80) {
                        $(".sub-exp li").removeClass("a-active");
                        $(".sub-exp li." + $(this).attr("id")).addClass("a-active");
                    }

                });
            })
        });


        $(".exp").click(function () {
            $(".sub-exp").toggleClass("open");
            $class = $(".sub-exp").attr("class");

            if ($class == "sub-exp") {
                $(".sub-exp").stop(true, false).animate({
                    "margin-left": -270,
                    opacity: 0
                }, "slow", "easeInOutExpo")
                $("#goback").stop(true, false).animate({
                    "margin-left": 0
                }, "slow", "easeInOutExpo");
            } else {

                $(".sub-exp").stop(true, false).animate({
                    "margin-left": 0,
                    opacity: 1
                }, "slow", "easeInOutExpo");
                $("#goback").stop(true, false).animate({
                    "margin-left": -120
                }, "slow", "easeInOutExpo")
            }

        });

    });
	
	
	
</script>

<section id="one-content"> 
  <!--<div class="wrap">
    <div class="observatorio-logo"> </div>
  </div>-->
  <article id="inicio" class="parallax" data-speed="7">
    <div class="slider-loader"></div>
    <div id="main-image"> <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/one-content-bg.jpg&w=1366&h=768"  data-description="<h1><a>PELA VALORIZAÇÃO</a></h1><span> DO TRABALHO, DA SAÚDE E DA VIDA!</span>" />
      <?php $r = DB__query::__SELECT( "observ_noticias", "checked,
				checked_data,
				observ_noticias.not_titulo as titulo,
				observ_noticias.not_subtitulo as subtitulo,
				observ_noticias.not_img as imagem,
				observ_noticias.not_slug as link,
				observ_noticias.not_type as categoria
							
				", "WHERE checked = 1 UNION (SELECT 
				
				checked,
				checked_data,
				observ_biblioteca.bib_titulo as titulo,
				observ_biblioteca.bib_subtitulo as subtitulo,
				observ_biblioteca.bib_img as imagem,
				observ_biblioteca.bib_files as link ,
				observ_biblioteca.bib_categoria as categoria
				
				
				
				FROM observ_biblioteca WHERE checked = 1) ORDER BY checked_data DESC LIMIT 0,4
				"); 
				
			if (DB__query::$num_row>= 1){ 
				
				$field = (array_keys($r[data][output][0])); 
				
				for ($i = "0"; $i< DB__query::$num_row; $i++){ 
					
					$DB_query->catch_($field,$i); 
								
					$url 		= $noticia_url_base."".$link; 
					$dtq_fonte 	= "noticias"; 
					$allow 		= array("artigos_cientificos","livros","revistas","teses","boletins","outros"); 
					
					if(in_array($categoria,$allow)) { 
						if($link){ 
							$arqExt 	= explode('.', $link); 
							$url 		= $_SESSION["URL_BASE"]."/uploads/biblioteca/arquivos/". end($arqExt)."/".$link; }else {$url = "#";} 
							$dtq_fonte = "biblioteca"; 
						} ?>
      <img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"]?>/uploads/<?php echo $dtq_fonte;?>/imagens/<?php echo $imagem;?>&w=1366&h=768"  data-description="<h1><a href='<?php echo $url;?>'><?php echo $titulo;?></a></h1><span><?php echo $subtitulo; ?></span>" />
      <?php }
		} ?>
    </div>
  </article>
  <article id="sobre">
    <div class="wrap">
      <header>
        <h1 class="title-feat">Quem <span class="NexaBold">somos? </span></h1>
        <p class="p-feat">O Observatório do Mundo do Tabaco é um site que busca compilar e disponibilizar ao leitor, todas as informações sobre o tema, desde notícias publicadas na mídia semanalmente, à livros, revistas, estudos científicos publicados, entre outros,
          além de vídeos e fotografias, com o intuito de disseminar a informação e contribuir para a construção da opinião pública sobre o assunto.</p>
        <!--<p class="p-feat">Aqui você também pode se manter on-line no chat da página e conversar com outras pessoas que também estiverem on-line sobre o tema, trocando informações e opiniões, desenvolvendo maior conhecimento sobre o tema.</p>--> 
      </header>
      <div id="parceiros">
        <h2 class="title-feat">NOSSOS <span class="NexaBold">Parceiros</span></h2>
        <div id="act" class="block">
          <div class="module"> <a target="_blank" href="http://actbr.org.br/"><img width="240" height="80" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/act.png" /></a> </div>
        </div>
        <div id="deser" class="block">
          <div class="module"> <a target="_blank" href="http://www.deser.org.br/"><img width="300" height="149" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/deser.png" /></a> </div>
        </div>
        <div id="tfk" class="block">
          <div class="module"> <a target="_blank" href="http://www.tobaccofreekids.org/"><img width="134" height="132" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/TFK.png" /></a> </div>
        </div>
      </div>
      <div id="midiasocial">
        <h2 class="title-feat">Encontre-nos <span class="NexaBold"></span></h2>
        <div class="block">
          <div  id="face-icon" class="module"> <a target="_blank" href="https://www.facebook.com/observatoriodomundodotabaco"><img width="" height="" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/FB_FindUsOnFacebook-320.png" /></a>
            <div class="fb-like" data-width="250" data-href="https://www.facebook.com/observatoriodomundodotabaco" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
          </div>
        </div>
        <div class="block">
        
          <div  id="twit-icon" class="module"> <a target="_blank" href="https://twitter.com/obsertabaco"><img width="" height="" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/TW_FindUsOnTwitter-320.png" /></a>
          <a href="https://twitter.com/obsertabaco" class="twitter-follow-button" data-show-count="true" data-size="large" data-dnt="true">Follow @obsertabaco</a>
 </div>
        </div>
      </div>
    </div>
  </article>
  <article id="conteudos">
    <header>
      <div class="wrap">
        <h1 class="title-feat">NOSSO <span class="NexaBold">TRABALHO</span></h1>
      </div>
    </header>
    <div class="wrap">
      <section class="content">
        <div id="cnt-content">
          <header> 
            <!--<h3 class="title-about">Somos Um Observatório do Mundo do Tabaco que visa compilar tudo sobre o tabaco com:</h3>--> 
          </header>
          <div id="news" class="block">
            <div class="module"> <a href="<?php echo $_SESSION["URL_BASE"];?>/noticias"><img width="167" height="127" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/news.png" /></a>
              <h4>Notícias</h4>
              <p>Uma galeria com inúmeras notícias sobre o tema, publicadas no Brasil e no Mundo, organizadas para a sua pesquisa e leitura.</p>
            </div>
          </div>
          <div id="blib" class="block">
            <div class="module"> <a href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca"><img width="184" height="173" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/biblio.png" /></a>
              <h4>Biblioteca</h4>
              <p>Aqui você encontrará livros, teses/dissertações, boletins e demais publicações sobre o tema, também publicadas no Brasil e no Mundo, onde você também pode interagir e e publicar seus estudos!</p>
            </div>
          </div>
          <div id="bndd" class="block">
            <div class="module"> <a href="#"><img width="167" height="127" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/bd.png" /></a>
              <h4>Banco de dados</h4>
              <p>Que contém inúmeros dados compilados de pesquisas, produção, consumo, exportações entre outros, prontos para seu uso!</p>
            </div>
          </div>
          <!--<div>
            <header>
              <h3 class="title-about">Usando as melhores formas de interagir e compartilhar o que encontramos e fazemos</h3>
            </header>
          </div>
          <div id="imgs" class="block">
            <div class="module"><img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/gallery.png" />
              <h4>Galería de fotos</h4>
              <p>Registros de imagens da produção do tabaco em todas as suas etapas.</p>
            </div>
          </div>
          <div id="tube" class="block">
            <div class="module"><img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/tube.png" />
              <h4>Vídeos</h4>
              <p>Com assuntos relacionados ao Mundo do Tabaco, divulgados na mídia em geral ou produzidos pelos nossos parceiros.</p>
            </div>
          </div>
          <div id="song" class="block">
            <div class="module"><img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/style/imgs/sound.png" />
              <h4>Áudio</h4>
              <p>Contendo entrevistas importantes e diversos programas de rádio, incluindo os programas Mundo do Tabaco, uma parceria entre ACTBr e as Abraços.</p>
            </div>
          </div>--> 
        </div>
      </section>
    </div>
  </article>
  <article id="contato">
    <header>
      <div class="wrap">
        <h1 class="title-feat">FALE <span class="NexaBold">CONOSCO</span></h1>
        <p class="p-feat">Tem alguma <span class="NexaBold">dúvida</span>, <span class="NexaBold">sugestão</span>, <span class="NexaBold">reclamação</span> ou gostaria de ver <span class="NexaBold">seu trabalho</span> publicado no site? entre em contato conosco.</p>
      </div>
    </header>
    <div class="wrap">
      <div id="wrap-form">
        <form name="form" id="form-contact" action="" method="POST" novalidate>
          <fieldset>
            <p class="p_form">
              <input type="text" name="nome" id="nome" maxlength="50" placeholder="Nome">
            </p>
            <p class="p_form">
              <input type="text" name="email" id="email" maxlength="60" placeholder="E-mail">
            </p>
            <!-- <p class="p_form">
                <input type="text" name="telefone" id="telefone" placeholder="Seu telefone" class="valid">
              </p>
              <p class="p_form">
                <input type="text" name="assunto" maxlength="50" id="assunto" placeholder="Assunto">
              </p>-->
            <p class="p_form textarea">
              <textarea name="mensagem" id="mensagem" placeholder="Escreva uma mensagem"></textarea>
              <span id="charsLeft"></span> </p>
            <input type="hidden" name="data" id="data" value="<?php echo date("d/m/Y"). " as ". date("H:i") ?>">
          </fieldset>
          <input name="enviar" type="submit" class="button" value="enviar">
        </form>
      </div>
      <script type="text/javascript">
                $(document).ready(function () {
                    //Mascara para o input telefone
                    $('#mensagem').truncate({
                        limit: "1000"
                    });
                    $("#form-contact").validate({

                        rules: {
                            nome: {
                                required: true,
                                minlength: 3
                            },
                            email: {
                                required: true,
                                email: true
                            },

                            mensagem: {
                                required: true,
                                maxlength: 1000
                            },

                        },

                        messages: {
                            nome: {
                                required: "Oops...! Coloque o seu nome, precisamos te conhecer um pouco melhor, <strong>Nome</strong> esta em branco.",
                                minlength: "O nome deve ter no minimo 3 caracteres!!"
                            },
                            email: {
                                required: "Oops...! coloque seu <strong>email</strong> para nos o responder, <strong>E-mail</strong> esta em branco.",
                                email: "Email Inválido...!"
                            },
                            mensagem: {
                                required: "Oops..! Acho que você esqueceu de <strong>escrever</strong> alguma coisa, <strong>Mensagem</strong> esta em branco.",
                                maxlength: "Campo com muitos caracteres!"
                            }

                        },

                        submitHandler: function (form) {
                            var dados = $(form).serialize();
                            var a = $.ajax({
                                type: "POST",
                                url: "<?php echo $_SESSION["URL_BASE"];?>/addons/php/send.php",
                                data: dados,
                                beforeSend: function () {
									$("input[name='enviar']").hide();
                                    $('#form-contact').append('<div class="loading_form"><span><span class="NexaBold">Enviando</span>, aguarde...<span></div>');
                                },
                                success: function (data) {
                                    
                                    alert(data,
										{	
											title: 'Envio de E-mail autorizado!',
											button: 
											{
												positive: "ok entendi!"
											}
										},function()
										{
											$('.loading_form').fadeTo('fast', 0).hide('fast', function () {
												$(".loading_form").remove();
												$("input[name='enviar']").show();
											});
										}
									);
									
									
                                },
                                error: function (xhr, ajaxOptions, thrownError, data) {
                                    $('.loading_form').remove();
                                    console.log("error: \n thrownError - " + thrownError + "\n data - " + data + "\n ajaxOptions - " + ajaxOptions + "\n xhr - " + xhr);
                                }
                            });

                            return false;
                        }
                    });
                });
            </script> 
    </div>
  </article>
  <article></article>
</section>
