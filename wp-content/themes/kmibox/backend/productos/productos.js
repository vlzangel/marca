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
            "url": TEMA+'/backend/productos/ajax/productos.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function abrir_link(e){
	init_modal({
		"titulo": e.attr("data-titulo"),
		"modulo": e.attr("data-modulo"),
		"modal": e.attr("data-modal"),
		"info": {
			"ID": e.attr("data-id")
		}
	});
}

function crearProducto(){
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: TEMA+"/backend/productos/ajax/crearProducto.php",
        data: jQuery("#producto").serialize(), 
        success:  function(HTML){
            
            console.log(HTML);

        },
        beforeSend:function(){},
        error:function(e){
        	console.log(e);
        }
    });
}

function img_cargada(img_reducida){
	jQuery("#img_reducida").val(img_reducida);
	jQuery("#img_vista").attr("src", img_reducida);
}