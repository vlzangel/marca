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

		$error = "";

		try {
		 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
	 		Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );
		 	try {
				$customer = $openpay->customers->get($openpay_cliente_id);
			} catch (Exception $e) { 
	        	$error = $e->getErrorCode()." - ".$e->getDescription();
			    $data = array(
			    	"error" => $error
			    );
			    $data = serialize($data);
	        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
        	}
			$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$suscripcion->id_producto);

			if( $data["tipo_pago"] == "Tarjeta" && $error == "" ){
				
				try {

					$chargeData = array(
					    'method' 			=> 'card',
					    'source_id' 		=> $data["card_id"],
					    'amount' 			=> (float) $suscripcion->total,
					    'description' 		=> "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )",
				    	'order_id' 			=> $suscripcion->id_orden."_CobroSuscripcion_".$time,
					    'device_session_id' => $data["device"]
				    );

		            $charge = $customer->charges->create($chargeData);
					$wpdb->query("UPDATE cobros SET openpay_transaccion_id = '{$charge->id}', status = 'Pagado' WHERE id = {$cobro->id};");

					crearNewCobro($cobro->item_orden, $time);
				
				} catch (Exception $e) {
		        	$error = $e->getErrorCode()." - ".$e->getDescription();
				    $data = array(
				    	"error" => $error
				    );
				    $data = serialize($data);
		        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
			    }
			}

			if( $data["tipo_pago"] == "Tienda" && $error == "" ){

				$plan = $wpdb->get_var("SELECT plan FROM planes WHERE id = ".$suscripcion->plan);
	    		$nombre = get_user_meta($orden->cliente, "first_name", true)." ".get_user_meta($orden->cliente, "last_name", true);
				$due_date = date( 'Y-m-d\TH:i:s', strtotime('+ 48 hours', $time) );

				$chargeRequest = array(
				    'method' => 'store',
				    'amount' => (float) $suscripcion->total,
				    'description' => "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )",
				    'order_id' => $suscripcion->id_orden."_CobroSuscripcion_".$time,
				    'due_date' => $due_date
				);

				$charge = $customer->charges->create($chargeRequest);
				$PDF = $dataOpenpay["OPENPAY_URL"]."/paynet-pdf/".$dataOpenpay["MERCHANT_ID"]."/".$charge->payment_method->reference;

				$HTML = generarEmail(
			    	"notificacion/cobro_tienda", 
			    	array(
			    		"USUARIO" => $nombre,
			    		"PLAN" => $plan,
			    		"INSTRUCCIONES" => $PDF,
			    		"TOTAL" => number_format( $suscripcion->total, 2, ',', '.')
			    	)
			    );

			    wp_mail( $email, "Cobro en Tienda - NutriHeroes", $HTML );

			    $data = array(
			    	"error" => "",
			    	"pago_id" => $charge->id,
			    	"pdf" => $PDF,
			    	"vence" => $due_date
			    );
			    $data = serialize($data);

			    $wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
			}
			
		} catch (Exception $e) {
        	$error = $e->getErrorCode()." - ".$e->getDescription();
		    $data = array(
		    	"error" => $error
		    );
		    $data = serialize($data);
        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
	    }

	}
?>