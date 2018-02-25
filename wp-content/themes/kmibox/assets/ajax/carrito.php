<?php
 
	if(!session_id()){session_start();}

	$data = explode("===", $_POST["CART"]);

	$descuentos = explode("|", $data[3]);
	$descuentos[0] = json_decode($descuentos[0]);
	$descuentos[1] = json_decode($descuentos[1]);

	$info = array(
		"total" => $data[0]-json_decode($descuentos[1]),
		"cantidad" => $data[1],
		"descuentos" => $descuentos[0],
		"totalDescuentos" => $descuentos[1]
	);

	$productos = explode("|", $data[2]);

	foreach ($productos as $key => $producto) {
		$productos[ $key ] = json_decode($producto);
	}

	$info["productos"] = $productos;

	$_SESSION["CARRITO"] = serialize($info);

	echo json_encode($info);

	exit;

?>