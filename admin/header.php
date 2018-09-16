<?php
	!defined("PAGINA_ATUAL") ?	define("PAGINA_ATUAL",	$_GET['query'])		:"";
	!defined("CATEGORIA")	 ?	define("CATEGORIA",		$_GET['category'])	:"";
	!defined("TIPO_MULT") 	 ?	define("TIPO_MULT",		$_GET['type'])		:"";
	
	if(CATEGORIA!="") 	$_category 	= " » ".str_replace("_"," ",ucfirst(CATEGORIA));
	if(TIPO_MULT!="") 	$_type 		= " » ".ucfirst(TIPO_MULT);
	
	$_queryStr = (PAGINA_ATUAL == "home" || PAGINA_ATUAL == "") ?"":ucfirst(PAGINA_ATUAL);
	
?>

<!doctype html>
<html>
<head>
<title>Observatório do tabaco</title>
<?php require_once ROOTPATH."addons/html/metatags.php"?>
<?php require_once ROOTADMPATH."load.sy.js.php";?>
</head>
<body>
<div id="page" class="administracao">
<!--Header-->
<header id="top">
  <div id="scrool-top"></div>
  <div id="wrap-top">
    <div id="block-header">
      
      <div class="wrap">
        <div id="logo"><a href="<?php echo $_SESSION["URL_BASE"];?>"></a></div>
        <nav id="menu-nav"> 

          <ul id="nav">
            <li class="home<?php active("home",$current_page,true);?>"> <a class="box-t"		href="<?php echo $_SESSION["URL_BASE"];?>">HOME</a></li>
            
            <li class="noticias<?php active("noticias",PAGINA_ATUAL);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_BASE"];?>/noticias/">NOTÍCIAS</a></li>
            <li class="biblioteca<?php active("biblioteca",PAGINA_ATUAL);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca">BIBLIOTECA</a>
              <ul class="sub-nav">
                <li class="<?php active("artigos_cientificos",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=artigos_cientificos">artigo cientifico</a> </li>
                <li class="<?php active("livros",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=livros">livros</a> </li>
                <li class="<?php active("revistas",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=revistas">revistas</a> </li>
                <li class="<?php active("teses",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=teses">Teses e Dissertações</a> </li>
                <li class="<?php active("boletins",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=boletins">boletins</a> </li>
                <li class="<?php active("demais_publicacoes",CATEGORIA);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=biblioteca&category=demais_publicacoes">demais publicações</a> </li>
              </ul>
            </li>
            <li class="multimidia<?php active("multimidia",PAGINA_ATUAL);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=multimidia">MULTIMÍDIA</a>
              <ul class="sub-nav">
                <li class="galeria<?php active("galeria",TIPO_MULT);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/gerenciador-de-imagens/">GALERIA</a></li>
                <li class="videos<?php active("videos",TIPO_MULT);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=multimidia&type=videos">VÍDEOS</a></li>
                <li class="audio<?php active("audio",TIPO_MULT);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=multimidia&type=audio">ÁUDIO</a></li>
              </ul>
            </li>
            <li class="arquivos<?php active("arquivos",PAGINA_ATUAL);?>"> <a class="box-t" href="<?php echo $_SESSION["URL_ADM_BASE"];?>/cms.php?query=arquivos">ARQUIVOS</a></li>
          </ul>
          <div class="p_search">
         
          <form method="GET" action="<?php echo $_SESSION["URL_BASE"];?>/busca/">
            <fieldset>
              <input type="text" name="q" id="search" maxlength="50" placeholder="Encontre">
              <input type="hidden" name="tipo" id="tipo" maxlength="50" placeholder="Encontre" value="noticias">
              <input type="submit" id="search_btn" value="OK" />
            </fieldset>
          </form>
          </div>
          
        </nav>
      </div>
    </div>
  </div>
</header>
<!--Fim Header-->
<section id="attached">
