<?php
	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	global $wpdb;

	$_productos = $wpdb->get_results("SELECT * FROM productos WHERE status = 'activo' ");
	$productos = array();
	foreach ($_productos as $producto) {
		$productos[$producto->id] = array(
			"nombre" => $producto->nombre,
			"tamanos" => unserialize($producto->tamanos),
			"edades" => unserialize($producto->edades),
			"presentaciones" => unserialize($producto->presentaciones),
			"planes" => unserialize($producto->planes),
			"dataextra" => unserialize($producto->dataextra)
		);
	}
/*
	echo "<pre>";
		print_r( $productos );
	echo "</pre>";*/

	echo json_encode($productos);

	exit;
?>