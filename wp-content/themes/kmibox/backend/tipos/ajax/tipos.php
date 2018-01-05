<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$tipos = $wpdb->get_results("SELECT * FROM tipo_mascotas ORDER BY id DESC");

	$data["data"] = array();

	foreach ($tipos as $tipo) {

		$data["data"][] = array(
	        $tipo->id,
	        $tipo->tipo,
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$tipo->id."' 
	        		data-titulo='Editar Tipo' 
	        		data-modulo='tipos' 
	        		data-modal='nuevo' 
	        		class='enlace'
	        	>Editar</span><br>
	        	<span onclick='eliminar_tipo( jQuery( this ) )' data-id='".$tipo->id."' class='enlace'>Eliminar</span><br>
	        "
	    );
	}

    echo json_encode($data);

?>