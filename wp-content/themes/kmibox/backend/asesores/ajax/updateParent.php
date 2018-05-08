<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;

	$existe_asesor = $wpdb->get_row("SELECT id, nombre, codigo_asesor, email FROM asesores WHERE id = '$codigo' ");

	if( $parent == $existe_asesor->codigo_asesor ){
		echo json_encode(array(
			"code" => 0,
			"msg" => 'No puede ser el mismo asesor.'
		));
		exit();		
	}
	
	$existe_parent = $wpdb->get_row("SELECT id, nombre, email FROM asesores WHERE codigo_asesor = '{$parent}' ");
	if( isset($existe_parent->id) && $existe_parent->id > 0 ){

		if( isset($existe_asesor->id) && $existe_asesor->id > 0 ){
			$wpdb->query("
				UPDATE asesores SET  
					parent = {$parent}
				WHERE id = '".$existe_asesor->id."'
			");

			// ************************
			// Agregar a bitrix
			// ************************
/*			include $raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php';
			$bitrix->updateParent( $existe_asesor->email, $existe_parent->email);
*/		

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