 <?php
/* 
 *
 * Template Name: Quiero mi Marca 
 *
 */

	get_header(); 

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		$PLANES .= '
			<article id="plan-'.$plan->plan.'" data-value="'.$plan->id.'" class="select_plan">
				<img class="img-responsive" src="'.TEMA().'/imgs/planes/'.$plan->plan.'.svg">
				<div>
					'.$plan->descripcion.'
				</div>
				<button class="btn btn-sm-marca btn-sm-kmibox-price postone"></button>
			</article>
		';
	}

	$HTML = '
		<link rel="stylesheet" href="'.TEMA().'/css/proceso_compra.css">

		<a class="controles_generales" id="vlz_atras" href="#">
			<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S	
		</a>

		<div class="controles_generales" id="vlz_titulo">
			Elije el tamaño de tu mascota
		</div>

		<div class="controles_generales" id="vlz_controles_fases">
			<span id="fase_indicador_1" class="fase_activa"></span>
			<span id="fase_indicador_2" ></span>
			<span id="fase_indicador_3" ></span>
			<span id="fase_indicador_4" ></span>
		</div>


		<div class="comprar_container">

			<section id="fase_1">
				<div class="carrusel_1">
					<span></span>
					<img src="'.TEMA().'/imgs/edad/Cachorro.png" data-value="Pequeño" class="tamano_activo" />
					<img src="'.TEMA().'/imgs/edad/Mediano.png" data-value="Mediano" />
					<img src="'.TEMA().'/imgs/edad/Adulto.png" data-value="Grande" />
				</div>
				<div class="selector_edad_container">
					<label>Selecciona la Edad</label>
					<div class="selector_edad_box" id="edad">
						<span id="edad_Cachorro" data-value="Cachorro">Cachorro</span>
						<span id="edad_Adulto" data-value="Adulto" >Adulto</span>
						<span id="edad_Senior" data-value="Senior" >Senior</span>
					</div>
				</div>
			</section>

			<section id="fase_2">
				<div class="carrusel_2">
					<span></span>
				</div>
				<div class="selector_producto_container">
					<div class="selector_producto_container_interno">
						<div class="selector_presentaciones">
							<span id="pres_900g" >P</span>
							<span id="pres_2000g" >M</span>
							<span id="pres_4000g" >G</span>
							<span id="pres_6000g" >XL</span>
						</div>
						<label>Selecci&oacute;n:</label>
						<div class="selector_producto_box" id="producto">
							<div id="nombre_producto" data-value="">ROYAL CANIN</div>
							<div id="descripcion_producto" data-value="" ><span><span></div>
						</div>
					</div>
					<div class="selector_producto_footer">
						Si no aparece tu marca, <a href="#">haz click aqui</a>
					</div>
				</div>
			</section>

			<section id="fase_3">
				<div class="comprar_box" id="plan">
					<div id="planes">
						<div class="select_plan_box">
							<span></span>	
							'.$PLANES.'
						</div>
					</div>
				</div>
			</section>

			<section id="fase_4" class="hidden">
				<div class="factura">
					<div class="cintillo_factura">
						<img id="cen" src="'.TEMA().'/imgs/marca/Elemento-1.png" />
					</div>
					<div class="alerta" id="cart-content-alerta">
						<span id="cart-alerta"></span>
					</div>
					<table id="desglose" cellspacing=5 cellpadding=5>	
						<thead>
							<th class="hidden-xs"width="40">&nbsp;</th>
							<th> <span> Producto </span> </th>
							<th> <span> Descripci&oacute;n </span> </th>
							<th> <span> Periodicidad </span> </th>
							<th> <span> Precio </span> </th>
							<th> <span> Cantidad </span> </th>
							<th> <span> Subtotal </span> </th>
						</thead>
						<tbody id="cart-items"></tbody>
					</table>
					<div id="totales">
						<table cellspacing=0 cellpadding=0>	
							<tr>
								<th> Productos en esta compra </th>
								<td id="cant-item"> </td>
							</tr>
							<tr>
								<th> Total sin IVA </th>
								<td id="subtotal"> </td>
							</tr>
							<tr>
								<th> IVA </th>
								<td id="iva"> </td>
							</tr>
							<tr>
								<th class="style_total" > Total </th>
								<td class="style_total" id="total"> </td>
							</tr>
						</table>
					</div>
				</div>
				
				<article class="col-md-12 text-center">
					<span id="agregar_plan" >Agregar otro plan</span>
					<a class="btn_pagar" href="#" data-toggle="modal" data-target="#suscription">Pagar</a>
				</article>		
			</section>	

		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog">
				<div class="Modal content text-center" >			     
					<div  class="btn btn-sm-marca"  style=" background-color:#ffffff; border-color:#fffff1; border-style: solid; border-width: 14px;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="row" >
							<div  style="clear:both;"></div>
							<div style="float:left;width:50%;">								
								<a href="#"  id="pagar" role="button"  data-target="suscription"><img src="'.get_home_url().'/img/tarjeta.png" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago con tarjeta</label></a>
							</div>
							<div style="float:left;width:50%;" > 
								<a href="#" type="button" id="tienda" data-target="suscription"><img src="'.get_home_url().'/img/efectivo.png" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago en efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/functions_new.js"></script>');
?>

