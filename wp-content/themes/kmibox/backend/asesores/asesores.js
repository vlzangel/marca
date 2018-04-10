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
            "url": TEMA+'/backend/asesores/ajax/asesores.php',
            "type": "POST"
        },
        "order": [[ 0, "desc" ]]
	});

    jQuery("#close_modal").on("click", function(e){
        cerrar(e);
    });

} );


function crearNuevo(){
	var URL = TEMA+"/backend/asesores/ajax/nuevo.php";
	jQuery.post(
		URL,
		jQuery("#asignar_asesor").serialize(), 
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
	var URL = TEMA+"/backend/asesores/ajax/nuevo.php";
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#asignar_asesor").serialize(), 
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

function actualizarParent(){
	var URL = TEMA+"/backend/asesores/ajax/updateParent.php";
	jQuery.ajax({
        async:true, 
        cache:false, 
        type: 'POST', 
        url: URL,
        data: jQuery("#asignar_parent").serialize(), 
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