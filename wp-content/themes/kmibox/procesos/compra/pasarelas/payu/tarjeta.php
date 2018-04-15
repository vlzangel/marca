<?php
	
	$dir_lib = dirname(dirname(__DIR__) );
	$PayU_file = realpath( $dir_lib ."/lib/payu/PayU.php" );
	$tdc = realpath( $dir_lib ."/lib/payu/validarTDC.php" );

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
	switch ( $pagar->tipo ) {
		case 'tarjeta':

			$charge = ""; 
			$error = "";
			$state = "";
			$code = "";

			// -- Agregar Parametros Adicionales

			$year_now = '20'.$exp_year; // Temporal 
			 	
			$tdc = new fngccvalidator();
			$tdc_name = $tdc->CreditCard($num_card, '', true);

			$PayuP["creditCard"]["name"] = $holder_name;
			$PayuP["creditCard"]["number"] = $num_card;
			$PayuP["creditCard"]["securityCode"] = $cvv;
			$PayuP["creditCard"]["payment_method"] = strtoupper($tdc_name['type']);
			$PayuP["creditCard"]["expirationDate"] = $year_now.'/'.$exp_month;

			try {
				$charge = $payu->AutorizacionCaptura( $PayuP );	
				if( $charge->code == 'SUCCESS' ){
					$state = $charge->transactionResponse->responseCode;
				}
	        } catch (Exception $e) {
				$state = '';
	        }

			if( $state == 'PENDING_TRANSACTION_REVIEW' || 
	        	$state == 'PENDING_TRANSACTION_CONFIRMATION' ||
	        	$state == 'PENDING_TRANSACTION_TRANSMISSION' ||
	        	$state == 'APPROVED' 
	        ){

				if ( $state == 'APPROVED' ) {
					if( $deposito["enable"] == "yes" ){
						$db->query("UPDATE wp_posts SET post_status = 'wc-partially-paid' WHERE ID = {$orden_id};");
					}else{
						$db->query("UPDATE wp_posts SET post_status = 'paid' WHERE post_parent = {$orden_id} AND post_type = 'wc_booking';");
						$db->query("UPDATE wp_posts SET post_status = 'wc-completed' WHERE ID = {$orden_id};");
					}
				}else{
					/*  Reserva_status : PENDING TRANSACTION 
						Variable para cambiar el texto en la vista Finalizar
					*/
		        	$_SESSION['reserva_status'] = 'PENDING_TRANSACTION';
	        	}
				
	            echo json_encode(array(
					"order_id" => $orden_id
				));

			    if( isset($_SESSION[$id_session] ) ){
			    	update_cupos( array(
				    	"servicio" => $_SESSION[$id_session]["servicio"],
				    	"tipo" => $parametros["pagar"]->tipo_servicio,
			    		"autor" => $parametros["pagar"]->cuidador,
				    	"inicio" => strtotime($_SESSION[$id_session]["fechas"]["inicio"]),
				    	"fin" => strtotime($_SESSION[$id_session]["fechas"]["fin"]),
				    	"cantidad" => $_SESSION[$id_session]["variaciones"]["cupos"]
				    ), "-");
					$_SESSION[$id_session] = "";
					unset($_SESSION[$id_session]);
				}

				update_cupos( array(
			    	"servicio" => $parametros["pagar"]->servicio,
			    	"tipo" => $parametros["pagar"]->tipo_servicio,
			    	"autor" => $parametros["pagar"]->cuidador,
			    	"inicio" => strtotime($parametros["fechas"]->inicio),
			    	"fin" => strtotime($parametros["fechas"]->fin),
			    	"cantidad" => $cupos_a_decrementar
			    ), "+");
    
				include(__DIR__."/../emails/index.php");

	        /* ****************************************** *
	         * Procesar Transacciones: Respuesta de error
	         * ****************************************** */
	        }else{

	            echo json_encode(array(
					"error" => $orden_id,
					"tipo_error" => $error,
					"status" => "Error, pago fallido",
					"code" => $state
				));

	        }

		break;

		case 'tienda':

			$charge = ""; 
			$error = "";
			$pdf = "";
			$code = "";
			$state = "";

			// -- Calcular Fecha limite para pago en tienda
			$due_date = date('Y-m-d\TH:i:s', strtotime('+ 48 hours'));

			// -- Agregar Parametros Adicionales
			$PayuP["pais_cod_iso"] =  get_region('pais_cod_iso');
			$PayuP["paymentMethod"] =  strtoupper($pagar->tienda);
			$PayuP["expirationDate"] = $due_date;

			try {
				$charge = $payu->Autorizacion( $PayuP );
				if( $charge->code == 'SUCCESS' ){
					$pdf = $charge->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_PDF;
					$state = $charge->transactionResponse->responseCode;
				}			
	        } catch (Exception $e) {
				print_r($e);
	        }

	        if( $state == 'PENDING_TRANSACTION_CONFIRMATION' && !empty($pdf) ){
				$db->query("UPDATE wp_posts SET post_status = 'wc-on-hold' WHERE ID = {$orden_id};");
				$db->query("INSERT INTO wp_postmeta VALUES (NULL, {$orden_id}, '_payu_pdf', '{$pdf}');");
				$db->query("INSERT INTO wp_postmeta VALUES (NULL, {$orden_id}, '_payu_tienda_vence', '{$due_date}');");

				echo json_encode(array(
					"user_id" => $pagar->cliente,
					"pdf" => $pdf,
					"barcode_url"  => $charge->transactionResponse->extraParameters->REFERENCE,
					"order_id" => $orden_id
				));
		    
			    if( isset($_SESSION[$id_session] ) ){
			    	update_cupos( array(
				    	"servicio" => $_SESSION[$id_session]["servicio"],
				    	"tipo" => $parametros["pagar"]->tipo_servicio,
			    		"autor" => $parametros["pagar"]->cuidador,
				    	"inicio" => strtotime($_SESSION[$id_session]["fechas"]["inicio"]),
				    	"fin" => strtotime($_SESSION[$id_session]["fechas"]["fin"]),
				    	"cantidad" => $_SESSION[$id_session]["variaciones"]["cupos"]
				    ), "-");
					$_SESSION[$id_session] = "";
					unset($_SESSION[$id_session]);
				}

				update_cupos( array(
			    	"servicio" => $parametros["pagar"]->servicio,
			    	"tipo" => $parametros["pagar"]->tipo_servicio,
			    	"autor" => $parametros["pagar"]->cuidador,
			    	"inicio" => strtotime($parametros["fechas"]->inicio),
			    	"fin" => strtotime($parametros["fechas"]->fin),
			    	"cantidad" => $cupos_a_decrementar
			    ), "+");

				include(__DIR__."/../emails/index.php");
			}else{
				 echo json_encode(array(
					"error" => $orden_id,
					"tipo_error" => $error,
					"status" => "Error, pago fallido",
					"code" => $state,
					"charge" =>$charge
				));
			}

		break;

	}
