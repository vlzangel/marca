<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	$cupones = $wpdb->get_results("SELECT * FROM cupones ORDER BY id DESC");

	$data["data"] = array();

	foreach ($cupones as $cupon) {

		$info = unserialize($cupon->data);

		$tipo = $wpdb->get_row("SELECT * FROM tipo_cupones WHERE id = {$info["tipo"]}");

		$exclusivo = "NO";
		if( $info["uso_individual"] == "1" ){
			$exclusivo = "Si";
		}

		$_data = "
			<div><strong>Tipo:</strong> {$tipo->tipo}</div>
			<div><strong>Vence:</strong> {$info["vence"]}</div>
			<div><strong>Limite por usuario:</strong> {$info["uso_por_usuario"]}</div>
			<div><strong>Limite por cup&oacute;n:</strong> {$info["uso_por_cupon"]}</div>
			<div><strong>Gasto M&iacute;nimo:</strong> {$info["gasto_minimo"]}</div>
			<div><strong>Gasto M&aacute;ximo:</strong> {$info["gasto_maximo"]}</div>
			<div><strong>Es de uso exclusivo:</strong> {$exclusivo}</div>
		";

		if( $cupon->usos == "" ){
			$cupon->usos = array();
		}else{
			$cupon->usos = unserialize($cupon->usos);
		}

		$plural = "veces";
		if( count($cupon->usos) == 1 ){
			$plural = "vez";
		}

		$data["data"][] = array(
	        $cupon->id,
	        $cupon->nombre,
	        $info["precio"].$tipo->simbolo,
	        count($cupon->usos)." ".$plural,
	        $_data,
	        "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$cupon->id."' 
	        		data-titulo='Editar Cup&oacute;n' 
	        		data-modulo='cupones' 
	        		data-modal='nuevo' 
	        		class='enlace'
	        	>Editar</span><br>
	        	<span onclick='eliminar_Cupon( jQuery( this ) )' data-id='".$cupon->id."' class='enlace'>Eliminar</span><br>
	        "
	    );
	}

    echo json_encode($data);

?>