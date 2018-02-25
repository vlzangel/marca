<?php
	if( !isset($_SESSION) ){ session_start(); }
	include_once( dirname(__DIR__, 5).'/wp-load.php' );

	global $wpdb;

	extract($_POST);

	$current_user = wp_get_current_user();
    $cliente = $current_user->ID;

	$cupon = $wpdb->get_row("SELECT * FROM cupones WHERE nombre = '{$cupon}'");

	if( $cupon == null ){
		echo json_encode(array(
			"error" => "Cupón Invalido"
		));
		exit;
	}

	$cupon->data = unserialize($cupon->data);
	$cupon->usos = unserialize($cupon->usos);
	if( $cupon->usos == "" ){ $cupon->usos = array(); }
	if( $cupones == "" ){ $cupones = array(); }

	$respuesta = aplicarCupon($cupon, $cupones, $total, true, $cliente, $totalDescuentos);

	echo json_encode($respuesta);

?>