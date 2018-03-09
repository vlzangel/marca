<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$clientes = $wpdb->get_results("SELECT * FROM wp_users ORDER BY ID DESC");

	$data["data"] = array();
	$excel = array();

	foreach ($clientes as $cliente) {

		$_metadata = get_user_meta($cliente->ID);
		$metadata = array();
		foreach ($_metadata as $key => $value) {
			$metadata[ $key ] = $value[0];
		}

		$donde = $metadata[ "dondo_conociste" ];
		if( !isset($metadata[ "dondo_conociste" ]) ){
			$donde = "otros";
		}

		if( !isset($metadata["is_user_kmimos"]) ){
			$metadata["is_user_kmimos"] = "NO";
		}

		$_es_asesor =  $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$cliente->user_email}' ");
		$es_asesor = "";
		$es_asesor_excel = "";
		if( $_es_asesor != null ){
			$es_asesor = $_es_asesor->codigo_asesor;
			$es_asesor_excel = $_es_asesor->codigo_asesor;
		}else{
			$es_asesor = "<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$cliente->ID."' 
	        		data-titulo='Convertir en Asesor' 
	        		data-modulo='clientes' 
	        		data-modal='asignar_asesor' 
	        		class='enlace' style='text-align: center;'
	        	>NO</span>";
			$es_asesor_excel = "NO";
		}

		$estado = utf8_decode( $wpdb->get_var("SELECT name FROM wp_estados WHERE id = '".$metadata[ "dir_estado" ]."' ") );
		$municipio = utf8_decode( $wpdb->get_var("SELECT name FROM wp_municipios WHERE id = '".$metadata[ "dir_estado" ]."' ") );
		if( $estado != "" ){ }else{ $estado = ""; }
		if( $municipio != "" ){ $municipio = ", ".$municipio; }else{ $municipio = ""; }
		if( $metadata["r_address"] != "" ){ $metadata["r_address"] = ", ".$metadata["r_address"]; }else{ $metadata["r_address"] = ""; }
		if( $metadata["dir_codigo_postal"] != "" ){ $metadata["dir_codigo_postal"] = " - ".$metadata["dir_codigo_postal"]; }else{ $metadata["dir_codigo_postal"] = ""; }
		$direccion = $estado.$municipio.$metadata["r_address"].$metadata["dir_codigo_postal"];
		if( $direccion == "" ){ $direccion = "No registrado"; }

		$telefonos = array();
		if( $metadata[ "telef_movil" ] != "" ){ $telefonos[] = $metadata[ "telef_movil" ]; }
		if( $metadata[ "telef_fijo" ] != "" ){ $telefonos[] = $metadata[ "telef_fijo" ]; }
		if( count($telefonos) > 0 ){ $telefonos = implode(" - ", $telefonos); }else{ $telefonos = "No registrado"; }

		$data["data"][] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        "<a href='".get_home_url()."/?i=".md5($cliente->ID)."' target='_blank'>".$metadata[ "first_name" ]." ".$metadata[ "last_name" ]."</a>",
	        $cliente->user_email,
	        $telefonos,
	        $direccion,
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor
	    );

		$excel[] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        $metadata[ "first_name" ]." ".$metadata[ "last_name" ],
	        array(
	        	"valor" => $cliente->user_email,
	        	"tipo" => "link",
	        	"link" => get_home_url()."/?i=".md5($cliente->ID)
	        ),
	        $telefonos,
	        $direccion,
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Clientes",
			"file_name" => "clientes",
			"titulos" => array(
				"ID",
                "Fecha Registro",
                "Nombre y Apellido",
                "Email",
                "Teléfono",
                "Dirección",
                "Donde nos conocio?",
                "Usuario Kmimos",
                "Asesor"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>