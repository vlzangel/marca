<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$niveles = $wpdb->get_results("SELECT * FROM asesores_niveles WHERE activo = 1 ORDER BY orden ASC");

	$data["data"] = array();
	$excel = array();

	foreach ($niveles as $nivel) {

		$bono = ($nivel->bono > 0)? $nivel->bono : '---' ; 

		$data["data"][] = array(
	        $nivel->orden,
	        $nivel->nivel,
	        $nivel->desde,
	        $nivel->hasta,
	        $bono,
			"<span 
        		onclick='abrir_link( jQuery( this ) )' 
        		data-id='".$nivel->id."' 
        		data-titulo='Editar Nivel' 
        		data-modulo='asesores_niveles' 
        		data-modal='nuevo' 
        		class='enlace'
        	>Editar</span><br>
        	<span onclick='eliminar( jQuery( this ) )' data-id='".$nivel->id."' class='enlace'>Eliminar</span><br>"
	    );

		$excel[] = array(
	        $nivel->orden,
	        $nivel->nivel,
	        $nivel->desde,
	        $nivel->hasta,
	        $bono,
	        ''
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Niveles de los asesores",
			"file_name" => "niveles_asesores",
			"titulos" => array(
                "Orden",
				"Nivel",
                "Desde",
                "Hasta",
                "Bono"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>