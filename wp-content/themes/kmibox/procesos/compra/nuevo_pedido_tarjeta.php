<?php 

	if( !isset($_SESSION) ){ session_start(); }
	include_once( dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/wp-load.php' );

    setZonaHoraria();

 	global $wpdb;

 	$current_user = wp_get_current_user();
    $user_id = $current_user->ID;

 	extract($_POST);

 	$_productos = get_productos();
    $CARRITO = unserialize( $_SESSION["CARRITO"] );
    
    if( !isset($CARRITO["orden_id"]) ){
 		$orden_id = crearPedido();
 		$CARRITO["orden_id"] = $orden_id;
 		$_SESSION["CARRITO"] = serialize($CARRITO);
    }else{
 		$orden_id = $CARRITO["orden_id"];
    }
 	$respuesta = array();
 	$respuesta["orden_id"] = $orden_id;
 	$respuesta["error"] = "";
 	$dataOpenpay = dataOpenpay();

    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
    $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);
    $openpay_cliente_id = get_user_meta($user_id, "openpay_id", true);

    $charge = "";

 	try {
	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
	 	Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;

	    if( $openpay_cliente_id == "" ){
			$customerData = array(
		     	'name' => $nombre,
		     	'email' => $email
		  	);
			$customer = $openpay->customers->add($customerData);
			$openpay_cliente_id = $customer->id;
			update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
	    }

	    try {
			$customer = $openpay->customers->get($openpay_cliente_id);
		} catch (Exception $e) {
	    	$customerData = array(
		     	'name' => $nombre,
		     	'email' => $email
		  	);
			$customer = $openpay->customers->add($customerData);
			$openpay_cliente_id = $customer->id;
			update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
	    }

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

	    try{
	    	$card = $customer->cards->get($card_id);
	    } catch (Exception $e) {
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

		$chargeData = array(
		    'method' 			=> 'card',
		    'source_id' 		=> $card_id,
		    'amount' 			=> (float) $CARRITO["total"],
		    'order_id' 			=> $orden_id."_CobroInicial_".time(),
		    'description' 		=> "Tarjeta",
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

        } catch (Exception $e) {
        	$error = $e->getErrorCode()." - ".$e->getDescription();
        	$respuesta["error"] = $error;
        }
		
	} catch (Exception $e) {
    	$error_code = $e->getErrorCode();
    	$error_info = $e->getDescription();

    	$respuesta["error"] = array(
    		"codigo" => $error_code,
    		"info" => $error_info
    	);

    }

    if( $respuesta["error"] == "" ){

    	$_tarjeta = substr($num_card, 0, 2)."********".substr($num_card, -2);
    	$HTML = generarEmail(
	    	"compra/nuevo/tarjeta", 
	    	array(
	    		"USUARIO" => $nombre,
	    		"TITULAR" => $holder_name,
	    		"NUMERO" => $_tarjeta,
	    		"MES" => $exp_month,
	    		"ANIO" => $exp_year,
	    		"TOTAL" => number_format( $CARRITO["total"], 2, ',', '.')
	    	)
	    );

		

	    wp_mail( $email, "Pago Recibido - NutriHeroes", $HTML );
 
	    mail_admin_nutriheroes( "Pago Recibido - NutriHeroes", $HTML );
 
	    crearCobro( $orden_id, $charge->id );

    	unset($_SESSION["CARRITO"]);
    }

    echo json_encode($respuesta);

?>