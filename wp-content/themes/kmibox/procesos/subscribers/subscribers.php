<?php


	session_start();

	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	global $wpdb;

	extract($_POST);

	echo json_encode(['code'=>1]);

	exit();

	if( isset($email) && isset($phone) && isset($mi_marca) ){

		$referencia = ( isset($referencia) )? $referencia : '' ;
		$wpdb->get_results("INSERT INTO subscribers_list (email, phone, marca, referencia) VALUES ('{$email}', '{$phone}', '{$mi_marca}', '{$referencia}') ");
	    echo json_encode(['code'=>1]);

		// Registro en Campaign Monitor
		$options = array(
	        'cm-ekhthj-ekhthj' => $email,
	        'cm-f-jyjrktr' => $phone,
	        'cm-f-jytlfk' => $mi_marca,
	    );
	    $request = Requests::post('http://kmimos.intaface.com/t/j/s/ekhthj', array(), $options );

	    exit();
	}

    echo json_encode(['code'=>0]);

 