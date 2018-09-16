<?php

@header( 'Content-Type: text/html; charset=iso-8859-1' );

if (!isset($_SESSION))
{
	session_start();
}

require_once("../../Connections/db.class.php");

	if(!$_SESSION['USER_AUTHORIZED']):
		@header( "Location: /admin/index.php?accesscheck=/admin/gerenciador-de-imagens/" );
	endif;


if ( isset( $_GET['create'] ) && !empty( $_POST['new'] ) )
{
    $album_name = trim( preg_replace( '/\s+/', ' ', $_POST['new'] ) ) ;
    if ( $album_name != "" )
    {
	   echo $album_name;
       $fields = array("album_name");
	   $values = array($album_name);
	   
		DB__query::__INSERT("observ_albuns", $fields, $values);
		$album_id = DB__query::$lastInsertId;
		
        @header( "Location: index.php?edit=$album_id" );
    }
}

if ( isset( $_GET['delete'] ) && !empty( $_GET['delete'] ) )
{
    $album_id = $_GET['delete'];
	$oldpath = getcwd();
	$r = DB__query::__SELECT("observ_fotos", "*", "where foto_album = $album_id");
	var_dump(  DB__query::$num_row);
    if ( DB__query::$num_row >= 1 )
    {
		
		chdir($oldpath);
		chdir("../../uploads/galeria/imagens/");
		
		$field = (array_keys($r[data][output][0]));								
		for ($i = "0"; $i < DB__query::$num_row; $i++):
			$DB_query->catch_($field, $i);
			$file = $foto_url;
				if ( file_exists( $file ) )
				{
					@unlink( $foto_url  );
					DB__query::__DELETE("observ_fotos", "foto_album = '".$album_id."'");
					DB__query::__DELETE("observ_albuns", "album_id = '".$album_id."'");
				}
		 endfor;
		
    }else DB__query::__DELETE("observ_albuns", "album_id = '".$album_id."'");
 
    @header( "Location: index.php" );
}
?>

