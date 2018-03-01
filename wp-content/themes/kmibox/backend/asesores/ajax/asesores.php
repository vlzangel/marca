<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$asesores = $wpdb->get_results("SELECT * FROM asesores ORDER BY id DESC");

	$data["data"] = array();
	$excel = array();

	foreach ($asesores as $asesor) {


		$data["data"][] = array(
	        $asesor->id,
	        $asesor->codigo_asesor,
	        $asesor->nombre,
	        $asesor->email,
	        $asesor->telefono
	    );

		$excel[] = array(
	        $asesor->id,
	        $asesor->codigo_asesor,
	        $asesor->nombre,
	        $asesor->email,
	        $asesor->telefono
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Asesores",
			"file_name" => "asesores",
			"titulos" => array(
				"ID",
                "Código de Asesor",
                "Nombre y Apellido",
                "Email",
                "Teléfono"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>