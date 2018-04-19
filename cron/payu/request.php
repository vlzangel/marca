<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
 
	$dir_base = dirname(dirname(__DIR__));
	$response = json_encode($_REQUEST);

	// ********************************
	// Crear Log de Respuesta PayU
	// ********************************
	if( !empty($response) ){
		$file_name = "log/payu_".date('Ymd').".txt";
        $file = fopen($file_name, "a+");
        fwrite($file, date('Y/m/d H:i:s') . '  ===============  ' . PHP_EOL);
        fwrite($file, $response . PHP_EOL);
        fclose($file);
	}

	
	// ********************************
	// Procesar transacciones
	// ********************************
	$log = [];
	$datos = json_decode($response);

	if ( isset($datos->response_message_pol) ) {
		if ( $datos->response_message_pol == 'APPROVED' ) {

			include( $dir_base . "/wp-load.php");
			include( $dir_base . "/wp-content/themes/kmibox/funciones/db.php");
			

			// validar si es tarjeta o tienda
			switch( $datos->metodo ){
				case 'tarjeta':
					// Procesar solo Pagos CobroInicial 
					$_orden = get_row("SELECT status FROM ordenes WHERE id = ".$datos->order_id);
					if( $_orden->status == "Pendiente" && $datos->periodo == 'CobroInicial' ){

						$_tarjeta = substr($num_card, 0, 2)."********".substr($num_card, -2);
				    	$HTML = generarEmail(
					    	"compra/nuevo/tarjeta", 
					    	array(
					    		"USUARIO" => $nombre,
					    		"TITULAR" => $holder_name,
					    		"NUMERO"  => $_tarjeta,
					    		"MES"   => $exp_month,
					    		"ANIO"  => $exp_year,
					    		"TOTAL" => number_format( $CARRITO["total"], 2, ',', '.')
					    	)
					    );
					    wp_mail( $email, "Pago Recibido - NutriHeroes", $HTML );
					    mail_admin_nutriheroes( "Pago Recibido - NutriHeroes", $HTML );
					    crearCobro( $datos->order_id, $datos->transaction_id );
		    			$log["Estatus"] = "Pago procesado - nuevo cobro generado";
					}else{

					}
					break;
				case 'tienda':
					if ( $datos->periodo == 'CobroInicial' ){
						crearCobro($datos->order_id, $datos->transaction_id);
		    			$log["Estatus"] = "Pago procesado - nuevo cobro generado";
					}
					if ( $datos->periodo == 'CobroSuscripcion') {
						$time = strtotime("+1 day");
						crearNewCobro($datos->order_id, $time);
					}
					break;
			}
			 
		}else{
			$log["Estatus"] = $datos->response_message_pol;
		}
	}else{
		$log["Estatus"] = "Estatus: response_message_pol NO_DEFINIDA ";
	}
	
	$l = json_encode($log);
	print_r( $l );

	// ********************************
	// Crear Log de Respuesta
	// ********************************
	if( !empty($l) ){
		$file_name = "log/dev_".date('Ymd').".txt";
        $file = fopen($file_name, "a+");
        fwrite($file, date('Y/m/d H:i:s') . '  ===============  ' . PHP_EOL);
        fwrite($file, $l . PHP_EOL);
        fclose($file);
	}
