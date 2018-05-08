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
            "url": TEMA+'/backend/asesores_niveles/ajax/asesores_niveles.php',
            "type": "POST"
        },
        "order": [[ 0, "asc" ]]
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );


function crear(){
    var URL = TEMA+"/backend/asesores_niveles/ajax/nuevo.php";
	jQuery.post(
		URL,
		jQuery("#nuevo").serialize(), 
		function(data){
			console.log(data);
        	if( data.code == 0 ){
        		alert(data.msg);
        	}else{
	            table.ajax.reload();
	            cerrar();
        	}
		}, "json"
	);
}

function actualizar(){
	var URL = TEMA+"/backend/asesores_niveles/ajax/update.php";
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#nuevo").serialize(), 
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

function eliminar(e){
    var _id = e.attr("data-id");
    var confirmed = confirm("Esta seguro de eliminar este nivel?");
    if (confirmed == true) {
    	var URL = TEMA+"/backend/asesores_niveles/ajax/delete.php";
    	jQuery.ajax({
            async:true, 
            cache:false, 
            type: 'POST', 
            url: URL,
            data: {id: _id}, 
            success:  function(HTML){
            	var data = JSON.parse(HTML); 
            	if( data['code'] == 1 ){
    	            table.ajax.reload();
    	            cerrar();
            	}else{
            		jQuery('#mensaje').html( data['msg'] );
            	}
            },
            beforeSend:function(){},
            error:function(e){
            	console.log(e);
            }
        });
    }
}