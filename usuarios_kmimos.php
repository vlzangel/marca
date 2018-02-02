<?php
	include_once( __DIR__."/wp-load.php" );

	global $wpdb;

	$users = $wpdb->get_results("SELECT ID, user_email FROM wp_users");

	$buscar = array();
	$usuarios = array();

	foreach ($users as $user) {
		$buscar[] = $user->user_email;
		$usuarios[$user->user_email] = $user->ID;
	}

	$options = array( 
		'funcion' => "is_user_array",
		'emails' => $buscar
	);
    Requests::register_autoloader();
    $request = Requests::post('http://kmimosmx.sytes.net/QA2/services/users.php', array(), $options );

    $resultado = json_decode( trim( $request->body ) );

    foreach ($resultado as $email => $id) {
    	$is_user_kmimos = "NO";
    	if( $id+0 > 0 ){
	    	$is_user_kmimos = "SI";
	    }
		update_user_meta( $usuarios[ $email ], 'is_user_kmimos', $is_user_kmimos );
    }

    echo "<pre>";
    	print_r( $resultado );
    	print_r( $usuarios );
    echo "</pre>";
?>