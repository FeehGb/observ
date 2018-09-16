<?php
function active($page,$source, $index = false){	
	$ativo = "";
	if ($source == $page) {
		$ativo = " a-active";
	}elseif($source == "" && $index == true){
		$ativo = " a-active";
	}
	echo $ativo;
}

?>