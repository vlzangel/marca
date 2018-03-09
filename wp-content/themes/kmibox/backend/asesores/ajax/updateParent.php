<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$existe_asesor = $wpdb->get_row("SELECT id, codigo_asesor FROM asesores WHERE id = '$codigo' ");

	if( $parent == $existe_asesor->codigo_asesor ){
		echo json_encode(array(
			"code" => 0,
			"msg" => 'No puede ser el mismo asesor.'
		));
		exit();		
	}
	
	$existe = $wpdb->get_row("SELECT id FROM asesores WHERE codigo_asesor = '{$parent}' ");
	if( isset($existe->id) && $existe->id > 0 ){

		if( isset($existe_asesor->id) && $existe_asesor->id > 0 ){
			$wpdb->query("
				UPDATE asesores SET  
					parent = {$parent}
				WHERE id = '".$existe_asesor->id."'
			");

			echo json_encode(array(
				"code" => 1
			));
		}else{
			echo json_encode(array(
				"code" => 0,
				"msg" => "El código asesor no se encuentra registrado o es incorrecto."
			));
		}

	}else{
		echo json_encode(array(
			"code" => 0,
			"msg" => 'El código asesor "PADRE" no se encuentra registrado o es incorrecto.'
		));
	}
?>	