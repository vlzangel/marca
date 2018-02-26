var CARRITO = [];
var CUPONES = [];

CUPONES["cupones"] = [];
CUPONES["totalDescuento"] = 0;

CARRITO["cantidad"] = 0;
CARRITO["productos"] = [];

/*CARRITO["productos"].push({
	"tamano": "",
	"edad": "",
	"plan": "",
	"plan_id": "",
	"cantidad": 1,
	"precio": 0.00,
	"subtotal": 0.00
});*/


CARRITO["cantidad"] = 1;
CARRITO["total"] = 1500.00;
CARRITO["productos"].push({
	"tamano": "Pequeño",
	"edad": "Cachorro",
	"marca": "19",
	"producto": "125",
	"plan": "Bimestral",
	"plan_id": "2",
	"cantidad": 1,
	"precio": 750.00,
	"subtotal": 1500
});

var mostrar_modal_marca = 1;
var BUSQUEDA_REGEXP = '';
var PRODUCTOS = [];
var MARCAS = [];
var PLANES = [];

jQuery( window ).resize(function() {
  	reset_flechas_marcas();
});

jQuery(document).ready(function() {

	if(navigator.platform.substr(0, 2) == 'iP'){
		jQuery("body").addClass('iOS');
	}

	jQuery('form[data-target="busqueda"]').on('submit', function(e){
		e.preventDefault();
		//var str = jQuery(this).parent().parent().find('input[data-target="search"]').val();
		var str = jQuery(this).find('input[data-target="search"]').val();
		jQuery('input[data-target="search"]').val( str );
		
		var REGEXP_SIN_ESPACIO = "";
		var REGEXP_CON_ESPACIO = str.trim().replace(/(\s{1,})/g, "|");
		
		if( REGEXP_CON_ESPACIO != ""){
			REGEXP_SIN_ESPACIO = "|"+str.trim().replace(/(\s{1,})/g, "");
		}
		BUSQUEDA_REGEXP = "("+REGEXP_CON_ESPACIO+REGEXP_SIN_ESPACIO+")";
		//console.log(BUSQUEDA_REGEXP);

		change_fase(3);
	});

	jQuery('.carrousel-items').on('click', 'article', function(){

		if( !jQuery(".carrousel-items-containers").hasClass("hover_carrousel_item") ){
			jQuery(".carrousel-items-containers").addClass("hover_carrousel_item");
			jQuery("#edad span").removeClass("btn-disable");
		}

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

		if( !jQuery(this).hasClass("btn-disable") ){
			jQuery("#edad span").removeClass("btn_activo");
			jQuery(this).addClass("btn_activo");
			var prod_actual = getCarritoActual();
			prod_actual["edad"] = jQuery(this).attr("data-value");
			jQuery("#descripcion_producto").html( "RAZA "+prod_actual["tamano"]+" "+prod_actual["edad"]+" <span><span>" );
			change_fase(2);
		}else{
			alert("Debe seleccionar un tamaño primero");
		}

	});

	jQuery("#marca_select").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			BUSQUEDA_REGEXP = '';
			jQuery('input[data-target="search"]').val( '' );
			change_fase(3);
		}
	});

	jQuery("#presentacion_select").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			change_fase(4);
		}
	});

	jQuery("#plan article").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["plan"] = PLANES[ jQuery(this).attr("data-value") ].nombre;
		prod_actual["plan_id"] = jQuery(this).attr("data-value");
		jQuery("#plan article").removeClass("plan_activo");
		jQuery(this).addClass("plan_activo");
		change_fase(5);
	});

	jQuery("#vlz_atras").on("click", function(e){
		change_fase( jQuery(this).attr("data-value") );
	});

	jQuery("#tipo_mascota").on("change", function(e){
		var TIPO = jQuery(this).val();
		jQuery('#marca > div').css("display", "none");
		jQuery('#marca > .tipo_'+TIPO).css("display", "block");
		jQuery('#cant_marcas').html( jQuery('#marca > .tipo_'+TIPO).length );
		reset_flechas_marcas();
	});

	jQuery("#agregar_plan").on("click", function(e){
		e.preventDefault();
		CARRITO["productos"].push({
			"tamano": "",
			"edad": "",
			"plan": "",
			"plan_id": "",
			"cantidad": 1,
			"precio": 0.00,
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

	jQuery("#abajo_marcas").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			bajarFila();
		}
	});

	jQuery("#arriba_marcas").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			subirFila();
		}
	});

	jQuery("#abajo_marcas_3").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			bajarFila(3);
		}
	});

	jQuery("#arriba_marcas_3").on("click", function(e){
		if( !jQuery(this).hasClass("btn-disable") ){
			subirFila(3);
		}
	});

	jQuery("#cupones .cupon_input_container span").on("click", function(e){
		jQuery.post(
			TEMA+"/procesos/compra/cupon.php", {
				cupon: jQuery("#cupones .cupon_input_container input").val(),
				cupones: CUPONES["cupones"],
				totalDescuentos: CUPONES["totalDescuento"],
				total: CARRITO["total"]
			},
			function(data){
				if( data.error == undefined ){
					CUPONES["cupones"].push( data.cupon );
					CUPONES["totalDescuento"] = data.totalDescuentos;
					jQuery("#input_cupon").val("");
					desgloseDescuentos();
				}else{
					alert(data.error);
				}
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
	});

	initProductos_y_Planes();

	if( MODIFICACION == "" ){
		change_fase(1);
	}else{
		CARRITO = MODIFICACION;
	}

});

