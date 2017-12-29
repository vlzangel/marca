$(function($){

	// *******************************
	// Carrousel - Tamaños
	// *******************************
	$('.carrousel-items').on('click', 'article', function(){

		var index = $(this).index() + 1; 
		// Primer items - Direccion (Izq. a Der.)
		if( index ==  1 ){
			$(".carrousel-items article:last")
				.insertBefore( $(".carrousel-items article:first") );
		}
		// Ultimo items - Direccion (Der. a Izq.)
		if( index == $('.carrousel-items article').length ){
			$(".carrousel-items article:first")
				.insertAfter( $(".carrousel-items article:last") );
		}

	});

	// *******************************
	// Carrousel - Productos
	// *******************************
	$('.carrousel2-items').on('click', 'article', function(){

		var index = $(this).index() + 1; 
		// Primer items - Direccion (Izq. a Der.)
		if( index ==  1 ){
			$(".carrousel2-items article:last")
				.insertBefore( $(".carrousel2-items article:first") );
		}
		// Ultimo items - Direccion (Der. a Izq.)
		if( index == $('.carrousel2-items article').length ){
			$(".carrousel2-items article:first")
				.insertAfter( $(".carrousel2-items article:last") );
		}

		$('[data-target="producto_name"]').html( $('.carrousel2-items article:nth-child(3)').attr('data-text') );
	});

	$('.tamano-list').on('click', 'li', function(){
		$('.tamano-list li').removeClass('selected');
		$(this).addClass('selected');
	});


});