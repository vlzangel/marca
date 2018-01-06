<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;

	extract($_POST);

	$_nombre = "";
	$img_url = "";
	$img_old = "";
	$ID_UPDATE = "";

	if( $ID != "" ){
		$marca = $wpdb->get_row("SELECT * FROM tipo_mascotas WHERE id = ".$ID);
		$_nombre = $marca->tipo;
		$ID_UPDATE = '<input type="hidden" id="ID" name="ID" value="'.$ID.'" />';
	}


?>
<form id="tipo">
	<?php echo $ID_UPDATE; ?>
	<div class="celdas_1">
		<div class="input_box">
			<label>Tipo de Mascota:</label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $_nombre; ?>">
		</div>
	</div>
	<?php if( $ID == "" ){ ?>
		<div class="botonera_container">
			<input type='button' value='Crear nuevo tipo de mascota' name='crear' onClick='crearTipo( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php }else{ ?>
		<div class="botonera_container">
			<input type='button' value='Actualizar tipo de mascota' name='update' onClick='crearTipo( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php } ?>
</form>