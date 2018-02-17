<?php
	if( !isset($_SESSION) ){ session_start(); }
	include_once( dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/wp-load.php' );
    
    setZonaHoraria();
	global $wpdb;

	// Autenticar Usuario
	$sql = "SELECT ID FROM wp_users WHERE md5(ID) = '{$_GET['u']}'";
	$data = $wpdb->get_row($sql);
    $user_id = $data->ID;
	$user = get_user_by( 'id', $user_id ); 
	if( $user ) {
	    wp_set_current_user( $user_id, $user->user_login );
	    wp_set_auth_cookie( $user_id );
	
		// Cargar Orden de usuario
		$sql_orden = " 
			SELECT *
			FROM asesores_ordenes
			WHERE valido_hasta > NOW() 
				AND token = '{$_GET["t"]}'
		";
		$orden = $wpdb->get_row($sql_orden);
		if( isset($orden->pedido) ){
			$pedido = unserialize($orden->pedido);
			$CARRITO= $pedido['carrito'];
			$_SESSION['CARRITO'] = serialize($CARRITO);
		}
	}

	// Redireccion
	if( isset($CARRITO) && !empty($CARRITO) ){
		header('location:'.get_home_url().'/pagar-mi-marca/');
	}else{
		header('location:'.get_home_url());		
	}
