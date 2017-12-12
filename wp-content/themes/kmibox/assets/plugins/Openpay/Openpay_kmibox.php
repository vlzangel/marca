<?php

function kmibox_create( $data, $customer_id = '' ){
	require_once('Openpay.php');
	$openpay = Openpay::getInstance('mbkjg8ctidvv84gb8gan', 'sk_883157978fc44604996f264016e6fcb7');

	$result = [];
	if ( !empty($customer_id)  || !empty($data['customer']) ){

		// ***********************
		// Cliente
		// ***********************
		$customer = [];
		// Buscar ID customer en openpay por External_ID
		if( empty($customer) && !empty($data['customer'])){
			$find = [
				'external_id' => $data['customer']['ID']
			];
			$op_customer = $openpay->customers->getList($find);		
			if( count($op_customer) > 0 ){
				$customer = $op_customer[0];
			}
		}

		// Buscar cliente por Openpay_ID
		if( !empty($customer_id) ){
			$customer = $openpay->customers->get( $customer_id );
		}
		if( empty($customer) && !empty($data['customer'])){

			// Crear Cliente
			if( empty($customer) ){
				$customerData = array(
					'external_id' => $data['customer']['ID'],
					'name' => $data['customer']['name'],
					'last_name' => $data['customer']['apellido'],
					'email' => $data['customer']['email'],
					'requires_account' => false,
					'phone_number' => $data['customer']['phone'],
					'address' => array(
					    'line1' => $data['customer']['calle'],
					    'line2' => '',
					    'line3' => '',
					    'state' => $data['customer']['state'],
					    'city' => $data['customer']['city'],
					    'postal_code' => $data['customer']['codigo_postal'],
					    'country_code' => 'MX'
					)
				);
				$customer = $openpay->customers->add($customerData);
			}
		}

		if( !empty($customer) ){

			// Planes
			$plan = $openpay->plans->add($data['plan']);
			if( $plan->id != '' ){
				// Suscripcion
				$data['suscripcion']['plan_id'] = $plan->id;
				$subscription = $customer->subscriptions->add($data['suscripcion']);
				if( $subscription->id != '' ){
					$result = [
						'code'=>1, 
						'plan'=>$plan, 
						'suscripcion'=>$subscription, 
						'customer' => $customer 
					];
				}else{
					$result['customer'] = $customer;
					$result['plan'] = $plan;
					$result['code'] = 0;
					$result['msg'] = 'Error al registrar suscripcion';
				}
			}else{
				$result['customer'] = $customer;
				$result['code'] = 0;
				$result['msg'] = 'Error al registrar plan openpay';
			}
		}else{

			$result['code'] = 0;
			$result['msg'] = 'Error al registrar cliente en openpay';
		}
	}else{
		$result['code'] = 0;
		$result['msg'] = 'faltan parametros de cliente';
	}
	return $result;
}



function kmibox_create_store( $data, $customer_id = '' ){
	require_once('Openpay.php');
	$openpay = Openpay::getInstance('mbkjg8ctidvv84gb8gan', 'sk_883157978fc44604996f264016e6fcb7');
$result = [];
	if ( !empty($customer_id)  || !empty($data['customer']) ){

		// ***********************
		// Cliente
		// ***********************
		$customer = [];
		// Buscar ID customer en openpay por External_ID
		if( empty($customer) && !empty($data['customer'])){
			$find = [
				'external_id' => $data['customer']['ID']
			];
			$op_customer = $openpay->customers->getList($find);		
			if( count($op_customer) > 0 ){
				$customer = $op_customer[0];
			}
		}

		// Buscar cliente por Openpay_ID
		if( !empty($customer_id) ){
			$customer = $openpay->customers->get( $customer_id );
		}
		if( empty($customer) && !empty($data['customer'])){

			// Crear Cliente
			if( empty($customer) ){
				$customerData = array(
					'external_id' => $data['customer']['ID'],
					'name' => $data['customer']['name'],
					'last_name' => $data['customer']['apellido'],
					'email' => $data['customer']['email'],
					'requires_account' => false,
					'phone_number' => $data['customer']['phone'],
					'address' => array(
					    'line1' => $data['customer']['calle'],
					    'line2' => '',
					    'line3' => '',
					    'state' => $data['customer']['state'],
					    'city' => $data['customer']['city'],
					    'postal_code' => $data['customer']['codigo_postal'],
					    'country_code' => 'MX'
					)
				);
				$customer = $openpay->customers->add($customerData);
			}
		}
		
				

		if( !empty($customer) ){

			$chargeRequest = array(
			    'method' => 'store',
			    'amount' => 100,
			    'description' => 'Cargo con tienda',
			    'order_id' => 'oid-00053',
			    'due_date' => '2014-05-28T13:45:00');

			$charge = $customer->charges->create($chargeRequest);
			
				if( $charge ){

					$result['code'] = 0;
					$result['msg'] = 'Error al registrar cliente en openpay';

				}
			
		}else{

			$result['code'] = 0;
			$result['msg'] = 'Error al registrar cliente en openpay';
		}
	}else{
		$result['code'] = 0;
		$result['msg'] = 'faltan parametros de cliente';
	}
	return $result;
}
		 
 