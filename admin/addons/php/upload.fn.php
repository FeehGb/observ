<?php
	/*
	* Precisa definir isso antes do upload
	*/
	//if(!defined(ALLOWED_FILE_EXTENSIONS) ) define('ALLOWED_FILE_EXTENSIONS', 'pdf, doc, docx, xls');
	//if(!defined(FOLDER_PATH) ) define('FOLDER_PATH', 'uploads/files/');

	function clean_file_name($filename){
		$invalid = array("<!--","-->","'","<",">",'"','&','$','=',';','?','/',"%20","%22","%3c","%253c","%3e","%0e","%28","%29","%2528","%26","%24","%3f","%3b", "%3d");		
		$filename = str_replace($invalid, '', $filename);
		$filename = preg_replace("/\s+/", "_", $filename);
		return stripslashes($filename);
	}
	
	function set_filename($path, $filename){
		$filename = clean_file_name($filename);
		$file_ext = GetExtension($filename);
		if ( ! file_exists($path.$filename)){
			return $filename;
		}
		$new_filename = str_replace('.'.$file_ext, '', $filename);
		for ($i = 1; $i < 300; $i++){			
			if ( ! file_exists($path.$new_filename.'_'.$i.'.'.$file_ext)){
				$new_filename .= '_'.$i.'.'.$file_ext;
				break;
			}
		}
		return $new_filename;
	}
	
	
	function GetExtension($filename){
		$x = explode('.', $filename);
		return end($x);
	}
		
	function ValidFileExtension($name){
		$allowed_extensions = explode(',', ALLOWED_FILE_EXTENSIONS);
		$extension = strtolower(GetExtension($name));
		if (in_array($extension, $allowed_extensions, TRUE)){
				return true;
		} else {
				return false;
		}
	}
		
	function DoUpload($field = 'userfile'){
		$output = array();
		$output["success"] = true;
		
		$current_folder = FOLDER_PATH;
		
		if(!isset($_FILES[$field])){
			$output["reason"] = "File not selected.";
			$output["success"] = false;
			return $output;
		}
		
		if(!is_uploaded_file($_FILES[$field]['tmp_name'])){
			$error = (!isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];
			$output["success"] = false;
			switch($error){
				case 1:	// UPLOAD_ERR_INI_SIZE
					$output["reason"] = "Arquivo excedeu o limite de tamanho.";
					break;
				case 2: // UPLOAD_ERR_FORM_SIZE
					$output["reason"] = "Arquivo excedeu o limite de tamanho";
					break;
				case 3: // UPLOAD_ERR_PARTIAL
					$output["reason"] = "File uploaded partially.";
					break;
				case 4: // UPLOAD_ERR_NO_FILE
					$output["reason"] = "Arquivo não selecionado.";
					break;
				case 6: // UPLOAD_ERR_NO_TMP_DIR
					$output["reason"] = "Sem pasta Temporária";
					break;
				case 7: // UPLOAD_ERR_CANT_WRITE
					$output["reason"] = "Unable to write the file.";
					break;
				case 8: // UPLOAD_ERR_EXTENSION
					$output["reason"] = "Extenção do arquivo invalida";
					break;
				default :   
					$output["reason"] = "File not selected.";
					break;
			}
	
			return $output;
		}
		
		if(!ValidFileExtension($_FILES[$field]['name'])){
			$output["reason"] = "Extenção do arquivo invalida, permitido apenas: ".ALLOWED_FILE_EXTENSIONS;;
			$output["success"] = false;
			return $output;
		}
	
		$file_name = set_filename($current_folder, $_FILES[$field]['name']);
		
		if (!is_dir($current_folder))
		{
			mkdir($current_folder, 0777, true);
		}
		if(!@copy($_FILES[$field]['tmp_name'], $current_folder.$file_name)){

			if(!@move_uploaded_file($_FILES[$field]['tmp_name'], $current_folder.$file_name)){
				$output["reason"] = "Could not move file.";
				$output["success"] = false;
				return $output;
			}
		}
		
		
		return $saida = array("saida" => $output,"nomeDoArquivo" => $file_name); ;
	}


?>