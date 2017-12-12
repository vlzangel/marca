<?php

require_once('Openpay.php');
$openpay = Openpay::getInstance('mbkjg8ctidvv84gb8gan', 'sk_883157978fc44604996f264016e6fcb7');



	$customer = $openpay->customers->get('a9ualumwnrcxkl42l6mh');

	// agrego el plan
	$planDataRequest = array(
	    'amount' => 150.00,
	    'status_after_retry' => 'cancelled',
	    'retry_times' => 2,
	    'name' => 'Plan Curso Verano italo',
	    'repeat_unit' => 'month',
	    'trial_days' => '30',
	    'repeat_every' => '1',
	    'currency' => 'MXN');
	$plan = $openpay->plans->add($planDataRequest);

	$subscriptionDataRequest = array(
	    'trial_end_date' => '2014-01-01', 
	    'plan_id' => $plan->id,
	    'card' => array(
	         'card_number' => '4111111111111111',
	         'holder_name' => 'Juan Perez Ramirez',
	         'expiration_year' => '20',
	         'expiration_month' => '12',
	         'cvv2' => '110',
	         'device_session_id' => 'kR1MiQhz2otdIuUlQkbEyitIqVMiI16f'
		)
	);
	$subscription = $customer->subscriptions->add($subscriptionDataRequest);


	print_r($subscription);