function desgloseDescuentos(){
	var cupones_str = "";
	var descuentos_str = "";
	if( CUPONES.cupones.length > 0 ){
		jQuery.each(CUPONES.cupones, function(key, cupon){
			cupones_str += "<div>"+cupon[0]+"</div>";
			descuentos_str += "<div>"+'$ '+FN(cupon[1])+' MXN'+" <i class='fa fa-trash' data-id='"+key+"' onclick='quitarCupon(jQuery(this));'></i> </div>";
		});
		jQuery("#desgloseDescuentos").css("display", "table-row");
	}else{
		jQuery("#desgloseDescuentos").css("display", "none");
	}
	jQuery("#cupones_desglose").html(cupones_str);
	jQuery("#descuentos_desglose").html(descuentos_str);
	jQuery("#total").html( '$ '+FN(CARRITO["total"]-CUPONES["totalDescuento"])+' MXN' );
}

function quitarCupon(cupon){
	var temp = CUPONES.cupones[ cupon.attr("data-id") ];
	CUPONES.totalDescuento -= temp[1];
	CUPONES.cupones.splice(cupon.attr("data-id"), 1);
	desgloseDescuentos();
}

function reset_flechas_marcas(){
	var seccion = getSeccion();
	if( seccion != '' ){
		var filas = getFilas();
		if( filas <= 0 ){
			jQuery("#msg_desplazar"+seccion).addClass("hidden");
		}else{
			jQuery("#msg_desplazar"+seccion).removeClass("hidden");
		}
	}
}

