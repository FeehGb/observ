	  /**
	   * Box dialog
	   *
	   * Função para estilizar caixas de dialogo
	   *
	   * @author     Felipe Augusto Gonçavelves Basilio 
	   * @version    1.0 
	   *
	   * TODO:
	   */
	  /**
	   * Funcao para criar caixa de dialogo de confirmação
	   * @param settings[title,text,positive,negative,draggable], callback
	   */

	  function confirm(settings, callback)
	  {
		
	  	if ($.isFunction(settings))
	  	{
	  		var callback = settings;
	  	}
	  	else
	  	{
	  		var callback = callback;
	  	}
	  	var defaults = {
	  		title: 'Confirmar',
	  		text: 'Tem certeza disso?',
	  		positive: 'Confirmar',
	  		negative: 'Cancelar',
	  		draggable: true,
			
	  	};
	  	 settings = $.extend(
	  	{}, defaults, settings);
	  	var create = function ()
	  		{
	  			e = $("#box-confirm")[0];
	  			if (!e)
	  			{
	  				$("body").append('<div id="box">' + '<div class="overlay_dialog"></div> ' + '<div id="box-confirm">' + '<div class="move">' + settings.title + ' ' + '<div class="close">x</div>' + '</div>' + '<div class="wrap">' + '<div id="box-question">' + '<div class="title">' + settings.title + '</div>' + '<div class="question">' + settings.text + '</div>' + '<div id="reply">' + '<button type="button" id="b-cPositive" class="button">' + settings.positive + '</button>' + '<button type="button" id="b-cNegative" class="button">' + settings.negative + '</button>' + '</div>' + '</div> ' + '</div>' + '</div>' + '</div>');
	  				$("#box-confirm").draggable(
	  				{
	  					containment: "window",
	  					scroll: false,
	  					handle: ".move"
	  				});
	  				center();
	  			}
	  		};
	  	var prepare = function ()
	  		{
	  			create();
				
	  			if (settings.draggable === true)
	  			{
	  				$("#box-alert").draggable(
	  				{
	  					containment: "window",
	  					scroll: false,
	  					handle: ".move"
	  				});
	  			}
	  			$('.overlay_dialog').click(function ()
	  			{
	  				scape.call();
	  			});
	  			$('button#b-cPositive').click(function ()
	  			{
	  				
					exit.call();
					
	  				if ($.isFunction(callback))
	  				{
	  					return callback();
	  				}
	  			});
	  			$('button#b-cNegative,.close').click(function ()
	  			{
	  				exit.call();
	  			});
	  		};
	  	var center = function ()
	  		{
	  			var width = $("div#box-confirm").width();
	  			var height = $("div#box-confirm").height();
	  			var windowHeight = $(window).height();
	  			var windowWidth = $(window).width();
	  			var top = (windowHeight - height) / 2 - 50;
	  			var left = (windowWidth - width) / 2;
	  			$("#box").show('slow');
	  			$("#box-confirm").css(
	  			{
	  				top: top - 50,
	  				left: left,
	  				opacity: '0'
	  			}).animate(
	  			{
	  				top: top,
	  				opacity: '1'
	  			}, 300);
	  		};
	  	var scape = function ()
	  		{
	  			var pos = $("#box-confirm").position().left;
	  			var array = new Array(15, -15, 0, 15, -15, 0);
	  			for (var i = 0; i < array.length; i++)
	  			{
	  				$("#box-confirm").animate(
	  				{
	  					left: pos + array[i]
	  				}, 50);
	  			}
	  		};
	  	var exit = function ()
	  		{
	  			$("#box").hide('slow', function ()
	  			{
	  				$(this).remove();
	  			});
	  		};
	  	prepare.call();
	  }
	  /**
	   * Funcao para criar caixa de dialogo de aletar
	   * @param text,settings[title,button[active,printit],draggable], callback
	   */

	  function alert(text, settings, callback)
	  {
	  	if ($.isFunction(settings))
	  	{
	  		var callback = settings;
	  	}
	  	else
	  	{
	  		var callback = callback;
	  	}
	  	var defaults = {
	  		title: 'AVISO!',
	  		button: {
	  			active: true,
	  			positive: "ok!"
	  		},
	  		draggable: false,
	  	}
	  	var settings = $.extend(
	  	{}, defaults, settings);
	  	var create = function ()
	  		{
	  			e = $("#box-alert")[0];
	  			if (!e)
	  			{
	  				$("body").append('<div id="box">' + '<div class="overlay_dialog"></div>' + '<div id="box-alert">' + '<div class="move">' + settings.title + ' ' + '<div class="close">x</div>' + '</div>' + '<div class="wrap">' + '<div id="box-callback">' + '<div class="box-text">' + text + '</div>' + '<div id="reply">' + '<button type="button" id="b-cPositive" class="button">' + settings.button.positive + '</button>' + '</div>' + '</div>' + '</div>' + '</div> ' + '</div>');
	  				center();
	  			}
	  		}
	  	var prepare = function ()
	  		{
	  			create();
	  			if (settings.draggable == true)
	  			{
	  				$("#box-alert").draggable(
	  				{
	  					containment: "window",
	  					scroll: false,
	  					handle: ".move"
	  				});
	  			}
	  			if (settings.button.active == false)
	  			{
	  				$("button#b-cPositive").hide();
	  			}
	  			$('.overlay_dialog').click(function ()
	  			{
	  				settings.positive == false ? exit.call() : scape.call();
	  			})
	  			$('button#b-cPositive').click(function ()
	  			{
	  				exit.call();
	  				if ($.isFunction(callback)) callback();
	  			});
	  			$('.close').click(function ()
	  			{
	  				exit.call();
	  				if ($.isFunction(callback)) callback();
	  			});
	  		}
	  	var center = function ()
	  		{
	  			var width = $("div#box-alert").width();
	  			var height = $("div#box-alert").height();
	  			var windowHeight = $(window).height();
	  			var windowWidth = $(window).width();
	  			var top = (windowHeight - height) / 2 - 50;
	  			var left = (windowWidth - width) / 2;
	  			$("#box").show('slow');
	  			$("#box-alert").css(
	  			{
	  				top: top - 50,
	  				left: left,
	  				opacity: '0'
	  			}).animate(
	  			{
	  				top: top,
	  				opacity: '1'
	  			}, 300);
	  		}
	  	var scape = function ()
	  		{
	  			var pos = $("#box-alert").position().left;
	  			var array = new Array(15, -15, 0, 15, -15, 0);
	  			for (var i = 0; i < array.length; i++)
	  			{
	  				$("#box-alert").animate(
	  				{
	  					left: pos + array[i]
	  				}, 50);
	  			}
	  		}
	  	var exit = function ()
	  		{
	  			$("#box").hide('slow', function ()
	  			{
	  				$(this).remove();
	  			});
	  		}
	  	prepare.call();
	  }(function ($)
	  {
	  	$.extend($.fn, {
	  		count: function ()
	  		{
	  			var each = $(this).each(function (index, element)
	  			{});
	  			return each.length;
	  		}
	  	});
	  
		
		
		//Slider Funcition
		$.extend($.fn, {
			slider: function (settings) {
				var defaults = {
					time: 4000,
				}
				var settings 	= $.extend({}, defaults, settings);
				$this 			= $(this);
				var img 		= $(this).find("IMG");
				var out 		= "";
				var count 		= 0;
				
				$this.show("slow");
				$(".slider-loader").remove();
				
				var newimg 		= img.each(function (index, element) {
					out += '<div class="img-slider" style = "display:none;background-repeat:none;background-size: cover; height:' + $(this).height() + 'px; background-image:url(' + $(this).attr("src") + ')" ><div class="caption">' + $(this).data("description") + '</div></div>';
	  				$this.css(
	  				{
	  					height: $(this).height()
	  				});
	  				count++;
				});

				
				$this.html("<div id='prev'></div><div id='next'></div><div id='slider'>" + out +"</div>");
				$(".img-slider:first-child").addClass("active").css({
					display: "block"
				});
				$(".img-slider").css({
					width: "100%",
					left: "0px",
					position: "absolute",
					top: "0px",
					
				});
				
				if(count >= 2){
					fade = function (target) {
							$("#previous").css({
								opacity: 1.0
							}).fadeTo("slow", 0, function () {
								$(this).hide().removeAttr("id");
							});
							target.css({
								display: "block",
								opacity: 0.0
							}).addClass('active').fadeTo("slow", 1.0);
						}
						
					
					loopSlider = function(){
						clearInterval($setInterval)
						
						var current = $(".active");
						var next 	= current.next();
						
						current.attr("id","previous"); 
						current.removeClass("active");
						current.is(":last-child") == true ? fade($(".img-slider:first-child")) : fade(next); 
					}
					
					
					var $setInterval = setInterval(function(){loopSlider()},settings.time);
					$this.on("mouseenter",function(e) {
						clearInterval($setInterval)
					}).on("mouseleave",function(e){
						$setInterval = setInterval(function(){loopSlider()},settings.time);	
					});
						
					$("#next")
					
					$("#next,#prev").on("click",function (e) {
						var target = e.currentTarget.id;
						var current = $(".active");
						var next 	= current.next();
						var prev 	= current.prev();
						
						/*start*/
						current.attr("id","previous"); 
						current.removeClass("active")
						button = target == "prev" ? "prev" : "next";
						switch (button) {
						case "next":
							current.is(":last-child") == true ? fade($(".img-slider:first-child")) : fade(next);
							break;
						case "prev":
							current.is(":first-child") == true ? fade($(".img-slider:last-child")) : fade(prev);
							break;
						}
					})
				}
			}
		});
		
	  	//Truncate
		
	  	$.fn.extend(
	  	{
	  		truncate: function (settings)
	  		{
	  			var $this = $(this);
	  			var defaults = {
	  				limit: "300",
	  				target: "#charsLeft"
	  			}
	  			var settings = $.extend(
	  			{}, defaults, settings);
	  			if (!$(settings.target)[0])
	  			{
	  				$(this).createobj(
	  				{
	  					attr: settings.target,
	  					where: "after",
	  					type: "span"
	  				});
	  			}
	  			$this.bind("keyup keydown", function ()
	  			{
	  				$value = $this.val();
	  				$length = $value.length;
	  				$calc = settings.limit - $length;
	  				if ($length > settings.limit)
	  				{
	  					$this.val($value.substring(0, settings.limit))
	  				};
	  				if ($calc >= settings.limit * 50 / 100)
	  				{
	  					$(settings.target).css(
	  					{
	  						color: "rgb(108, 204, 116)"
	  					})
	  				}
	  				else if ($calc >= (settings.limit * 21 / 100) && $calc <= (settings.limit * 49.999 / 100))
	  				{
	  					$(settings.target).css(
	  					{
	  						color: "rgb(255, 122, 0)"
	  					})
	  				}
	  				else if ($calc >= 0 && $calc <= (settings.limit * 20 / 100))
	  				{
	  					$(settings.target).css(
	  					{
	  						color: "rgb(233, 6, 6)"
	  					})
	  				}
	  				$(settings.target).html($calc);
	  			})
	  		}
	  	})
	  	//Create
	  	$.fn.extend(
	  	{
	  		createobj: function (settings)
	  		{
	  			var $this = $(this);
	  			var defaults = {
	  				type: "div",
	  				attr: "new_obj",
	  				where: "before",
	  			}
	  			var settings = $.extend(
	  			{}, defaults, settings);
	  			switch (settings.attr.charAt())
	  			{
	  			case "#":
	  				attrType = "id";
	  				attr_name = settings.attr.split("#")[1];
	  				break;
	  			case ".":
	  				attrType = "class";
	  				attr_name = settings.attr.split(".")[1];
	  				break;
	  			default:
	  				attrType = "class";
	  				attr_name = settings.attr
	  				break;
	  			}
	  			obj = '<' + settings.type + ' ' + attrType + '= "' + attr_name + '"></' + settings.type + '>';
	  			switch (settings.where)
	  			{
	  			case "after":
	  				$this.after(obj);
	  				break;
	  			case "before":
	  				$this.before(obj);
	  				break;
	  			default:
	  				$this.append(obj);
	  				break;
	  			}
	  		}
	  	});
	  	/*
	  	 * $.extend $.fn :: Reset Form
	  	 * - find and aply reset in form
	  	 * @return element.reset
	  	 */
	  	$.fn.reset = function ()
	  	{
	  		$(this).each(function ()
	  		{
	  			this.reset();
	  		});
	  	}
	  	/*
	  	 * $.extend $.fn :: Jquery scrolling
	  	 */
	  	$.fn.extend(
	  	{
	  		scrolling: function (settings)
	  		{
	  			var $this = $(this);
	  			var defaults = {
	  				duration: "800",
	  				_event: "",
	  				before: function ()
	  				{}
	  			}
	  			var settings = $.extend(
	  			{}, defaults, settings);
	  			$.isFunction(settings.before) ? settings.before() : settings.before;
	  			$(this).on(settings._event, function (event)
	  			{
	  				event.preventDefault();
	  				hash = $(this).attr('href')
	  				$('html,body').animate(
	  				{
	  					scrollTop: $(hash).offset().top
	  				}, settings.duration);
	  			});
	  		}
	  	});
		/*
	  	 * $.extend $.fn :: Jquery endScroll
	  	 */
	  	$.fn.extend(
	  	{
	  		endScroll: function (callback)
	  		{
	  			var e = $(this);
	  			var sf = false;
	  			$(window).scroll(function (event)
	  			{
	  				sf = true;
	  			});
				
	  			setInterval(function ()
	  			{
	  				if (sf)
	  				{
	  					sf = false;
	  					var h = e.height();
	  					var p = e.offset().top + h;
	  					if ($(this).scrollTop() >= (p - ($(this).height() + 500)))
	  					{
	  						callback();
	  					}
	  				}
	  			}, 1000);
	  		}
	  	});
		/*
	  	 * $:: Jquery loadAjax
	  	 */
	  	carregarComAjax = function (configuracao, dadosDoPost)
	  	{
	  		var valorNativo = {
	  			url: "",
	  			alvo: "",
	  			elemento: "",
	  		}
	  		var configuracao = $.extend(
	  		{}, valorNativo, configuracao);
	  		var retorno = $.ajax(
	  		{
	  			type: "POST",
	  			url: configuracao.url,
	  			beforeSend: function ()
	  			{
	  				$(configuracao.alvo).after('<div id="pub-loading">Carregando</div>');
	  			},
	  			data: dadosDoPost,
	  			complete: function ()
	  			{
	  				$(configuracao.elemento).addClass("ekr-s45-s");
	  			}
	  		}).done(function (retornoAjax)
	  		{
	  			$("#pub-loading").fadeTo("slow",0,function(){$(this).remove();})
	  			$(configuracao.alvo).append(retornoAjax);
	  			$(configuracao.elemento).fadeTo(0, 0, function ()
	  			{
	  				$(".ekr-s45-s").fadeTo(0, 1);
	  				$(this).fadeTo("slow", 1);
	  			})
	  			return true;
	  		}).fail(function (jqXHR, textStatus)
	  		{
	  			console.log("Request failed: " + textStatus);
	  		});
	  		return retorno;
	  	}
	  })(jQuery);
	  
	  
	  
	$.fn.extend(
	  	{
	  		parallax: function (callback)
	  		{
			  $(this).each(function(){
				var $obj = $(this);

					$(window).scroll(function() {
						var yPos = -($(window).scrollTop() / $obj.data('speed')); 
				
						var bgpos = '50% '+ yPos + 'px';
				
						$obj.css('background-position', bgpos );
				
					});
				});    
			}
	  	});
	  
	  
	
		
