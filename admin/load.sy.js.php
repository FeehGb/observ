<?php

$css    = '<link href="' . $_SESSION["URL_BASE"] . '/style/page-style.css" rel="stylesheet" type="text/css" />';
$script = '<script type="text/javascript" src="' .  $_SESSION["URL_BASE"] . '/addons/javascript/jquery.js"></script>';
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.js"></script>';
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_BASE"] . '/addons/javascript/jquery.fn.form.js"></script>';
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_ADM_BASE"] . '/addons/plugins/tiny_mce/tinymce.min.js"></script>';
$script .= '<script type="text/javascript" src="' . $_SESSION["URL_ADM_BASE"] . '/addons/javascript/jquery.uploadify.min.js"></script>';

switch ($current_page)
{
	case 'home':
	case '':
		
		break;
	case 'noticias':
	case 'biblioteca':
		break;
	case 'biblioteca':
	break;

}

echo $css;
echo $script;
?>

<script>
var tinyMCExec = function(id)
{
	tinymce.init({
			selector: "#div-textarea-"+id,
			entity_encoding : "raw",
			plugins: [
				"advlist autolink lists link image charmap anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste youtube"
			],
			setup: function(editor) {
				editor.addButton('adicionar', {
					type: 'menubutton',
					text: 'Adicionar',
					icon: false,
					menu: [
						{text: 'Saiba Mais', onclick: function() {editor.insertContent("<div class='saibamais componente_materia'><b>Saiba mais</b><ul><li><a href='#'>Mude este texto</a></li><li><a href='#'>Mude este texto</a></li><li><a href='#'>Mude este texto</a></li></ul></div>");}},
						{text: 'Citação', onclick: function() {editor.insertContent("<div class='citacao componente_materia'>Escreva aqui uma citação <div class='autor-citacao'><abbr>De </abbr>Autor da citação</div></div>");}}
					]
				});
			},
			style_formats: [
				{title: 'Headers', items: [
					{title: 'h1', block: 'h1'},
					{title: 'h2', block: 'h2'},
					{title: 'h3', block: 'h3'},
					{title: 'h4', block: 'h4'},
					{title: 'h5', block: 'h5'},
					{title: 'h6', block: 'h6'}
				]},
		
				{title: 'Blocks', items: [
					{title: 'p', block: 'p'},
					{title: 'div', block: 'div'},
					{title: 'pre', block: 'pre'}
				]},
		
				{title: 'Containers', items: [
					{title: 'section', block: 'section', wrapper: true, merge_siblings: false},
					{title: 'article', block: 'article', wrapper: true, merge_siblings: false},
					{title: 'blockquote', block: 'blockquote', wrapper: true},
					{title: 'hgroup', block: 'hgroup', wrapper: true},
					{title: 'aside', block: 'aside', wrapper: true},
					{title: 'figure', block: 'figure', wrapper: true}
				]}
			],
			mode : "none",
			inline: true,
			skin : "",   
			height : 700,
			content_css: "<?php echo $_SESSION["URL_BASE"];?>/style/tiny-style.css",
			language : 'pt_BR',
			relative_urls: false,
			convert_urls: false,
			remove_script_host : false,
			document_base_url: "<?php echo $_SESSION["URL_BASE"];?>",
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |  link image youtube | adicionar"
	});
}
</script>
