var CARRITO = [];
CARRITO["cantidad"] = 0;
CARRITO["productos"] = [];
CARRITO["productos"].push({
	"tamano": "",
	"edad": "",
	"presentacion": "",
	"plan": "",
	"plan_id": "",
	"cantidad": 1,
	"subtotal": 0.00
});


var PRODUCTOS = [];
var PLANES = [];

jQuery(document).ready(function() {
	jQuery('.carrousel-items').on('click', 'article', function(){
		var index = jQuery(this).index() + 1; 
		if( index ==  1 ){
			jQuery(".carrousel-items article:last").insertBefore( jQuery(".carrousel-items article:first") );
		}
		if( index == jQuery('.carrousel-items article').length ){
			jQuery(".carrousel-items article:first").insertAfter( jQuery(".carrousel-items article:last") );
		}
		var prod_actual = getCarritoActual();
		prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");
	});
	jQuery('.tamano-list').on('click', 'li', function(){
		jQuery('.tamano-list li').removeClass('selected');
		jQuery(this).addClass('selected');
	});
	jQuery("#edad span").on("click", function(e){
		jQuery("#edad span").removeClass("btn_activo");
		jQuery(this).addClass("btn_activo");
		var prod_actual = getCarritoActual();
		prod_actual["edad"] = jQuery(this).attr("data-value");
		jQuery("#descripcion_producto").html( "RAZA "+prod_actual["tamano"]+" "+prod_actual["edad"]+" <span><span>" );
		change_fase(2, this);
	});
	jQuery(".selector_presentaciones span").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["presentacion"] = jQuery(this).attr("data-presentacion");
		jQuery("#descripcion_producto span").html( jQuery(this).attr("data-presentacion") );
		jQuery(".selector_presentaciones span").removeClass("btn_activo");
		jQuery(this).addClass("btn_activo");

		jQuery("#siguiente_pantalla").removeClass("btn-disable");
	});
	jQuery("#siguiente_pantalla").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			change_fase(3, this);
		}
	});
	jQuery("#plan article").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["plan"] = PLANES[ jQuery(this).attr("data-value") ].nombre;
		prod_actual["plan_id"] = jQuery(this).attr("data-value");
		jQuery("#plan article").removeClass("plan_activo");
		jQuery(this).addClass("plan_activo");
		change_fase(4, this);
	});
	jQuery("#vlz_atras").on("click", function(e){
		jQuery('.comprar_container')
			.css("overflow", "hidden")
			.css("position", "fixed");
		change_fase( jQuery(this).attr("data-value") );
	});
	jQuery("#agregar_plan").on("click", function(e){
		e.preventDefault();
		CARRITO["productos"].push({
			"tamano": "",
			"edad": "",
			"presentacion": "",
			"plan": "",
			"plan_id": "",
			"cantidad": 1,
			"subtotal": 0.00
		});
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = undefined;
		jQuery("button").removeClass("vlz_activo");
		change_fase( 1 );
	});
	jQuery("#pagar").on("click", function(e){
		e.preventDefault();
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
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
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
				CART: _json
			},
			function(data){
				location.href = HOME+"/pago-tienda";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
		
	});

	jQuery('[data-target="show-list"]').on('click', function(){
		jQuery('.comprar_container')
			.css("overflow", "initial")
			.css("position", "initial");
		jQuery("#fase_2").addClass('hidden');
		jQuery("#product-list").removeClass('hidden');
		jQuery('#vlz_titulo').html("Listado de marcas");

	});
	initProductos_y_Planes();
	change_fase(1);

});

function get_json_cart(){
	var _json = JSON.stringify( CARRITO["total"] )+"===";
	_json += JSON.stringify( CARRITO["cantidad"] )+"===";
	jQuery.each(CARRITO["productos"],  function(key, producto){
		_json += JSON.stringify( producto )+"|";
	});
	return _json;
}

function initProductos_y_Planes(){
	jQuery.post(
		TEMA+"assets/ajax/productos_planes.php", {},
		function(data){
			PRODUCTOS = data["PRODUCTOS"];
			PLANES = data["PLANES"];
		}, "json"
	).fail(function(e) {
		console.log( e );
  	});
}

