<?php

require_once( __DIR__.'/../assets/plugins/Openpay/Openpay_kmibox.php' );

$visible = false;
$cart = get_cart();
$resumen = get_resumen();

$result = [];

if( $_POST ){
 
	$sts = true;
	
	if( $sts ){
		$data = [
			'plan' => [
			    'amount' => $resumen['total'],
			    'status_after_retry' => 'cancelled',
			    'retry_times' => 3,
			    'name' => $cart['items'][0]['name'],
			    'repeat_unit' => 'month',
			    'trial_days' => '90', // segun plan de kmibox
			    'repeat_every' => '1',
			    'currency' => 'MXN'
			],
			'suscripcion' => [
			    'trial_end_date' => '2000-01-01', 
			    'plan_id' => '',
			    'store' => ''
			]
		];

		$_openpay = cliente( $data);

		if( !isset($_openpay->id) ){
			$result['msg'] = 'Datos guardados satisfactoriamente';
			$visible = true;
		} 
	}
}

print_r( json_encode( $result ) );
