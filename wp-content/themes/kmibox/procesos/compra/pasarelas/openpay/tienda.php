<?php

		include_once(dirname(dirname(dirname(dirname(__DIR__))))."/lib/openpay/Openpay.php");
	 	$dataOpenpay = dataOpenpay();

	 	try {
		 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
		 	Openpay::setProductionMode( $dataOpenpay["SANDBOX_MODE"] != 1 );

		 	if( isset($CARRITO['user_id']) || $CARRITO['user_id'] > 0 ){
		 		$user_id = $CARRITO['user_id'];
		 	}else{
			 	$current_user = wp_get_current_user();
			    $user_id = $current_user->ID;	 		
		 	}

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
		    }else{
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
		    }

			$chargeRequest = array(
			    'method' => 'store',
			    'amount' => (float) $CARRITO["total"],
			    'description' => 'Tienda - NutriHeroes',
			    'order_id' => $order_id."_CobroInicial_".time(),
			    'due_date' => $due_date
			);
		
			$charge = $customer->charges->create($chargeRequest);

			$_POST["error"] = "";

			$CARRITO["PDF"] = $dataOpenpay["OPENPAY_URL"]."/paynet-pdf/".$dataOpenpay["MERCHANT_ID"]."/".$charge->payment_method->reference;
			$_POST['order'] = $order_id;

		} catch (Exception $e) {
	    	$error_code = $e->getErrorCode();
	    	$error_info = $e->getDescription();

	    	$_POST["error"] = array(
	    		"codigo" => $error_code,
	    		"info" => $error_info
	    	);
	    }
