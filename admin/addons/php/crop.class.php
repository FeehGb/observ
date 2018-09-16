<?php
/*
 * Class thumb 2.0
 *
 *
 * Copyright (c) 2012 Felipe Augusto Gonçalves Basilio
 * https://www.facebook.com/FelipeGB.Taurus
 */
class crop
{
	public $img_name, $first_redirect,$queue_resize = array();
	private $resize = NULL;

	/*
	 *
	 * Inicio do Construtor
	 * @string $dst_image destino da imagem 
	 *
	 */
	public function __construct($dst_image = "")
	{

		$this->dst_image 	= $dst_image;

		if ($this->dst_image)
		{
			$this->starting();
		}

	}//Fim do Construtor
	
	/*
	 * Inicia a criação da nova imagem
	 */
	private function starting()
	{
		$this->info();
		
		$this->is_image = $this->is_image();
		if (!$this->is_image)
		{
			echo ('<div class="_error"><b>Erro:</b> Arquivo <b>' . $this->dst_image[name] . '</b> não é uma imagem!</div>');
		}
		else
		{
			/* 
			 * Captura os dados da imagem tmp;
			 * "@int dst_h = altura, @int dst_w = largura, @int formato = extencao, @string wh_html "
			 */
			$this->__getimagesize();
			
			// Cria a imagem;
			$this->create();
		}
	}// Fim do start
	
	/*
	 * Captura informaçoes da imagem caso precise
	 */
	private function info()
	{
		
		$pathinfo        = pathinfo($this->dst_image[name]);
		// Extençao do arquivo
		$this->extensao  = strtolower($pathinfo['extension']);
		// Nome do arquivo sem extençao
		$this->filename   = $pathinfo['filename'];
		// Nome do diretorio
		$this->diretorio = $pathinfo['dirname'];

		
	}// Fim do info
	
	/*
	 * Vefefica se o arquivo selecionado é uma imagem
	 * @return boolean
	 */
	private function is_image()
	{
		
		$valida = getimagesize($this->dst_image[tmp_name]);
		
		if (!is_array($valida) || empty($valida))
		{
			return false;
		}
		else
		{
			return true;
		}
	}// Fim do is_image
	
	/*
	 * Determina o tamanho da imagem temp gerada;
	 */
	private function __getimagesize()
	{
		$dimensoes          = getimagesize($this->dst_image[tmp_name]);

		// Largura da imagem destino
		$this->dst_w     	= $dimensoes[0];
		// Altura da imagem destino
		$this->dst_h    	= $dimensoes[1];
		// Formato da imagem destino em @int
		$this->int_ext      = $dimensoes[2];
		// Altura e Largura 
		$this->wh_html 		= $dimensoes[3];

		
		
	}// Fim da captura das dados da imagem
	
	
	/*
	 * Cria imagem apartir do seu formato de origem
	 */
	private function create()
	{
		switch ($this->int_ext)
		{
			case "1":
				$this->createfrom = imagecreatefromgif($this->dst_image[tmp_name]);
				$this->ext     = "gif";
				break;
			case "2":
				$this->createfrom = imagecreatefromjpeg($this->dst_image[tmp_name]);
				$this->ext     = "jpg";
				break;
			case "3":
				$this->createfrom = imagecreatefrompng($this->dst_image[tmp_name]);
				$this->ext     = "png";
				break;
			default:
				echo ('<div class="_error"><b>Error:</b> A extenção .'.$this->extensao.' não eh permitida, use imagens <b>.jpg .png</b> ou <b>gif</b></div>');
				break;
		}
		
	} // Fim da criacao 


		/*
		**********************************************
					>>>>>>>>>>>>>>>>>>>>>
					Definicoes do usuario
					>>>>>>>>>>>>>>>>>>>>>
		**********************************************
		*/
	
	
  	/*
   	 * Define o tamanho maximo permitido para o usuário
   	 * @return Object instância atual do objeto, para métodos encadeados
   	 */
	public function maxMb($max)
	{
		$this->maxMbSize = floor($max * 1048576);
		return $this;
		
	}
	
	/*
   	 * Define a Largura e Altura da imagem para redimensionar
   	 * Aceita várias redimensionamento ao mesmo tempo
   	 * @return Object instância atual do objeto, para métodos encadeados
   	 */
	public function resize()
	{
		$this->resize = func_get_args();
		return $this;
		
	}// Fim do resize
	
	/*
	 * Define onde sera salvo a imagem destino
 	 * @return Object instância atual do objeto, para métodos encadeados
 	 */
	public function saveIn($dir)
	{
		$this->upload_dir = $dir;
		$this->temp_updir = $this->upload_dir;
		
		// Cria o diretorio caso ele nao exista
		if (!is_dir($dir))
		{
			mkdir($dir, 0777, true);
		}
		return $this;
	}// Fim SaveIn
	
	 
	// *** Fim das definicoes do usuario ***

	
		
	/*
   	 * Redimensiona imagem apartir do tipo
	 * @string $tipo
   	 */
	public function crop($tipo = "")
	{	
		if($this->check())
		{
			
			for ($i = 0; $i < count($this->resize); $i++)
			{
				$this->_count = $i;
				$resizetolower = strtolower($this->resize[$this->_count]);
				
				$this->resizes = explode('x', $resizetolower);
				
				$this->prepare();
			
				switch ($tipo)
				{
					case "center":
						$this->cropCenter();
						break;
					default:
						$this->cropdefault();
						break;
				}
			}
		}
		return $this;
	} // Fim do redimensionamento
  
