<?php

$css    = '<link href="' . $_SESSION["URL_BASE"] . '/style/page-style.css" rel="stylesheet" type="text/css" />';
$script = '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.js"></script>';
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.js"></script>';
//$script .= '<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>';
//$script .= '<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>';



switch ($current_page)
{
	case 'home':
	case '':
	

	$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.form.js"></script>';
		
		break;
	case 'noticias':
	case 'biblioteca':
		
		break;
	case 'multimidia':
		$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/shadowbox.js"></script>';
		$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/plugins/AutomaticImageMontage/js/jquery.montage.min.js"></script>';
		
		
		
		$css    .= '<link href="' . $_SESSION["URL_BASE"] . '/addons/plugins/AutomaticImageMontage/css/style.css" rel="stylesheet" type="text/css" />';
		$css    .= '<link href="' . $_SESSION["URL_BASE"] . '/style/shadowbox.css" rel="stylesheet" type="text/css" />';
	break;
}
echo $css;
echo $script;
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50137792-1', 'observatoriodotabaco.com.br');
  ga('send', 'pageview');

</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



