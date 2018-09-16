<?php
if ( !isset( $_SESSION ) )
{
	session_start();
}
/*
**********************************************
			>>>>>>>>>>>>>>>>>>>>>
			manipulação de paginas
			>>>>>>>>>>>>>>>>>>>>>
**********************************************
*/


/**
* Aquivos com as principais Funções 
*/
require_once("../../../addons/php/addons.fn.php");
/**
* Class para conexão e manipulção do banco de dados
*/
require_once("../../../Connections/db.class.php");


/**
* Função _POST para capturar dados vindo do formulario pelo variavel $_POST[]
*/
__POST("acao", "origem","id_requisitado","query","tinyMCE","check_dtq","exb_checkbox");

if (!empty($origem))
{
	/**
	* Indentifica qual a pagina fonte
	*/	
	switch ($origem)
	{	
	
		/**
		* 
		* Captura os dados vindo da pagina de origem;
		* Cria a tag para minipulçao dos dados
		* Set os novos valores recebidos do formulario
		* 
		*/
		
		
		/*
		**********************************************
					>>>>>>>>>>>>>>>>>>>>>
						  BIBLIOTECA
					>>>>>>>>>>>>>>>>>>>>>
		**********************************************
		*/
		
		case "biblioteca":
			
			/**
			* 
			* Captura os dados vindo da pagina BIBLIOTECA;
			* 
			*/
			__POST("form_titulo", "form_subtitulo", "form_credito","form_tags");
			__FILE("_IMG_","FILE");
			
			$_TAG	= "bib_";
					
			$fields = array("bib_titulo",	"bib_subtitulo",	"bib_resumo",	"bib_credito", "bib_tags");
			$values = array(($form_titulo),	($form_subtitulo),	($tinyMCE),		($form_credito), $form_tags);
			
					
			
			/**
			* 
			* Executa a class de maipulão do banco TIPO SELECT
			* 
			*/
		
			DB__query::__SELECT("observ_biblioteca","*","WHERE bib_id = '$id_requisitado'");
			DB__query::fetch_("bib_img","bib_files");
			$currentIMG = $bib_img;
			
			if(!empty($query))
			{
				array_push($fields,"bib_categoria");
				array_push($values,$query);
			}

			break;
		
		
		/*
		**********************************************
					>>>>>>>>>>>>>>>>>>>>>
						   NOTICAS
					>>>>>>>>>>>>>>>>>>>>>
		**********************************************
		*/
		case "noticias":
		
			/**
			* 
			* Captura os dados vindo da pagina NOTICIAS;
			* 
			*/
			__POST("form_user", "form_titulo", "form_subtitulo", "form_credito", "form_content","form_tags","form_type");
			__FILE("_IMG_");
			
			$_TAG	= "not_";	
			$slug 	= url_slug($form_titulo);
					
			$fields = array("not_subtitulo",	"not_content",	"not_credito","not_tags","not_type");
			$values = array(($form_subtitulo),	($tinyMCE),	($form_credito), ($form_tags), $form_type);
			
			
			/**
			* 
			* Executa a class de maipulão do banco TIPO SELECT
			* 
			*/
			
			DB__query::__SELECT("observ_noticias","*","WHERE not_id = '$id_requisitado'");
			DB__query::fetch_("not_titulo","not_img","not_slug");
			if($not_titulo != $form_titulo or $form_titulo == ""){
				DB__query::__SELECT("observ_noticias","*","WHERE not_slug = '$slug'");
				if((DB__query::$num_row == "0"  && $form_titulo != "" && $slug != "cadastrar-nova-noticia"))
				{
					array_push($fields,"not_titulo","not_slug");
					array_push($values,$form_titulo,$slug);	
					
					
						
				}else{
					$error = "<b>Oops! Um erro:</b> Título ja em uso ou não permitido<br />";
				}
			}
			
			$currentIMG = $not_img;
		break;	
		
		
	}
	
	
	/**
	* Define onde sera efetuados os uploads
	*/
	$path = "../../../uploads";
	$oldpath = getcwd();

	if (!empty($_IMG_[name]))
	{	
		/**
		* Class para manipulçao de imagens
		*/
		require_once("../php/crop.class.php");
		
		/** 
		* Executa a class de maipulação de imagem
		*/
		$crop = new crop($_IMG_);
		$crop->maxMb(10)->resize("")->saveIn($path."/".$origem."/imagens")->crop("center");
		/**
		* 
		* Excluindo imagem caso ele exista no diretorio
		* 
		*/

		if($crop->created != NULL){
			chdir($path."/".$origem."/imagens");
			if(file_exists($currentIMG) )unlink($currentIMG);
			
			array_push($fields,$_TAG."img");
			array_push($values,$crop->img_name);
			
		}
		else
		{
			$error = "<b>Oops! Um erro:</b> Imagem nao cadastrada tente com outra imagem<br />";
		}
		chdir($oldpath);
	}

	if((!empty($FILE[name])))
	{
		
		$x = explode('.', $FILE[name]);
		$ext = end($x);
		
		if(!defined(ALLOWED_FILE_EXTENSIONS) )	define('ALLOWED_FILE_EXTENSIONS', 'pdf, doc, docx, xls');
		if(!defined(FOLDER_PATH) ) 				define('FOLDER_PATH', $path.'/'.$origem.'/arquivos/'.$ext.'/');
		
		/**
		* Function para manipulçao de arquivos
		*/

		require_once("../php/upload.fn.php");
		$up = DoUpload('FILE');
		
		
		if($up[saida][success]){
			chdir(FOLDER_PATH);
			if(file_exists($bib_files)) unlink($bib_files);
			
			array_push($fields,$_TAG."files");
			array_push($values,$up[nomeDoArquivo]);
			
		
			
			
		} else { 
		
			$error = "<b>Oops! Um erro:</b> ".$up[reason]."<br />";
		}
		chdir($oldpath);
	}
	
	
	$chekeds 		= isset($check_dtq)?1:0;
	$exb_checkbox 	= isset($exb_checkbox)?1:0;
	array_push($fields,"exb_checkbox","checked","checked_data");
	array_push($values,$exb_checkbox,$chekeds,format_date(date("d/m/Y")));
	
	
	/**
	* 
	* Recebe a ação do banco de dados e executa
	* 
	*/
	switch($acao)
	{
		case "CRIAR":
		
			array_push($fields,$_TAG."data",$_TAG."user");
			array_push($values,format_date(date("d/m/Y")),$_SESSION[ 'MM_Username' ]);
			
			

			if(empty($error))DB__query::__INSERT("observ_".$origem, $fields, $values);
			$InsertId = DB__query::$lastInsertId;
			
			break;
		case "EDITAR":
			
			
			if(empty($error))$r = DB__query::__UPDATE("observ_".$origem, $fields, $values, "WHERE ".$_TAG."id = '".$id_requisitado."'");
			$InsertId = $id_requisitado;
			
			break;
	}
	
	/**
	* 
	* Retorno de acordo com os dados inseridos no banco de dados
	* 
	*/
	if(DB__query::$success && empty($error)):	
		
		echo "true" ;
	else:
		echo $error;
	endif;
}

