<?php
	include( dirname(__DIR__, 5)."/wp-load.php" );

	global $wpdb;

	extract($_POST);
	
	$wpdb->query( "UPDATE ordenes SET status = 'Cancelada' WHERE id = {$ID_ORDEN};" );

	exit();
?>