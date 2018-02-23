<?php
	global $wpdb;

    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$mis_suscripciones = getSuscripciones();

	$mis_despachos = getDespachosActivos();
	$despacho_inicial = array();

	
	$ordenes = getOrdenes();
/*
	echo "<pre>";
		print_r($ordenes);
	echo "</pre>";
*/
	$opciones = "";
	foreach ($ordenes as $key => $value) {
		$productos_list = $mis_suscripciones[ $value->id ]["productos"];
		if( !empty($productos_list) ){		
			$productos_list_name = '';
			foreach ($productos_list as $item) {
				$separador = ( empty($productos_list_name) )? '' : ' - ';
				$productos_list_name .= $separador . $item['nombre'];
			}
			$opciones .= "<option value={$value->id} data-status='{$value->status}'>Suscripci&oacute;n (Id: {$value->id}): {$productos_list_name} </option>";
		}
	}

	if( count($mis_suscripciones) > 0 ){
		$HTML .= '
			<section id="tab_2" class="section_activo">
				<div class="section_box">

					<div class="selector_container">
						<div class="titulo_selector">Seleccionar Suscripción:</div>
						<select id="selector_suscripcion" class="selector">'.$opciones.'</select>
					</div>

					<div class="acciones_container">
						<button id="cancelar_suscripcion" class="btn-sm-kmibox cancelar_suscripcion">Cancelar Suscripci&oacute;n</button>
						<button id="modificar_suscripcion" class="btn-sm-kmibox">Modificar Suscripci&oacute;n</button>
					</div>

					<div class="carrusel_suscripciones_box">
						<div class="carrusel_suscripciones_container_general">
							<label class="gothan">Productos de tu suscripci&oacute;n</label>
							<div class="carrusel_suscripciones_container slider_suscripciones"></div>
						</div>
						<div class="img_grande">
							<div class="">
								<img id="img_item" src="'.$inicial["img"].'" />
							</div>
						</div>
					</div>

					<div class="form_suscripcion">
						<div class="celda_4" style="margin-bottom: 0px;">
							<div class="">
								<label>Tipo de suscripción</label>
							    <input readonly id="tipo_suscripcion" class="profile-content-input form-control"  value="'.$inicial["plan"].'">
							</div>
							<div class="">
								<label>Tipo de Alimento</label>
								<input readonly id="presentacion" class="profile-content-input form-control"  value="'.$inicial["type"].'">				
							</div>
							<div class="">
								<label>Estatus</label>
								<input readonly id="status" class="profile-content-input form-control"  value="'.$inicial["status"].'">
							</div>
							<div class="">
								<label>Proxima entrega</label>
								<input readonly id="entrega" class="profile-content-input form-control"  value="'.$inicial["entrega"].'">
							</div>
						</div>
						<div>
							<label class="subtiulo">Entregas realizadas</label>
							<div class="celda_6 entregas">
								<div><span id="mes_01"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Enero</label></div> 
								<div><span id="mes_02"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Febrero</label></div>
								<div><span id="mes_03"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Marzo</label></div>
								<div><span id="mes_04"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Abril</label></div>
								<div><span id="mes_05"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Mayo</label></div>
								<div><span id="mes_06"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Junio</label></div>
							</div>
							<div class="celda_6 entregas">
								<div><span id="mes_07"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Julio</label></div> 
								<div><span id="mes_08"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Agosto</label></div>
								<div><span id="mes_09"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Septiembre</label></div>
								<div><span id="mes_10"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Octubre</label></div>
								<div><span id="mes_11"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Noviembre</label></div>
								<div><span id="mes_12"> <i class="fa fa-check" aria-hidden="true"></i> &nbsp; </span><label>Diciembre</label></div>			
							</div>
						</div>
					</div>
				</div>
			</section>';
		}else{
			$HTML .= '
			<section id="tab_2" class="section_activo">
				<h1>Usted no tiene suscripciones.</h1>
			</section>';
		}
?>