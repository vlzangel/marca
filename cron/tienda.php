<?php
	include '../wp-load.php';

	global $wpdb;

	extract($_GET);

	crearCobro( $orden_id, $charge_id );
?>