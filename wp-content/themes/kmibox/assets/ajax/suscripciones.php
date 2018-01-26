<?php
	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );
	$suscripciones = getSuscripciones();
	echo json_encode( $suscripciones );
	exit;
?>