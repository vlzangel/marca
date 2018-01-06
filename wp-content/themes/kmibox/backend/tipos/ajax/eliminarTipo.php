<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;
	extract($_POST);
	$SQL = "DELETE FROM tipo_mascotas WHERE id = $id;";
	$wpdb->query( $SQL );

	exit();
?>