  	/*
   	 * Verefica e aplica os defauts caso nao chamado
	 * @return true
   	 */
	private function check()
	{
		if ($this->is_image && $this->createfrom)
		{
			if (!$this->upload_dir)
			{
				$this->saveIn("../uploads/img");
			}
			if (!$this->resize)
			{
				$this->resize(NULL);
			}
			if (!$this->maxMbSize)
			{
				$this->maxMb("3");
			}
			if ($this->dst_image[size] > $this->maxMbSize)
			{
				echo ('<div class="_error"><b>Erro:</b> Arquivo eh maior que: ' . round($this->maxMbSize / 1048576,1) . 'mb !</div>');
				return false;
			}
			else
			{
				return true;
			}
		}	
	} // Fim do Check
	
	
	
	/*
   	* Prepara o novos valores de altura e largura e nomes para a pasta
   	*/
	private function prepare()
	{
		if ($this->resizes[1])
		{
			$new_width  = $this->resizes[0];
			$new_height = $this->resizes[1];
		}
		else
		{
			$new_width  = $this->resizes[0];
			$new_height = $new_width * ($this->dst_h/$this->dst_w);
			
		}
		$this->info_resize = $new_width . "x" . round($new_height, 0);
		
		if ($this->resizes[0] == NULL)
		{
			$new_width  = $this->dst_w;
			$new_height = $this->dst_h;
			
			$this->info_resize = "index";
			
		}
		
		$this->new_w  = $new_width;
		$this->new_h = $new_height;
		
	} // Fim do prepare
	
	/*
   	 * Corta a imagem no centro
   	 */
	private function cropCenter()
	{
		// Descubra a escala a partir de uma regra de 3
		$scale_y = $this->dst_h / $this->new_h;
		$scale_x = $this->dst_w / $this->new_w;

		if (($this->new_h && $this->new_w))
		{
			// Comprido
			if ($scale_x > $scale_y)
			{

				$src_x = $this->dst_w / $scale_y;
				$src_y = $this->new_h;
				
				$half_x = ($this->new_w - $src_x )/ 2;
				$half_y = 0;
			}
			// Largo
			elseif (($scale_x <= $scale_y))
			{

				$src_x = $this->new_w;
				$src_y = $this->dst_h / $scale_x;
				
				$half_x = 0;
				$half_y = ($this->new_h - $src_y )/ 2;
			}
		}
		
		$this->processing($this->createfrom, $half_x, $half_y, 0, 0, $src_x, $src_y, $this->dst_w, $this->dst_h);
		
	} // Fim do cropCenter

	/*
   	 * Redimensiona a imagem sem centralizar
   	 */
	private function cropdefault()
	{
		$scale_y = $this->dst_h / $this->new_h;
		$scale_x = $this->dst_w / $this->new_w;
		
		
		if (($this->new_h && $this->new_w))
		{
			// Comprido
			if ($scale_x > $scale_y)
			{
				$src_x = $this->dst_w / $scale_y;
				$src_y = $this->new_h;
				
			}
			// Largo
			elseif (($scale_x <= $scale_y))
			{
				$src_x = $this->new_w;
				$src_y = $this->dst_h / $scale_x;
				
			}
		}
		
		$this->processing($this->createfrom, 0, 0, 0, 0, $src_x, $src_y, $this->dst_w, $this->dst_h);
		
	} // Fim do cropdefault
	
	/*
   	 * Processa todos os dados recebido e aplica
   	 */
	private function processing($src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
	{
		
		if (!$this->createfrom)
		{
			echo ('<div class="_error"><b>Error:</b> Ocorreu um erro inesperado, tente com outra imagem!</div>');
		}
		else
		{
			$this->alias();
			$dst_image = $this->img_temp = imagecreatetruecolor($this->new_w, $this->new_h);
			
			imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
			$this->save();
		}
	}// Fim do processing
	
	/*
   	 * Cria novo nome para imagem
	 * @return @string nome da imagem
   	 */
	protected function alias()
	{

		if ($this->_count > 0)
		{
			$this->temp_name  = $this->temp_name;
			$this->upload_dir = $this->temp_updir . "/" . "resized_" . $this->info_resize;
			
			// Retorna todos os resizes definidos para o usuario;
			array_push($this -> queue_resize,$this->info_resize);
		}
		else
		{
			$this->temp_name = md5(uniqid(rand(), true)) . "." . $this->ext;
			$this->img_name  = $this->temp_name;
			
			// Retorna o primeiro resize @array
			
		}
		$this -> first_resize = array("width" => $this->new_w,"height" => $this->new_h);
		return $this->img_name;
	}// Fim do Alias
	
	/*
   	 * Salva a imagem no diretorio a partir do formato
   	 */
	private function save()
	{
		// Cria a pasta caso nao exista
		if (!is_dir($this->upload_dir) && $this->upload_dir) 
		{
			mkdir($this->upload_dir, 0777, true);
		}
		
		
		switch ($this->ext)
		{
			case "gif":
				$this->created = imagegif($this->img_temp, "$this->upload_dir/$this->temp_name");
				break;
			case "jpg":
				$this->created = imagejpeg($this->img_temp, "$this->upload_dir/$this->temp_name", 90);
				break;
			case "png":
				$this->created = imagepng($this->img_temp, "$this->upload_dir/$this->temp_name");
				break;
		}
	}// Fim do save
	
	/*
   	 * Libera qualquer memória associada com a imagem
   	 */
	public function __destruct()
	{
		if($this->img_temp)
		{
			imagedestroy($this->createfrom);
			imagedestroy($this->img_temp);
		}
	}// Fim do __destruct
}
?>