<?php 

	if( !isset($_SESSION) ){ session_start(); }

	include_once( dirname(__DIR__, 5).'/wp-load.php' );

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

    /*
    $fechas = getFechas();
    $desde = strtotime('+7 day');
    $hasta = strtotime('+10 day');
    $fecha_estimada = 
    	$fechas["semana"][ date('N', $desde) ]." ".date('d', $desde)." de ".$fechas["meses"][ date('n', $desde) ]." - ".
    	$fechas["semana"][ date('N', $hasta) ]." ".date('d', $hasta)." de ".$fechas["meses"][ date('n', $hasta) ];
    $_metas_user = get_user_meta($user_id);
    $metas_user = array();
    foreach ($_metas_user as $key => $value) {
    	$metas_user[ $key ] = $value[0];
    }
    $estado = utf8_decode( $wpdb->get_var("SELECT name FROM wp_estados WHERE id = ".$metas_user["dir_estado"]) );
    $municipio = utf8_decode( $wpdb->get_var("SELECT name FROM wp_municipios WHERE id = ".$metas_user["dir_ciudad"]) );
    $direccion = '
    	<div> '.$nombre.' </div>
		<div> '.$metas_user[ "dir_colonia" ].' '.$metas_user[ "dir_numext" ].', interior '.$metas_user[ "dir_numint" ].' </div>
		<div> '.$metas_user[ "dir_calle" ].' </div>
		<div> '.$estado.', '.$municipio.' '.$metas_user[ "dir_codigo_postal" ].' </div>
		<div> M&eacute;xico </div>
    ';
    $hoy = time();
    $realizado = $fechas["semana"][ date('N', $hoy) ]." ".date('d', $hoy)." de ".$fechas["meses"][ date('n', $hoy) ];
    $pedido = "0001111";
    */
    
 	/*
 	$productos = "";
 	foreach ($CARRITO["productos"] as $key => $value) {
 		if( $value != "" ){
	 		$temp = getTemplate("/compra/nuevo/partes/producto");
	 		$temp = str_replace("[IMG_PRODUCTO]", TEMA()."/imgs/productos/".$_productos[ $value->producto ]["dataextra"]["img"], $temp);
	 		$temp = str_replace("[NOMBRE]", $_productos[ $value->producto ]["nombre"], $temp);
	 		$temp = str_replace("[DESCRIPCION]", $_productos[ $value->producto ]["descripcion"], $temp);
	 		$temp = str_replace("[PLAN]", $value->plan, $temp);
	 		$temp = str_replace("[PRECIO]", number_format($value->precio, 2, ',', '.'), $temp);
	 		$productos .= $temp;
	 	}
 	}
 	*/

 	try {
	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);

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
		    'order_id' 			=> $orden_id,
		    'description' 		=> "Tarjeta",
		    'device_session_id' => $deviceIdHiddenFieldName
	    );

		$charge = ""; $error = "";

		try {
            $charge = $customer->charges->create($chargeData);
			$respuesta["transaccion"] = $charge->id;
			$respuesta["cliente"] = $openpay_cliente_id;
			$respuesta["tarjeta"] = $card->id;

			crearCobro( $orden_id, $charge->id );

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
    	$HTML = generarEmail(
	    	"compra/nuevo/tarjeta", 
	    	array(
	    		"USUARIO" => $nombre,
	    		"TITULAR" => $holder_name,
	    		"NUMERO" => $num_card,
	    		"MES" => $exp_month,
	    		"ANIO" => $exp_year,
	    		"CVV" => $cvv,
	    		"TOTAL" => number_format( $CARRITO["total"], 2, ',', '.')
	    	)
	    );

	    wp_mail( $email, "Pago Recibido - NutriHeroes", $HTML );

    	unset($_SESSION["CARRITO"]);
    }

    echo json_encode($respuesta);

?>