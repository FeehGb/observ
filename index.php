<?php
	
	require ("config.php");
	$released_page = array(
		"home",
		"noticias",
		"biblioteca",
		"multimidia",
		"banco-de-dados",
		"busca",
		"topico",
		"files",
		"admin"
	);	
	$NOT_FOUND = $_SESSION["NOT_FOUND"];
	
	if ( ( $current_page == "" ) || ( isset( $current_page ) && ( in_array( $current_page, $released_page ) ) ) )
	{
		unset($_SESSION["NOT_FOUND"]);
		require_once( ROOTPATH . "header.php" );
		
	
		switch ( $current_page )
		{
			case "":
				require_once( PATH . "/home.php" );
				break;
			default:
				require_once( PATH . '/' . $current_page . '.php' );
				break;
		}
		#incluindo o footer
		require_once( ROOTPATH . 'footer.php' );
		
	}
	else
	{
		require_once(ROOTPATH."addons/html/error404.php");
	}