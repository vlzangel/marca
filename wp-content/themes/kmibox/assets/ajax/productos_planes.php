<?php
	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	$PRODUCTOS = get_productos();
	$PLANES = get_planes();

	echo json_encode(
		array(
			"PLANES" => $PLANES,
			"PRODUCTOS" => $PRODUCTOS
		)
	);

	exit;
?>