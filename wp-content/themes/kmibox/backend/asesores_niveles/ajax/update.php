<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$exite = $wpdb->get_row("SELECT * FROM asesores_niveles WHERE id = {$id} ");
	if( isset($exite->id) ){

		$wpdb->query("
			UPDATE asesores_niveles SET 
				nivel = '{$nivel}',
				desde = '{$desde}',
				hasta = '{$hasta}',
				orden = '{$orden}',
				bono  = {$bono}
			WHERE id = {$id}
		");
		
		echo json_encode(array(
			"code" => 1
		));
	}else{
		echo json_encode(array(
			"code" => 0,
			"msg" => "Este código no se encuentra registrado"
		));
	}
?>	