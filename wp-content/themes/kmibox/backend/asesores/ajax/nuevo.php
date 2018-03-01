<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$exite = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '$codigo' ");
	if( $existe == null ){
		$wpdb->query("
			INSERT INTO asesores VALUES (
				NULL,
				'$codigo',
				'$nombre',
				'$email'
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