
	<div role="dialog" id="nutriheroes" style="visibility: hidden;">
		<div class="nutri-container">

			<div style="display: inline-block; position: relative;">
				<button type="button" class="nutri-close" id="nutri-close" onclick="jQuery('#nutriheroes').css('display', 'none');">×</button>

				<img  class="solo_pc" src="<?php echo TEMA().'imgs/popup-nutriheroes/full/Pop-Up-Homepage_new.png'; ?>" style='width: 100%;' />

				<img  class="solo_movil fondo_popup_movil" src="<?php echo TEMA().'imgs/popup-nutriheroes/full/Pop-Up-Homepage-responsive_2.png'; ?>" />

				<article style="
					position: absolute;
				    bottom: 0px;
				    width: 100%;
				    text-align: center;
				">

					<form id="form-pop-up-home">

						<input type="text" id="email" name="email" placeholder="Correo Electr&oacute;nico" class="input-pop-up-home" value="Correo Electr&oacute;nico" /> <!--  -->
						<div class="separador-pop-up-home"></div>
						<input type="text" id="phone" name="phone" placeholder="N&uacute;mero de tel&eacute;fono" class="input-pop-up-home" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="13" value="N&uacute;mero de tel&eacute;fono" /> <!--  -->
						<input type="hidden" name="mi_marca" value="">
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



 