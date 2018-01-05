<?php
	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	$PRODUCTOS = get_productos();
	$MARCAS = get_marcas();
	$PLANES = get_planes();

	echo json_encode(
		array(
			"PLANES" => $PLANES,
			"MARCAS" => $MARCAS,
			"PRODUCTOS" => $PRODUCTOS
		)
	);

	exit;
?>