<!DOCTYPE html>
<html>
    <head>  
        <title>Gallery - Admin</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <link href="" href="tpl/css/all.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/960_12.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/simple-lists.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/reset.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/common.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/standard.css" rel="stylesheet" type="text/css">
        <link href="tpl/css/form.css" rel="stylesheet" type="text/css" />
        <link href="tpl/css/simple-lists.css" rel="stylesheet" type="text/css" />
        <link href="tpl/css/block-lists.css" rel="stylesheet" type="text/css" />
        <link href="tpl/css/table.css" rel="stylesheet" type="text/css" />
        <link href="../css/admin.css" rel="stylesheet" type="text/css" />
        <!-- Generic libs -->
        <script type="text/javascript" src="tpl/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="tpl/js/html5.js"></script>
        <script type="text/javascript" src="tpl/js/old-browsers.js"></script>
        <!-- Template core functions -->
        <script type="text/javascript" src="tpl/js/common.js"></script>
        <script type="text/javascript" src="tpl/js/jquery.tip.js"></script>
        <script type="text/javascript" src="tpl/js/standard.js"></script>
        <!--[if lte IE 8]><script type="text/javascript" src="tpl/js/standard.ie.js"></script><![endif]-->

        <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link href="uploadfy/css/uploadify.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="uploadfy/js/swfobject.js"></script>
        <script type="text/javascript" src="uploadfy/js/jquery.uploadify.v2.1.4.min.js"></script>
        <script src="js/jquery.scrollto.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/album.js"></script>
    </head>
    <body>	
        <div id="status-bar">
            <div class="container_12">
                <ul id="status-infos">
                    <li class="spaced">Gerenciador de<strong> Galeria</strong></li>
                </ul>             
            </div>        
        </div> 
        <div id="control-bar" class="grey-bg clearfix">
            <div class="container_12">
                <div class="float-right mar-r-15"> 
                    <button type="button" class="grey" id="toDown">Fim da Página</button> 
                    <button type="button" class="grey" id="toUp">Topo da Página</button> 
                </div>
            </div>
        </div> 

        <div id="wrap" class="container_12">
            <div class="grid_12">
                <p>&nbsp;</p>

                <div class="block-border">
                    <div class="block-content">
                        <h1>Área Restrita - Álbuns
                            <?php
                            if ( isset( $_GET ) && !empty( $_GET ) )
                            {
                                ?>
                                <a href="index.php" class="with-tip"  title="Todos os Álbuns">
                                    <img src="tpl/images/back_blue.png" width="16" height="16"> 
                                    Voltar
                                </a>                        
                            <?php } ?>
                        </h1>
                        <div class="block-controls">
                            <ul class="controls-tabs js-tabs with-children-tip">
                                
                                
                                
                                <li class="current"><a href="<?php echo $_SESSION["URL_BASE"];?>/admin/gerenciador-de-imagens/" title="Álbuns">
                                        <img src="<?php echo $_SESSION["URL_BASE"];?>/admin/gerenciador-de-imagens/tpl/images/images.png" width="24" height="24"></a>
                                </li>
								<li class=""><a href="<?php echo $_SESSION["URL_BASE"];?>/admin/cms.php" title="Início">
                                        <img src="<?php echo $_SESSION["URL_BASE"];?>/admin/gerenciador-de-imagens/tpl/images/home.png" width="24" height="24"></a>
                                </li>
                                <li><a href="<?php echo $_SESSION["URL_ADM_BASE"];?>/logoff.php" title="Logout">
                               
                                        <img src="<?php echo $_SESSION["URL_BASE"];?>/admin/gerenciador-de-imagens/tpl/images/icons/logout-gray.png" width="24" height="24"></a>
                                </li>					
                            </ul>
                        </div>
                        <div id="home" style="min-height: 600px; overflow-y:auto; ">
                            <p>&nbsp;</p>

                            <?php
                            if ( isset( $_GET['edit'] ) )
                            {
                                $album_id = $_GET['edit'];
                                ?>
                                <script type="text/javascript">
                                    $(document).ready(function() {                
                                        $('#fupload').uploadify({
                                            'uploader'  : 'uploadfy/js/uploadify.swf',
                                            'script'    : 'upload.php?album_id=<?= $album_id ?>',
                                            'cancelImg' : 'uploadfy/js/cancel.png',
                                            'folder'    : '../fotos',
                                            'auto'      : true,
                                            'multi'     : true,
                                            'buttonText'  : 'Upload',
                                            'sizeLimit'   : 1000002400,
                                            'width'       : 186,
                                            'height'       : 55,  
                                            //'queueSizeLimit' : 10,
                                            'uploadLimit' : 1,
                                            'fileExt'     : '*.jpg;*.gif;*.png;*.bmp;*.jpeg',
                                            'fileDesc'    : 'Imagens (JPG, GIF, PNG, BMP)',
                                            'buttonImg'   : '../images/upload.png',
											'onUploadSuccess' : function(file, data, response) {
            console.log('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
        },
                                            'onAllComplete': function(event, queueID, fileObj,response){
                                                //'onComplete': function(event, queueID, fileObj,response){
                                                // var response = JSON.parse(response);
                                                //alert(response.url)
                                                //window.location = baseUri+'/admin/campanha/cliente/<!--{cliente_id}-->/#&tab-mini&'+response.time ;
                                                window.location = 'index.php?edit=<?= $album_id ?>';
                                                //$('#banner_mini_img').html('<img src="<!--{baseUri}-->/application/banners/'+response.url+'" id="'+response.id+'" />');
                                                //$("#mini .info").show();
                                            }		    
                                        })
                                    })
                                </script>                            
                                <?php
                              
								$r = DB__query::__SELECT("observ_albuns", "*", "where album_id = $album_id");
								
                                if ( DB__query::$num_row >= 1 )
                                {
                                    
                                    ?>
                                    <div class="box-album">                                        
                                        <ul class="box-album-head">

                                            <p class="one-line-input grey-bg with-padding">
                                                <span class="relative">
                                                    <label for="<?= $album_id ?>">Nome do Álbum</label>
                                                    <input type="text" name="album_name" id="<?= $album_id ?>" class="album_name with-tip" title="Nome do Álbum" value="<?= $album_name ?>" />
                                                    <button class="grey updateAlbumName">Atualizar</button>
                                                </span>					
                                            </p>

                                        </ul>
                                        <span class="align-right btn-upload">
                                            <input id="fupload" name="upload" type="file" class="hides" />
                                        </span>                                        
                                        <?php
                                        //$db->query( "select * from fotos join albuns on (album_id = foto_album) where foto_album = $album_id order by foto_pos asc" )->fetchAll();
										$r = DB__query::__SELECT("observ_fotos JOIN observ_albuns on (album_id = foto_album)", "*", " where foto_album = $album_id ORDER BY foto_pos asc");
                                        if ( DB__query::$num_row >= 1 )
                                        {
                                           
                                            echo "<ul class=\"sortable\" style=\"list-style-type: none; margin: 0; padding: 0;\">";
											$field = (array_keys($r[data][output][0]));
											
											for ($i = "0"; $i < DB__query::$num_row; $i++):
												
                                               	$DB_query->catch_($field, $i);
												
												
                                                echo "<li class=\"lisort\" id=\"item_$foto_id\" class=\"div_$foto_id\">";
                                                if ( $foto_caption == "" )
                                                {
                                                    $foto_caption = "";
                                                }
                                                $foto_caption = utf8_decode( $foto_caption );
                                                echo '<ul class="box-foto-edit extended-list div_' . $foto_id . '">' . "\n";
                                                echo "<li class=\"div_$foto_id\">" . "\n";
                                                ?>
                                                <ul class="mini-menu with-children-tip">
                                                    <li><a href="javascript:void(0)" title="Atualizar" id="<?= $foto_id ?>" album="<?= $album_id ?>" class="refresh"><img src="tpl/images/icons/refresh.png" width="16" height="16"></a></li>
                                                    <li><a href="javascript:void(0)" title="Definir Capa" id="<?= $foto_id ?>" album="<?= $album_id ?>" class="cover"><img src="tpl/images/icons/photo.png" width="16" height="16"></a></li>
                                                    <li><a href="javascript:void(0)" title="Remover" id="<?= $foto_id ?>" class="delete"><img src="tpl/images/cross-circle.png" width="16" height="16"></a></li>
                                                </ul>
                                                <?php
                                                	
												?> 
                                                <img class="pic with-tip tip-bottom" title="mover posição" src="<?php echo $_SESSION["URL_BASE"];?>/addons/php/thumb.url.class.php?src=<?php echo $_SESSION["URL_BASE"]?>/uploads/galeria/imagens/<?php echo $foto_url?>&w=174&h=136" />
                                                <input type="text" class="with-tip foto_caption" id="f_<?= $foto_id ?>"  value="<?= $foto_caption ?>" maxlength="74" title="Info 1" />
                                                <input type="text" class="with-tip tip-bottom foto_info" id="if_<?= $foto_id ?>"  value="<?= $foto_info ?>" maxlength="15" title="Info 2" />
                                                <?php
                                                echo "</li>\n";
                                                echo "</ul>\n";
                                                echo '</li>' . "\n";
                                            
											
											endfor;
											
                                            echo '</ul>';
                                        }
                                    }
                                }
                                else
                                {
                                    ?>

                                    <div class="box-album"> 
                                        <form name="f" action="index.php?create=true" method="post">
                                            <ul class="box-album-head" style="width: 101%; margin:0; margin-bottom: 20px; padding: 0 !important">
                                                <p class="one-line-input grey-bg with-padding">
                                                    <span class="relative">
                                                        <label for="new">Nome do Álbum</label>
                                                        <input type="text" name="new" id="new" class="album_name with-tip" title="Nome do Álbum" />
                                                        <button class="grey">Criar</button>
                                                    </span>					
                                                </p>
                                            </ul>
                                        </form>
                                    </div>

                                    <table class="table w-all" id="tbl_list_serv" style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="10">ID</th>
                                                <th>Álbum</th>
                                                <th width="60"> </th>
                                                <th width="50">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>                             
                                            <?php
											
											$r = DB__query::__SELECT("observ_albuns", "*", "ORDER by album_name asc");
        
                                            if ( DB__query::$num_row >= 1  )
                                            {
                                               
                                                $field = (array_keys($r[data][output][0]));	
													$album_rows = DB__query::$num_row;
													
													for ($i = "0"; $i < $album_rows; $i++){
														$DB_query->catch_($field, $i);
														$a_id = $album_id;
														$a_name = $album_name;
														
														//$x = DB__query::__SELECT("observ_fotos", "*", " WHERE foto_album = $id");
														echo "<tr>";
                                                    	echo "<td> $a_id </td>";
                                                    	echo "<td> $a_name </td>";
                                                    	echo "<td> </td>";
														
															?>
														<td> 
															<a class="with-tip edit" title="editar álbum" href="index.php?edit=<?= $album_id ?>">
																<img src="tpl/images/pencil.png" width="16" height="16">
															</a> 
															&nbsp;
															<a class="with-tip deleteAlbum" title="remover álbum"  id="<?= $album_id ?>" href="javascript:void(0)">
																<img src="tpl/images/cross-circle.png" width="16" height="16">
															</a> 
                                                            
														</td>
		
														<?php
														echo "</tr>";
														
													};
												
                                        }
                                        ?>
                                        <tfoot>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </tfoot>                                        
                                    </table>
                                    <?php
									
                                }
                                ?>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                        <p>&nbsp;</p>

                    </div>
                </div>
            </div>
            <div id="footer"></div>
    </body>
</html>