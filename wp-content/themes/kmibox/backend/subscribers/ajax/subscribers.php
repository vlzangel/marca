<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$where='';
	if( isset($_SESSION["wlabel"]) ){
		$where = " where referencia = 'momsweb'";
	}

	$subscribers = $wpdb->get_results("SELECT * FROM subscribers_list {$where} ORDER BY ID DESC");

	$data["data"] = array();

	foreach ($subscribers as $subscriber) {

		$data["data"][] = array( 
	        $subscriber->fecha,
	        $subscriber->email,
	        $subscriber->phone,
	        $subscriber->referencia,
	    );
	}

    echo json_encode($data);

?>