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
            "url": TEMA+'/backend/tipos/ajax/tipos.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function crearTipo(e){
	var name = e.attr("name");
	var URL = TEMA+"/backend/tipos/ajax/crearTipo.php";
	if( name == "update" ){ URL = TEMA+"/backend/tipos/ajax/updateTipo.php"; }

	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#tipo").serialize(), 
        success:  function(HTML){
            table.ajax.reload();
            cerrar();
        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
}

function eliminar_tipo(e){
	var id_Tipo = e.attr("data-id");
    var confirmed = confirm("Esta seguro de eliminar este Tipo de Mascota?");
    if (confirmed == true) {
		jQuery.ajax({
	        async:true, 
	        cache:false, 
	        type: 'POST', 
	        url: TEMA+"/backend/tipos/ajax/eliminarTipo.php",
	        data: {id: id_Tipo}, 
	        success:  function(HTML){
	            table.ajax.reload();
	            alert("Tipo de Mascota eliminada exitosamente!");
	        },
	        beforeSend:function(){},
	        error:function(e){
	        	console.log(e);
	        }
	    });
    }
}
