<?php
 
	if(!session_id()){session_start();}

	$data = explode("===", $_POST["CART"]);

	$info = array(
		"total" => $data[0]
	);

	$productos = explode("|", $data[1]);

	foreach ($productos as $key => $producto) {
		$productos[ $key ] = json_decode($producto);
	}

	$info["productos"] = $productos;

	$_SESSION["CARRITO"] = serialize($info);

	echo json_encode($info);

	exit;

?>