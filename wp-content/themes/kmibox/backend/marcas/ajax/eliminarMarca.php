<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;
	extract($_POST);
	$data = $wpdb->get_row("SELECT * FROM marcas WHERE id = $id");
	unlink( dirname(dirname(dirname(__DIR__)))."/imgs/marcas/".$data->img );
	$SQL = "DELETE FROM marcas WHERE id = $id;";
	$wpdb->query( $SQL );

	exit();
?>