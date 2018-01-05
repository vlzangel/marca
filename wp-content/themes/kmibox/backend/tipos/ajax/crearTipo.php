<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$SQL = "
		INSERT INTO tipo_mascotas VALUES (
			NULL,
			'$nombre'
		);
	";

	$wpdb->query( $SQL );
?>