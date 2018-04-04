<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;
	extract($_POST);
	$SQL = "DELETE FROM asesores_niveles WHERE id = {$id};";
 
	$wpdb->query( $SQL );
	echo json_encode(array(
		"code" => 1
	));
	exit();
