<?php


	session_start();

	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	global $wpdb;

	extract($_POST);

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


	    // Registro en la campaing de Mom's
		if( $referencia == 'momsweb' ){
			$options = array(
		        'cm-skutlh-skutlh' => $email,
		        'cm-f-jjhluii' => $phone,
		        'cm-f-jjhlutd' => $mi_marca,
		    );
		    $request = Requests::post('http://kmimos.intaface.com/t/j/s/skutlh', array(), $options );		
		}	    



	    exit();
	}

    echo json_encode(['code'=>0]);

 