<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' ORDER BY id DESC");
	$data["data"] = array();
	$ordenes = array();

	foreach ($despachos as $despacho) {

		$item = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = '{$despacho->sub_orden}' ");
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = '{$item->id_producto}' ");
		$user_id = $wpdb->get_var("SELECT cliente FROM ordenes WHERE id = '{$despacho->orden}' ");
		$cliente = get_user_meta($user_id, 'first_name', true)." ".get_user_meta($user_id, 'last_name', true);

		if( $despacho->fecha_entrega == null ){
			$despacho->fecha_entrega = "---";
		}else{
			$despacho->fecha_entrega = date("d/m/Y", strtotime( $despacho->fecha_entrega ) );
		}

		if( $despacho->guia == "" ){
			$despacho->guia = "---";
		}

		$ordenes[ $despacho->orden ]["fecha_entrega"] = $despacho->fecha_entrega;
		$ordenes[ $despacho->orden ]["guia"] = $despacho->guia;
		$ordenes[ $despacho->orden ]["cliente"] = $cliente;
		$ordenes[ $despacho->orden ]["status"] = $despacho->status;
		$ordenes[ $despacho->orden ]["productos"][] = $producto->nombre.", ".$producto->descripcion.", ".$producto->peso;
		
	}

	foreach ($ordenes as $orden_id => $_data) {

		$_productos = "";
		foreach ($_data["productos"] as $producto) {
			$_productos .= $producto."<br>";
		}

		$data["data"][] = array(
	        str_pad($orden_id, 5, "0", STR_PAD_LEFT),
	        $_data["cliente"],
	        $_productos,
	        "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Gu&iacute;a de Rastreo' 
	        		data-modulo='despacho' 
	        		data-modal='guia' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["guia"]."
	        	</div>",
	        "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Fecha de Entrega' 
	        		data-modulo='despacho' 
	        		data-modal='fecha_entrega' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["fecha_entrega"]."
	        	</div>",
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Status' 
	        		data-modulo='despacho' 
	        		data-modal='editar' 
	        		class='enlace' style='text-align: center;'
	        	>".$despacho->status."</span>
	        "
	    );
	}

    echo json_encode($data);

?>