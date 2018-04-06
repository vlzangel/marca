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
            "url": TEMA+'/backend/clientes/ajax/clientes.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function actualizarAsesor(){
	var URL = TEMA+"/backend/clientes/ajax/updateAsesor.php";
    jQuery.post(
		URL,
		jQuery("#asignar_asesor").serialize(), 
		function(data){
        	if( data.code == 0 ){
        		alert(data.msg);
        	}else{
	            table.ajax.reload();
	            cerrar();
        	}
		}, "json"
	);

}


function asociarAsesor(){
	var URL = TEMA+"/backend/clientes/ajax/asociarAsesor.php";
    jQuery.post(
		URL,
		jQuery("#asociar_asesor").serialize(),
		function(data){
        	if( data.code == 0 ){
        		alert(data.msg);
        	}else{
	            table.ajax.reload();
	            cerrar();
        	}
		}, "json"
	);
}