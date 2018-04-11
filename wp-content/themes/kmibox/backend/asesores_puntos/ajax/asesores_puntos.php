<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	extract($_POST);


	// Validar si es administrador
	$user_info = get_userdata( get_current_user_id() );
	$user_type = $user_info->roles[0];

	$WHERE ='';
	if( $user_type != 'administrator' ){
		$WHERE = ( !empty($WHERE) )? ' AND ':'';
		$WHERE = " a.email = '{$user_info->user_email}'" ;
	}
	if( isset($id) ){ 
		$WHERE = ( !empty($WHERE) )? ' AND ':'';
		$WHERE = "p.asesor_id = {$id}";
	}

	if( !empty($WHERE) ){
		$WHERE = ' WHERE ' . $WHERE;
	}
	$sql = "SELECT p.*, a.codigo_asesor as codigo, a.nombre, a.email, pr.nombre as producto
		FROM asesores_puntos as p
			INNER JOIN asesores as a ON a.id = p.asesor_id
			INNER JOIN productos as pr ON pr.id = p.producto_id
		{$WHERE} ";

	$asesores = $wpdb->get_results($sql);

	$data["data"] = array();
	$excel = array();

	foreach ($asesores as $asesor) {

		$data["data"][] = array(
			$asesor->codigo,
			$asesor->nombre,
			$asesor->email,
			$asesor->id_factura_bitrix,
			$asesor->id_orden,
			$asesor->producto,
			$asesor->puntos,
			$asesor->cantidad,
			$asesor->total
	    );

		$excel[] = array(
			$asesor->codigo,
			$asesor->nombre,
			$asesor->email,
			$asesor->id_factura_bitrix,
			$asesor->id_orden,
			$asesor->producto,
			$asesor->puntos,
			$asesor->cantidad,
			$asesor->total
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Puntos",
			"file_name" => "asesor_puntos",
			"titulos" => array(
				"Codigo",
				"Nombre",
				"Email",
				"Factura Bitrix",
				"Orden",
				"Producto",
				"Puntos",
				"Cantidad",
				"Total"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>