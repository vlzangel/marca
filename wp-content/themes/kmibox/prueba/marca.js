jQuery(function(jQuery){

	// *******************************
	// Carrousel - Tamaños
	// *******************************
	jQuery('.carrousel-items').on('click', 'article', function(){
		var index = jQuery(this).index() + 1; 
		// Primer items - Direccion (Izq. a Der.)
		if( index ==  1 ){
			jQuery(".carrousel-items article:last").insertBefore( jQuery(".carrousel-items article:first") );
		}
		// Ultimo items - Direccion (Der. a Izq.)
		if( index == jQuery('.carrousel-items article').length ){
			jQuery(".carrousel-items article:first").insertAfter( jQuery(".carrousel-items article:last") );
		}

	});

	// *******************************
	// Carrousel - Productos
	// *******************************
	jQuery('.carrousel2-items').on('click', 'article', function(){
		var index = jQuery(this).index() + 1; 
		// Primer items - Direccion (Izq. a Der.)
		if( index ==  1 ){
			jQuery(".carrousel2-items article:last").insertBefore( jQuery(".carrousel2-items article:first") );
		}
		// Ultimo items - Direccion (Der. a Izq.)
		if( index == jQuery('.carrousel2-items article').length ){
			jQuery(".carrousel2-items article:first").insertAfter( jQuery(".carrousel2-items article:last") );
		}
		jQuery('[data-target="producto_name"]').html( jQuery('.carrousel2-items article:nth-child(3)').attr('data-text') );
	});

	jQuery('.tamano-list').on('click', 'li', function(){
		jQuery('.tamano-list li').removeClass('selected');
		jQuery(this).addClass('selected');
	});


});