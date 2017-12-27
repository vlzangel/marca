<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' ORDER BY id DESC");

	foreach ($despachos as $despacho) {

		$item = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = '{$despacho->sub_orden}' ");
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = '{$item->id_producto}' ");

		$user_id = $wpdb->get_var("SELECT * FROM ordenes WHERE id = '{$despacho->orden}' ");

		$cliente = get_user_meta($user_id, 'first_name', true)." ".get_user_meta($user_id, 'last_name', true);

		$_data = unserialize( $item->data );

		$data["data"][] = array(
	        str_pad($despacho->sub_orden, 5, "0", STR_PAD_LEFT),
	        $cliente,
	        $producto->nombre,
	        $_data['presentacion'],
	        $_data['plan'],
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$despacho->id."' 
	        		data-titulo='Editar Status' 
	        		data-modulo='despacho' 
	        		data-modal='editar' 
	        		class='enlace'
	        	>".$despacho->status."</span>
	        "
	    );
	}

    echo json_encode($data);

?>