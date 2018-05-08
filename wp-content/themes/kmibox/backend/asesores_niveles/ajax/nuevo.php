<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$exite = $wpdb->get_row("SELECT * FROM asesores_niveles WHERE nivel = '{$nivel}' ");
	if( !isset($exite->id) ){

		$wpdb->query("
			INSERT INTO asesores_niveles VALUES (
				NULL,
				'{$nivel}',
				'{$desde}',
				'{$hasta}',
				'{$orden}',
				1,
				{$bono}
			)
		");
		echo json_encode(array(
			"code" => 1
		));
	}else{
		echo json_encode(array(
			"code" => 0,
			"msg" => "Este nivel ya esta registrado registrado"
		));
	}
?>	