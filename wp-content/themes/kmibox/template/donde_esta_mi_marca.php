<?php
	
	$HTML .= '
		<section id="tab_3">
			<div class="section_box">
				<div class="carrusel_suscripciones_container">
					<div style="width: '.($W*200).'px;">
						'.$carrusel.'
					</div>
				</div>

				<div class="form_suscripcion">
					
					<div>
						<label class="subtiulo">Estatus del envío</label>
						<div class="progress-content">
							<div class="border-curvo col-md-12 text-center">
								
								<div class="row">
									<div id="armada" class="col-xs-12 col-sm-12 col-md-3  pull-left">
										<img src="'.get_home_url().'/img/progress-box.png" class="img-responsive" >
										<label>Armada</label>
									</div>
									<div class="col-md-2 flecha hidden-xs hidden-sm">
										<img src="'.get_home_url().'/img/flecha.png" width="120">
									</div>
									<div id="enviada" class="col-md-3 hidden-xs hidden-sm">
										<img src="'.get_home_url().'/img/progress-cart.png" class="img-responsive" >
										<label>Enviada</label>
									</div>
									<div class="col-md-2 flecha hidden-xs hidden-sm">
										<img src="'.get_home_url().'/img/flecha.png" width="120">
									</div>
									<div id="recibida" class="col-md-3 hidden-xs hidden-sm pull-right">
									    <img src="'.get_home_url().'/img/progress-house.png" class="img-responsive" >
										<label>Recibida</label>
									</div>
								</div>

							</div>
						</div>
					</div>


				</div>

			</div>

		</section>';
?>