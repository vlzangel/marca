<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$existe = $wpdb->get_var("SELECT * FROM cupones WHERE nombre = '$nombre' ");
	if( $existe != null ){ echo "existe"; exit(); }

	if( !isset($uso_individual) ){ $uso_individual = 0; }

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

	$usos = array();
	$usos = serialize($usos);

	$SQL = "
		INSERT INTO cupones VALUES (
			NULL,
			'$nombre',
			'$data',
			'$usos'
		);
	";

	$wpdb->query( $SQL );
?>