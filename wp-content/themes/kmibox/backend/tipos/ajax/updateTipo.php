<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$SQL = "
		UPDATE 
			tipo_mascotas 
		SET 
			tipo = '{$nombre}'
		WHERE 
			id = {$ID}
	";

	$wpdb->query( $SQL );
?>