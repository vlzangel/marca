<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	extract($_POST);

	$existe = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '$codigo' ");

	if( $existe == null ){

		$wpdb->query("
			INSERT INTO asesores VALUES (
				NULL,
				'$codigo',
				'$nombre',
				'$email',
				'$telefono',
				0,
				0,
				0,
				0
			)
		");

		include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
		$bitrix->department($email);

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