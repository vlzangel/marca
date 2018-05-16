<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$exite = $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$email}' or codigo_asesor = '{$codigo}' ");
	if( !isset($exite->id) ){

		$wpdb->query("
			INSERT INTO asesores (
				codigo_asesor,
				nombre,
				email,
				telefono
				) VALUES (
				'$codigo',
				'$nombre',
				'$email',
				'$telefono'
			)
		");

		// Registrar usuario		
		$user = get_user_by('email', $email);
		if( !isset($user->ID) ){
			$hoy = date("Y-m-d H:i:s");
	 		$clave = 'nutri'.date("mHi");
	        $password = md5(wp_generate_password( $clave, false ));
		    $user_id  = wp_create_user( $email, $password, $email );
			$_user = new WP_User( $user_id );
			$_user->set_role( 'subscriber' );
 
			// Se guarda informacion de la orden en los metas del usuario 
			update_user_meta( $user_id, 'first_name', $nombre);
			update_user_meta( $user_id, 'telef_movil', $telefono );
		}

		// ************************
		// BEGIN Agregar a bitrix
		// ************************
		include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
		$bitrix->department($email);
		// ************************
		// END bitrix
		// ************************

		echo json_encode(array(
			"code" => 1
		));
	}else if( isset($exite->id) && $user_id == $exite->id  ){

		$wpdb->query("
			UPDATE asesores SET 
				codigo_asesor = '$codigo',
				nombre = '$nombre',
				telefono = '$telefono'
			WHERE id = $user_id
		");

		// actualizar usuario		
		$user = get_user_by('email', $email);
		if( isset($user->ID) && $user->ID > 0 ){
			update_user_meta( $user->ID, 'first_name', $nombre);
			update_user_meta( $user->ID, 'telef_movil', $telefono );
		}
 
		echo json_encode(array(
			"code" => 1
		));

	}else{
		echo json_encode(array(
			"code" => 0,
			"msg" => "Este código ya se encuentra registrado"
		));
	}
?>	