<?php
	$tamanos = array(
		"pequenos" => "Peque&ntilde;os",
		"medianos" => "Medianos",
		"grandes" => "Grandes"
	);

	$edades = array(
		"cachorros" => "Cachorros",
		"adultos" => "Adultos",
		"maduros" => "Maduros"
	);

	$presentaciones = array(
		"900g" => "Peque&ntilde;a",
		"2000g" => "Mediana",
		"4000g" => "Grande"
	);

	$planes = array(
		"quincenal" => "Quincenal",
		"mensual" => "Mensual",
		"bimestral" => "Bimestral"
	);

	function newCheck($key, $value){
		$HTML = '
			<div class="input_checkbox">
				<input type="checkbox" id="'.$key.'" name="'.$key.'" for="'.$key.'"> <label for="'.$key.'">'.$value.'</label>
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
						echo newCheck($key, $value);
					}
				?>
			</div>
		</div>
		
		<div class="input_box">
			<label>Edades:</label>
			<div class="input_checkbox_container">
				<?php
					foreach ($edades as $key => $value) {
						echo newCheck($key, $value);
					}
				?>
			</div>
		</div>
		
		<div class="input_box">
			<label>Planes:</label>
			<div class="input_checkbox_container">
				<?php
					foreach ($planes as $key => $value) {
						echo newCheck($key, $value);
					}
				?>
			</div>
		</div>

	</div>

</form>