<?php
    date_default_timezone_set('America/Mexico_City');
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;
	$suscripciones = $wpdb->get_results("SELECT * FROM items_ordenes ORDER BY id DESC");
	$data["data"] = array();
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
		$ordenes[ $suscripcion->id_orden ]["cliente"] = $_meta_cliente[ "first_name" ][0]." ".$_meta_cliente[ "last_name" ][0];
		

		$_descripcion = $suscripcion->cantidad." x ".$producto->nombre." - ".$producto->descripcion." - ".$producto->peso." - ".$data_suscripcion[ "plan" ];
		// $_descripcion .= ', <span class="precio"> $ '.number_format( $suscripcion->total, 2, ',', '.').' MXN</span>';
		$ordenes[ $suscripcion->id_orden ]["productos"][] = $_descripcion;
		
		$ordenes[ $suscripcion->id_orden ]["precio"][] = "$ ".number_format( $suscripcion->total, 2, ',', '.')." MXN";
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
		foreach ($_data["productos"] as $producto) {
			$_productos .= '<div style="margin:2px 0px;">'.$producto."</div>";
			$_cobros .= ""."<br>";
		}

		$_precios = "";
		foreach ($_data["precio"] as $precio) {
			$_precios .= $precio."<br>";
		}

		$_cobros = "";
		foreach ($_data["proximo_cobro"] as $cobro) {
			$_cobros .= $cobro."<br>";
		}

		$index_row++;
		$data["data"][] = array(
			$index_row,
	        $orden_id,
	        $_data["fecha_creacion"],
	        $_data["cliente"],
	        $_productos,
	        $_precios,
	        $_cobros,
	        $_data["asesor_id"],
	        $_data["asesor_nombre"],
	        $_data["asesor_email"]
	    );
	}

	//$data['data'] = array_reverse( $data['data'] );  

    echo json_encode($data);

?>