function getFilas(h){
	var seccion = getSeccion();
	if( seccion != '' ){
		var filas_h = 0;
		switch(seccion){
			case "_marcas":
				filas_h = 4;
			break;
			case "_precentaciones":
				filas_h = 3;
			break;
		}

		var h = getH();
		if( h != 0 ){
			var filas = Math.ceil( parseInt( jQuery("#cant"+seccion).html() ) / h );
			return (filas-filas_h);
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}

function getH(){
	var seccion = getSeccion();
	switch(seccion){
		case "_marcas":
			var index = jQuery("#arriba_marcas").css("z-index");
			switch(index){
				case "101":
					return 3;
				break;
				case "102":
					return 2;
				break;
			}
		break;
		case "_precentaciones":
			var index = jQuery("#arriba_marcas").css("z-index");
			switch(index){
				case "101":
					return 1;
				break;
				case "102":
					return 1;
				break;
			}
		break;
		case "":
			return 0;
		break;
	}
	return 0;
}

function getSeccion(){
	var seccion = "";
	if( !jQuery("#fase_2").hasClass("hidden") ){
		seccion = "_marcas";
	}
	if( !jQuery("#fase_3").hasClass("hidden") ){
		seccion = "_precentaciones";
	}
	return seccion;
}

function subirFila(){
	var top = parseInt( jQuery("#marca").attr("data-top") );
	top -= 1;
	jQuery("#marca > div").animate({top: "-"+(top*25)+"%"}, "slow" );
	jQuery("#marca").attr("data-top", top);
	if( top == 0 ){
		jQuery("#arriba_marcas").addClass("btn-disable");
	}
	var filas = getFilas();
	if( top < filas ){
		jQuery("#abajo_marcas").removeClass("btn-disable");
	}
}

function bajarFila(){
	var top = parseInt( jQuery("#marca").attr("data-top") );
	top += 1;
	jQuery("#marca > div").animate({top: "-"+(top*25)+"%"}, "slow" );
	jQuery("#marca").attr("data-top", top);
	if( top > 0 ){
		jQuery("#arriba_marcas").removeClass("btn-disable");
	}
	var filas = getFilas();
	if( top >= filas ){
		jQuery("#abajo_marcas").addClass("btn-disable");
	}
}

function get_json_cart(){
	var _json = JSON.stringify( CARRITO["total"] )+"===";
	_json += JSON.stringify( CARRITO["cantidad"] )+"===";
	jQuery.each(CARRITO["productos"],  function(key, producto){
		_json += JSON.stringify( producto )+"|";
	});
	_json += "==="+JSON.stringify( CUPONES.cupones )+"|"+CUPONES.totalDescuento+"===";
	return _json;
}

function initProductos_y_Planes(){
	jQuery.post(
		TEMA+"assets/ajax/productos_planes.php", {},
		function(data){
			PRODUCTOS = data["PRODUCTOS"];
			MARCAS = data["MARCAS"];
			PLANES = data["PLANES"];

			if( MODIFICACION != "" ){
				change_fase(5);
			}

		}, "json"
	).fail(function(e) {
		console.log( e );
  	});
}

function change_fase(fase){
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

function loadMarcas(){
	var prod_actual = getCarritoActual();
	var actual_select = prod_actual["producto"];
	jQuery('#marca').html("");
	var CANT = 0;
	jQuery.each(MARCAS,  function(key, marca){
		jQuery('#marca').append(
			'<div id="item_'+key+'" data-id="'+key+'" data-name="'+marca.nombre+'" class="tipo_'+marca.tipo+'">'+
				'<div class="item_box">'+
					'<div class="img_box" style="background-image: url('+marca.img+');"></div>'+
				'</div>'+
			'</div>'
		);
		CANT++;
	});

	jQuery('#cant_marcas').html( CANT );	
}

function initMarcas(){
	jQuery("#marca > div").on("click", function(e){ 
		var prod_actual = getCarritoActual();
		prod_actual["marca"] = jQuery(this).attr("data-id");
		jQuery("#marca > div").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery("#marca_select").removeClass("btn-disable");
	});
	jQuery("#tipo_mascota").change();
}

function loadPresentaciones(){
	jQuery('#presentaciones').html("");
	var CANT = 0;
	var prod_actual = getCarritoActual();

	jQuery.each(PRODUCTOS,  function(key, producto){

		/* BEGIN Search */
			var mostrar = 0;

			/* Integrar los criterios de busqueda */
			var buscar_por = 
					producto.nombre + ' ' + 
					producto.descripcion + ' ' +
					MARCAS[producto.marca].nombre
				;

			// Agregar criterios de busqueda sin espacios
			buscar_por = buscar_por + ' ' + buscar_por.trim().replace(/(\s{1,})/g, "");

			if( BUSQUEDA_REGEXP != '' ){
				prod_actual["marca"] = '';
				var re = new RegExp(BUSQUEDA_REGEXP.toLowerCase());
				if ( re.test(buscar_por.toLowerCase())) {
					mostrar = 1;
				}
			}
		/* END Search */

		if( prod_actual["marca"] == producto.marca || mostrar == 1 ){

			if( producto.tamanos[ prod_actual["tamano"] ] == 1 ){
				if( producto.edades[ prod_actual["edad"] ] == 1 ){

					var existencia = "";
					if( producto.existencia == -1 ){
						existencia = "Agotado";
					}

					HTML = '<div id="item_'+key+'" data-id="'+key+'" data-name="'+producto.nombre+'">'+
							'<div class="item_box">'+
								'<div class="img_box" style="background-image: url('+TEMA+"/imgs/productos/"+producto.dataextra.img+');"></div>'+
								'<div class="info_producto_container">'+
									'<div class="title_producto_box">'+producto.nombre+'</div>'+
									'<div class="descripcion_producto_box">'+producto.descripcion+'</div>'+
									'<div class="peso_producto_box">'+producto.peso+'</div>'+
									'<div class="existencia_producto_box">'+existencia+'</div>'+
									'<div class="title_producto_box">'+FN(producto.precio)+" MXN"+'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
					jQuery('#presentaciones').append( HTML );
					CANT++;
				}
			}
		}
	});

	jQuery('#cant_precentaciones').html( CANT );

	BUSQUEDA_REGEXP = '';

	reset_flechas_marcas();
}

function initPresentaciones(){
	jQuery("#presentaciones > div").on("click", function(e){
		var prod_actual = getCarritoActual();
		prod_actual["producto"] = jQuery(this).attr("data-id");
		prod_actual["precio"] = PRODUCTOS[ jQuery(this).attr("data-id") ].precio;
		jQuery("#presentaciones > div").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery("#presentacion_select").removeClass("btn-disable");
	});
}

function change_title(txt){
	jQuery("#vlz_titulo").html(txt);
}

function add_item_cart( index, ID, name, frecuencia, thumnbnail, price, descripcion, peso, cantidad = 1 ){
	var hoy = new Date();
	hoy = parseInt( hoy.getDate() );
	var msjFrecuencia;

	if (frecuencia === 'Sólo por esta vez'){
		msjFrecuencia = 'El cobro de tu suscripción se hará <label class="resaltar_desglose">'+frecuencia+'</label>';	
	}else{
		msjFrecuencia = 'El monto mostrado a continuación se cobrará automáticamente <label class="resaltar_desglose">'+frecuencia+'</label> los días '+hoy+' de cada mes';
	}
	
	//if(hoy < 10){ hoy = "0"+hoy; }
	var HTML = "";
	HTML += '<tr>';
	HTML += '	 <td class="solo_pc">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')" style="display: inline-block; padding-left: 10px;">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_movil" id= "prueba" style="text-align: center;">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')" style="margin-right: 10px;">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 	<img src="'+thumnbnail+'"  height="60px">';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc" style="text-align: center;">';
	HTML += '	 	<img src="'+thumnbnail+'"  height="60px">';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label> <div class="resaltar_desglose">'+name+'</div> <div class="cart_descripcion">'+descripcion+' </div> <div class="">'+peso+' </div></label>';
	HTML += '	 	<label class="solo_movil">$ '+FN(price)+' MXN</label>';
	/*HTML += '	 	<div class="solo_movil">El monto mostrado a continuación se cobrará automáticamente <label class="resaltar_desglose">'+frecuencia+'</label> los días '+hoy+'de cada mes</div>';
	*/
	HTML += '	 	<div  class="solo_movil"><div class="solo_movil" >'+msjFrecuencia+'</div>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 '+msjFrecuencia+'</label>';	
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 	<label>$ '+FN(price)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<div class="cantidad_controls">';
	HTML += '	 		<i class="fa fa-minus-circle menos" onclick="menos_cantidad('+index+')"></i>';
	HTML += '	 			<label id="cant_'+index+'"> '+cantidad+' </label>';
	HTML += '	 		<i class="fa fa-plus-circle mas" onclick="mas_cantidad('+index+')"></i>';
	HTML += '	 	</div>';
	HTML += '	 	<div class="resaltar_desglose solo_movil total_en_cantidad" style="text-align: center; width: 100%;">$ '+FN(price*cantidad)+' MXN</div>';
	HTML += '	 </td>';
	HTML += '	 <td class="solo_pc center">';
	HTML += '	 	<label class="resaltar_desglose">$ '+FN(price*cantidad)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '</tr>';
	HTML += '<tr>';
	HTML += '	 <td colspan=7 class="separador">';
	HTML += '	 	<hr>';
	HTML += '	 </td>';
	HTML += '</tr>';
	jQuery( '#cart-items' ).append(HTML);
}

function loadFase(fase){

	if( parseInt(fase) == 4 ){
		jQuery("#vlz_titulo").addClass("titulo_planes");
	}else{
		jQuery("#vlz_titulo").removeClass("titulo_planes");
	}

	switch( fase ){
		case "1":
			change_title('Elije el tamaño de tu mascota');
			mostrar_modal_marca = 1;
		break;
		case 1: // Fase #1 - Tamaño
			change_title('Elije el tamaño de tu mascota');
			
			var prod_actual = getCarritoActual();
			prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");
			mostrar_modal_marca = 1;
		break;


		case "2":
			change_title('Escoge la marca de tu preferencia');
			
			var prod_actual = getCarritoActual();
			prod_actual["tamano"] = jQuery(".carrousel-items article:nth-child(2)").attr("data-value");

		break;
		case 2: // Fase #2 - Producto

			change_title('Escoge la marca de tu preferencia');
			loadMarcas();
			initMarcas();

		break;

		case "3":
			change_title('Selecciona la presentaci&oacute;n del alimento');
		break;
		case 3: // Fase #3 - Presentación
			change_title('Selecciona la presentaci&oacute;n del alimento');
			
			loadPresentaciones();
			initPresentaciones();

			if( mostrar_modal_marca == 1){
				mostrar_modal_marca = 0;
				setTimeout(function() {
					jQuery("#modal-contacto-marca").modal('show');
		        },1500);
			}

		break;
		case "4":
			change_title('Selecciona el tiempo de suscripción');
		break;
		case 4: // Fase #4 - Plan
			change_title('Selecciona el tiempo de suscripción');
			jQuery("#plan article").css("display", "none");
			var actual = getCarritoActual();
			jQuery.each(PRODUCTOS[ actual["producto"] ]["planes"],  function(key, val){
				if( val == 1 ){
					jQuery( "#plan-"+key ).css("display", "inline-block");
				}
			});
		break;

		case "5":
			change_title('Verifica tu compra');
		break;
		case 5: // Fase #5 - Resumen de Compra
			change_title('Verifica tu compra');
			var subtotal = 0;
			var iva = 0;
			var total = 0;
			var cant_item = 0;
			jQuery( '#cart-items' ).html("");
			var precio = 0;
			jQuery.each( CARRITO["productos"],  function(key, producto){
				var plan = PLANES[ producto['plan_id'] ].meses;
				var descripcion_mes = PLANES[ producto['plan_id'] ].descripcion_mes;

				if( plan == 0 ){ plan = 1; }
				var _producto = producto["producto"];
				var precio_plan = producto["precio"];
				precio = precio_plan;
				add_item_cart(
					key,
					producto["producto"],
					PRODUCTOS[ _producto ].nombre,
					//producto['plan'],
					descripcion_mes,
					TEMA+"/imgs/productos/"+PRODUCTOS[ producto["producto"] ].dataextra.img,
					precio_plan,
					PRODUCTOS[ _producto ].descripcion,
					PRODUCTOS[ _producto ].peso,
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

function mas_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	var max = 20;
	if(valor < max){
	valor++;
	jQuery("#cant_"+index).html(valor);
	CARRITO["productos"][index]["cantidad"] = valor;
	CARRITO["cantidad"]++;
	loadFase(5);
	}else{
		jQuery('#mensaje').modal('show');
		jQuery('#label-mensaje').html('Excedio la cantidad maxima de productos nutriheoes permitido');
		
	}
}

function menos_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	if( valor > 1){
		valor--;
		jQuery("#cant_"+index).html(valor);
		CARRITO["productos"][index]["cantidad"] = valor;
		CARRITO["cantidad"]--;
		loadFase(5);
	}
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
			change_fase(5);
		}
    }
}