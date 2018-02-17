<?php
	include '../wp-load.php';

	global $wpdb;

	$time = strtotime("+1 day");
	$hoy = date("Y-m-d", $time );
	$cobros = $wpdb->get_results("SELECT * FROM cobros WHERE fecha_cobro = '{$hoy}' AND status = 'Pendiente' ");

 	$dataOpenpay = dataOpenpay();

	foreach ($cobros as $cobro) {
		$suscripcion = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = {$cobro->item_orden}");
		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$cliente = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$orden->cliente}");
		$openpay_cliente_id = get_user_meta($orden->cliente, "openpay_id", true);

		$data = unserialize( $orden->metadata );

		try {
		 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
	 		Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

		 	try {
				$customer = $openpay->customers->get($openpay_cliente_id);
			} catch (Exception $e) { 
        		$error = $e->getErrorCode()." - ".$e->getDescription();
        		echo $error."<br>";
        	}

			$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$suscripcion->id_producto);

			$chargeData = array(
			    'method' 			=> 'card',
			    'source_id' 		=> $data["card_id"],
			    'amount' 			=> (float) $suscripcion->total,
			    'description' 		=> "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )",
		    	'order_id' 			=> $suscripcion->id_orden."_CobroSuscripcion_".$time,
			    'device_session_id' => $data["device"]
		    );

			$error = "";

			try {

	            $charge = $customer->charges->create($chargeData);
				$wpdb->query("UPDATE cobros SET openpay_transaccion_id = '{$charge->id}', status = 'Pagado' WHERE id = {$cobro->id};");

				crearNewCobro($cobro->item_orden, $time);

	        } catch (Exception $e) {
	        	$error = $e->getErrorCode()." - ".$e->getDescription();
	        	echo $error."<br>";
	        	$wpdb->query("UPDATE cobros SET data = '{$error}' WHERE id = {$cobro->id};");
	        }
			
		} catch (Exception $e) {
        	$error = $e->getErrorCode()." - ".$e->getDescription();
        	echo $error."<br>";
        	$wpdb->query("UPDATE cobros SET data = '{$error}' WHERE id = {$cobro->id};");
	    }

	}
?>