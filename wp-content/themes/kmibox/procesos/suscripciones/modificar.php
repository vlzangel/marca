<?php

	session_start();

	include( dirname(dirname(dirname(dirname(dirname(__DIR__)))))."/wp-load.php" );

	global $wpdb;

	extract($_GET);
	extract($_POST);

	$orden = $wpdb->get_row( "SELECT * FROM ordenes WHERE id = {$ID_ORDEN};" );
	$sub_ordenes = $wpdb->get_results( "SELECT * FROM items_ordenes WHERE id_orden = {$ID_ORDEN};" );

	$data = array(
		"total" => $orden->total,
		"cantidad" => $orden->cantidad,
		"productos" => array()
	);

	foreach ($sub_ordenes as $sub_orden) {

		$_data = unserialize($sub_orden->data);

		$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id = {$sub_orden->id_producto};" );

		$data["productos"][] = (Object) array(
			"tamano" => $_data["tamano"],
			"edad" => $_data["edad"],
			"plan" => $_data["plan"],
			"plan_id" => $sub_orden->plan,
			"cantidad" => $sub_orden->cantidad+0,
			"precio" => $producto->precio+0,
			"subtotal" => $sub_orden->cantidad*$sub_orden->total,
			"marca" => $producto->marca,
			"producto" => $sub_orden->id_producto
		);
	}

	$_SESSION["CARRITO"] = serialize($data);
	$_SESSION["MODIFICACION"] = $ID_ORDEN;

	header("location: ".HOME()."/quiero-mi-marca/")

?>