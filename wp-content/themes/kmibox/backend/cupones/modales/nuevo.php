<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;

	extract($_POST);

	$_nombre = "";
	$ID_UPDATE = "";

	if( $ID != "" ){
		$cupon = $wpdb->get_row("SELECT * FROM cupones WHERE id = ".$ID);
		$_nombre = $cupon->nombre;

		$info = unserialize($cupon->data);

		$ID_UPDATE = '<input type="hidden" id="ID" name="ID" value="'.$ID.'" />';
	}

	$_tipos = $wpdb->get_results("SELECT * FROM tipo_cupones");
	$tipos = "";
	foreach ($_tipos as $key => $tipo) {
		$tipos .= "<option value='{$tipo->id}' ".selected($tipo->id, $info["tipo"], false).">({$tipo->simbolo}) {$tipo->tipo}</option>";
	}

?>
<form id="cupones">
	<?php echo $ID_UPDATE; ?>
	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Nombre del cup&oacute;n:</label>
					<input type="text" id="nombre" name="nombre" value="<?php echo $_nombre; ?>">
				</div>
				
				<div class="input_text">
					<label>Importe del cup&oacute;n:</label>
					<input type="text" id="precio" name="precio" value="<?php echo $info["precio"]; ?>"> 
				</div>
			
			</div>
		</div>
	</div>

	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Tipo de descuento:</label>
					<select id="tipo" name="tipo">
						<?php echo $tipos; ?>
					</select>
				</div>
			
				<div class="input_text">
					<label>Fecha de caducidad del cup&oacute;n</label>
					<input type="text" id="vence" name="vence" placeholder="dd/mm/yyyy" value="<?php echo $info["vence"]; ?>" readonly /> 
				</div>

			</div>
		</div>
	</div>

	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Límite de uso por usuario:</label>
					<input type="text" id="uso_por_usuario" name="uso_por_usuario" value="<?php echo $info["uso_por_usuario"]; ?>"> 
				</div>
			
				<div class="input_text">
					<label>Límite de uso por cup&oacute;n:</label>
					<input type="text" id="uso_por_cupon" name="uso_por_cupon" value="<?php echo $info["uso_por_cupon"]; ?>"> 
				</div>

			</div>
		</div>
	</div>

	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Gasto m&iacute;nimo:</label>
					<input type="text" id="gasto_minimo" name="gasto_minimo" value="<?php echo $info["gasto_minimo"]; ?>"> 
				</div>
			
				<div class="input_text">
					<label>Gasto m&aacute;ximo:</label>
					<input type="text" id="gasto_maximo" name="gasto_maximo" value="<?php echo $info["gasto_maximo"]; ?>"> 
				</div>

			</div>
		</div>
	</div>


	<div class="celdas_1">
		<div class="input_box">

			<div class="input_checkbox_container">
				<div class="input_checkbox">
					<?php
						$checked = "";
						if( $info["uso_individual"] == "1" ){
							$checked = "checked";
						}
					?>
					<input type="checkbox" id="uso_individual" name="uso_individual" value="1" <?php echo $checked; ?> > <label for="uso_individual">Uso individual <span class='msg'>Marca esta casilla si el cupón no se puede utilizar en combinación con otros cupones.</span> </label>
				</div>
			</div>

		</div>
	</div>

	<?php if( $ID == "" ){ ?>
		<div class="botonera_container">
			<input type='button' value='Crear cup&oacute;n' name='crear' onClick='crearCupon( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php }else{ ?>
		<div class="botonera_container">
			<input type='button' value='Actualizar cup&oacute;n' name='update' onClick='crearCupon( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php } ?>
</form>

<script type="text/javascript">
	var date = new Date();
	jQuery('#vence').datepick({
        dateFormat: 'dd/mm/yyyy',
        minDate: date,
        onSelect: function(xdate) {},
        yearRange: date.getFullYear()+':'+(parseInt(date.getFullYear())+1),
        firstDay: 1,
        onmonthsToShow: [1, 1]
    });
</script>