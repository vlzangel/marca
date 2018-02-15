<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$subscribers = $wpdb->get_results("SELECT * FROM subscribers_list ORDER BY ID DESC");

	$data["data"] = array();

	foreach ($subscribers as $subscriber) {

		$data["data"][] = array(
	        $subscriber->ID,
	        $subscriber->email,
	        $subscriber->phone,
	        $subscriber->fecha,
	    );
	}

    echo json_encode($data);

?>