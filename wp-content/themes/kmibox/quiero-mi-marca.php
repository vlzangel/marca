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
			<article id="plan-'.$plan->plan.'" class="select_plan">
				<img class="img-responsive" src="'.get_home_url().'/img/x'.$plan->plan.'.png">
				<button 
					class="btn btn-sm-marca btn-sm-kmibox-price postone" 
					data-value="'.$plan->id.'" 
				>
					'.$plan->plan.'
				</button>
			</article>
		';
	}

	$HTML = '
		<link rel="stylesheet" href="'.get_home_url().'/css/quiero.css">

		<div class="vlz_header">
			<a class="btn btn-sm btn-black pull-left" id="btn-atras" href="#" data-value="0">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atras
			</a>
			<label class="header_titulo" id="header">Prueba</label>
		</div>

		<div class="comprar_container">


			<section id="fase_1">

				<div class="carrousel-items col-xs-12 col-md-10 col-md-offset-1">
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_pequeno.png" class="img-responsive img-circle" id="Grande"/>
							<p  class="col-md-12">Pequeño</p>
						</div>
					</article>
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_mediano.png" class="img-responsive img-circle" id="Mediano"/>
							<p  class="col-md-12">Mediano</p>
						</div>
					</article>
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_adulto.png" class="img-responsive img-circle" id="Pequeño"/>
							<p  class="col-md-12">Grande</p>
						</div>
					</article>
				</div>
				<div class="text-center col-xs-12 col-md-8 col-md-offset-2">
					<h2>Selecciona la edad</h2>
					<button id="edad-btn" data-value="Cachorro" class="col-md-3 btn btn-black">CACHORRO</button>
					<button id="edad-btn" data-value="Adulto" class="col-md-3 btn btn-black">ADULTO</button>
					<button id="edad-btn" data-value="Maduro" class="col-md-3 btn btn-black">SENIOR</button>
				</div>
			</section>

 

			<section id="fase_2" class="hidden">

				<div class="comprar_box">					

				<div class="comprar_box">

						<div id="vlz_carrousel_2" class="vlz_carrousel hidden-xs hidden-sm"></div>
						<div id="carrousel_2" class="vlz_carrousel hidden-lg hidden-md"></div>
				</div>

				
				
				<div id="descripciones" class="comprar_descripcion" data-value=""></div>
				<div id="presentaciones" class="comprar_footer" data-value="">

					<span id="nombre_producto"></span>


					<div id="presentacion-900g" class="button_presentacion" style="margin-left:-4%">
						<button data-value="900g">
							<b>P (900g)</b>
						</button>
						<span class="separador_presentacion">|</span>
					</div>

					<div id="presentacion-2000g" class="button_presentacion">
						<button data-value="2000g">
							<b>M (2000g)</b>
						</button>
						<span class="separador_presentacion">|</span>
					</div>

					<div id="presentacion-4000g" class="button_presentacion">
						<button data-value="4000g">
							<b>G (4000g)</b>
						</button>
					</div>

					<span id="no_aparece" class="caviar">Si no aparece tu marca haz <a href="#">click aqui</a></span>
				</div>
			</section>

			<section id="fase_3" class="hidden">
				<div class="comprar_box" id="plan">
					<div id="planes">
						<div class="select_plan_box">
							'.$PLANES.'
						</div>
					</div>
				</div>
			</section>

			<section id="fase_4" class="hidden">
				<div class="factura">

					<div class="cintillo_factura">
						<img id="izq" src="'.get_home_url().'/img/marca/store.png" />
						<img id="cen" src="'.get_home_url().'/img/marca/Line---escritorio.png" />
						<img id="der" src="'.get_home_url().'/img/marca/box.png" />
					</div>

					<div class="alerta" id="cart-content-alerta">
						<span id="cart-alerta"></span>
					</div>
					
					<table id="desglose" cellspacing=0 cellpadding=0>	
						<thead>
							<th class="hidden-xs"width="40">&nbsp;</th>
							<th>Producto</th>
							<th>Descripci&oacute;n</th>
							<th>Frecuencia</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
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
					<a href="#" data-toggle="modal" data-target="#suscription"><img src="'.get_home_url().'/img/Boton-2.png" width="220" height="50"/></a>
				</article>		
			</section>	

		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" id="suscription">
				<div class="Modal content text-center" id="suscription" >			     
					<div  class="btn btn-sm-marca"  style=" background-color:#ffffff; border-color:#fffff1; border-style: solid; border-width: 14px; /*display: inline-block; */">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="row" >
							<div  style="clear:both;"></div>
							<div style="float:left;width:50%;">								
								<a href="#"  id="pagar" role="button"  data-target="suscription"><img src="'.get_home_url().'/img/tarjeta.png"   alt="Cinque Terre"  width="240" height="180"/><br><label style="caviar_dreamsregular">Pago con tarjeta</label></a>
							</div>
							<div style="float:left;width:50%;" >    
								
								<a href="#" type="button" id="tienda" data-target="suscription"><img src="'.get_home_url().'/img/efectivo.png" alt="Cinque Terre" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago en efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.get_home_url().'/js/functions.js"></script>');
?>

