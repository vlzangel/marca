<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();

    if( $ID != "" ){
		$nivel = $wpdb->get_row("SELECT * FROM asesores_niveles WHERE id = ".$ID);
		$_nivel = $nivel->nivel;
		$_desde = $nivel->desde;
		$_hasta = $nivel->hasta;
		$_bono = $nivel->bono;
		$_orden = $nivel->orden;
	}


	if( $ID == "" ){
		$BOTON = '
			<div class="botonera_container">
				<input type="button" value="Crear" name="crear" onClick="crear()" class="button button-primary button-large" />
			</div>
		';
	}else{
		$BOTON = '
		<div class="botonera_container">
			<input type="button" value="Actualizar" name="update" onClick="actualizar()" class="button button-primary button-large" />
		</div>
		';
	}

	$HTML = '
	<div>
		<form id="nuevo">
			<input type="hidden" id="id" name="id" value="'.$ID.'">

			<div class="celdas_1">
				<div class="input_box">
					<label>Nivel:</label>
					<input type="text" id="nivel" name="nivel" value="'.$_nivel.'" required />
				</div>
			</div>
			<div class="celdas_1">
				<div class="input_box">
					<label>Desde:</label>
					<input type="text" id="desde" name="desde" value="'.$_desde.'" required />
				</div>
			</div>
			<div class="celdas_1">
				<div class="input_box">
					<label>Hasta:</label>
					<input type="text" id="hasta" name="hasta" value="'.$_hasta.'" required />
				</div>
			</div>

			<div class="celdas_1">
				<div class="input_box">
					<label>Multiplicador:</label>
					<input type="text" id="bono" name="bono" value="'.$_bono.'" required />
				</div>
			</div>
			<div class="celdas_1">
				<div class="input_box">
					<label>Orden:</label>
					<input type="text" id="orden" name="orden" value="'.$_orden.'" required />
				</div>
			</div>
		</form>


			'.$BOTON.'
	</div>
	';




	echo $HTML;
?>