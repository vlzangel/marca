<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;
	extract($_POST);
	$data = $wpdb->get_row("SELECT * FROM productos WHERE id = $id");
	$dataextra = unserialize( $data->dataextra );
	unlink( dirname(dirname(dirname(__DIR__)))."/imgs/productos/".$dataextra["img"] );
	$SQL = "DELETE FROM productos WHERE id = $id;";
	$wpdb->query( $SQL );

	exit();
?>