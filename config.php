<?php
	if (!isset($_SESSION))
	{ 
		session_start();
	}
	
	
	define( 'ROOTPATH', 	dirname( __FILE__ ) . '/' ); 
	define( 'PHPSCRPATH', 	ROOTPATH . 'addons/php/' );
	define( 'ROOTADMPATH', 	ROOTPATH . 'admin/' );
	define( 'SERVER_NAME', 	$_SERVER[ 'SERVER_NAME' ] );
	define( '_URI', 		$_SERVER[ 'REQUEST_URI' ] );
	define( 'MOSTRAR_NO_MAXIMO', 15);
	define( 'PATH', ROOTPATH . "nav" );
	
	$_SESSION["URL_BASE"] 		= $_SERVER['REQUEST_SCHEME']."://" . SERVER_NAME;
	$_SESSION["URL_ADM_BASE"] 	= $_SERVER['REQUEST_SCHEME']."://" . SERVER_NAME."/admin";
	$_URI          				= explode( "/", _URI );
	
	
	$current_page  = strtolower( $_URI[1] );

	
	require_once(ROOTPATH."Connections/db.class.php");
	require_once( PHPSCRPATH."addons.fn.php" );
	
	/*
	*	CONFIG DE PAG
	*/
	$noticia_url_base = isset($_SESSION['USER_AUTHORIZED']) ? $_SESSION["URL_ADM_BASE"].'/cms.php?query=noticias&slug=':$_SESSION["URL_BASE"].'/noticias/';

?>