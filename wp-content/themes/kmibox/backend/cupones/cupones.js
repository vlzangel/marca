var table = "";
jQuery(document).ready(function() {
    table = jQuery('#example').DataTable({
    	"language": {
			"emptyTable":			"No hay datos disponibles en la tabla.",
			"info":		   			"Del _START_ al _END_ de _TOTAL_ ",
			"infoEmpty":			"Mostrando 0 registros de un total de 0.",
			"infoFiltered":			"(filtrados de un total de _MAX_ registros)",
			"infoPostFix":			" (actualizados)",
			"lengthMenu":			"Mostrar _MENU_ registros",
			"loadingRecords":		"Cargando...",
			"processing":			"Procesando...",
			"search":				"Buscar:",
			"searchPlaceholder":	"Dato para buscar",
			"zeroRecords":			"No se han encontrado coincidencias.",
			"paginate": {
				"first":			"Primera",
				"last":				"Última",
				"next":				"Siguiente",
				"previous":			"Anterior"
			},
			"aria": {
				"sortAscending":	"Ordenación ascendente",
				"sortDescending":	"Ordenación descendente"
			}
		},
        "scrollX": true,
        "ajax": {
            "url": TEMA+'/backend/cupones/ajax/cupones.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function crearCupon(e){
	var name = e.attr("name");
	var URL = TEMA+"/backend/cupones/ajax/crearCupon.php";
	if( name == "update" ){ URL = TEMA+"/backend/cupones/ajax/updateCupon.php"; }

	var btn = jQuery("#btn_submit").val();
	jQuery("#btn_submit").val("Procesando...");

	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#cupones").serialize(), 
        success:  function(HTML){
			jQuery("#btn_submit").val( btn);
            table.ajax.reload();
            cerrar();
        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
}

function editar_Cupon(e){
	var id = e.attr("data-id");
}

function eliminar_Cupon(e){
	var id_Cupon = e.attr("data-id");
    var confirmed = confirm("Esta seguro de eliminar esta Cupon?");
    if (confirmed == true) {
		jQuery.ajax({
	        async:true, 
	        cache:false, 
	        type: 'POST', 
	        url: TEMA+"/backend/cupones/ajax/eliminarCupon.php",
	        data: {id: id_Cupon}, 
	        success:  function(HTML){
	            table.ajax.reload();
	            alert("Cupon eliminado exitosamente!");
	        },
	        beforeSend:function(){},
	        error:function(e){
	        	console.log(e);
	        }
	    });
    }
}