/*
 * @build  : 20-07-2013
 * @author : Ram swaroop
 * @site   : Compzets.com
 */
(function($){
      
    
    
    $.fn.animatescroll = function(options) {
        
        // fetches options
        var opts = $.extend({},$.fn.animatescroll.defaults,options);
                
        if(opts.element == "html,body") {
            // Get the distance of particular id or class from top
            var offset = this.offset().top;
        
            // Scroll the page to the desired position
            $(opts.element).stop().animate({ scrollTop: offset - opts.padding}, opts.scrollSpeed, opts.easing);
        }
        else {
            // Scroll the element to the desired position
            $(opts.element).stop().animate({ scrollTop: this.offset().top - this.parent().offset().top + this.parent().scrollTop() - opts.padding}, opts.scrollSpeed, opts.easing);
        }
    };
    
    // default options
    $.fn.animatescroll.defaults = {        
        easing:"linear",
        scrollSpeed:800,
        padding:0,
        element:"html,body"
    };   
    
}(jQuery));
	  
	$(document).ready(function(){
		  
		  $("#menu-nav ul li").hover(function () {
			  $(this).children("ul").stop(true, false).slideToggle('fast');
		  }, function () {
			  $(this).children("ul").stop(true, false).slideToggle(0);
		  });

	  });