<?php

	include "wp-load.php";

	global $wpdb;

	$users = $wpdb->get_results("SELECT * FROM wp_users");

	foreach ($users as $user) {
		$tipo = $wpdb->get_var( "SELECT user_id FROM wp_usermeta WHERE meta_key = 'wp_capabilities' AND user_id = ".$user->ID );
		if( $tipo+0 == 0 ){
			$wpdb->query( 
				"
				INSERT INTO 
					wp_usermeta 
				VALUES (
					NULL,
					'{$user->ID}',
					'wp_capabilities',
					'a:1:{s:10:\"subscriber\";b:1;}'
				)" 
			);
		}
	}

?>