 <?php

$PayU_file = realpath( $dir ."/lib/payu/PayU.php" );
$tdc = realpath( $dir ."/lib/payu/validarTDC.php" );

$_POST["error"] = "";

if( file_exists($PayU_file) && file_exists($tdc) ){
	include( $PayU_file );
	include( $tdc );

	$current_user = wp_get_current_user();
	$nombre = get_user_meta($current_user->ID, "first_name", true)." ".get_user_meta($user_id, "last_name", true);
	$email = $current_user->user_email;

	$PayuP = [];
	$tipoCobro = ( isset($tipoCobro) && !empty($tipoCobro) )? $tipoCobro : 'CobroInicial' ;
	// -- Agregar Parametros Adicionales
	$PayuP["pais_cod_iso"] =  'MX';
	$PayuP["paymentMethod"] =  (isset($CARRITO["tienda_tipo"]) && !empty($CARRITO["tienda_tipo"]))? $CARRITO["tienda_tipo"] : 'OTHERS_CASH_MX';
	$PayuP["expirationDate"] = $due_date;
	// -- Orden
	$PayuP['code_orden'] = "order_id={$order_id}&periodo={$tipoCobro}";
	$PayuP['id_orden'] = $order_id.'_'.date('Ymd\THis');
	$PayuP['monto'] =  (float) $CARRITO["total"];
	$PayuP['descripcion'] =  ( isset($__descripcion) && !empty($__descripcion) )? $__descripcion : 'Tarjeta - Nutriheroes';
	// -- Clientes
	$PayuP['cliente']['ID'] = $user_id;
	$PayuP['cliente']['dni'] = '';
	$PayuP['cliente']['name'] = $nombre;
	$PayuP['cliente']['email'] = $email;
	$PayuP['cliente']['calle1'] = $_direccion;
	$PayuP['cliente']['calle2'] = '';
	$PayuP['cliente']['ciudad'] = $_ciudad;
	$PayuP['cliente']['estado'] = $_estado;
	$PayuP['cliente']['telef'] = $_telefono;
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
			//$pdf = $charge->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_PDF;
			$pdf = $charge->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_HTML;
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
			"error" => $order_id,
			"tipo_error" => 404,
			"status" => "Error, Transaccion no confirmada ",
			"dev" => $charge,
			"code" => 0
		];
	}
}else{
    $_POST["error"] = array(
		"error" => $order_id,
		"tipo_error" => 404,
		"status" => "Error, Libreria no encontrada",
		"code" => 0
	);
}
