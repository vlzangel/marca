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
            "url": TEMA+'/backend/marcas/ajax/marcas.php',
            "type": "POST"
        }
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );

function crearMarca(e){
	var name = e.attr("name");
	var URL = TEMA+"/backend/marcas/ajax/crearMarca.php";
	if( name == "update" ){ URL = TEMA+"/backend/marcas/ajax/updateMarca.php"; }

	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#marca").serialize(), 
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

function img_cargada(img_reducida){
	jQuery("#img_reducida").val(img_reducida);
	jQuery("#img_vista").attr("src", img_reducida);
}

function editar_Marca(e){
	var id = e.attr("data-id");

}

function eliminar_marca(e){
	var id_Marca = e.attr("data-id");
    var confirmed = confirm("Esta seguro de eliminar esta Marca?");
    if (confirmed == true) {
		jQuery.ajax({
	        async:true, 
	        cache:false, 
	        type: 'POST', 
	        url: TEMA+"/backend/marcas/ajax/eliminarMarca.php",
	        data: {id: id_Marca}, 
	        success:  function(HTML){
	            table.ajax.reload();
	            alert("Marca eliminado exitosamente!");
	        },
	        beforeSend:function(){},
	        error:function(e){
	        	console.log(e);
	        }
	    });
    }
}
