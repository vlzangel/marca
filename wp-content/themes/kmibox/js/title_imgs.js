jQuery(document).ready(function() {
	jQuery("img").attr("alt", "Nutriheroes - El camino a una correcta nutrición");
	if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod' || navigator.platform == 'MacIntel'){ 
		jQuery("body").addClass("iOS");
	}

	setTimeout(function(){
		jQuery( window ).scrollTop( 0 );
	}, 200);
	
	jQuery(".cerrar_modal_footer").on("click", function(e){
		jQuery("#contacto-ayuda").fadeOut();
	});
});