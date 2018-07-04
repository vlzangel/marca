<?php
	error_reporting(0);

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

    setZonaHoraria();

	global $wpdb;

	// Validar si es administrador
	$user_info = get_userdata( get_current_user_id() );
	$user_type = $user_info->roles[0];

	$WHERE ='';
	if( $user_type != 'administrator' ){
		$__asesor_id = $wpdb->get_var("SELECT id FROM asesores WHERE email = '{$user_info->user_email}' ");
		$WHERE = " WHERE asesor = {$__asesor_id}" ;
	}

	$suscripciones = $wpdb->get_results("SELECT * FROM ordenes {$WHERE} ORDER BY id DESC");
	$data["data"] = array();
	$excel = array();
	$ordenes = array();

	foreach ($suscripciones as $orden) {
		$_meta_cliente = get_user_meta($orden->cliente);

		$ordenes[ $orden->id ]["id"] = $orden->id;

		$ordenes[ $orden->id ]["fecha_creacion"] = date("d/m/Y", strtotime($orden->fecha_creacion));
		$ordenes[ $orden->id ]["cliente_id"] = $orden->cliente;
		$ordenes[ $orden->id ]["cliente"] = $_meta_cliente[ "first_name" ][0]." ".$_meta_cliente[ "last_name" ][0];
		$ordenes[ $orden->id ]["status"] = $orden->status;

		$asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id=".$orden->asesor);
		if( $asesor == null ){
			$asesor_padre = 0;
			if( $_meta_cliente[ "asesor_registro" ] != "" ){ $asesor_padre = $_meta_cliente[ "asesor_registro" ][0]; }
			if( $asesor_padre != "" ){ $asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id=".$asesor_padre); }
		}
		$ordenes[ $orden->id ]["asesor_id"] = $asesor->codigo_asesor;
		//$ordenes[ $orden->id ]["asesor_id"] = $asesor->id;

		$ordenes[ $orden->id ]["asesor_nombre"] = $asesor->nombre;
		$ordenes[ $orden->id ]["asesor_email"] = $asesor->email;

		$ordenData = unserialize($orden->metadata); 
		$cupones = ""; $cupones_excel = array();
		if( is_array($ordenData["cupones"]) && count($ordenData["cupones"]) > 0 ){
			foreach ($ordenData["cupones"] as $cupon) {
				$monto = "$ ".number_format( $cupon[1], 2, ',', '.')." MXN";
				$cupones .= "<div><strong>{$cupon[0]}: </strong>{$monto}</div>";
				$cupones_excel[] = "{$cupon[0]}: {$monto}";
			}
		}
		if( $cupones == "" ){ 
			$cupones = "---"; 
			$cupones_excel = "---";
		}else{
			$cupones_excel = implode(PHP_EOL, $cupones_excel);
		}

		$array_productos = array();
		$array_precios = array();
		$array_proximo_cobro = array();
		$array_status_cobro = array();
		$total_suscripcion = 0;

		$sub_suscripciones = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id_orden = ".$orden->id);
		foreach ($sub_suscripciones as $suscripcion) {

			$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = {$suscripcion->id_producto}");
			$data_suscripcion = unserialize($suscripcion->data);
			$_proximo_cobro = $wpdb->get_row("SELECT * FROM cobros WHERE item_orden = {$suscripcion->id} AND openpay_transaccion_id = '---'");

			$proximo_cobro = $_proximo_cobro->fecha_cobro;
			if( $proximo_cobro."" == "" ){
				$proximo_cobro = "---";
			}else{
				$proximo_cobro = date("d/m/Y h:i a", strtotime($proximo_cobro));
			}

			$hoy = date("Y-m-d", time() );
			$cobro_actual = $wpdb->get_var("SELECT status FROM cobros WHERE item_orden = {$suscripcion->id} AND fecha_cobro <= '{$hoy}' ");

			$_descripcion = $suscripcion->cantidad." x ".$producto->nombre." - ".$producto->descripcion." - ".$producto->peso." - ".$data_suscripcion[ "plan" ];
			$array_productos[] = $_descripcion;
			
			$array_precios[] = "$ ".number_format( $suscripcion->total+0, 2, ',', '.')." MXN";
			$array_proximo_cobro[] = $proximo_cobro;
			$array_status_cobro[] = $cobro_actual;

			$total_suscripcion += $suscripcion->total;
		}

		$ordenes[ $orden->id ]["productos"] = $array_productos;
		$ordenes[ $orden->id ]["precio"] = $array_precios;
		$ordenes[ $orden->id ]["proximo_cobro"] = $array_proximo_cobro;
		$ordenes[ $orden->id ]["status_cobro"] = $array_status_cobro;
		
		$total = $orden->total;
		if( $ordenData["descuento"] == "" && $total < $total_suscripcion ){
			$ordenData["descuento"] = $total_suscripcion - $total;
			$cupones .= "<div><strong>Cup&oacute;n no registrado</strong></div>";
			$total = $total_suscripcion;
		}

		$ordenes[ $orden->id ]["info_pago"] = array(
			"total" => "$ ".number_format( $total+0, 2, ',', '.')." MXN",
			"pago" => "$ ".number_format( $total-$ordenData["descuento"], 2, ',', '.')." MXN",
			"descuento" => "$ ".number_format( $ordenData["descuento"], 2, ',', '.')." MXN",
			"cupones" => $cupones,
			"cupones_excel" => $cupones_excel,
			"tipo_pago" => $ordenData["tipo_pago"],
		);
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
		if( $estado != "" ){ $estado = ", ".$estado; }else{ $estado = ""; }
		if( $municipio != "" ){ $municipio = ", ".$municipio; }else{ $municipio = ""; }

		if( $metadata["dir_colonia"] != "" ){ $metadata["dir_colonia"] = ", ".$metadata["dir_colonia"]; }else{ $metadata["dir_colonia"] = ""; }
		if( $metadata["dir_calle"] != "" ){ $metadata["dir_calle"] = $metadata["dir_calle"]; }else{ $metadata["dir_calle"] = ""; }
		if( $metadata["dir_numint"] != "" ){ $metadata["dir_numint"] = ", Int: ".$metadata["dir_numint"]; }else{ $metadata["dir_numint"] = ""; }
		if( $metadata["dir_numext"] != "" ){ $metadata["dir_numext"] = ", Ext: ".$metadata["dir_numext"]; }else{ $metadata["dir_numext"] = ""; }
		if( $metadata["dir_codigo_postal"] != "" ){ $metadata["dir_codigo_postal"] = " - ".$metadata["dir_codigo_postal"]; }else{ $metadata["dir_codigo_postal"] = ""; }

		$direccion = $metadata["dir_calle"].$metadata["dir_numint"].$metadata["dir_numext"].$metadata["dir_colonia"].$municipio.$estado.$metadata["dir_codigo_postal"];

		if( $direccion == "" ){ $direccion = "No registrado"; }

		$telefonos = array();
		if( $metadata[ "telef_movil" ] != "" ){ $telefonos[] = $metadata[ "telef_movil" ]; }
		if( $metadata[ "telef_fijo" ] != "" ){ $telefonos[] = $metadata[ "telef_fijo" ]; }
		if( count($telefonos) > 0 ){ $telefonos = implode(" - ", $telefonos); }else{ $telefonos = "No registrado"; }

		if( $_data["asesor_id"] == "" ){ $_data["asesor_id"] = "---"; }
	    if( $_data["asesor_nombre"] == "" ){ $_data["asesor_nombre"] = "---"; }
	    if( $_data["asesor_email"] == "" ){ $_data["asesor_email"] = "---"; }


	    $ordenes[ $suscripcion->id_orden ]["info_pago"] = array(
			"total" => $orden->total,
			"pago" => $orden->total-$ordenData["descuento"],
			"descuento" => $ordenData["descuento"],
			"cupones" => $cupones,
		);

	   	$__meta = $wpdb->get_row("SELECT * FROM ordenes WHERE id = $orden_id" );
        $__meta_arr = unserialize( $__meta->metadata );
        $migrada = ( isset( $__meta_arr['migrada'] ) && $__meta_arr['migrada']=='SI'  )? 'SI' : '';

        $btn_cancelar = "<span class='enlace' onClick='cancelarSuscripcion(jQuery(this))' data-id='{$_data["id"]}'>Cancelar</span>";
        if(!empty($__asesor_id)){
        	$btn_cancelar = "---";
        }

		$index_row++;
		$data["data"][] = array(
			$index_row,
	        $orden_id,
	        $migrada,
	        $_data["status"],
	        $_data["fecha_creacion"],
	        $_data["cliente"],
	        "<strong>ID: </strong>".$_data["cliente_id"]."<br>".
	        "<strong>Email: </strong>".$wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = ".$_data["cliente_id"])."<br>".
	        "<strong>Tel&eacute;fono: </strong>".$telefonos."<br>".
	        "<strong>Direcci&oacute;n: </strong>".$direccion,	
	        $_data["info_pago"]["tipo_pago"],        
	        $_productos,
	        $_precios,

	        $_data["info_pago"]["total"],
	        $_data["info_pago"]["pago"],
	        $_data["info_pago"]["descuento"],
	        $_data["info_pago"]["cupones"],

	        implode("<br>", $_data["status_cobro"]),
	        $_cobros,
	        $_data["asesor_id"],
	        $_data["asesor_nombre"],
	        $_data["asesor_email"],
	        $btn_cancelar
	    );

		$excel[] = array(
			$index_row,
	        $orden_id,
	        $migrada,
	        date("d/m/Y", strtotime( str_replace("/", "-", $_data["fecha_creacion"])))." ",
	        $_data["cliente"],
	        "Teléfono: ".$telefonos."\nDirección: ".$direccion,
	        $_data["tipo_pago"],  
	        implode(PHP_EOL, $_productos_excel),
	        implode(PHP_EOL, $_precios_excel),

	        $_data["info_pago"]["total"],
	        $_data["info_pago"]["pago"],
	        $_data["info_pago"]["descuento"],
	        $_data["info_pago"]["cupones_excel"],

	        implode(PHP_EOL, $_data["status_cobro"]),
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
				"Tipo de pago",
				"Producto(s)",
				"Precio(s)",

				"Total",
				"Pago",
				"Descuento",
				"Cupones",

				"Status Cobro(s)",
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