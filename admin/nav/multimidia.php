<header id="title" class="multimidia">
  <div class="wrap">
    <h1 class="title-pg">MULTIMÍDIA</h1>
    <p class="title-ct"></p>
  </div>
  <div class="bars">
    <div class="wrap">
      <div class="bar-noticias"></div>
    </div>
  </div>
</header>
<section id="content">
  <div class="wrap">
    <div id="publication">
    

    
<form name="form" id="form-multimidia-imagens"  method="POST" enctype="multipart/form-data">
  
  <fieldset>
    <div class="img-galeria">
      <label for="form_img" class="iFile">Escolha uma imagem</label>
      <input type="file" name="img[]" class="inFile" id="form_img" data-acao="CRIAR" data-id="" value="" multiple >
	</div>
  </fieldset>
</form>
    
<script>
	$("body").on("change","#form_img",function(event)
	{
		event.preventDefault();
		var acao = $(this).data("acao");
		var form = $('form');
		
		console.log(form);

		form.ajaxForm({
		 	url:"<?php echo $_SESSION["URL_ADM_BASE"];?>/addons/management/mani.galeria.php", 
           data: {
				acao	: acao,
				origem	: 'multimidia',
			},
			beforeSubmit: function ()
			{
				form.prepend("<div class='loading'></div>");
			},
			uploadProgress: function (event, position, total, percentComplete)
			{
				$(".loading").html(percentComplete + '%');
			},
			success: function (data)
			{
				$(".loading").fadeToggle("fast",function()
				{
					$(this).remove();
				})
				
				
			},
			complete: function ()
			{
					
			},
			error: function (xhr, ajaxOptions, thrownError, data)
			{
				console.log("error: \n thrownError - " + thrownError + "\n data - " + data + "\n ajaxOptions - " + ajaxOptions + "\n xhr - " + xhr);
			}
		}).submit(); 
	});
</script> 


    </div>
  </div>
</section>
