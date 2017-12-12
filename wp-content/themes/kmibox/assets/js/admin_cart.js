
function addCart( urlbase ){
	if( kmibox_param != "" ){
		var xdata = {
			'key':'create',
			'plan': kmibox_param['fase3'],
			'kmibox': service[ kmibox_param['fase1'] ][ kmibox_param['fase2'] ],
			'extras': {}
		};
		debug = xdata;
		$.each( kmibox_param['cart']['extra'], function(val){
			xdata['extras'][ val ] = extras[val];
		});

		$.post( urlbase+"/ajax/admin_cart.php", {xdata}, function(result) {
			/*console.log( result );*/		
		})
		.fail(function() {
			console.log( "error al registrar los datos al carrito de compras" );
		})

	}
}

function updateItem( id, cant, urlbase){
	var xdata = {
		'key':'update_cant',
		'cant': cant,
		'ID': id
	};

	debug = xdata;

	$.post( urlbase+"/ajax/admin_cart.php", {xdata}, function(result) {
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