<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";


	$_data = $wpdb->get_var("SELECT guia FROM despachos WHERE ".$condicion);
	
	if( $_data == "" ){
		$_data = array();
	}else{
		$_data = unserialize($_data);
	}
	$_data["I1"] = $agencia;
	$_data = serialize($_data);

	$SQL = "UPDATE despachos SET guia = '{$_data}' WHERE ".$condicion;
	$wpdb->query( $SQL );
?>