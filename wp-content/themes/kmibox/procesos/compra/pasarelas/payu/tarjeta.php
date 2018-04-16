<?php
	
	$dir_lib = dirname(dirname(dirname(dirname(__DIR__))));
	$PayU_file = $dir_lib ."/lib/payu/PayU.php";
	$tdc = $dir_lib ."/lib/payu/validarTDC.php";

	if( file_exists($PayU_file) && file_exists($tdc) ){
		include( $PayU_file );
		include( $tdc );
	}else{
	    echo json_encode(array(
			"error" => $orden_id,
			"tipo_error" => 404,
			"status" => "Error, Libreria no encontrada",
			"code" => 0
		));
		exit();
	}

	$PayuP = [];
	// -- Orden
	$PayuP['code_orden'] = $orden_id;
	$PayuP['orden_id'] = $orden_id."_CobroInicial_".date('Ymd\THis');
	$PayuP['monto'] =  (float) $CARRITO["total"];
	$PayuP['descripcion'] =  "Tarjeta - NutriHeroes";
	// -- Clientes
	$PayuP['cliente']['ID'] = $user_id;
	$PayuP['cliente']['dni'] = $DNI;
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

	    /* Obtener id de tarjeta */
			$tdc = new fngccvalidator();
			$tdc_name = $tdc->CreditCard($num_card, '', true);

		    $cardDataRequest = array( 
		    	'user_id' => $user_id,
		    	'nombre' => $holder_name, 
		    	'DNI' => $DNI, 
		    	'card_number' => $num_card, 
		    	'cvv2' => $cvv,
		    	'type' => strtoupper($tdc_name['type']), 
		    	'expiredDate' => "20{$exp_year}/{$exp_month}", 
		    );

	    	$card_id = "";

			$tarjeta = $payu->getTokenTDC( $cardDataRequest );
			$card_id = $tarjeta->creditCardToken->creditCardTokenId;

	    /* Fin obtener id de tarjeta */

	    /* Crear cargo con tarjeta */
			$error = "";
			try {
				if( !empty($card_id) ){

				    /* cargar Datos de tarjeta */
					$PayuP["creditCard"]["token"] = $card_id;
					$PayuP["creditCard"]["payment_method"] = strtoupper($tdc_name['type']);
					$PayuP["creditCard"]["cvv"] = $cvv;

		            $charge = $payu->cobroTokenTDC( $PayuP );
		            $state = $charge->transactionResponse->state;

	            	if( 
		            	$state == 'PENDING_TRANSACTION_REVIEW' || 
			        	$state == 'PENDING_TRANSACTION_CONFIRMATION' ||
			        	$state == 'PENDING_TRANSACTION_TRANSMISSION' ||
	            		$state == 'APPROVED' 
	            	){

						$respuesta["state"] = $state;
						$respuesta["transaccion"] = $charge->transactionResponse->transactionId;
						$respuesta["tarjeta"] = $card_id;

						$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$orden_id}");
						$data = unserialize( $orden->metadata );
						$data["card_id"] = $card_id;
						$data["device"] = $PayuP["PayuDeviceSessionId"];
						$data = serialize($data);
						$wpdb->query("UPDATE ordenes SET metadata = '{$data}' WHERE id = {$orden_id};");

						$cardDataRequest["token"] = $card_id;
						update_user_meta($user_id, "payu_card_".md5($num_card), serialize($cardDataRequest) );
		            }

				}else{
			    	$error_code = 404;
			    	$error_info = "Error al tratar de registrar la tarjeta";
			    	$respuesta["error"] = array(
			    		"codigo" => $error_code,
			    		"info" => $error_info
			    	);
				}
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

