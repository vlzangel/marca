<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");
	global $wpdb;

	extract($_POST);

	$_nombre = "";
	$_precio = "";
	$_marca = "";
	$_nombre = "";
	$img_url = "";
	$img_old = "";
	$_descripcion = "";
	$ID_UPDATE = "";
	$_existencia = "";

	$_origen_1 = "";
	$_origen_2 = "";

	if( $ID != "" ){
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$ID);
		$_nombre = $producto->nombre;
		$_precio = $producto->precio;
		$_peso = $producto->peso;
		$_marca = $producto->marca;
		$_existencia = $producto->existencia;
		$_puntos = $producto->puntos;
		$_descripcion = $producto->descripcion;
		$_tamanos = unserialize($producto->tamanos);
		$_edades = unserialize($producto->edades);
		$_planes = unserialize($producto->planes);
		$_dataextra = unserialize($producto->dataextra);
		$img_url = TEMA()."/imgs/productos/".$_dataextra["img"];
		$img_old = $_dataextra["img"];
		$ID_UPDATE = '<input type="hidden" id="ID" name="ID" value="'.$ID.'" />';

		$_origen_1 = $_dataextra["origen_1"];
		$_origen_2 = $_dataextra["origen_2"];
	}

	$tamanos = array(
		"pequenos" => "Pequeño",
		"medianos" => "Mediano",
		"grandes" => "Grande"
	);

	$edades = array(
		"cachorros" => "Cachorro",
		"adultos" => "Adulto",
		"senior" => "Senior"
	);

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$planes = array();
	foreach ($data_planes as $plan) {
		$planes[ $plan->id ] = array(
			$plan->plan,
			$plan->meses
		);
	}

	function newCheck($name, $key, $value, $valor, $checked = ""){
		$HTML = '
			<div class="input_checkbox">
				<input type="checkbox" id="'.$key.'" name="'.$name.'" for="'.$key.'" value="'.$value.'" '.$checked.'> <label for="'.$key.'">'.$valor.'</label>
			</div>
		';
		return $HTML;
	}

	function newInput($key, $value, $valor = ""){
		$HTML = '
			<div class="input_text">
				<label>'.$value.'</label>
				<input type="number" id="'.$key.'" name="'.$key.'" value="'.$valor.'"> 
			</div>
		';
		return $HTML;
	}

	$_marcas = $wpdb->get_results("SELECT * FROM marcas");
	$marcas = "";
	foreach ($_marcas as $key => $marca) {
		$marcas .= "<option value='{$marca->id}' ".selected($marca->id, $_marca, false).">{$marca->nombre}</option>";
	}

	$_origenes = $wpdb->get_results("SELECT * FROM ciudades_origen");
	$origen_1 = "";
	$origen_2 = "";
	$origen_1 .= "<option>Seleccione una ciudad</option>";
	$origen_2 .= "<option>Seleccione una ciudad</option>";	
	foreach ($_origenes as $key => $origen) {
		$origen_1 .= "<option value='{$origen->id}' ".selected($origen->id, $_origen_1, false).">{$origen->ciudad}</option>";
		$origen_2 .= "<option value='{$origen->id}' ".selected($origen->id, $_origen_2, false).">{$origen->ciudad}</option>";
	}
?>
<form id="producto">
	<?php echo $ID_UPDATE; ?>
	<div class="celdas_1">
		<div class="input_box">
			<div class="input_box">
				<label>Nombre del producto:</label>
				<input type="text" id="nombre" name="nombre" value="<?php echo $_nombre; ?>">
			</div>
		</div>
	</div>
	<div class="celdas_1">
		<div class="input_box">
			<div class="input_box">
				<label>Breve descripci&oacute;n del producto:</label>
				<input type="text" id="descripcion" name="descripcion" value="<?php echo $_descripcion; ?>">
			</div>
		</div>
	</div>
	<div class="celdas_3">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Precio</label>
					<input type="number" id="precio" name="precio" value="<?php echo $_precio; ?>"> 
				</div>
			
				<div class="input_text">
					<label>Peso</label>
					<input type="text" id="peso" name="peso" value="<?php echo $_peso; ?>"> 
				</div>
			
				<div class="input_text">
					<label>Marca</label>
					<select id="marca" name="marca">
						<?php echo $marcas; ?>
					</select>
				</div>

			</div>
		</div>
	</div>
	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">

				<div class="input_text">
					<label>Existencia</label>
					<input type="text" id="existencia" name="existencia" value="<?php echo $_existencia; ?>"> 
				</div>
			
				<div class="input_text">
					<label>Puntos</label>
					<input type="text" id="puntos" name="puntos" value="<?php echo $_puntos; ?>"> 
				</div>

			</div>
		</div>
	</div>
	<div class="celdas_2">
		<div class="input_box">
			<div class="input_text_container">
			
				<div class="input_text">
					<label>Origen I</label>
					<select id="origen_1" name="origen_1">
						<?php echo $origen_1; ?>
					</select>
				</div>
			
				<div class="input_text">
					<label>Origen II</label>
					<select id="origen_2" name="origen_2">
						<?php echo $origen_2; ?>
					</select>
				</div>

			</div>
		</div>
	</div>


	<div class="celdas_3">
		<div class="input_box">
			<div class="input_text_container">
				
				<div class="input_text">
					<label>Tama&ntilde;os:</label>
					<div class="input_checkbox_container">
						<?php
							foreach ($tamanos as $key => $value) {
								$checked = ""; if( $_tamanos[$value] == 1 ){ $checked = 'checked="checked"'; }
								echo newCheck("tamanos[]", $key, $value, $value, $checked);
							}
						?>
					</div>
				</div>
			
				<div class="input_text">
					<label>Edades:</label>
					<div class="input_checkbox_container">
						<?php
							foreach ($edades as $key => $value) {
								$checked = ""; if( $_edades[$value] == 1 ){ $checked = 'checked="checked"'; }
								echo newCheck("edades[]", $key, $value, $value, $checked);
							}
						?>
					</div>
				</div>
			
				<div class="input_text">
					<label>Planes:</label>
					<div class="input_checkbox_container">
						<?php
							foreach ($planes as $key => $value) {
								$checked = ""; if( $_planes[ $key ] == 1 ){ $checked = 'checked="checked"'; }
								echo newCheck("planes[]", "plan_".$key, $key, $value[0], $checked);
							}
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
	
	<div class="celdas_1">
		<div class="input_box">
			<label>Imagen del producto:</label>
			<input type="file" id="img" name="img" accept="image/*">
			<input type="hidden" id="img_reducida" name="img_producto" />
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
			<input type='button' value='Crear nuevo producto' name='crear' onClick='crearProducto( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php }else{ ?>
		<div class="botonera_container">
			<input type='button' value='Actualizar Producto' name='update' onClick='crearProducto( jQuery( this ) )' class="button button-primary button-large" />
		</div>
	<?php } ?>
</form>
<script type="text/javascript"> initImg("img"); </script>