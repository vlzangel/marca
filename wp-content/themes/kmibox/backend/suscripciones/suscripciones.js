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
            "url": TEMA+'/backend/suscripciones/ajax/suscripciones.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function cancelarSuscripcion(_this){
	var id_orden = _this.attr("data-id");
    var confirmed = confirm("Esta seguro de cancelar la suscripci\u00f3n id: "+id_orden+"?");
    if (confirmed == true) {
        jQuery.ajax({
            async:true, 
            cache:false, 
            type: 'POST', 
            url: TEMA+'/procesos/suscripciones/cancelar.php',
            data: {ID_ORDEN: id_orden}, 
            success:  function(HTML){
                alert("Suscripci\u00f3n cancelada exitosamente!");
                location.reload();
            },
            beforeSend:function(){},
            error:function(e){
                console.log(e);
            }
        });
    }
}