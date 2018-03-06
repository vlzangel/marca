<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();

	$_asesor =  get_user_meta($ID, 'asesor_registro', true);
    if( $_asesor == "" ){ $_asesor =  get_user_meta($ID, 'asesor', true); }
    if( $_asesor == "" ){ $_asesor =  ""; }

    $asesores = $wpdb->get_results("SELECT * FROM asesores");
    $_asesores = "";
    foreach ($asesores as $asesor) {
    	$_asesores .= "<option ".selected($asesor->id, $_asesor, false)." value='".$asesor->id."'>(".$asesor->codigo_asesor.") ".$asesor->nombre."</option>";
    }

    $cliente = $wpdb->get_row("SELECT * FROM wp_users WHERE ID = '$ID'");
	$nombre = get_user_meta($ID, "first_name", true)." ".get_user_meta($ID, "last_name", true);
	$telefono = get_user_meta($ID, "telef_movil", true);

	$HTML = '
		<form id="asignar_asesor">
			<input type="hidden" id="user_id" name="user_id" value="'.$ID.'">

			<input type="hidden" id="nombre" name="nombre" value="'.$nombre.'">
			<input type="hidden" id="email" name="email" value="'.$cliente->user_email.'">
			<input type="hidden" id="telefono" name="telefono" value="'.$telefono.'">
			<div>
				<label><strong>Informaci&oacute;n del Cliente:</strong></label>
				<div> <strong>Nombre:</strong> '.$nombre.' </div>
				<div> <strong>Email:</strong> '.$cliente->user_email.' </div>
				<div> <strong>Tel&eacute;fono</strong> '.$telefono.' </div>
			</div>
			<div class="celdas_1">
				<div class="input_box">
					<label>Indique c&oacute;digo de asesor:</label>
					<input type="text" id="codigo" name="codigo" />
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Crear" name="update" onClick="actualizarAsesor()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>