<?php
	include '../wp-load.php';

	extract($_GET);

	setZonaHoraria();

	global $wpdb;

	$orden = $wpdb->get_row( "SELECT * FROM ordenes WHERE id = {$orden_id};" );
	$metaData = deserializar($orden->metadata);

	$user_id = $orden->cliente;
		
	$email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
	$_name = $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);

	$hoy = time();
	$dia_semana_hoy = date("N", $hoy);

	if( $dia_semana_hoy >= 5 ){ $desde = strtotime('+'.(8-$dia_semana_hoy).' day', $hoy); 
	}else{ $desde = strtotime('+1 day', $hoy);  }

	if( $dia_semana_hoy == 1 ){ $hasta = strtotime('+5 day', $hoy);
	}else{ $hasta = strtotime('+7 day', $hoy); }

    $fecha_estimada = date("d/m/Y", $desde)." y ".date("d/m/Y", $hasta);

	echo $HTML = generarEmail(
		"notificacion/pago_recibido_tienda", 
		array(
			"USUARIO" => $_name,
			"ORDEN_ID" => $orden_id,
    		"FECHAS" => $fecha_estimada,
		)
	);

	// wp_mail( $email, "Pago Recibido Exitosamente - NutriHeroes", $HTML );
	// mail_admin_nutriheroes("Pago Recibido Exitosamente - NutriHeroes", $HTML );
?>