function change_fase(fase, _this = ""){
	jQuery("#vlz_controles_fases span").removeClass("fase_activa");
	jQuery("#fase_indicador_"+fase).addClass("fase_activa");
	jQuery(".comprar_container section").addClass("hidden");
	jQuery("#fase_"+fase).addClass("bounceInRight animated");
	jQuery("#fase_"+fase).removeClass('hidden');
	if( fase > 0 ){
		jQuery("#vlz_atras").attr("data-value", fase-1);
	}else{
		location.href = HOME;
	}
	loadFase(fase);
}

function loadProductos(){
	var prod_actual = getCarritoActual();
	var actual_select = prod_actual["producto"];
	jQuery('.carrusel_2').html("");
	jQuery('#otras-marcas').empty();
	jQuery('.carrusel_2').append(jQuery('<span></span>'));
	jQuery.each(PRODUCTOS,  function(key, val){
		if( actual_select == undefined ){
			prod_actual["producto"] = key;
			actual_select = key;
		}
		jQuery('.carrusel_2').append(
			'<div id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">'+
				'<img src="'+TEMA+"/productos/imgs/"+val.dataextra.img+'">'+
				'<div>'+val.nombre+'</div>'+
			'</div>'
		);
		jQuery('#otras-marcas').append(
			'<article class="col-xs-6 col-md-3 text-center" id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">'+
				'<div class="col-xs-12">'+
					'<img src="'+TEMA+"/productos/imgs/"+val.dataextra.img+'" width="70%" class="img-responsive"/>'+
					'<div  class="col-md-12"><strong>'+val.nombre+'</strong></div>'+
					'<div  class="col-md-12">Descripcion corta</div>'+
				'</div>'+
			'</article>'
		);

	});
	if( actual_select != undefined ){
		prod_actual["actual"] = "#item_"+actual_select;
	}
}

function initProductosCarrusel(){
	jQuery(".carrusel_2 > div").on("click", function(e){
		var index = jQuery(this).index() + 1; 
		var _index = getPosision();
		if( index != _index ){
			if( index < _index ){
				var clicks = _index - index;
				for (var i = 0; i < clicks; i++) {
					jQuery("#anterior").click();
				}
			}
			if( index > _index ){
				var clicks = index - _index;
				for (var i = 0; i < clicks; i++) {
					jQuery("#siguiente").click();
				}
			}
		}
	});
	jQuery("#anterior").on("click", function(e){
		jQuery(".carrusel_2 > div:last").insertBefore( jQuery(".carrusel_2 > div:first") );
		selectProducto();
	});
	jQuery("#siguiente").on("click", function(e){
		jQuery(".carrusel_2 > div:first").insertAfter( jQuery(".carrusel_2 > div:last") );
		selectProducto();
	});
	selectProducto();
}

function selectProducto(){
	var prod_actual = getCarritoActual();
	var index = getPosision();
	var _this = ".carrusel_2 > div:nth-child("+index+")";
	jQuery(".carrusel_2 > div").removeClass("producto_activo");
	jQuery(_this).addClass("producto_activo");
	prod_actual["producto"] = jQuery(_this).attr("data-id");
	jQuery("#nombre_producto").html( jQuery(_this).attr("data-name") );
	jQuery(".selector_presentaciones span").css("display", "none");
	jQuery.each( PRODUCTOS[ jQuery(_this).attr("data-id") ].presentaciones,  function(key, val){
		jQuery("#pres_"+key).attr("data-value", val);
		jQuery("#pres_"+key).attr("data-presentacion", key);
		if( val+0 > 0){
			jQuery("#pres_"+key).css("display", "inline-block");
		}
	});
}

function change_title(txt){
	jQuery("#vlz_titulo").html(txt);
}

jQuery( window ).resize(function() {
	var index = getPosision();
	var _pre = ".carrusel_2 > div:nth-child("+(index-1)+")";
	var _this = ".carrusel_2 > div:nth-child("+index+")";
	var _sig = ".carrusel_2 > div:nth-child("+(index+1)+")";
	if( !jQuery(_this).hasClass("producto_activo") ){
		if( jQuery(_sig).hasClass("producto_activo") ){
			jQuery("#siguiente").click();
		}
		if( jQuery(_pre).hasClass("producto_activo") ){
			jQuery("#anterior").click();
		}
		selectProducto();
	}
	
});

