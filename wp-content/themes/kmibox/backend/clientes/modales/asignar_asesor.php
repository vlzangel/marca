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
	$HTML = '
		<form id="asignar_asesor">
			<input type="hidden" id="user_id" name="user_id" value="'.$ID.'">
			<div class="celdas_1">
				<div class="input_box">
					<label>Asesor Asignado:</label>
					<select id="asesor" name="asesor">
						<option value="">Seleccione una opci&oacute;n</option>
						'.$_asesores.'
					</select>
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Actualizar" name="update" onClick="actualizarAsesor()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>