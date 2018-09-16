<?php

require_once("../../../addons/php/addons.fn.php");
require_once("../../../Connections/db.class.php");


__POST("id_requisitado","origem");

if (!empty($origem)):

	switch ($origem):
		case "biblioteca":
			$_TAG	= "bib_";
		break;
		case "noticias":
			$_TAG	= "not_";
		break;
	endswitch;

	$r = DB__query::__SELECT("observ_".$origem, "*", "WHERE ".$_TAG."id = '".$id_requisitado."'");
	$field = (array_keys($r[data][output][0]));
	$DB_query->catch_($field);
	
	$path = "../../../uploads";
	$oldpath = getcwd();
	
	DB__query::__DELETE("observ_".$origem, $_TAG."id = '".$id_requisitado."'");
	
	if(DB__query::$num_row >= '1' && DB__query::$success):
		
			chdir($path."/".$origem."/imagens");
			if (file_exists($GLOBALS[$_TAG."img"])) unlink($GLOBALS[$_TAG."img"]);
			
			
			if(isset($GLOBALS[$_TAG."files"])):
				$x = explode('.', $GLOBALS[$_TAG."files"]);
				$ext = end($x);
			
				chdir($oldpath);
				chdir($path.'/'.$origem.'/arquivos/'.$ext.'/');
				if (file_exists($GLOBALS[$_TAG."files"])) unlink($GLOBALS[$_TAG."files"]);
			endif;
			
			

	endif;
endif;




?>