<?php 
  /*
   * Inicia a sessão caso nao exista
   */
  if ( !isset( $_SESSION ) )
  {
	  session_start();
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Error 404 - Pagina não encontrada...!</title>
<link href="<?php echo $_SESSION["URL_BASE"];?>/style/img/favicon.png" rel="SHORTCUT icon" type="image/x-icon" />
<link href="<?php echo $_SESSION["URL_BASE"] ?>/style/error404.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="page" class="error404">
  <header>
    <nav>
      <div id="menu">
        <ul id="nav">
          <li class="blue"> <a class="box-t"		href="<?php echo $_SESSION["URL_BASE"];?>">HOME</a></li>
          <li class="red"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/noticias/">NOTÍCIAS</a></li>
          <li class="blue"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/biblioteca/">BIBLIOTECA</a> </li>
          <li class="red"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/multimidia/">MULTIMÍDIA</a> </li>
          <li class="blue"> <a class="box-t"  		href="<?php echo $_SESSION["URL_BASE"];?>/banco-de-dados/">BANCO DE DADOS</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <section>
    <article id="error404"></article>
  </section>
</div>
</body>
</html>