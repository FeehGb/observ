<?php

@header( 'Content-Type: text/html; charset=iso-8859-1' );
require_once("../../Connections/db.class.php");




if ( isset( $_GET['action'] ) )
{
    $action = $_GET['action'];
    $action();
}

function fulltrim( $str )
{
    return trim( preg_replace( '/\s+/', ' ', $str ) );
}

function updateAlbumName()
{
    $album_name = fulltrim( $_POST['album_name'] );
    $album_name = utf8_decode($album_name);
    $album_id = $_POST['album_id'];
	$r = DB__query::__UPDATE("observ_albuns", "album_name", $album_name, "where album_id = $album_id");
	
    echo 'Álbum Atualizado: <Br/>' . $album_name;
}

function updateFotoCover()
{
    $foto_album = $_POST['foto_album'];
    $foto_id = $_POST['foto_id'];
	
	DB__query::__UPDATE("observ_fotos ", "foto_pos", "1", "where foto_album = $foto_album");
	DB__query::__UPDATE("observ_fotos", "foto_pos", "0", "where foto_id = $foto_id");
	
    echo 'Cover Atualizado <Br/>';
}

function updateFotoName()
{
    $foto_caption = fulltrim( $_POST['foto_caption'] );
    $foto_info = fulltrim( $_POST['foto_info'] );
    $foto_id = preg_replace( '/f\_/', '', fulltrim( $_POST['foto_id'] ) );
	
	$fields = array("foto_caption","foto_info");
	$values = array($foto_caption,$foto_info);
	
	DB__query::__UPDATE("observ_fotos", $fields, $values, "WHERE foto_id = $foto_id");
	
	
    echo 'Foto Atualizada<Br/>' . $foto_caption;
}

function deleteFoto()
{	
	
	$oldpath = getcwd();
	$foto_id = $_POST['foto_id'];

	$r = DB__query::__SELECT("observ_fotos", "*", "where foto_id = $foto_id");
	$foto_url = (($r[data][output][0][foto_url]));
	
	if ( DB__query::$num_row >= 1 )
	{	
	
		chdir($oldpath);
		chdir("../../uploads/galeria/imagens/");

		
		if ( file_exists( $foto_url ) )
		{
			@unlink( $foto_url  );
			DB__query::__DELETE("observ_fotos", "foto_id = '".$foto_id."'");
		}
		
	}
	
	
	
    echo 'Foto Removida<Br/> ';
}
function updateVideoPos()
{
    extract( $_POST );
    parse_str( $item, $arr );
    foreach ( $arr['item'] as $pos => $foto_id )
    {
		$r = DB__query::__UPDATE("observ_fotos", "foto_pos", $pos, "WHERE foto_id = $foto_id");
    }
}

?>