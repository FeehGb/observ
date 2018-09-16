	</section>
</section>

<footer>
  <div id="wrap-footer">
  <div id="header-adm">
      <div id="bem-vindo"><span class="bem">BEM</span> <span class="vindo">VINDO <?php echo $_SESSION[ 'MM_Username' ]?></span></div>
      <div id="sair"><a href="<?php echo $_SESSION["URL_ADM_BASE"];?>/logoff.php">Sair</a></div>
      <nav id="admin"> </nav>
      <div class="wrap">
        <div id="title-top">ÁREA DE MANUTENÇÃO DO SITE</div>
      </div>
    </div>
    <div class="wrap">
      <section id="block">
        <div id="block-st" class="block"> </div>
        <div id="block-nd" class="block"> </div>
        <div id="block-rd" class="block"></div>
      </section>
    </div>
  </div>
  <div id="scrool-wrap"><a href="#scrool-top" class="scroll">subir</a></div>
</footer>
<script>
	$("body,form").on("click", ".pega-form", function ()
	{
		var parent = $(this).parent();
		id_requisitado = $(this).data("id"), $.ajax(
		{
			type: "POST",
			url: '<?php echo $_SESSION["URL_ADM_BASE"]?>/addons/management/load.content.php',
			data: {
				id_requisitado: id_requisitado,
				origem: '<?php echo PAGINA_ATUAL ?>',
				acao: $(this).data("acao"),
				query: '<?php echo CATEGORIA ? CATEGORIA :  TIPO_MULT ; ?>'
			},
			beforeSend: function ()
			{
				parent.html("<div class='loading'></div>")
			},
			complete: function ()
			{}
		}).done(function (data)
		{
			parent.html(data);
		});
	});
	$('body').on("click", ".remover", function (event)
	{
		event.preventDefault();

		var id_requisitado = $(this).data("id");
		var origem = '<?php echo PAGINA_ATUAL;?>';
		var parent = $(this).parent();
		confirm(
		{
			title: 'Remover ' + origem,
			text: 'Você tem certeza que deseja remover este item de  ' + origem + '?'
		}, function ()
		{
			$.ajax(
			{
				type: "POST",
				url: '<?php echo $_SESSION["URL_ADM_BASE"]?>/addons/management/erase.content.php',
				data: {
					id_requisitado: id_requisitado,
					origem: origem,
				},
				beforeSend: function ()
				{},
				success: function (data)
				{
					
					
					parent.fadeTo("fast", 0, function ()
					{
						$(this).slideToggle("fast", function ()
						{
							$(this).remove();
						})
					});
				},
				complete: function ()
				{},
				error: function (xhr, ajaxOptions, thrownError, data)
				{
					$('.loading_form').remove();
					console.log("error: \n thrownError - " + thrownError + "\n data - " + data + "\n ajaxOptions - " + ajaxOptions + "\n xhr - " + xhr);
				}
			});
		})
	});
	$("body").on("click", "#EDITAR,#CRIAR", function (event)
	{
		event.preventDefault();
		
		var tinyMCEC = "";
		var params = {};
		var id_requisitado = $(this).data("id");
		var titulo = $("#form_titulo").val();
		var form = $(this).parent();
		var section = form.parent();
		var origem = '<?php echo PAGINA_ATUAL;?>';
		var acao = $(this).data("acao");
		var query = '<?php echo CATEGORIA ? CATEGORIA :  TIPO_MULT ; ?>'
		
		
		tinyMCEC = tinyMCE.get('div-textarea-' + id_requisitado);
		tinyMCEC = tinyMCEC.getContent();
		$.each(form.find('input'), function (index, value)
		{
			params[value.name] = value.value;
		});
		
		
		$("#form-" + origem + "-" + id_requisitado).ajaxForm(
		{
			data: {
				id_requisitado: id_requisitado,
				tinyMCE: tinyMCEC,
				acao: acao,
				origem: origem,
				query: query,
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
				var data 	= data;
				var alerta 	= data == 'true'? "Operação efetuada com sucesso...!":data;
				
				alert(alerta, {
					title: "Aviso de execução",
					button: {
						positive: "Confirmar"
					},
					draggable: true,
				}, function ()
				{
					if (data == 'true')
					{
						if (acao == "EDITAR")
						{
							if (params.FILE || params._IMG_) 
							$.ajax(
							{
								type: "POST",
								url: '<?php echo $_SESSION["URL_ADM_BASE"]?>/addons/management/load.content.php',
								data: {
									id_requisitado: id_requisitado,
									origem: origem,
									acao: acao,
								},
								beforeSend: function ()
								{
									form.html("<div class='loading'></div>")
								},
								complete: function ()
								{
									if (typeof (tinyMCExec) != 'undefined') tinyMCExec();
								}
							}).done(function (data)
							{
								section.html(data);
							});
						}
						else
						{
							location.reload();
						}
					}
				});
				$(".loading").remove();
			},
			complete: function ()
			{},
			error: function (xhr, ajaxOptions, thrownError, data)
			{
				console.log("error: \n thrownError - " + thrownError + "\n data - " + data + "\n ajaxOptions - " + ajaxOptions + "\n xhr - " + xhr);
			}
		}).submit();
	});
	$('#execCriar').click();
	
</script>
</div>
</body></html>