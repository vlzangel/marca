<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	extract($_POST);

	$asesor = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '$codigo' ");

	if( isset($asesor->id) && isset($user_id) && $user_id > 0 ){

		$user = get_userdata( $user_id );

		update_usermeta( $user->id, 'asesor_registro', $asesor->id );

		include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
		$bitrix->addAsesor_customer($user->user_email, $asesor->email);

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