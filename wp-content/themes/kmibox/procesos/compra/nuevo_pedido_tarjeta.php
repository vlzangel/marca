<?php 

	if( !isset($_SESSION) ){ session_start(); }
	$raiz = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
	include_once( $raiz.'/wp-load.php' );

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

    $email 	= $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
    $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);

 	$current_user = wp_get_current_user();

    $user_id = $current_user->ID;   
	$_direccion = get_user_meta( $user_id, 'dir_calle', true );
	$_ciudad = get_user_meta( $user_id, 'dir_ciudad', true );
	$_estado = get_user_meta( $user_id, 'dir_estado', true );
	$_telefono  = get_user_meta( $user_id, 'telef_movil', true );

    $charge = "";

	$payment_gateway = get_payment_gateway();	
	switch( strtolower( $payment_gateway ) ){
		case "openpay":
		 	include_once("pasarelas/openpay/tarjeta.php");
	    	break;
		case "payu":
		 	include_once("pasarelas/payu/tarjeta.php");
	    	break;
	    default:
			$respuesta["error"] = [
				"error" => $orden_id,
				"tipo_error" => 404,
				"status" => "Error, PaymentGateway no definido.",
				"code" => 0
			];
			// crearCobro( $order_id, time() );
			break;
	}

    if( $respuesta["error"] == "" ){

		if( 
			 $respuesta["state"] == 'PENDING_TRANSACTION_REVIEW' 		 || 
			 $respuesta["state"] == 'PENDING_TRANSACTION_CONFIRMATION' ||
			 $respuesta["state"] == 'PENDING_TRANSACTION_TRANSMISSION' ||
			 $respuesta["state"] == 'APPROVED' 
		){
			$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$orden_id}");
			$data = unserialize( $orden->metadata );
			$data["card_id"] = $card_id;
			$data["device"] = $PayuP["PayuDeviceSessionId"];
			$data["payu_metadata"] = serialize($PayuP);
			$data = serialize($data);
			$wpdb->query("UPDATE ordenes SET metadata = '{$data}' WHERE id = {$orden_id};");
			$cardDataRequest["token"] = $card_id;
			update_user_meta($user_id, "payu_card_".md5($num_card), serialize($cardDataRequest) );
		}

    	if( $respuesta["state"] == "APPROVED" ){
    		
		    crearCobro( $orden_id, $respuesta["transaccion"] );

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
	    	// ************************
			// Agregar a bitrix
			// ************************
//			include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
//			$bitrix->loadInvoice_by_asesor($orden_id);		
    	}

    	unset($_SESSION["CARRITO"]);
    }

    $respuesta["user_id"] = $user_id;

    echo json_encode($respuesta);


?>