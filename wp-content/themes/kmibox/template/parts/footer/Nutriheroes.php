<?php
	$marcas = $wpdb->get_results("select * from marcas");
	$marcas_option = '';
	foreach ($marcas as $marca) {
		$marcas_option .= '<option value="'.$marca->nombre.'">'.$marca->nombre.'</option>';
	}
?>


	<div role="dialog" id="nutriheroes" style="visibility: hidden;">
		<div class="nutri-container">

			<div id="nutri-container" style="display: inline-block; position: relative;border-radius: 40px;">
				<button type="button" class="nutri-close" id="nutri-close" onclick="jQuery('#nutriheroes').css('display', 'none'); jQuery('body').css('overflow', 'auto');">×</button>

				<img  class="solo_pc" src="<?php echo TEMA().'imgs/popup-nutriheroes/full/Pop-Up-Homepage_new_2.png'; ?>" style='
					width: 100%;
				    max-width: 840px;
				    height: 265px;
				' />

				<img  class="solo_movil fondo_popup_movil" src="<?php echo TEMA().'imgs/popup-nutriheroes/full/Pop-Up-Homepage-responsive_3.png'; ?>" />

				<article style="
					position: absolute;
				    bottom: 0px;
				    width: 100%;
				    text-align: center;
				">

					<form id="form-pop-up-home" method="post" action="#">
						<input type="text" id="email" name="email" placeholder="Correo Electr&oacute;nico" class="input-pop-up-home" /> 
							<div class="separador-pop-up-home"></div>
						<input type="text" id="phone" name="phone" placeholder="N&uacute;mero de tel&eacute;fono" class="input-pop-up-home" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="13" />

						<select id="opt_marcas" name="mi_marca" placeholder="Selecciona tu marca" class="input-pop-up-home" style="text-align-last:center;width: 100%">
							<option>Selecciona tu marca</option>
							<?php echo $marcas_option; ?>
						</select>

						<input type="hidden" name="referencia" value="ayuda-home">

						<button type="submit" class="btn-pop-up-home">ENVIAR</button>
					</form>

					<div id="mensaje"></div>

				</article>
			</div>

		</div>
	</div>

	<script>
        setTimeout(function() {
            jQuery("#nutriheroes").css("visibility", "visible");
            jQuery("#nutriheroes").css("opacity", "1");
        }, 2 );
    </script>



 