function getPosision(){
	var W = jQuery(window).width();
	if( W >= 1000 ){
		return 4;
	}
	if( W > 680 && W < 1000 ){
		return 3;
	}
	if( W <= 680 ){
		return 2;
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
	HTML += '	 	<label> <div class="resaltar_desglose">'+name+'</div> '+presentacion+'</label>';
	HTML += '	 	<label class="resaltar_desglose solo_movil">'+frecuencia+'</label>';
	HTML += '	 	<label class="solo_movil">$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc">';
	HTML += '	 	<label class="resaltar_desglose">'+frecuencia+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc">';
	HTML += '	 	<label>$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<div class="cantidad_controls"> <i class="fa fa-plus-circle mas" onclick="mas_cantidad('+index+')"></i>  <label id="cant_'+index+'"> '+cantidad+' </label> <i class="fa fa-minus-circle menos" onclick="menos_cantidad('+index+')"></i> </div>';
	HTML += '	 	<label class="resaltar_desglose solo_movil" style="text-align: right;">$ '+(price*cantidad)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc">';
	HTML += '	 	<label class="resaltar_desglose">$ '+(price*cantidad)+' MXN</label>';
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
	CARRITO["cantidad"]++;
	loadFase(4);
}

function menos_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	if( valor > 1){
		valor--;
		jQuery("#cant_"+index).html(valor);
		CARRITO["productos"][index]["cantidad"] = valor;
		CARRITO["cantidad"]--;
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
			initProductosCarrusel();
			var actual = getCarritoActual();
			setTimeout(
				function(){
					if( actual["actual"] != undefined ){
						jQuery(actual["actual"]).click();
					}
				}, 500
			);
		break;
		case 3: // Fase #3 - Plan
			change_title('Selecciona el tiempo de suscripción');
			jQuery("#plan article").css("display", "none");
			var actual = getCarritoActual();
			jQuery.each(PRODUCTOS[ actual["producto"] ]["planes"],  function(key, val){
				if( val == 1 ){
					jQuery( "#plan-"+PLANES[ key ].nombre ).css("display", "inline-block");
					var producto = actual["producto"];
					var presentacion = actual["presentacion"];
					var meses = PLANES[ key ].meses;
					jQuery( "#plan-"+PLANES[ key ].nombre+" .precio_plan" ).html( "$ "+( PRODUCTOS[ producto ]["presentaciones"][presentacion] * meses )+" MXN" );
				}
			});
		break;
		case 4: // Fase #5 - Resumen de Compra
			change_title('Verifica tu compra');
			var subtotal = 0;
			var iva = 0;
			var total = 0;
			var cant_item = 0;
			jQuery( '#cart-items' ).html("");
			var precio = 0;
			jQuery.each( CARRITO["productos"],  function(key, producto){
				var plan = PLANES[ producto['plan_id'] ].meses;
				var _producto = producto["producto"];
				var presentacion = producto["presentacion"];
				var precio_plan = PRODUCTOS[ _producto ]["presentaciones"][ presentacion ]*plan;
				precio = precio_plan;
				add_item_cart(
					key,
					producto["producto"],
					PRODUCTOS[ _producto ].nombre,
					producto['plan'],
					TEMA+"/productos/imgs/"+PRODUCTOS[ producto["producto"] ].dataextra.img,
					precio_plan,
					"RAZA "+producto["tamano"]+" "+producto["edad"]+" "+producto["presentacion"],
					producto["cantidad"]								
				);
				var temp_total = ( precio_plan * producto["cantidad"] );
				CARRITO["productos"][key]["subtotal"] = temp_total;
				subtotal += temp_total;
				cant_item += parseInt( producto["cantidad"] );
			});
			iva = subtotal * 0.12;
			subtotal= subtotal - iva;
			total = subtotal + iva;
			jQuery('#cant-item').html(cant_item);
			jQuery('#subtotal').html( FN(subtotal)+" MXN" );
			jQuery('#iva').html( FN(iva)+" MXN" );
			jQuery('#total').html( FN(total)+" MXN" );
			jQuery('#precio').html( FN(precio)+" MXN" );
			jQuery('#precio1').html( FN(precio)+" MXN" );
			jQuery('#precio2').html( FN(precio)+" MXN" );
			CARRITO["total"] = total;
			CARRITO["cantidad"] = cant_item;
		break;
	}
}

function getCarritoActual(){
	return CARRITO["productos"][ (CARRITO["productos"].length-1) ];
}

function FN(number){
	return new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(number);
}