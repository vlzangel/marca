function carrousel_productos_responsive() {
		jQuery("#carrousel_2").waterwheelCarousel({
			flankingItems: 5,
			separation: 100,
			orientation: 'horizontal',
			movingToCenter: function (jQueryitem) {},
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
			movingFromCenter: function (jQueryitem) {},
			movedFromCenter: function (jQueryitem) {},
			clickedCenter: function (jQueryitem) {}
		});
	}