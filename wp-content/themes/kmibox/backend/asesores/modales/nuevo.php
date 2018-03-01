<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

    setZonaHoraria();

    if( $ID != "" ){
		$marca = $wpdb->get_row("SELECT * FROM asesores WHERE id = ".$ID);
		$_codigo = $marca->codigo_asesor;
		$_nombre = $marca->nombre;
		$_email = $marca->email;
		$_telefono = $marca->telefono;
	}


	if( $ID == "" ){
		$BOTON = '
			<div class="botonera_container">
				<input type="button" value="Crear" name="crear" onClick="crearNuevo()" class="button button-primary button-large" />
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
		<form id="asignar_asesor">
			<input type="hidden" id="user_id" name="user_id" value="'.$ID.'">

			<div class="celdas_1">
				<div class="input_box">
					<label>C&oacute;digo:</label>
					<input type="text" id="codigo" name="codigo" value="'.$_codigo.'" required />
				</div>
			</div>

			<div class="celdas_1">
				<div class="input_box">
					<label>Nombre:</label>
					<input type="text" id="nombre" name="nombre" value="'.$_nombre.'" required />
				</div>
			</div>

			<div class="celdas_1">
				<div class="input_box">
					<label>Email:</label>
					<input type="email" id="email" name="email" value="'.$_email.'" required />
				</div>
			</div>

			<div class="celdas_1">
				<div class="input_box">
					<label>Tel&eacute;fono:</label>
					<input type="text" id="telefono" name="telefono" value="'.$_telefono.'" />
				</div>
			</div>

			'.$BOTON.'
		</div>
	';




	echo $HTML;
?>