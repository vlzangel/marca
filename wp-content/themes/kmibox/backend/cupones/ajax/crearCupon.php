<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$data = array(
	    "precio" => $precio,
	    "tipo" => $tipo,
	    "vence" => $vence,
	    "uso_por_usuario" => $uso_por_usuario,
	    "uso_por_cupon" => $uso_por_cupon,
	    "gasto_minimo" => $gasto_minimo,
	    "gasto_maximo" => $gasto_maximo,
	    "uso_individual" => $uso_individual
	);
	$data = serialize($data);

	$SQL = "
		INSERT INTO cupones VALUES (
			NULL,
			'$nombre',
			'$data'
		);
	";

	$wpdb->query( $SQL );
?>