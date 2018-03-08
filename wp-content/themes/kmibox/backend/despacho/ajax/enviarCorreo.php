<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";

	$fecha = date("Y-m-d", strtotime( str_replace("/", "-", $fecha) ) );

	$despacho = $wpdb->get_row("SELECT * FROM despachos WHERE ".$condicion);
	 if( $despacho->fecha_entrega != $fecha ){

		// Correo

		$hoy = strtotime($despacho->fecha_entrega);
		$dia_semana_hoy = date("N", $hoy);

		if( $dia_semana_hoy >= 5 ){ $desde = strtotime('+'.(8-$dia_semana_hoy).' day', $hoy); 
		}else{ $desde = strtotime('+1 day', $hoy);  }

		if( $dia_semana_hoy == 1 ){ $hasta = strtotime('+5 day', $hoy);
		}else{ $hasta = strtotime('+7 day', $hoy); }

	    $fecha_estimada = date("d/m/Y", $desde)." - ".date("d/m/Y", $hasta);
	    $metas_user = get_user_meta($despacho->cliente);

	    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$despacho->cliente}");
	    $nombre = $metas_user[ "first_name" ][0]." ".$metas_user[ "last_name" ][0];

	    $estado = utf8_decode( $wpdb->get_var("SELECT name FROM wp_estados WHERE id = ".$metas_user["dir_estado"][0]) );
	    $municipio = utf8_decode( $wpdb->get_var("SELECT name FROM wp_municipios WHERE id = ".$metas_user["dir_ciudad"][0]) );
	    $direccion = '
			<div> 
				'.$metas_user[ "dir_calle" ][0].', 
				Colonia: '.$metas_user[ "dir_colonia" ][0].', 
				'.$municipio.', 
				'.$estado.', 
				'.$metas_user[ "dir_codigo_postal" ][0].' - M&eacute;xico 
			</div>
	    ';
	    $_productos = getProductosDesglose($ID);

	    $dia_de_cobro = end( explode("-", $wpdb->get_var("SELECT fecha_creacion FROM ordenes WHERE id = ".$ID) ) );

	    
	 	$productos = "";
	 	foreach ($_productos as $producto) {
	 		if( $producto != "" ){
		 		$temp = getTemplate("/compra/envio/partes/producto");
		 		$temp = str_replace("[IMG_PRODUCTO]", $producto["img"], $temp);
		 		$temp = str_replace("[NOMBRE]", $producto["nombre"], $temp);
		 		$temp = str_replace("[DESCRIPCION]", $producto["descripcion"], $temp);
		 		$temp = str_replace("[PLAN]", ' Tu asesor nutricional te contactará una semana antes de que venza tu suscripción. Adicionalmente, se hará un envío de tu orden de pago '.$producto["plan"].' de manera automática los días '.$dia_de_cobro.' por el cobro de tu alimento, el cual será enviado una vez sea aprobado el pago.', $temp);
		 		$temp = str_replace("[CANTIDAD]", $producto["cantidad"], $temp);
		 		$temp = str_replace("[PRECIO]", number_format($producto["precio"], 2, ',', '.'), $temp);
		 		$productos .= $temp;
		 	}
	 	}

	 	$HTML = generarEmail(
	    	"compra/envio/index", 
	    	array(
	    		"USUARIO" => $nombre,
	    		"DIRECCION" => $direccion,
	    		"FECHA_ESTIMADA" => $fecha_estimada,
	    		"GUIA" => $despacho->guia,
	    		"TOTAL" => number_format($wpdb->get_var("SELECT total FROM ordenes WHERE id = ".$ID), 2, ',', '.'),
	    		"PRODUCTOS" => $productos,
	    	)
	    );

	    wp_mail( $email, "Notificación de Envío - NutriHeroes", $HTML );
	    mail_admin_nutriheroes( "Notificación de Envío - NutriHeroes", $HTML );
	   
	        

	    $wpdb->query( "UPDATE despachos SET correo_enviado = '1' WHERE ".$condicion );


	}

?>