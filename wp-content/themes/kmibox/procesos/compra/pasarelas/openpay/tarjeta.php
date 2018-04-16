<?php

$dataOpenpay = dataOpenpay();
$openpay_cliente_id = get_user_meta($user_id, "openpay_id", true);

try {
 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
 	Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

    /* Obtener id de usuario */
		$customerData = array( 'name' => $nombre, 'email' => $email );
	    if( $openpay_cliente_id == "" ){
			$customer = $openpay->customers->add($customerData);
	    }
	    try {
			$customer = $openpay->customers->get($openpay_cliente_id);
		} catch (Exception $e) {
			$customer = $openpay->customers->add($customerData);
	    }
		$openpay_cliente_id = $customer->id;
		update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
    /* Fin obtener id de usuario */


    /* Obtener id de tarjeta */

	    $cardDataRequest = array( 'holder_name' => $holder_name, 'card_number' => $num_card, 'cvv2' => $cvv, 'expiration_month' => $exp_month, 'expiration_year' => $exp_year );
		$cardData = array( 'token_id' => $token_id, 'device_session_id' => $deviceIdHiddenFieldName );

    	$card_id = "";
    	$tarjeta = get_user_meta($user_id, "openpay_card_".md5($num_card), true);

	    if ( strlen($tarjeta) == 0 ) {
			$card = $customer->cards->add($cardData); $card_id = $card->id;
	    }else{
	    	$tarjeta = unserialize($tarjeta); $card_id = $tarjeta["id"];
	    }

	    try{
	    	$card = $customer->cards->get($card_id);
	    } catch (Exception $e) {
			$card = $customer->cards->add($cardData);
	    }
		
	    $cardDataRequest["id"] = $card->id;
		$card_id = $card->id;
    /* Fin obtener id de tarjeta */


    /* Crear cargo con tarjeta */

		$chargeData = array(
		    'method' 			=> 'card',
		    'source_id' 		=> $card_id,
		    'amount' 			=> (float) $CARRITO["total"],
		    'order_id' 			=> $orden_id."_CobroInicial_".time(),
		    'description' 		=> "Tarjeta - NutriHeroes",
		    'device_session_id' => $deviceIdHiddenFieldName
	    );

		$error = "";

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

			update_user_meta($user_id, "openpay_card_".md5($num_card), serialize($cardDataRequest) );

        } catch (Exception $e) {
	    	$error_code = $e->getErrorCode();
	    	$error_info = $e->getDescription();
	    	$respuesta["error"] = array(
	    		"codigo" => $error_code,
	    		"info" => $error_info
	    	);
        }
    /* Fin creación cargo con tarjeta */
	
} catch (Exception $e) {
	$error_code = $e->getErrorCode();
	$error_info = $e->getDescription();
	$respuesta["error"] = array(
		"codigo" => $error_code,
		"info" => $error_info
	);
}
$respuesta["user_id_openpay"] = $openpay_cliente_id;
