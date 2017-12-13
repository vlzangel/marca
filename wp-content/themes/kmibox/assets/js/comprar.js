var PRODUCTOS = [];
jQuery(document).ready(function() {

	carrousel();

	CARRITO["tamano"] = jQuery("#carrousel img")[0].id;

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
			console.log( data );
		}, "json"
	).fail(function(e) {
		console.log( e );
  	});

	jQuery("#fase_1").css("display", "block");

});

function carrousel(){
	jQuery('#vlz_carrousel').waterwheelCarousel({
		separation: 300,
		edgeFadeEnabled: true,     	 
		flankingItems: 3,
		movingToCenter: function (jQueryitem) {
			CARRITO["tamano"] = jQueryitem.attr('id');
			jQuery('#callback-output').prepend('movingToCenter: ' + jQueryitem.attr('id') + '<br/>');
		},
		movedToCenter: function (jQueryitem) {
			jQuery('#callback-output').prepend('movedToCenter: ' + jQueryitem.attr('id') + '<br/>');
		},
		movingFromCenter: function (jQueryitem) {
			jQuery('#callback-output').prepend('movingFromCenter: ' + jQueryitem.attr('id') + '<br/>');
		},
		movedFromCenter: function (jQueryitem) {
			jQuery('#callback-output').prepend('movedFromCenter: ' + jQueryitem.attr('id') + '<br/>');
		},
		clickedCenter: function (jQueryitem) {
			jQuery('#callback-output').prepend('clickedCenter: ' + jQueryitem.attr('id') + '<br/>');
		}
	});
}