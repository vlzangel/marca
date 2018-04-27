<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$clientes = [];

	$user_info = get_userdata( get_current_user_id() );
	$user_type = $user_info->roles[0];
	$_soy_asesor =  $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$user_info->user_email}' ");
	if( $user_type == 'administrator' ){
		$clientes = $wpdb->get_results("SELECT * FROM wp_users ORDER BY ID DESC");
	}else{
		if( $_soy_asesor != null ){
			$clientes = $wpdb->get_results("
				SELECT u.* FROM wp_users as u 
					INNER JOIN wp_usermeta as m ON m.user_id = u.ID 
				WHERE m.meta_value = {$_soy_asesor->id} and m.meta_key = 'asesor_registro'
				ORDER BY ID DESC");
		}
	}

	$data["data"] = array();
	$excel = array();

	$contador = 0;
	foreach ($clientes as $cliente) {

		$contador++;

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
			$es_asesor_excel = "NO";
			$es_asesor = "NO";
			if( $user_type == 'administrator' ){
				$es_asesor = "<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$cliente->ID."' 
	        		data-titulo='Convertir en Asesor' 
	        		data-modulo='clientes' 
	        		data-modal='asignar_asesor' 
	        		class='enlace' style='text-align: center;'
	        	>NO</span>";
	    	}
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

		$asesor_padre = "---";
		$__asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id = ".$metadata[ "asesor_registro" ]);
		if( $metadata[ "asesor_registro" ] > 0 ){ $asesor_padre = $__asesor->codigo_asesor; }

		if( $user_type == 'administrator' ){
			$_asesor_padre = "<span 
        		onclick='abrir_link( jQuery( this ) )' 
        		data-id='".$cliente->ID."' 
        		data-titulo='Asociar un Asesor' 
        		data-modulo='clientes' 
        		data-modal='asociar_asesor' 
        		class='enlace' style='text-align: center;'
        		>$asesor_padre</span>";
        	$cliente_nombre = "<a href='".get_home_url()."/?i=".md5($cliente->ID)."' target='_blank'>".$metadata[ "first_name" ]." ".$metadata[ "last_name" ]."</a>";
    	}else{
        	$cliente_nombre = $metadata[ "first_name" ]." ".$metadata[ "last_name" ];
			$_asesor_padre = "<span style='text-align: center;'>$asesor_padre</span>";
    	}

		$data["data"][] = array(
	        $contador,
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        $cliente_nombre,
	        $cliente->user_email,
	        $telefonos,
	        $direccion,
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor,
	        $_asesor_padre
	    );

		$excel[] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        $metadata[ "first_name" ]." ".$metadata[ "last_name" ],
	        array(
	        	"valor" => $cliente->user_email,
	        	"tipo" => "link",
	        	"link" => ( $user_type == 'administrator' )? get_home_url()."/?i=".md5($cliente->ID) : '' 
	        ),
	        $telefonos,
	        $direccion,
	        strtoupper( $donde ),
	        $metadata["is_user_kmimos"],
	        $es_asesor,
	        $asesor_padre
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
                "Asesor",
                "Asesor Padre",
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>