<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
	$condicion = "orden = {$ID} AND mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}'";

	$_data = $wpdb->get_var("SELECT guia FROM despachos WHERE ".$condicion);
	$_data = unserialize($_data);

	$HTML = '
		<form id="status_agencia">
			<input type="hidden" id="ID" name="ID" value="'.$ID.'">
			<div class="celdas_1">
				<div class="input_box">
					<label>Compa&ntilde;ia de Env&iacute;o:</label>
					<input id="agencia" name="agencia" style="width: 100%;" value="'.$_data["I1"].'">
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Actualizar" name="update" onClick="actualizarAgencia()" class="button button-primary button-large" />
			</div>
		</div>
	';


	echo $HTML;
?>