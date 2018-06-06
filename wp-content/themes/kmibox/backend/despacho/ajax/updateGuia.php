<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$_data = $wpdb->get_var("SELECT guia FROM despachos WHERE orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}';");

	echo "<pre>";
		print_r($_data);
	echo "</pre>";

	if( $_data == "" ){
		$_data = array();
	}else{
		$_data = unserialize($_data);
	}

	echo "<pre>";
		print_r($_data);
	echo "</pre>";

	$_data["I0"] = $guia;

	echo "<pre>";
		print_r($_data);
	echo "</pre>";

	$_data = serialize($_data);

	$SQL = "UPDATE despachos SET guia = '{$_data}' WHERE orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}';";
	$wpdb->query( $SQL );

?>