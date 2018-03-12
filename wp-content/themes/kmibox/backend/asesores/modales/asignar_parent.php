<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();

    $asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id = {$ID}");

	$HTML = '
		<form id="asignar_parent">
			<input type="hidden" id="codigo" name="codigo" value="'.$ID.'">

			<div>
				<label><strong>Informaci&oacute;n del Asesor:</strong></label>
				<div> <strong>Nombre:</strong> '.$asesor->nombre.' </div>
				<div> <strong>Email:</strong> '.$asesor->email.' </div>
				<div> <strong>Tel&eacute;fono</strong> '.$asesor->telefono.' </div>
			</div>
			<div class="celdas_1">
				<div class="input_box">
					<label>Indique c&oacute;digo de asesor padre:</label>
					<input type="text" id="parent" name="parent" />
				</div>
			</div>
			<div class="botonera_container">
				<span class="pull-left" id="mensaje"></span>
				<input type="button" value="Actualizar" name="update" onClick="actualizarParent()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>