<?php
		require_once("../../../config.php");
		//INFO IMAGEM
		$file 		= $_FILES['img'];
		$numFile	= count(($file['name']));
		
		//PASTA
		$folder		= '../../../uploads/multimidia/imagens';
		if (!is_dir($folder))
		{
			mkdir($folder, 0777, true);
		}
		
		//REQUISITOS
		$permite 	= array('image/jpeg', 'image/png');
		$maxSize	= 1024 * 1024 * 5;
		
		//MENSAGENS
		$msg		= array();
		$errorMsg	= array(
			1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
			2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
			3 => 'o upload do arquivo foi feito parcialmente',
			4 => 'Não foi feito o upload do arquivo'
		);
		
		if($numFile <= 0)
			echo 'Selecione uma Imagem!';
			else if($numFile >= 6)
		{
			echo 'So 5 arquivos de upload por vez =/';
		}
			else
		{
			for($i = 0; $i < $numFile; $i++){
				$name 	= $file['name'][$i];
				$type	= $file['type'][$i];
				$size	= $file['size'][$i];
				$error	= $file['error'][$i];
				$tmp	= $file['tmp_name'][$i];
				
				$extensao = @end(explode('.', $name));
				$novoNome = md5(uniqid(rand(), true)).".$extensao";
				
				if($error != 0)
					$msg[] = "<b>$name :</b> ".$errorMsg[$error];
				else if(!in_array($type, $permite))
					$msg[] = "<b>$name :</b> Erro imagem não suportada!";
				else if($size > $maxSize)
					$msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
				else{
					
							
					if(move_uploaded_file($tmp, $folder.'/'.$novoNome)):
						$fields = array("img_nome","img_nomereal","img_data","img_usuario");
						$values = array("unnamed",$novoNome,format_date(date("d/m/Y")),$_SESSION[ 'MM_Username' ]);
						DB__query::__INSERT("observ_imagem", $fields, $values);
						
						
						
					else:
					
						echo "<b>$name :</b> Desculpe! Ocorreu um erro...";
						
					endif;
				
				}
				
				
			}
		}
