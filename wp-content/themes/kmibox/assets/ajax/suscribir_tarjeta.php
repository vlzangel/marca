<?php 

	define('WP_USE_THEMES', false);
	$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
	include_once( $url );

 	include_once("../../lib/openpay/Openpay.php");

 	global $wpdb;

 	extract($_POST);

 	$dataOpenpay = dataOpenpay();

 	$_POST["OP"] = $dataOpenpay;

 	try {
	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);

	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;

	    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
	    $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);
	    $openpay_cliente_id = get_user_meta($user_id, "openpay_id", true);

	    if( $openpay_cliente_id == "" ){
			$customerData = array(
		     	'name' => $nombre,
		     	'email' => $email
		  	);
			$customer = $openpay->customers->add($customerData);
			$openpay_cliente_id = $customer->id;
			update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
	    }

	    $cardDataRequest = array(
		    'holder_name' => $holder_name,
		    'card_number' => $num_cart,
		    'cvv2' => $cvv,
		    'expiration_month' => $exp_month,
		    'expiration_year' => $exp_year
		);

		$customer = $openpay->customers->get($openpay_cliente_id);
		$card = $customer->cards->add($cardDataRequest);

		$subscriptionDataRequest = array(
		    "trial_end_date" => "2014-01-01", 
		    'plan_id' => 'pm65iqu66o2umlx1zfsa',
		    'card_id' => $card->id
		);

		$customer = $openpay->customers->get($openpay_cliente_id);
		$subscription = $customer->subscriptions->add($subscriptionDataRequest);

		$_POST["cliente"] = $openpay_cliente_id;
		$_POST["tarjeta"] = $card->id;
		$_POST["suscripcion"] = $subscription->id;
		$_POST["error"] = "";

		echo json_encode($_POST);

	} catch (Exception $e) {
    	$error_code = $e->getErrorCode();
    	$error_info = $e->getDescription();

    	$_POST["error"] = array(
    		"codigo" => $error_code,
    		"info" => $error_info
    	);

    	echo json_encode($_POST);
    }

?>