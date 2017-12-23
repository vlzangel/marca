<?php
	$tamanos = array(
		"pequenos" => "Pequeños",
		"medianos" => "Medianos",
		"grandes" => "Grandes"
	);

	$edades = array(
		"cachorros" => "Cachorros",
		"adultos" => "Adultos",
		"maduros" => "Maduros"
	);

	$presentaciones = array(
		"900g" => "Pequeños",
		"2000g" => "Mediana",
		"4000g" => "Grande"
	);

	$planes = array(
		"mensual" => "Mensual",
		"bimestral" => "Bimestral",
		"trimestral" => "Trimestral",
		"semestral" => "Semestral"
	);

	function newCheck($name, $key, $value){
		$HTML = '
			<div class="input_checkbox">
				<input type="checkbox" id="'.$key.'" name="'.$name.'" for="'.$key.'" value="'.$value.'"> <label for="'.$key.'">'.$value.'</label>
			</div>
		';
		return $HTML;
	}

	function newInput($key, $value){
		$HTML = '
			<div class="input_text">
				<label>'.$value.'</label>
				<input type="number" id="'.$key.'" name="'.$key.'" for="'.$key.'"> 
			</div>
		';
		return $HTML;
	}
?>
<form id="producto">
	<div class="celdas_1">
		<div class="input_box">
			<label>Nombre producto:</label>
			<input type="text" id="nombre" name="nombre">
		</div>
	</div>
	<div class="celdas_1">
		<div class="input_box">
			<label>Presentaciones:</label>
			<div class="input_text_container">
				<?php
					foreach ($presentaciones as $key => $value) {
						echo newInput( $key, $value." (".$key.")" );
					}
				?>
			</div>
		</div>
	</div>
	<div class="celdas_3">
		<div class="input_box">
			<label>Tama&ntilde;os:</label>
			<div class="input_checkbox_container">
				<?php
					foreach ($tamanos as $key => $value) {
						echo newCheck("tamanos[]", $key, $value);
					}
				?>
			</div>
		</div>
		<div class="input_box">
			<label>Edades:</label>
			<div class="input_checkbox_container">
				<?php
					foreach ($edades as $key => $value) {
						echo newCheck("edades[]", $key, $value);
					}
				?>
			</div>
		</div>
		<div class="input_box">
			<label>Planes:</label>
			<div class="input_checkbox_container">
				<?php
					foreach ($planes as $key => $value) {
						echo newCheck("planes[]", $key, $value);
					}
				?>
			</div>
		</div>
	</div>
	<div class="celdas_1">
		<div class="input_box">
			<label>Imagen del producto:</label>
			<input type="file" id="img" name="img" accept="image/*">
			<input type="hidden" id="img_reducida" name="img_producto" />
			<img id="img_vista">
		</div>
	</div>
	<div class="botonera_container">
		<input type='button' value='Crear nuevo producto' onClick='crearProducto()' class="button button-primary button-large" />
	</div>
</form>
<script type="text/javascript"> initImg("img"); </script>