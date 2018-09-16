<!doctype html>
<html>
<head>
<title>Observatório do tabaco</title>
<?php require_once ROOTPATH."addons/html/metatags.php"?>
<?php require_once ROOTPATH."load.sy.js.php";?>
</head>
<body>
<div id="page">
<?php 
echo (dirname( __FILE__ ));
if (  $current_page == NULL or $current_page == "home"  ):?>

<nav id="menu-explore">
  <ul id="explore">
    <li class="explore"> <a class="exp" id="goback">NAVEGUE</a>
      <ul class="sub-exp">
        <span id="top-menu" class="exp">NAVEGUE</span>
        <li class="inicio"> <a class="box-t scroll" 	data-alvo="#inicio" >INÍCIO </a></li>
        <li class="sobre"> <a class="box-t scroll" 	data-alvo="#sobre">QUEM SOMOS? </a></li>
        <li class="conteudos"> <a class="box-t scroll" 	data-alvo="#conteudos">NOSSO TRABALHO </a></li>
        <li class="contato"> <a class="box-t scroll" 	data-alvo="#contato">FALE CONOSCO</a></li>
      </ul>
    </li>
  </ul>
</nav>
<?php endif;?>
<header id="top">
  <div id="scrool-top"></div>
  <div id="wrap-top">
    <div id="block-header">
      <div class="wrap">
        <div id="logo"><a href="<?php echo $_SESSION["URL_BASE"];?>"></a></div>
        <?php
   	if($_SESSION['USER_AUTHORIZED']):
	?>
        <nav id="menu-nav">
          <ul id="nav">
            <li class="home<?php active("home",$current_page,true);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_BASE"];?>">HOME</a></li>
            <li class="noticias<?php active("noticias",$current_page);?>"> <a class="box-t"  href="<?php echo $_SESSION["URL_BASE"];?>/noticias/">NOTÍCIAS</a></li>
            <li class="biblioteca<?php active("biblioteca",$current_page);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca">BIBLIOTECA</a>
              <ul class="sub-nav">
                <li class="<?php active("artigos_cientificos",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=artigos_cientificos">artigo cientifico</a> </li>
                <li class="<?php active("livros",$_GET[queryStr]);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=livros">livros</a> </li>
                <li class="<?php active("revistas",$_GET[queryStr]);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=revistas">revistas</a> </li>
                <li class="<?php active("teses",$_GET[queryStr]);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=teses">Teses e Dissertações</a> </li>
                <li class="<?php active("boletins",$_GET[queryStr]);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=boletins">boletins</a> </li>
                <li class="<?php active("demais_publicacoes",$_GET[queryStr]);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=demais_publicacoes">demais publicações</a> </li>
              </ul>
            </li>
            <li class="multimidia<?php active("multimidia",$current_page);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=multimidia">MULTIMÍDIA</a>
              <ul class="sub-nav">
                <li class="galeria<?php active("galeria",TIPO_MULT);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/#">GALERIA</a></li>
                <!-- cms.php?query=multimidia&type=imagens-->
                <li class="videos<?php active("videos",TIPO_MULT);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/#">VÍDEOS</a></li>
                <!-- cms.php?query=multimidia&type=videos-->
                <li class="audio<?php active("audio",TIPO_MULT);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/#">ÁUDIO</a></li>
                <!-- cms.php?query=multimidia&type=audio-->
              </ul>
            </li>
            <li class="arquivos<?php active("arquivos",$current_page);?>"> <a class="box-t"  			href="<?php echo $_SESSION["URL_ADM_BASE"];?>/#">ARQUIVOS</a></li>
          </ul>
          <div class="p_search">
            <form method="GET" action="<?php echo $_SESSION["URL_BASE"];?>/busca/">
              <fieldset>
                <input type="text" name="q" id="search" maxlength="50" placeholder="Encontre">
                <input type="hidden" name="tipo" id="tipo" maxlength="50" placeholder="Encontre" value="">
                <input type="submit" id="search_btn" value="OK" />
              </fieldset>
            </form>
          </div>
        </nav>
        <?php
		else:
	?>
        <nav id="menu-nav">
          <ul id="nav">
            <li class="home<?php active("home",$current_page,true);?>"> <a class="box-t"		href="<?php echo $_SESSION["URL_BASE"];?>">HOME</a></li>
            <li class="noticias<?php active("noticias",$current_page);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/noticias/">NOTÍCIAS</a></li>
            <li class="biblioteca<?php active("biblioteca",$current_page);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/">BIBLIOTECA</a>
              <ul class="sub-nav">
                <li class="<?php active("artigos_cientificos",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/artigos_cientificos">artigo cientifico</a> </li>
                <li class="<?php active("livros",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/livros">livros</a> </li>
                <li class="<?php active("revistas",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/revistas">revistas</a> </li>
                <li class="<?php active("teses",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/teses">Teses e Dissertações</a> </li>
                <li class="<?php active("boletins",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/boletins">boletins</a> </li>
                <li class="<?php active("demais_publicacoes",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/demais_publicacoes">demais publicações</a> </li>
              </ul>
            </li>
            <li class="multimidia<?php active("multimidia",$current_page);?>"> <a class="box-t"  		href="#">MULTIMÍDIA</a><!--multimidia/audio-->
              <ul class="sub-nav">
                <li class="galeria<?php active("galeria",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/multimidia/galeria">GALERIA</a></li>
                <li class="videos<?php active("videos",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/#">VÍDEOS</a></li>
                <li class="audio<?php active("audio",$_GET[queryStr]);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/#">ÁUDIO</a></li>
              </ul>
            </li>
            <li class="arquivos<?php active("banco de dados",$current_page);?>"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/#">BANCO DE DADOS</a></li><!--banco-de-dados-->
          </ul>
          <div class="p_search">
            <form method="GET" action="<?php echo $_SESSION["URL_BASE"];?>/busca/">
              <fieldset>
                <input type="text" name="q" id="search" maxlength="50" placeholder="Encontre">
                <input type="hidden" name="tipo" id="tipo" maxlength="50" placeholder="Encontre" value="">
                <input type="submit" id="search_btn" value="OK" />
              </fieldset>
            </form>
          </div>
        </nav>
        <?php

   	endif;
	?>
      </div>
    </div>
  </div>
</header>
<!--Fim Header-->
<section id="attached">
