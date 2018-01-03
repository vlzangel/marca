<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$clientes = $wpdb->get_results("SELECT * FROM wp_users ORDER BY ID DESC");

	foreach ($clientes as $cliente) {

		$_metadata = get_user_meta($cliente->ID);
		$metadata = array();
		foreach ($_metadata as $key => $value) {
			$metadata[ $key ] = $value[0];
		}

		$donde = $metadata[ "dondo_conociste" ];
		if( !isset($metadata[ "dondo_conociste" ]) ){
			$donde = "otros";
		}

		$data["data"][] = array(
	        $cliente->ID,
	        date("d/m/Y", strtotime($cliente->user_registered)),
	        $metadata[ "first_name" ]." ".$metadata[ "last_name" ],
	        $cliente->user_email,
	        $metadata[ "telef_movil" ],
	        strtoupper( $donde )
	    );
	}

    echo json_encode($data);

?>