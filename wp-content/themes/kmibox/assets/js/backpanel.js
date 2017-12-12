$(function($){

	// *******************************
	// Backpanel Control Envio
	// *******************************
	var protocol = window.location.href.split('#')[0].split('?')[0].split('/')[0];
	var urlbase = protocol+'//'+window.location.href.split('#')[0].split('?')[0].split('/')[2];
	
	$(document).on('change', '[data-target="estatus_envio"]', function(){
		var id = $(this).attr('data-id');		
		//alert(id);

		$.get( urlbase+"/kmibox/ajax/update_ubicacion_kmibox.php?estatus="+$(this).val()+"&id="+$(this).data('id'), function(result) {		
			
			if(result == 1){
				alert('Datos guardados');
			}else{
				alert('El registro no fue actualizado');
				$('[data-id="'+id+'"]').val('');
			}
		})
		.fail(function() {
			console.log( "error al registrar los datos al carrito de compras" );
		});

	});

});