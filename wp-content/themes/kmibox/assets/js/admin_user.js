
function login( urlbase ){
	$.post( urlbase+"/ajax/admin_user.php", {'key': 'login', 'email': $('[name="email"]').val(), 'clave': $('[name="clave"]').val(), }, function(result) {
		if( result > 0){
			$('#cant-'+id ).val( result );	
		}else{
			$('#cant-'+id ).val( 1 );	
		}
	})
	.fail(function() {
		console.log( "error al registrar los datos al carrito de compras" );
	})
}


function registro( urlbase ){
	var d = {
		'key': 'registro', 
		'email': $('[name="email"]').val(), 
		'email_c': $('[name="email_c"]').val(), 
		'clave': $('[name="clave"]').val(), 
		'clave_c': $('[name="clave_c"]').val(), 
		'nombre': $('[name="nombre"]').val(), 
		'apellido': $('[name="apellido"]').val(), 
	};
	$.post( urlbase+"/ajax/admin_user.php", d, function(result) {
		if( result > 0){
			$('#cant-'+id ).val( result );	
		}else{
			$('#cant-'+id ).val( 1 );	
		}
	})
	.fail(function() {
		console.log( "error al registrar los datos al carrito de compras" );
	})
}

