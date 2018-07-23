<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$img = "";
	if( $img_marca != "" ){
		$img = guardarImg(
			dirname(dirname(dirname(__DIR__)))."/imgs/marcas/", 
			$img_marca
		);
		if( $img != "" ){
			unlink( dirname(dirname(dirname(__DIR__)))."/imgs/marcas/".$img_old );
		}
	}

	if( $img != "" ){
		$_dataextra = ", img = '{$img}'";
	}
	
	$extradata = array(
		"agotado" => $agotado
	);
	$extradata = json_encode($extradata);


	$SQL = "
		UPDATE 
			marcas 
		SET 
			nombre = '{$nombre}',
			extradata = '{$extradata}',
			tipo = '{$tipo}' {$_dataextra}
		WHERE 
			id = {$ID}
	";

	$wpdb->query( $SQL );
?>