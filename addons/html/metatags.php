<?php 
switch($current_page){
		case 'home':
		case '':
			
			$meta = '<meta name="description" content="Observatório do Tabaco - Tudo sobre o tabaco no Brasil e no Mundo.">';
			$meta .= '<meta name="keywords" content="Observatório do Tabaco, de Olho no mundo do tabaco, deser, Agricultura Familiar, Diversificação, Tabaco"/>';		

		break;
		
		case 'noticias':
			$meta .= '<meta property="fb:app_id" content="1411309372451325"/>';
			//$meta .= '<meta property="fb:admins" content="100000726657347"/>';
			$meta .= '<meta name="description" content="Observatório do Tabaco - Últimas notícias do tabaco no Brasil e no Mundo.">';
			if(isset($_GET['queryStr']))
			{
				$r = DB__query::__SELECT("observ_noticias", "*", "WHERE not_slug = '".$_GET[queryStr]."' ORDER BY not_id DESC LIMIT 0,1" );
				
				if (DB__query::$num_row >= 1){

					$field = (array_keys($r[data][output][0]));
					$DB_query->catch_($field);
					
					//facebook
					
					$meta .= '<meta name="keywords" 			content="Tabaco, noticias, diversificação,regulamentação,eventos,economia,safra,'.$not_tags.'" />';
					$meta .= '<meta name="author" 				content="'.$not_user.'" />';
					$meta .= '<meta property="og:type" 			content="article" />';
					$meta .= '<meta property="og:title" 		content="'.$not_titulo.'" />';
					$meta .= '<meta property="og:image" 		content="'.$_SESSION["URL_BASE"].'/uploads/noticias/imagens/'.$not_img.'" />';
					$meta .= '<meta property="og:description" 	content="'.$not_subtitulo.'" />';
					$meta .= '<meta property="og:url" 			content="'.$_SESSION["URL_BASE"]."/".$current_page."/".$_GET[queryStr].'" />';
					
				}
			}
			
			
		break;
		
		case 'biblioteca':
			
				$meta .= '<meta name="description" content="Observatório do Tabaco - Biblioteca completa com diversos arquivos e dados de pesquisa sobreo o tabaco.">';
				$meta .= '<meta name="keywords" content="Tabaco, Biblioteca, artigos cientificos,livros,revista,teses,boletins"/>';
		
	
		break;
		
		case 'multimidia':

		break;
		
	}
?>

<?php

$meta .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
$meta .= '<meta charset="utf-8">';
$meta .= '<meta name="title" content="OBESERVATÓRIO DO TABACO" />';
$meta .= '<meta name="url" content="'.$_SESSION["URL_BASE"].'" />';
$meta .= '<meta name="language" content="Portuguese, English" />';
$meta .= '<meta name="Distribution" content="Global" />';
$meta .= '<meta name="Designer" content="Felipe Augusto Gonçalves Basilio" />';
$meta .= '<meta name="Rating" content="General" />';
$meta .= '<meta name="robots" content="ALL" /> ';






echo $meta;
?>
<link href="<?php echo $_SESSION["URL_BASE"];?>/style/img/favicon.png" rel="SHORTCUT icon" type="image/x-icon" />
