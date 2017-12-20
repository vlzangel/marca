var CARRITO = [];
// ***************************************
// Global Function 
// ***************************************
function autoload_execute(){
	if( autoload != '' ){
		faseNext( $('[data-value="'+autoload+'"]') );
	}
}
	
function loadFase(fase_id){

		var offset = 0;

		var obj = $('[data-fase="'+fase_id+'"]'); 
		if( obj.length > 0 ){
			loadAttr( obj );

			switch( fase_id){
				// ***************************************
				// Fase #1 - Tamaño
				// ***************************************
				case 1:
					$('#btn-linkprev').removeClass('hidden');
					$('[data-action="prev"]').addClass('hidden');//header
					$('#header').text('Elije el tamaño de tu mascota');
				break;
				// ***************************************
				// Fase #2 - Producto
				// ***************************************
				case 2:
					$('#btn-linkprev').removeClass('hidden');
					$('[data-action="prev"]').removeClass('hidden');
					$('#header').text('Escoge la marca de tu preferencia');
					// Cargar Items
					//$('[data-fase="2"]').empty();
					

					// Cargar Items
					var producto = service[ kmibox_param['fase1'] ];					
					var product_id=0;

					$.each(PRODUCTOS,  function(key, val){

						//console.log(val);
						
						//if( val['tamanos'][ CARRITO["tamano"] ] == 1 ){

							if( jQuery("#presentaciones").attr("data-value") == "" ){
								CARRITO["producto"] = key;
								jQuery("#presentaciones").attr("data-value", key );

								jQuery("#presentaciones button").css("display", "none");
								$.each(val["presentaciones"],  function(key, val){
									if( val > 0 ){
										jQuery("#presentacion-"+key).css("display", "block");
									}
								});
							}

							$('#carrousel1')
							.attr({
								'color': color_default,
							})
							.append(
								$('<span></span>').append( 
									$('<img data-id="'+key+'">')
										.attr({'src' : TEMA+"/productos/imgs/"+val.dataextra.img,
											   'width': '270px',
											   })),
									$('#name').text('s')
									
							);

						//}

					});

					$.each(PRODUCTOS,  function(key, val){

						//console.log(val);
						
						//if( val['tamanos'][ CARRITO["tamano"] ] == 1 ){

							if( jQuery("#presentaciones").attr("data-value") == "" ){
								CARRITO["producto"] = key;
								jQuery("#presentaciones").attr("data-value", key );

								jQuery("#presentaciones button").css("display", "none");
								$.each(val["presentaciones"],  function(key, val){
									if( val > 0 ){
										jQuery("#presentacion-"+key).css("display", "block");
									}
								});
							}

							$('#carrousel1')
							.attr({
								'color': color_default,
							})
							.append(
								$('<span></span>').append( 
									$('<img data-id="'+key+'">')
										.attr({'src' : TEMA+"/productos/imgs/"+val.dataextra.img,
											   'width': '270px',
											   })),
									$('#name').text('s')
									
							);

						//}

					});
	
					$("#carrousel1").waterwheelCarousel({
						flankingItems: 3,
						movingToCenter: function ($item) {
							$('#callback-output name').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
						},
						movedToCenter: function ($item) {
							jQuery("#presentaciones").attr("data-value", jQuery("#carrousel1 .carousel-center").attr("data-id") );
							CARRITO["producto"] = jQuery("#carrousel1 .carousel-center").attr("data-id");

							jQuery("#presentaciones button").css("display", "none");
							$.each(PRODUCTOS[ CARRITO["producto"] ]["presentaciones"],  function(key, val){
								if( val > 0 ){
									jQuery("#presentacion-"+key).css("display", "block");
								}
							});
							$('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
						},
						movingFromCenter: function ($item) {
							$('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
						},
						movedFromCenter: function ($item) {
							$('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
						},
						clickedCenter: function ($item) {
							$('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
						}
					});
					 
				break;
				// ***************************************
				// Fase #3 - Plan ****
				// ***************************************
				case 3:
				$('#header').text('Selecciona el tiempo de suscripción');
					jQuery("#plan article").css("display", "none");
					$.each(PRODUCTOS[ CARRITO["producto"] ]["planes"],  function(key, val){
						if( val == 1 ){
							jQuery("#plan-"+key).css("display", "inline-block");
						}
					});
				break;
				// ***************************************
				// Fase #4 - Extras
				// ***************************************
				case 5:
					/* Omitir paso
					$('#btn-omitir').removeClass('hidden');
					$("#slider-item").empty();

					var count_items = 1;
					$.each( extras, function(ind, itm){					
						changeExtra( count_items, ind, 0 );
						count_items++;
					});

					// Registrar Carrito de compras
					 addCart(urlbase);*/
				break;
				// ***************************************
				// Fase #5 - Resumen de Compra
				// ***************************************
				case 4:
					$('#btn-omitir').addClass('hidden');
					$('#header').text('Verifica tu compra');

					console.log( "Hola" );

					var subtotal = 0;
					var iva = 0;
					var total = 0;
					var cant_item = 0;

					add_item_cart(
						CARRITO["producto"],
						PRODUCTOS[ CARRITO["producto"] ].nombre,
						CARRITO['plan'],
						TEMA+"/productos/imgs/"+PRODUCTOS[ CARRITO["producto"] ].dataextra.img,
						PRODUCTOS[ CARRITO["producto"] ]["presentaciones"][ CARRITO["presentacion"] ],
						1,
						PRODUCTOS[ CARRITO["producto"] ]["presentaciones"][ CARRITO["presentacion"] ]									
					);

					subtotal += PRODUCTOS[ CARRITO["producto"] ]["presentaciones"][ CARRITO["presentacion"] ];
					//iva += subtotal ;
					total += subtotal + iva;

					cant_item += parseInt( 1 );

					$('#cant-item').html(cant_item);
					$('#subtotal').html('$ '+subtotal);
					$('#iva').html('$ '+iva);
					$('#total').html('$ '+total);

				break;
			}
		}
	}

	function add_item_cart( ID, name, frecuencia, thumnbnail, price, cant, total ){
		$( '#cart-items' )
		.append( 
			$('<article class="item-cart-container" id="art'+ID+'"></article>')
			.addClass('col-md-12')
			.append(

				$('<div></div>')
				.addClass('row')
				.append(	
					$('<div></div>')
					.addClass('col-xs-12 col-md-2')
					.append(
						
						$('<a data-target="delete" data-type="box" data-parent="'+ID+'"></a>')
							.append(
								$('<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg">Remover</span>')
							)
						,$('<span></span>')
							.attr({
								'href':"#"
							})
							.append(
								$('<img>')
								.attr({
									'src': thumnbnail, 
									'width':"60px", 
									'height':"60px"	 
								})
							)
					)	
					,$('<div></div>')
					.addClass('col-xs-12 col-md-6')
					.append(
						$('<label></label>').html( name )
					)
					,
					$('<div></div>')
					.addClass('col-xs-12 col-md-2 currency')
					.append(
						$('<label>') 
						.html( frecuencia )
					)

					,
					$('<div></div>')
					.addClass('col-xs-12 col-md-2 currency')
					.append(
						$('<label>') 
						.html( '$ '+ price )
					)
					/*
					,
					$('<div></div>')
					.addClass('col-xs-12 col-md-2 cantidad')
					.append(
						$('<input>') 
			
							.addClass("col-xs-5 col-md-6")
							.attr({
								'readonly':'true'
								,'type':"numeric" 
								,'id':"cant-" + ID 
								,'value': cant
							})
						,$("<div></div>") 
							.addClass("col-xs-6 col-md-4 items-cant-cart")
							.attr("data-target","actions")
							.append(
								$("<button></button>") 
									.attr({
										'data-action':"sumarItems",
										'data-id': ID	
									})
									.append('<i class="fa fa-plus"></i>')
								,$("<button></button>") 
									.attr({
										'data-action':"restarItems",
										'data-id': ID	
									})
									.append('<i class="fa fa-minus"></i>')
							)
							
					) 
					,$('<div></div>') 
						.addClass("col-xs-12 text-center bg-dark col-md-2 currency")
						.append( $('<label>').html( '$ '+total ) )*/
				)
			)
		);
	}
	function loadColor( obj_fase ){
		color = obj_fase.attr('color'); 
		if( $(obj_fase).attr('color') == ''){
			color = color_default;	
		}

		// header
		$('#header-purchase').css('background', color);
		$('.compra-titulo').css('background', color);
		$('#marcas').css('background-color', color);
	}
	function loadAttr( obj ){
		// Titulo
		$("#title").html( $.parseHTML( obj.data("title") ) );
		// SubTitulo
		$("#subtitle").html( $.parseHTML( obj.data("subtitle") ) );
		// Footer Titulo
		$("#section-msg").html( $.parseHTML( obj.data("msg") ) );
		$("#section-msg").css('color', obj.data("msg-color") );
	}
	function cal_column(_service){
		var col = 4;
		var count_items = Object.keys(_service).length;
		if( count_items > 0 && count_items < 3 ){
			col = (12 - (count_items * 4)) / 2; 
		}
		return col;
	}
	function ucfirst(string){
		return string.substr(0,1).toUpperCase()+string.substr(1,string.length).toLowerCase();
	}
	// Change items Slider
	function changeExtra( count_items, item ){
		console.log('llego aqui');
		var itm;
		console.log();
		var tmp = service [kmibox_param['fase1']] ['content']['post_title'];
		console.log("item"+item);
		if( item >= -1 ){
			tmp = item;
		}
		service[ kmibox_param['fase1'] ];
		console.log( service[ kmibox_param['fase1'] ]);
		itm = service[ tmp ];
		console.log(tmp);

		$("#f4-slider-item"+count_items).empty();
		$("#f4-slider-item"+count_items)
		.attr({
			'data-index': tmp,
			'data-id': itm['content']['post_title'],
			'data-name': itm['name'],
			'data-price': itm['price']
		})
		.append( 
			$("<img>")
			//.addClass("vertical-center") 
			//.addClass("text-center") 
			.attr({
				'width':"300px",
				'height':"300px",
				'src': itm['thumnbnail']
			})
			,$('<div>')
				.attr({
					'data-agregado': tmp
				})
				.css("top", "50%") 
				.css("width", "100%") 
				.css("height", "auto")
				.css("position", "absolute")
				.addClass("row hidden text-center")
				.append( 
					$('<span>')
						.css("font-weight", "bold")
						.css("color", "#fff")
						.css("background", "#94d400")
						.html("Ha sido añadido")
				)
		);
		// Cargar Detalle del producto
		$('#extra-price').html(
			'$' + $("#f4-slider-item3").attr('data-price')
		);
		$('#extra-name').html(
			$("#f4-slider-item3").attr('data-name')
		);
		// validar si ya fue agregado
		existeExtra(tmp, 0, 0);
	}
	// Exste items Slider
	function existeExtra( id, delay=1000, fade=1200, primary=false ){
		// Eliminar item
		if(kmibox_param['cart']['extra'][id] >= 0){
			$("[data-agregado='"+id+"'] span")
				.css("background", "#94d400")
				.html("Ha sido añadido")
			$("[data-agregado='"+id+"']")
				.fadeIn(fade)
				.removeClass('hidden');
			$("[data-index='"+id+"'] img")
				.addClass('selected')
		}else{
		// Agregar item
			if( !$("[data-agregado='"+id+"']").hasClass('hidden') ){
				$("[data-agregado='"+id+"'] span")
					.css("background", "#c16363")
					.html("Ha sido removido");
				$("[data-agregado='"+id+"']")
					.delay(delay).fadeOut(fade)
				$("[data-index='"+id+"'] img")
					.removeClass('selected')
			}
		}
		if( primary ){
			addCart(urlbase);
		}
	}

	function existeTamaño( id, delay=1000, fade=1200, primary=false ){
		// Eliminar item
		if(kmibox_param['fase1'][id] >= 0){
			$("[data-agregado='"+id+"'] span")
				.css("background", "#94d400")
				.html("Ha sido añadido")
			$("[data-agregado='"+id+"']")
				.fadeIn(fade)
				.removeClass('hidden');
			$("[data-index='"+id+"'] img")
				.addClass('selected')
		}else{
		// Agregar item
			if( !$("[data-agregado='"+id+"']").hasClass('hidden') ){
				$("[data-agregado='"+id+"'] span")
					.css("background", "#c16363")
					.html("Ha sido removido");
				$("[data-agregado='"+id+"']")
					.delay(delay).fadeOut(fade)
				$("[data-index='"+id+"'] img")
					.removeClass('selected')
			}
		}
		if( primary ){
			addCart(urlbase);
		}
	}


	function existeProducto( id, delay=1000, fade=1200, primary=false ){
		// Eliminar item
		if(kmibox_param['cart']['extra'][id] >= 0){
			$("[data-agregado='"+id+"'] span")
				.css("background", "#94d400")
				.html("Ha sido añadido")
			$("[data-agregado='"+id+"']")
				.fadeIn(fade)
				.removeClass('hidden');
			$("[data-index='"+id+"'] img")
				.addClass('selected')
		}else{
		// Agregar item
			if( !$("[data-agregado='"+id+"']").hasClass('hidden') ){
				$("[data-agregado='"+id+"'] span")
					.css("background", "#c16363")
					.html("Ha sido removido");
				$("[data-agregado='"+id+"']")
					.delay(delay).fadeOut(fade)
				$("[data-index='"+id+"'] img")
					.removeClass('selected')
			}
		}
		if( primary ){
			addCart(urlbase);
		}
	}



	function faseNext( _this ){
		// Config.
		var fase_section= $('[data-fase="' + _this.data("target") + '"]');
		var fase = fase_section.attr("data-fase");
		var faseNext_id = parseFloat(fase)+1;
		var faseNext = $('[data-fase="'+faseNext_id+'"]');

		// Es la ultima fase

		if( $('[data-fase="'+faseNext_id+'"]').length > -1 ){
			//console.log('bandera1--- entro');

			kmibox_param['fase'+_this.attr('data-target')] = _this.attr('data-value');
			if( _this.attr('data-object') > 0 ){
				kmibox_param['cart']['code'] = _this.attr('data-object');
				//console.log('bandera2'+kmibox_param['cart']['code']);
			}
			loadFase( faseNext_id );
			//console.log('bandera3');

			// Mostrar Proxima fase
			faseNext
				.addClass('bounceInRight animated')
				.removeClass('hidden')
			;			
			// Ocultar Obj. Actual
			$(fase_section).addClass('hidden');
			// Cargar Titulo
			$("#title").html( faseNext.data("title") );
			// Boton Prev
			$('[data-action="prev"]')
				.attr('data-target', fase)
				;
			// Config Color Base
			$(faseNext).attr('color', _this.data('color'));
			loadColor(faseNext);

			if(faseNext_id==4){
				$('#btn-omitir').removeClass('hidden');
				addCart( urlbase );
			}else{
				$('#btn-omitir').addClass('hidden');
			}
			save_session_cart();
			//console.log('bandera4');
		}
		//console.log('no entro');
	}
	function fasePrev( _this ){
		// Actual
		var fase_section= $('[data-fase="' + _this.attr("data-target") + '"]');
		var fase = fase_section.attr("data-fase");

		// Siguiente
		var faseNext_id = parseFloat(fase)+1;
		var faseNext = $('[data-fase="'+faseNext_id+'"]');

		// Anterior
		var fasePrev_id = parseFloat(fase)-1;

		// Es la ultima fase
		if( $('[data-fase="' + _this.attr("data-target") + '"]').length > 0 ){

			// Mostrar Proxima fase
			fase_section
				.removeClass('bounceInRight')
				.addClass('bounceInLeft')
				.removeClass('hidden')
			;			
			// Ocultar Obj. Actual
			$(faseNext)
				.addClass('hidden');

			// Cargar Titulo
			loadAttr( fase_section );

			// Boton Next
			_this.attr('data-target', fasePrev_id);

			if(fasePrev_id==0){
				$('#btn-linkprev').removeClass('hidden');
				$('[data-action="prev"]').addClass('hidden');
			}else{
				$('#btn-linkprev').addClass('hidden');
				$('[data-action="prev"]').removeClass('hidden');
			}

			if(fasePrev_id==3){
				$('#btn-omitir').removeClass('hidden');
			}else{
				$('#btn-omitir').addClass('hidden');
			}

			loadColor( fase_section ); 
			save_session_cart();

		}
	}
	function save_session_cart(){
		var xdata = {
			'key': 'save_session_cart',
			'param': kmibox_param
		};

		$.post( urlbase+"/ajax/admin_cart.php", {xdata}, function(result) {	
			console.log(result);
		})
		.fail(function() {
			console.log( "error al registrar los datos al carrito de compras" );
		});
	}

	function responsive_modal(){
		$('.modal-content').resizable({
	      	//alsoResize: ".modal-dialog",
	      	minHeight: 300,
	      	minWidth: 300
	    });
	    $('.modal-dialog').draggable();

	    $('#suscription').on('show.bs.modal', function() {
	      	$(this).find('.modal-body').css({
	        	'max-height': '100%'
	      	});
	    });
	}

	
var PRODUCTOS = [];
$(document).ready(function() {


	jQuery("#fase_1").css("display", "block");
	change_title("Elije el tamaño de tu mascota");

	carrousel();
	CARRITO["tamano"] = jQuery("#vlz_carrousel img")[0].id;

	jQuery("#edad button").on("click", function(e){
		CARRITO["edad"] = jQuery(this).attr("data-value");
	});

	jQuery("#presentaciones button").on("click", function(e){
		CARRITO["presentacion"] = jQuery(this).attr("data-value");
	});

	jQuery("#plan button").on("click", function(e){
		CARRITO["plan"] = jQuery(this).attr("data-value");
	});

	jQuery.post(
		TEMA+"assets/ajax/productos.php",
		{},
		function(data){
			PRODUCTOS = data;
		}, "json"
	).fail(function(e) {
		console.log( e );
  	});

});

function change_title(txt){
	jQuery("#header").html(txt);
}

function carrousel(){
	$('#vlz_carrousel').waterwheelCarousel({
		separation: 300,
		edgeFadeEnabled: true,     	 
		flankingItems: 3,
		movingToCenter: function ($item) {
			CARRITO["tamano"] = $item.attr('id');
			$('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
		},
		movedToCenter: function ($item) {
			$('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
		},
		movingFromCenter: function ($item) {
			$('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
		},
		movedFromCenter: function ($item) {
			$('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
		},
		clickedCenter: function ($item) {
			$('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
		}
	});
}








