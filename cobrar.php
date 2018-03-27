<?php
	include 'wp-load.php';

	extract($_GET);
	
	crearCobro( $orden_id, $charge_id );
?>