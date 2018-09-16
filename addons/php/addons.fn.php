<?php

function delimiter($str,$start,$finish)
{
	if($start)
	{
		$pattern[0] = "/".$start."[^>]*".$finish."/";				
		return preg_replace($pattern,$finish,$query); 
	}
	else
	{
		return false;	
	}
}

function active($page,$source, $index = false){
		
		$ativo = "";
		if ($source == $page) {
			$ativo = " a-active";
		}elseif($source == "" && $index == true){
			$ativo = " a-active";
		}
		echo $ativo;
}
function str_truncate($texto, $limite){
	
	$texto = preg_replace("/<img.*?>/", "", $texto);
    $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' '));
    return $texto;
}

function __POST()
{
	$_args 	= func_get_args();
	if (is_array($_args))
	{
		foreach ($_args as $POST)
		{
			$GLOBALS[ "$POST" ] = $_POST[ "$POST" ];
		}
	}
}
function __GET()
{
	$_args 	= func_get_args();
	if (is_array($_args))
	{
		foreach ($_args as $GET)
		{
			$GLOBALS[ "$GET" ] = $_GET[ "$GET" ];
		}
	}
}
function __FILE()
{
	$_args 	= func_get_args();
	if (is_array($_args))
	{
		foreach ($_args as $FILE)
		{
			$GLOBALS[ "$FILE" ] = $_FILES[ "$FILE" ];
		}
	}
}

function format_date($date)
{
	$entry = trim($date);
	if (strstr($entry, "/"))
	{
		$date      = explode("/", $entry);
		$time      = date('H:i:s');
		$formatted = $date[ 2 ] . '-' . $date[ 1 ] . '-' . $date[ 0 ] . ' ' . $time;
	}
	return $formatted;
}

function url_slugs($str, $replace=array(), $delimiter='-', $maxLength=200) {

	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("%[^-/+|\w ]%", '', $clean);
	$clean = strtolower(trim(substr($clean, 0, $maxLength), '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}
function url_slug($str){
 
    $str = strtolower(utf8_decode($str)); $i=1;
    $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûüýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuuyyy');
    $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
    while($i>0) $str = str_replace('--','-',$str,$i);
    if (substr($str, -1) == '-') $str = substr($str, 0, -1);
    return $str;
 
 
} 


?>