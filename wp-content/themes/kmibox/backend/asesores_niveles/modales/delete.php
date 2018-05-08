<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();

    $nivel = $wpdb->get_row("SELECT * FROM asesores_niveles WHERE id = {$ID}");

	$HTML = '
		<form id="form_delete">
			<input type="hidden" id="codigo" name="codigo" value="'.$ID.'">

			<div>
				<label><strong>Informaci&oacute;n del Asesor:</strong></label>
				<div> <strong>Nivel:</strong> '.$nivel->nivel.' </div>
				<div> <strong>Desde:</strong> '.$nivel->desde.' </div>
				<div> <strong>Hasta:</strong> '.$nivel->hasta.' </div>
				<div> <strong>Orden:</strong> '.$nivel->orden.' </div>
				<div> <strong>Bono:</strong> '.$nivel->bono.' </div>
			</div>
			<div class="botonera_container">
				<span class="pull-left" id="mensaje"></span>
				<input type="button" value="Actualizar" name="update" onClick="delete()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>