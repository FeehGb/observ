<?php
if ( !isset( $_SESSION ) )
{
	session_start();
}
?>
<?php
require_once("../../../addons/php/addons.fn.php");
require_once("../../../Connections/db.class.php");

__POST(acao,origem,id_requisitado,query);

if (!empty($origem))
{
	
	switch ($origem)
	{
		case "biblioteca":		
			$_TAG = "bib_";
			$once = "../includes/biblioteca.form.php";
		break;
		case "noticias":
			$_TAG = "not_";
			$once = "../includes/noticias.form.php";
		break;
		
	}
	
	$validar 		= true;
	$num_linhas 	= 1;
	
	if($acao != "CRIAR"):
	
		$retorno	= DB__query::__SELECT("observ_".$origem, "*",  "WHERE ".$_TAG."id = '".$id_requisitado."'");
		$num_linhas	= DB__query::$num_row;
		
		$validar 	= $num_linhas >= 1 ? true: false;
		$campos 	= (array_keys($retorno[data][output][0]));
		
	endif;
	
	if ($validar):

		for ($i = "0"; $i < $num_linhas; $i++):	
		$DB_query->catch_($campos, $i);

		require_once($once);
	
		endfor;
	endif;
	
}
?>
<script>tinyMCExec('<?php echo $id_requisitado?>');</script>