<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$img = guardarImg(
		dirname(dirname(dirname(__DIR__)))."/imgs/marcas/", 
		$img_marca
	);

	$SQL = "
		INSERT INTO marcas VALUES (
			NULL,
			'$nombre',
			'$img'
		);
	";

	$wpdb->query( $SQL );
?>