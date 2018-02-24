<?php
	include( dirname(__DIR__, 5)."/wp-load.php" );

	global $wpdb;

	extract($_POST);
	
	$wpdb->query( "UPDATE ordenes SET status = 'Cancelada' WHERE id = {$ID_ORDEN};" );

 	$current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
	$_name = $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);;

	$HTML = generarEmail(
    	"suscripciones/cancelacion", 
    	array(
    		"USUARIO" => $_name,
    		"LINK" => HOME(),
    		"ID_ORDEN" => $ID_ORDEN
    	)
    );

    wp_mail( $email, "Suscripción Cancelada Exitosamente - NutriHeroes", $HTML );
   
           

// ----- Copia a los administradores
            $headers = array(
               'BCC: r.rodriguez@kmimos.la',
               'BCC: r.cuevas@kmimos.la',
            );
    wp_mail( 'i.cocchini@kmimos.la', "Suscripción Cancelada Exitosamente - NutriHeroes", $HTML, $headers );

	exit();
?>