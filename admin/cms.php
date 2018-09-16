<?php
	require_once("../config.php");
	require_once ROOTADMPATH."addons/php/restrict_admin.php";
	
	define( 'path', ROOTADMPATH . "nav" );
	$current_page  	= strtolower( $_GET['query'] );
	
	$released_page = array(
		"home",
		"noticias",
		"biblioteca",
		"multimidia",
		"arquivos",
		"gerenciador_de_imagens"
	);	
	
	$NOT_FOUND = $_SESSION["NOT_FOUND"];
	ob_start();
	if ( ( $current_page == "" ) || ( isset( $current_page ) && ( in_array( $current_page, $released_page ) ) ) )
	{
		unset($_SESSION["NOT_FOUND"]);
		require_once( ROOTADMPATH . "header.php" );
		
		//var_dump($_SESSION);
		switch ( $current_page )
		{
			case "":
				
				require_once( path . "/home.php" );
				break;
			default:
				echo path . '/' . $current_page . '.php';
				require_once( path . '/' . $current_page . '.php' );
				break;
		}
		#incluindo o footer
		require_once( ROOTADMPATH . 'footer.php' );
		
	}
	else
	{
		require_once(ROOTPATH."addons/html/error404.php");
	}
	ob_end_flush(); 
	
	
	?>