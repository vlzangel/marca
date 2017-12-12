<?php

//if(!session_id()){session_start();}

define('WP_USE_THEMES', false);

 $url = realpath( __DIR__ . '/../../../../../wp-load.php' );
 include_once( $url );
 include_once("../../lib/openpay/Openpay.php");
//require_once('Openpay.php');


$result = ['visible'=>false, 'msg'=>''];
$resumen = get_resumen();
$user = get_user_info();
$OPENPAY_URL = "https:sandbox-dashboard.openpay.mx";
$user_id = get_current_user_id();
//*$parametros = paramters();
$url_id_empresa='mbkjg8ctidvv84gb8gan';
//print_r($parametros);
$email = $user['email'];
$openpay = Openpay::getInstance('mbkjg8ctidvv84gb8gan', 'sk_883157978fc44604996f264016e6fcb7');

$order_id = 0;

	$o = create_order();
	$order_id = $o->id; 
		

		  $customer_id=get_user_meta( $user_id ,"openpay_customer_id", true);
		

		// Buscar cliente por Openpay_ID

		if( !empty($customer_id) ){
			$customer = $openpay->customers->get( $customer_id );
		}
			
			// Crear Cliente
			if( empty($customer) ){
			

				$customerData = array(
					'external_id' => $user_id,
					'name' => $user['first_name'],
					'last_name' => $user['last_name'],
					'email' => $user['email'],
					'requires_account' => false,
					'phone_number' => $user['telef_movil'],
					'address' => array(
					    'line1' => $user['calle'],
					    'line2' => '',
					    'line3' => '',
					    'state' => $user['estado'],
					    'city' => $user['city'],
					    'postal_code' => $user['codigo_postal'],
					    'country_code' => 'MX'
					)
				);
				

				$customer = $openpay->customers->add($customerData);

				if( array_key_exists('customer', $customerData) ){
				if( !empty($customer) ){
					update_user_meta( get_current_user_id(), 'openpay_customer_id', $customerData['external_id'] );
				}
			}

					if( !isset($customer->id) ){
					$result['msg'] = 'Datos guardados satisfactoriamente';
					$visible = true;
				}
				
					}
				
			


				$due_date = date('Y-m-d\TH:i:s', strtotime('+ 48 hours'));

	   			$chargeRequest = array(
				    'method' => 'store',
				    'amount' => (float) $resumen['total'],
				    'description' => 'Tienda',
				    'order_id' => $order_id,
				    'due_date' => $due_date
				);
			

				$charge = $customer->charges->create($chargeRequest);

				

				$pdf = $OPENPAY_URL."/paynet-pdf/".$url_id_empresa."/".$charge->payment_method->reference;


				include( realpath( __DIR__ . '/../../template/email/pago_tienda.php' ) );
				wp_mail(
					$email, 	
					"Pago tienda por conveniencia", 
					$HTML
		);

				//print_r("PDF".$pdf);

			echo json_encode(array(
   					"user_id" => $customer->id,
					"pdf" => $pdf,
					"barcode_url"  => $charge->payment_method->barcode_url,
					"order_id" => $id_orden
				));
		    
			


?>



