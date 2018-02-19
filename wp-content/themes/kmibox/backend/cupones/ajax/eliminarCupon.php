<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;
	extract($_POST);

	$SQL = "DELETE FROM cupones WHERE id = $id;";
	$wpdb->query( $SQL );

	exit();
?>