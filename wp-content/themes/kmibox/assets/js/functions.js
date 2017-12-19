var CARRITO = [];
CARRITO["productos"] = [];
CARRITO["productos"].push({
	"tamano": "",
	"edad": "",
	"presentacion": "",
	"plan": "",
	"cantidad": 1
});


var PRODUCTOS = [];

jQuery(document).ready(function() {

	change_fase(1);

	carrousel();
	carrousel_responsive();
	CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = jQuery("#vlz_carrousel img")[0].id;

	jQuery("#edad button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["edad"] = jQuery(this).attr("data-value");
		change_fase(2, this);
	});

	jQuery("#presentaciones button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["presentacion"] = jQuery(this).attr("data-value");
		change_fase(3, this);
	});

	jQuery("#plan button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["plan"] = jQuery(this).attr("data-value");
		change_fase(4, this);
	});

	jQuery("#btn-atras").on("click", function(e){
		change_fase( jQuery(this).attr("data-value") );
	});

	jQuery("#agregar_plan").on("click", function(e){
		e.preventDefault();

		CARRITO["productos"].push({
			"tamano": "",
			"edad": "",
			"presentacion": "",
			"plan": "",
			"cantidad": 1
		});

		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = undefined;
		jQuery("button").removeClass("vlz_activo");

		carrousel();
		carrousel_responsive();

		change_fase( 1 );
	});

	jQuery("#pagar").on("click", function(e){

		var _json = JSON.stringify( CARRITO["total"] )+"===";
		jQuery.each(CARRITO["productos"],  function(key, producto){
			_json += JSON.stringify( producto )+"|";
		});

		jQuery.post(
			TEMA+"assets/ajax/carrito.php", 
			{
				CART: _json
			},
			function(data){
				location.href = HOME+"/pagar-mi-marca";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
	});

	jQuery("#tienda").on("click", function(e){
		e.preventDefault();

		var _json = JSON.stringify( CARRITO["total"] )+"===";
		jQuery.each(CARRITO["productos"],  function(key, producto){
			_json += JSON.stringify( producto )+"|";
		});

		jQuery.post(
			TEMA+"assets/ajax/carrito.php", 
			{
				CART: _json
			},
			function(data){
				location.href = HOME+"/pago-tienda";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
		
	});

	jQuery.post(
		TEMA+"assets/ajax/productos.php", {},
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

function change_fase(fase, _this = ""){

	jQuery(".comprar_container section").addClass("hidden");

	jQuery("#fase_"+fase).addClass("bounceInRight animated");
	jQuery("#fase_"+fase).removeClass('hidden');

	if( fase > 0 ){
		jQuery("#btn-atras").attr("data-value", fase-1);
	}else{
		location.href = HOME;
	}

	if( _this != "" ){
		var padre = jQuery(_this).parent().parent().attr("id");
		jQuery("#"+padre+" button").removeClass("vlz_activo");
		jQuery(_this).addClass("vlz_activo");
	}

	loadFase(fase);
}

$(window).resize(function() {
	ventana_ancho = $(window).width();
	ventana_alto = $(window).height();
  switch(ventana_ancho) {
	    case 360: 
	    case 375:
	    case 400:
	    case 412:
	    case 414: 
	        //console.log('Cambio a pequeña '+ventana_ancho);
	        break;
	    case 500: 
	    case 600: 
	    case 700: 
	    case 768: 
	    case 800: 
	        //console.log('Cambio a grande '+ventana_ancho);
	        break;
	    
	    default:
	        //console.log('va cambiando '+ventana_ancho);
	        break;
	}
});


function carrousel(){
	jQuery('#vlz_carrousel').waterwheelCarousel({
		separation: 300,
		edgeFadeEnabled: true,     	 
		flankingItems: 3,
		orientation: 'horizontal',
		movingToCenter: function ($item) {
			CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = $item.attr('id');
			jQuery('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
		},
		movedToCenter: function ($item) {
			jQuery('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
		},
		movingFromCenter: function ($item) {
			jQuery('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
		},
		movedFromCenter: function ($item) {
			jQuery('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
		},
		clickedCenter: function ($item) {
			jQuery('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
		}
	});
}
function carrousel_responsive(){
	jQuery('#carrousel_responsive').waterwheelCarousel({
		separation: 150,
		edgeFadeEnabled: true,     	 
		flankingItems: 3,
		orientation: 'vertical',
		movingToCenter: function ($item) {
			CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = $item.attr('id');
			jQuery('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
		},
		movedToCenter: function ($item) {
			jQuery('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
		},
		movingFromCenter: function ($item) {
			jQuery('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
		},
		movedFromCenter: function ($item) {
			jQuery('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
		},
		clickedCenter: function ($item) {
			jQuery('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
		}
	});
}
function carrousel_productos() {
	jQuery("#vlz_carrousel_2").waterwheelCarousel({
			flankingItems: 3,
			movingToCenter: function (jQueryitem) {

			},
			movedToCenter: function (jQueryitem) {
				jQuery("#presentaciones").attr("data-value", jQuery("#vlz_carrousel_2 .carousel-center").attr("data-id") );
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = jQuery("#vlz_carrousel_2 .carousel-center").attr("data-id");

				jQuery("#nombre_producto").html( jQuery("#vlz_carrousel_2 .carousel-center").attr("data-name") );

				jQuery("#presentaciones .button_presentacion").css("display", "none");
				jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["presentaciones"],  function(key, val){
					if( val > 0 ){
						jQuery("#presentacion-"+key).css("display", "inline-block");
					}
				});
			},
			movingFromCenter: function (jQueryitem) {

			},
			movedFromCenter: function (jQueryitem) {

			},
			clickedCenter: function (jQueryitem) {

			}
	});
	
}
function carrousel_productos_responsive() {
		jQuery("#carrousel_2").waterwheelCarousel({
			flankingItems: 5,
			separation: 100,
			orientation: 'vertical',
			movingToCenter: function (jQueryitem) {

			},
			movedToCenter: function (jQueryitem) {
				jQuery("#presentaciones").attr("data-value", jQuery("#carrousel_2 .carousel-center").attr("data-id") );
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = jQuery("#carrousel_2 .carousel-center").attr("data-id");

				jQuery("#nombre_producto").html( jQuery("#carrousel_2 .carousel-center").attr("data-name"));
				jQuery("#presentaciones .button_presentacion").css("display", "none", "");
				jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["presentaciones"],  function(key, val){
					if( val > 0 ){
						jQuery("#presentacion-"+key).css("display", "inline-block");
					}
				});
			},
			movingFromCenter: function (jQueryitem) {

			},
			movedFromCenter: function (jQueryitem) {

			},
			clickedCenter: function (jQueryitem) {

			}
		});
}
function loadProductos(){
	var actual_select = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"];
	jQuery('#vlz_carrousel_2').html("");
	jQuery.each(PRODUCTOS,  function(key, val){
		// if( val['tamanos'][ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] ] == 1 ){
			

			if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] == undefined ){
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = key;
				jQuery("#presentaciones").attr("data-value", key );
				jQuery("#nombre_producto").html( val.nombre );
				jQuery("#presentaciones .button_presentacion").css("display", "none");
				jQuery.each(val["presentaciones"],  function(key2, val2){
					if( val2 > 0 ){
						jQuery("#presentacion-"+key2).css("display", "inline-block");
					}
				});
			}

			jQuery('#vlz_carrousel_2')
			.append(
				jQuery('<img id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">')
				.attr(
					{
						'src': TEMA+"/productos/imgs/"+val.dataextra.img,
					   	'width': '270px',
					}
				)
			);

		// }
	});

	if( actual_select != undefined ){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = "#item_"+actual_select;
	}
}
function loadProductosResponsive(){
	var actual_select = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"];
	jQuery('#carrousel_2').html("");
	jQuery.each(PRODUCTOS,  function(key, val){
		// if( val['tamanos'][ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] ] == 1 ){
			

			if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] == undefined ){
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = key;
				jQuery("#presentaciones").attr("data-value", key );
				jQuery("#nombre_producto").html( val.nombre );
				jQuery("#presentaciones .button_presentacion").css("display", "none");
				jQuery.each(val["presentaciones"],  function(key2, val2){
					if( val2 > 0 ){
						jQuery("#presentacion-"+key2).css("display", "inline-block");
					}
				});
			}

			jQuery('#carrousel_2')
			.append(
				jQuery('<img id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">')
				.attr(
					{
						'src': TEMA+"/productos/imgs/"+val.dataextra.img,
					   	'width': '270px',
					}
				)
			);

		// }
	});

	if( actual_select != undefined ){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = "#item_"+actual_select;
	}
}

function add_item_cart( index, ID, name, frecuencia, thumnbnail, price, presentacion, cantidad = 1 ){
	var HTML = "";

	HTML += '<tr>';
	HTML += '	 <td class=" hidden-xs">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<span href="#">';
	HTML += '	 		<img src="'+thumnbnail+'" width="60px" height="60px">';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label> '+name+' <br> '+presentacion+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>'+frecuencia+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label id="cant_'+index+'"> '+cantidad+' </label> <div class="cantidad_controls"> <i class="fa fa-plus-circle mas" onclick="mas_cantidad('+index+')"></i> <i class="fa fa-minus-circle menos" onclick="menos_cantidad('+index+')"></i> </div>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>$ '+(price*cantidad)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '</tr>';
	HTML += '<tr>';
	HTML += '	 <td colspan=7 class="separador">';
	HTML += '	 	<hr>';
	HTML += '	 </td>';
	HTML += '</tr>';

	jQuery( '#cart-items' ).append(HTML);
}

function mas_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	valor++;
	jQuery("#cant_"+index).html(valor);
	CARRITO["productos"][index]["cantidad"] = valor;
	loadFase(4);
}

function menos_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	if( valor > 1){
		valor--;
		jQuery("#cant_"+index).html(valor);
		CARRITO["productos"][index]["cantidad"] = valor;
		loadFase(4);
	}
}

function loadFase(fase){

	switch( fase ){
		
		case 1: // Fase #1 - Tamaño
			change_title('Elije el tamaño de tu mascota');
		break;

		case 2: // Fase #2 - Producto
			change_title('Escoge la marca de tu preferencia');

			loadProductos();
			loadProductosResponsive()
			carrousel_productos();
			carrousel_productos_responsive();

			setTimeout(
				function(){
					if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] != undefined ){
						jQuery(CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"]).click();
					}
				}, 500
			);
			 
		break;
		// ***************************************
		// Fase #3 - Plan ****
		// ***************************************
		case 3:
			change_title('Selecciona el tiempo de suscripción');
			jQuery("#plan article").css("display", "none");
			jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["planes"],  function(key, val){
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
			jQuery('#btn-omitir').removeClass('hidden');
			jQuery("#slider-item").empty();

			var count_items = 1;
			jQuery.each( extras, function(ind, itm){					
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
			change_title('Verifica tu compra');

			var subtotal = 0;
			var iva = 0;
			var total = 0;
			var cant_item = 0;

			jQuery( '#cart-items' ).html("");
			jQuery.each( CARRITO["productos"],  function(key, producto){
				add_item_cart(
					key,
					producto["producto"],
					PRODUCTOS[ producto["producto"] ].nombre,
					producto['plan'],
					TEMA+"/productos/imgs/"+PRODUCTOS[ producto["producto"] ].dataextra.img,
					PRODUCTOS[ producto["producto"] ]["presentaciones"][ producto["presentacion"] ],
					producto["presentacion"],
					producto["cantidad"]								
				);
				
				subtotal += ( PRODUCTOS[ producto["producto"] ]["presentaciones"][ producto["presentacion"] ] * producto["cantidad"] );
			});
			iva = subtotal *0.12;
			total = subtotal + iva;


			cant_item += parseInt( 1 );

			jQuery('#cant-item').html(cant_item);
			jQuery('#subtotal').html( FN(subtotal)+" MXN" );
			jQuery('#iva').html( FN(iva)+" MXN" );
			jQuery('#total').html( FN(total)+" MXN" );

			CARRITO["total"] = total;

		break;
	}
}

function FN(number){
	return new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(number);
}

function eliminarProducto(id){
	var confirmed = confirm("Esta seguro de quitar este producto.?");
    if (confirmed == true) {
    	var TEMP = [];
    	jQuery.each( CARRITO["productos"],  function(key, producto){
    		if(key != id){
				TEMP.push(producto);
    		}
		});
		CARRITO["productos"] = TEMP;
		if( CARRITO["productos"].length == 0 ){
			jQuery("#agregar_plan").click();
		}else{
			change_fase(4);
		}
    }
}

add_action('phpmailer_init','send_smtp_email');
	function send_smtp_email( $phpmailer )
	{
	   /* // Define que estamos enviando por SMTP
	    $phpmailer->isSMTP();
	 
	    // La dirección del HOST del servidor de correo SMTP p.e. mail.midominio.com o pa IP del servidor
	    $phpmailer->Host = "smtp.gmail.com";
	 
	    // Uso autenticación por SMTP (true|false)
	    $phpmailer->SMTPAuth = true;
	 
	    // Puerto SMTP - Suele ser el 25, 465 o 587
	    $phpmailer->Port = "587";
	 
	    // Usuario de la cuenta de correo
	    $phpmailer->Username = "clubpatitasfelices@kmimos.la";
	 
	    // Contraseña para la autenticación SMTP
	    $phpmailer->Password = "Kmimos2017";
	 
	    // El tipo de encriptación que usamos al conectar - ssl (deprecated) o tls
	    $phpmailer->SMTPSecure = "tls";
	 
	    $phpmailer->From = "clubpatitasfelices@kmimos.la";*/
	    $phpmailer->FromName = "Marca";
	}




