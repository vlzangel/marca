<?php
    date_default_timezone_set('America/Mexico_City');
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;
	$suscripciones = $wpdb->get_results("SELECT * FROM items_ordenes ORDER BY id DESC");
	$data["data"] = array();
	$excel = array();
	$ordenes = array();

	foreach ($suscripciones as $suscripcion) {
		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$_meta_cliente = get_user_meta($orden->cliente);
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = {$suscripcion->id_producto}");
		$data_suscripcion = unserialize($suscripcion->data);
		$proximo_cobro = $wpdb->get_var("SELECT fecha_cobro FROM cobros WHERE item_orden = {$suscripcion->id} AND openpay_transaccion_id = '---'");
		if( $proximo_cobro."" == "" ){
			$proximo_cobro = "---";
		}else{
			$proximo_cobro = date("d/m/Y h:i a", strtotime($proximo_cobro));
		}

		$ordenes[ $suscripcion->id_orden ]["fecha_creacion"] = date("d/m/Y", strtotime($orden->fecha_creacion));
		$ordenes[ $suscripcion->id_orden ]["cliente_id"] = $orden->cliente;
		$ordenes[ $suscripcion->id_orden ]["cliente"] = $_meta_cliente[ "first_name" ][0]." ".$_meta_cliente[ "last_name" ][0];
		

		$_descripcion = $suscripcion->cantidad." x ".$producto->nombre." - ".$producto->descripcion." - ".$producto->peso." - ".$data_suscripcion[ "plan" ];
		$ordenes[ $suscripcion->id_orden ]["productos"][] = $_descripcion;
		
		$ordenes[ $suscripcion->id_orden ]["precio"][] = "$ ".number_format( $suscripcion->total+0, 2, ',', '.')." MXN";
		$ordenes[ $suscripcion->id_orden ]["proximo_cobro"][] = $proximo_cobro;
		$ordenes[ $suscripcion->id_orden ]["status"] = $suscripcion->status_suscripcion;

		$asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id=".$orden->asesor);

		$ordenes[ $suscripcion->id_orden ]["asesor_id"] = $asesor->id;
		$ordenes[ $suscripcion->id_orden ]["asesor_nombre"] = $asesor->nombre;
		$ordenes[ $suscripcion->id_orden ]["asesor_email"] = $asesor->email;
	}

	$index_row=0;
	foreach ($ordenes as $orden_id => $_data) {
		$_asesor = '---';
		$orden = $wpdb->get_results(
			"SELECT a.* 
				FROM ordenes as o
					INNER JOIN asesores as a ON a.id = o.asesor 
			 	WHERE o.id = ". $orden_id);
		if( isset($orden[0]) ){
			$orden = $orden[0];
			$_asesor = "( ".$orden->codigo_asesor." ) ".$orden->nombre;
		}

		$_productos = "";
		$_productos_excel = array();
		foreach ($_data["productos"] as $producto) {
			$_productos .= '<div style="margin:2px 0px;">'.$producto."</div>";
			$_productos_excel[] = $producto;
		}

		$_precios = "";
		$_precios_excel = array();
		foreach ($_data["precio"] as $precio) {
			$_precios .= $precio."<br>";
			$_precios_excel[] = $precio;
		}

		$_cobros = "";
		$_cobros_excel = array();
		foreach ($_data["proximo_cobro"] as $cobro) {
			$_cobros .= $cobro."<br>";
			$_cobros_excel[] = $cobro;
		}

		$_metadata = get_user_meta($_data["cliente_id"]);
		$metadata = array();
		if( is_array($_metadata) && count($_metadata) > 0 ){
			foreach ($_metadata as $key => $value) {
				$metadata[ $key ] = $value[0];
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

		$index_row++;
		$data["data"][] = array(
			$index_row,
	        $orden_id,
	        $_data["fecha_creacion"],
	        $_data["cliente"],
	        "<strong>Tel&eacute;fono: </strong>".$telefonos."<br><strong>Direcci&oacute;n: </strong>".$direccion,	        
	        $_productos,
	        $_precios,
	        $_cobros,
	        $_data["asesor_id"],
	        $_data["asesor_nombre"],
	        $_data["asesor_email"]
	    );

		$excel[] = array(
			$index_row,
	        $orden_id,
	        date("d/m/Y", strtotime( str_replace("/", "-", $_data["fecha_creacion"])))." ",
	        $_data["cliente"],
	        "Teléfono: ".$telefonos."\nDirección: ".$direccion,
	        implode(PHP_EOL, $_productos_excel),
	        implode(PHP_EOL, $_precios_excel),
	        implode(PHP_EOL, $_cobros_excel),
	        $_data["asesor_id"],
	        $_data["asesor_nombre"],
	        $_data["asesor_email"]
	    );

	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Suscripciones",
			"file_name" => "suscripciones",
			"titulos" => array(
				"ID",
				"Orden",
				"Fecha suscripción",
				"Cliente",
				"Datos del cliente",
				"Producto(s)",
				"Precio(s)",
				"Proximo Cobro",
				"ID Asesor",
				"Asesor",
				"Email Asesor"
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>