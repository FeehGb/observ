<?php	
	require_once("../config.php");
	$iniciarNo 	= isset($_POST['iniciarNo']) ? $_POST['iniciarNo'] : '0';
	
	
	if(isset($_POST['album']) && $_POST['album'] != ''):
		$r = DB__query::__SELECT("observ_albuns","album_id","WHERE album_name = '".$_POST['album']."'");
		$DB_query->catch_("album_id");
		
			$where = "WHERE foto_album = '$album_id'";
	endif;
	
	$r = DB__query::__SELECT("observ_fotos", "*", " $where ORDER BY foto_pos,foto_id DESC LIMIT ".$iniciarNo.",".MOSTRAR_NO_MAXIMO);
	if (DB__query::$num_row >= 1):
		

		$field = (array_keys($r[data][output][0]));
		for ($i = "0"; $i < DB__query::$num_row; $i++):
		
			$DB_query->catch_($field, $i);
			
			?>
            
            <a title="<?php echo $foto_caption;?>" rel="shadowbox[Vacation]"  href="<?php echo $_SESSION["URL_BASE"];?>/uploads/galeria/imagens/<?php echo $foto_url;?>"><img src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"];?>/uploads/galeria/imagens/<?php echo $foto_url;?>&w=179&h=179" /></a>
              
			<?php
			
		
		endfor;
		else:
			
	endif;
    

	  
	  ?>

  <script type="text/javascript">
  	
				


	
boxInitialize();
				

</script>

