<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	extract($_POST);

	$existe = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '$codigo' ");

	if( $existe == null ){

		// ************************
		// BEGIN Agregar a bitrix
		// ************************
		$bitrix_id = 0;
		$bitrix_departamento_id = 0;

		include_once($raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php');
		$bitrix_id = $bitrix->addUser([
			"email" => $email,
			'nombre' => $nombre,
			'apellido' => '',
		]);

		$bitrix_departamento_id = $bitrix->addDepartament([
			"departament_name" => $nombre,
			'parent_id' => 1,
			'admin_user_id' => $bitrix_id,
			"email" => $email,
		]);
		// ************************
		// END bitrix
		// ************************

		$wpdb->query("
			INSERT INTO asesores VALUES (
				NULL,
				'$codigo',
				'$nombre',
				'$email',
				'$telefono',
				0,
				{$bitrix_id},
				{$bitrix_departamento_id},
				0
			)
		");

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