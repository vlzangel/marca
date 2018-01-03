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
		$marca = $wpdb->get_row("SELECT * FROM marcas WHERE id = ".$ID);
		$_nombre = $marca->nombre;
		$img_url = TEMA()."/imgs/marcas/".$marca->img;
		$img_old = $marca->img;
		$ID_UPDATE = '<input type="hidden" id="ID" name="ID" value="'.$ID.'" />';
	}


?>
<form id="marca">
	<?php echo $ID_UPDATE; ?>
	<div class="celdas_1">
		<div class="input_box">
			<label>Nombre de la marca:</label>
			<input type="text" id="nombre" name="nombre" value="<?php echo $_nombre; ?>">
		</div>
	</div>
	<div class="celdas_1">
		<div class="input_box">
			<label>Imagen de la marca:</label>
			<input type="file" id="img" name="img" accept="image/*">
			<input type="hidden" id="img_reducida" name="img_marca" />
			<?php if( $ID == "" ){ ?>
				<img id="img_vista">
			<?php }else{ ?>
				<input type="hidden" id="img_old" name="img_old" value="<?php echo $img_old; ?>" />
				<img id="img_vista" src="<?php echo $img_url; ?>">
			<?php } ?>
		</div>
	</div>
	<?php if( $ID == "" ){ ?>
		<div class="botonera_container">
			<input type='button' value='Crear nueva marca' name='crear' onClick='crearMarca( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php }else{ ?>
		<div class="botonera_container">
			<input type='button' value='Actualizar marca' name='update' onClick='crearMarca( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php } ?>
</form>
<script type="text/javascript"> initImg("img"); </script>