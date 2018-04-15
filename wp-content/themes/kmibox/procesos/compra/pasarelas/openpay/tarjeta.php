<?php

$charge = "";

 	try {
 		
 		// Datos de Configuracion Openpay
		 	$dataOpenpay = dataOpenpay();

	    // Librerias Openpay
		 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
		 	Openpay::setProductionMode( $dataOpenpay["SANDBOX_MODE"] != 1 );

		// Datos de cliente
		    $openpay_cliente_id = get_user_meta($user_id, "openpay_id", true);		    

	    // Registrar cliente en openpay
		    if( $openpay_cliente_id == "" ){
				$customerData = array(
			     	'name' => $nombre,
			     	'email' => $email
			  	);
				$customer = $openpay->customers->add($customerData);
				$openpay_cliente_id = $customer->id;
				update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
		    }

    	// Cargar datos de cliente de Openpay
		    try {
				$customer = $openpay->customers->get($openpay_cliente_id);
			} catch (Exception $e) {
			// Registrar datos de CLiente en openpay
		    	$customerData = array(
			     	'name' => $nombre,
			     	'email' => $email
			  	);
				$customer = $openpay->customers->add($customerData);
				$openpay_cliente_id = $customer->id;
				update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
		    }

	    // Cargar datos de tarjeta
		    $card_id = "";
		    $tarjeta = get_user_meta($user_id, "openpay_card_".md5($num_card), true);

		    if ( strlen($tarjeta) == 0 ) {
			    $cardDataRequest = array(
				    'holder_name' => $holder_name,
				    'card_number' => $num_card,
				    'cvv2' => $cvv,
				    'expiration_month' => $exp_month,
				    'expiration_year' => $exp_year
				);
				$card = $customer->cards->add($cardDataRequest);
				$card_id = $card->id;
				$cardDataRequest["id"] = $card->id;
				update_user_meta($user_id, "openpay_card_".md5($num_card), serialize($cardDataRequest) );
		    }else{
		    	$tarjeta = unserialize($tarjeta);
				$card_id = $tarjeta["id"];
		    }

		// Buscar Object de tarjeta de Openpay
		    try{
		    	$card = $customer->cards->get($card_id);
		    } catch (Exception $e) {

		    	// Registrar tarjeta en Openpay
		    	$cardDataRequest = array(
				    'holder_name' => $holder_name,
				    'card_number' => $num_card,
				    'cvv2' => $cvv,
				    'expiration_month' => $exp_month,
				    'expiration_year' => $exp_year
				);
				$card = $customer->cards->add($cardDataRequest);
				$card_id = $card->id;
				$cardDataRequest["id"] = $card->id;
				update_user_meta($user_id, "openpay_card_".md5($num_card), serialize($cardDataRequest) );
		    }

		// Parametros de Pago
			$chargeData = array(
			    'method' 			=> 'card',
			    'source_id' 		=> $card_id,
			    'amount' 			=> (float) $CARRITO["total"],
			    'order_id' 			=> $orden_id."_CobroInicial_".time(),
			    'description' 		=> "Tarjeta - NutriHeroes",
			    'device_session_id' => $deviceIdHiddenFieldName
		    );

			$error = "";

		// Realizar Cargos a la tarjeta
			try {
	            $charge = $customer->charges->create($chargeData);
				$respuesta["transaccion"] = $charge->id;
				$respuesta["cliente"] = $openpay_cliente_id;
				$respuesta["tarjeta"] = $card->id;

				$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$orden_id}");
				$data = unserialize( $orden->metadata );
				$data["card_id"] = $card_id;
				$data["device"] = $deviceIdHiddenFieldName;
				$data = serialize($data);
				$wpdb->query("UPDATE ordenes SET metadata = '{$data}' WHERE id = {$orden_id};");

	        } catch (Exception $e) {
		    	$error_code = $e->getErrorCode();
		    	$error_info = $e->getDescription();
		    	$respuesta["error"] = array(
		    		"codigo" => $error_code,
		    		"info" => $error_info
		    	);
	        }
		
	} catch (Exception $e) {
    	$error_code = $e->getErrorCode();
    	$error_info = $e->getDescription();
    	$respuesta["error"] = array(
    		"codigo" => $error_code,
    		"info" => $error_info
    	);
    }