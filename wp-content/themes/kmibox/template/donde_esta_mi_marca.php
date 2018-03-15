<?php
	
	if( count($mis_despachos) > 0 ){
		$HTML .= '
		<section id="tab_3">
			<div class="section_box">

				<div class="selector_container">
					<div class="titulo_selector">Seleccionar Suscripción:</div>
					<select id="selector_despachos" class="selector">
						<option value="">Seleccione...</option>
						'.$opciones_despachos.'
					</select>
				</div>
				
				<div class="form_suscripcion">
					<div>
						<!-- <label class="subtiulo">Estatus del envío</label> -->
						<div class="progress-content">
							<div class="xborder-curvo col-md-12 text-center">
								<div class="row">
									<div id="armada" class="col-xs-12 col-sm-12 col-md-4">
										<img src="'.TEMA().'/imgs/perfil/Box-01.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i>
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											Armada
										</label>
									</div>
									<div id="enviada" class="col-xs-12 col-sm-12 col-md-4">
									    <img src="'.TEMA().'/imgs/perfil/Truck-02.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i>  
											En transito
										</label>
									</div>
									<div id="recibida" class="col-xs-12 col-sm-12 col-md-4">
										<img src="'.TEMA().'/imgs/perfil/Great-03.svg" class="img-responsive" >
										<label> 
											<i class="fa fa-check-square-o" aria-hidden="true"></i> 
											<i class="fa fa-square-o" aria-hidden="true"></i> 
											Entregado
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