<?php
	
	if( count($mis_despachos) > 0 ){
		$HTML .= '
		<section id="tab_3">
			<div class="section_box">
				<div class="carrusel_suscripciones_box">
					<div class="carrusel_suscripciones_container_general">
						<label class="gothan">Selecciona un suscripci&oacute;n</label>
						<div class="carrusel_suscripciones_container">
							<div style="width: '.($W_2*200).'px;">
								'.$carrusel_despachos.'
							</div>
						</div>
					</div>
					<div class="img_grande">
						<div class="">
							<img id="img_item" src="'.$inicial["img"].'" />
						</div>
					</div>
				</div>
				<div class="form_suscripcion">
					<div>
						<!-- <label class="subtiulo">Estatus del envío</label> -->
						<div class="progress-content">
							<div class="border-curvo col-md-12 text-center">
								<div class="row">
									<div id="armada" class="col-xs-12 col-sm-12 col-md-4  pull-left">
										<img src="'.TEMA().'/imgs/perfil/Box-01.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i>
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											Armada
										</label>
									</div>
									<div id="enviada" class="col-md-4 hidden-xs hidden-sm">
									    <img src="'.TEMA().'/imgs/perfil/Truck-02.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											Enviada
										</label>
									</div>
									<div id="recibida" class="col-md-4 hidden-xs hidden-sm pull-right">
										<img src="'.TEMA().'/imgs/perfil/Great-03.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i> 
											Recibida
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>';
	}else{
		$HTML .= '
		<section id="tab_3">
			<h1>Usted no tiene suscripciones activas.</h1>
		</section>';
	}
?>