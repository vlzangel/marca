<?php
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	global $wpdb;

	$_fecha = $wpdb->get_var("SELECT fecha_entrega FROM despachos WHERE id = {$ID}");

	if( $_fecha == null ){
		$_fecha = "---";
	}

	$HTML = '
		<form id="status_despacho">
			<input type="hidden" id="ID" name="ID" value="'.$ID.'">
			<div class="celdas_1">
				<div class="input_box">
					<label>Fecha Estimada de Entrega:</label>
					<input id="fecha" name="fecha" style="width: 100%;" value="'.$_fecha.'" readonly>
				</div>
			</div>
			<div class="botonera_container">
				<input type="button" value="Actualizar" name="update" onClick="actualizarFecha()" class="button button-primary button-large" />
			</div>
		</div>
		<script>
			var date = new Date();
			jQuery("#fecha").datepick({
                dateFormat: "dd/mm/yyyy",
                defaultDate: date,
                selectDefaultDate: true,
                minDate: date,
                onSelect: function(xdate) {
                    
                },
                yearRange: date.getFullYear()+":"+(parseInt(date.getFullYear())+1),
                firstDay: 1,
                onmonthsToShow: [1, 1]
            });
		</script>
	';


	echo $HTML;
?>