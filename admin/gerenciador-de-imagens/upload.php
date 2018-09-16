<?php

require_once("../../Connections/db.class.php");
require_once("../../addons/php/crop.class.php");



$file_dst_name = "";
$album_id = $_GET['album_id'];

$dir_dest = '../../uploads/galeria/imagens';

$file = $_FILES['Filedata'];
		

		$crop = new crop($_FILES['Filedata']);
		$crop->maxMb(10)->resize("")->saveIn($dir_dest)->crop("center");

		if($crop->created != NULL){
			chdir($dir_dest);
			if(file_exists($currentIMG) )unlink($currentIMG);
			
			
			$file_dst_name = $crop->img_name;
            $foto_data = date( 'd-m-Y 00:00:00' );
			
			$fields = array("foto_album","foto_url"			,"foto_data"	,"foto_pos");
	   		$values = array("$album_id"	,"$file_dst_name"	,"$foto_data"	,'999');
	   
			$r = DB__query::__INSERT("observ_fotos", $fields, $values);
			$last_id = DB__query::$lastInsertId;
			
            echo json_encode( array( 'url' => "$file_dst_name", 'id' => $last_id, 'time' => time() ) );
			
		}
		else
		{
			$error = "<b>Oops! Um erro:</b> Imagem nao cadastrada tente com outra imagem<br />";
			    echo json_encode( array( 'url' => "error", 'id' => '', 'time' => time() ) );
        
		}
		chdir($oldpath);

?>
