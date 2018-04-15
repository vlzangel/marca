 <?php

	$PayU_file = realpath( $dir ."/lib/payu/PayU.php" );
	$tdc = realpath( $dir ."/lib/payu/validarTDC.php" );

	$_POST["error"] = "";

	if( file_exists($PayU_file) && file_exists($tdc) ){
		include( $PayU_file );
		include( $tdc );
	
		$PayuP = [];

		// -- Agregar Parametros Adicionales
		$PayuP["pais_cod_iso"] =  'MX';
		$PayuP["paymentMethod"] =  'TIENDA';
		$PayuP["expirationDate"] = $due_date;
		// -- Orden
		$PayuP['code_orden'] = $orden_id;
		$PayuP['orden_id'] = $orden_id.'_'.date('Ymd\THis');
		$PayuP['monto'] =  (float) $CARRITO["total"];
		// -- Clientes
		$PayuP['cliente']['ID'] = $user_id;
		$PayuP['cliente']['dni'] = '';
		$PayuP['cliente']['name'] = $nombre;
		$PayuP['cliente']['email'] = $email;
		$PayuP['cliente']['telef'] = $_telefono;
		$PayuP['cliente']['calle1'] = $_direccion;
		$PayuP['cliente']['calle2'] = '';
		$PayuP['cliente']['ciudad'] = $_ciudad;
		$PayuP['cliente']['estado'] = $_estado;
		$PayuP['cliente']['telef'] = $_telefono;

		$PayuP['pais'] = 'MX';
		$PayuP['moneda'] = "MXN";
		$PayuP['cliente']['pais'] = 'MX';
		$PayuP['cliente']['postal'] = '000000';
		$PayuP["PayuDeviceSessionId"] = md5(session_id().microtime()); 

		$payu = new PayU();

		try {
			$charge = $payu->Autorizacion( $PayuP );

			if( $charge->code == 'SUCCESS' ){
				$pdf = $charge->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_PDF;
				$state = $charge->transactionResponse->responseCode;
			}			
		} catch (Exception $e) {
			$state = $e->getMessage();
		}

		if( $state == 'PENDING_TRANSACTION_CONFIRMATION' && !empty($pdf) ){

			$CARRITO["PDF"] = $pdf;
			$_POST['order'] = $order_id;
			$_POST["error"] = "";

		}else{
		    $_POST["error"] = [
				"error" => $orden_id,
				"tipo_error" => 404,
				"status" => "Error, Transaccion no confirmada ",
				"dev" => $charge,
				"code" => 0
			];
		}
}else{
    $_POST["error"] = array(
		"error" => $orden_id,
		"tipo_error" => 404,
		"status" => "Error, Libreria no encontrada",
		"code" => 0
	);
}
