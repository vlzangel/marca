<?php


	session_start();

	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	global $wpdb;

	extract($_POST);

	if( isset($email) && isset($phone) ){

		// Registro en Nutriheroes
		$subscriber = $wpdb->get_results("SELECT * FROM subscribers_list WHERE email = '{$email}' ");
		if( count($subscriber) < 1 ){
			$wpdb->get_results("INSERT INTO subscribers_list (email, phone) VALUES ('{$email}', '{$phone}') ");
		    echo json_encode(['code'=>1]);
		}

		// Registro en Campaign Monitor
		$options = array(
	        'cm-ekhthj-ekhthj' => $email,
	        'cm-f-jyjrktr' => $phone
	    );
	    $request = Requests::post('http://kmimos.intaface.com/t/j/s/ekhthj', array(), $options );

	    exit();
	}

    echo json_encode(['code'=>0]);

 