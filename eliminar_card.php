<?php
	
	extract($_GET);

	include("wp-load.php");

	if( isset($cliente) && isset($tarjeta) ){
		try {
			$dataOpenpay = dataOpenpay();
		 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
			Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

			$customer = $openpay->customers->get($cliente);
			$card = $customer->cards->get($tarjeta);
			$card->delete();
		} catch (Exception $e) { 
        	$error = $e->getErrorCode()." - ".$e->getDescription();
		    echo "Error: ".$error;
    	}
	}
?>