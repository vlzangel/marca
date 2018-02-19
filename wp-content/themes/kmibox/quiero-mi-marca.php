 <?php
/* 
 *
 * Template Name: Quiero mi Marca 
 *
 */
	
	session_start();

	$CARRITO = "";
	if( isset($_SESSION["CARRITO"]) && isset($_SESSION["MODIFICACION"]) ){
		$CARRITO = unserialize($_SESSION["CARRITO"]);
	}
	
	wp_enqueue_style( 'proceso_compra', TEMA()."/css/proceso_compra.css", array(), "1.0.0" );
	wp_enqueue_style( 'responsive_proceso_compra', TEMA()."/css/responsive/proceso_compra.css", array(), "1.0.0" );

	get_header(); 
	
	wp_enqueue_script( 'nutriheroes_script', TEMA()."/js/popup_nutriheroes.js" );

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY meses ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		// $plan->plan = str_replace(" ", "-", $plan->plan);
		$PLANES .= '
			<article id="plan-'.$plan->id.'" data-value="'.$plan->id.'" class="select_plan">
				<img class="img-responsive" src="'.TEMA().'/imgs/planes/'.$plan->plan.'.png">
				<div>
					'.$plan->descripcion.'
				</div>
			</article>
		';
	}
   
	$_tipos = $wpdb->get_results("SELECT * FROM tipo_mascotas");
	$tipos = "";
	foreach ($_tipos as $key => $tipo) {
		$tipos .= "<option value='{$tipo->id}' ".selected($tipo->id, $_tipo, false).">".strtoupper($tipo->tipo)."</option>";
	}

	$form_busqueda = get_form_busqueda();

	$HTML = '

		<a class="controles_generales" id="vlz_atras" href="#">
			<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S	
		</a>

		<div class="controles_generales" id="vlz_titulo">
			Elije el tamaño de tu mascota
		</div>

		<div class="controles_generales" id="vlz_controles_fases">
			<span id="fase_indicador_1" class="fase_activa"> <span>Paso 1</span> </span>
			<span id="fase_indicador_2" > <span>Paso 2</span> </span>
			<span id="fase_indicador_3" > <span>Paso 3</span> </span>
			<span id="fase_indicador_4" > <span>Paso 4</span> </span>
			<span id="fase_indicador_5" > <span>Paso 5</span> </span>
		</div>

		<div class="comprar_container">

			<section id="fase_1">

				<div class="carrousel-items-containers">

					<div class="carrousel-items">

						<article data-value="Mediano">
							<div>
								<div style="background-image: url('.get_home_url().'/img/edad/p_mediano.png);" class="img-responsive img-circle"></div>
								<p class="col-md-12">Mediano</p>
							</div>
						</article>
						<article data-value="Pequeño">
							<div>
								<div style="background-image: url('.get_home_url().'/img/edad/p_pequeno_1.png);" class="img-responsive img-circle"></div>
								<p class="col-md-12">Pequeño</p>
							</div>
						</article>
						<article data-value="Grande">
							<div>
								<div style="background-image: url('.get_home_url().'/img/edad/p_adulto.png);" class="img-responsive img-circle"></div>
								<p class="col-md-12">Grande</p>
							</div>
						</article>
					</div>

					<div class="selector_edad_container">
						<label>Selecciona la Edad</label>
						<div class="selector_edad_box" id="edad">
							<span id="edad_Cachorro" data-value="Cachorro" class="btn-disable" >Cachorro</span>
							<span id="edad_Adulto" data-value="Adulto" class="btn-disable" >Adulto</span>
							<span id="edad_Senior" data-value="Senior" class="btn-disable" >Senior</span>
						</div>
					</div>

				</div>
			</section>

			<section id="fase_2" class="hidden">
				
				<div class="controles_marca_container">
					'.$form_busqueda.'
					<div class="cantidad_resultados"><span id="cant_marcas">0</span> RESULTADOS</div>
					<div class="tipo_mascota">
						<select id="tipo_mascota"> '.$tipos.' </select>
					</div>
				</div>

				<div class="marcas_container">
					<div id="marca" data-top="0" class="marcas_box"></div>
				</div>

				<div style="display: none;">
					<i id="abajo_marcas" class="abajo_marcas fa fa-angle-down"></i>
					<i id="arriba_marcas" class="arriba_marcas fa fa-angle-up btn-disable"></i>
				</div>

				<div id="msg_desplazar_marcas" class="msg_desplazar">
					Desliza hacia arriba o abajo para ver las opciones
				</div>


				<div class="btn_siguiente_container">
					<button id="marca_select" class="btn_siguiente btn-disable" > Siguente </button>
				</div>
			</section>

			<section id="fase_3" class="hidden">
				
				<div class="controles_presentaciones_container">
					'.$form_busqueda.'
					<div class="cantidad_resultados"><span id="cant_precentaciones">0</span> RESULTADOS</div>
					<div class="tipo_mascota"></div>
				</div>

				<div id="presentaciones" class="presentaciones_container"> </div>

				<div id="msg_desplazar_precentaciones" class="msg_desplazar">
					Desliza hacia arriba o abajo para ver las opciones
				</div>

				<div class="btn_siguiente_container">
					<button id="presentacion_select" class="btn_siguiente btn-disable"> Siguente </button>
				</div>
			</section>

			<section id="fase_4" class="hidden">
				<div id="plan">
					<div id="nivel"></div>

					<div id="plan_box">
						'.$PLANES.'
					</div>

				</div>
			</section>

			<section id="fase_5" class="hidden">
				<div class="factura">
					<div class="cintillo_factura">
						<img id="cen" src="'.TEMA().'/imgs/Elemento-1.png" />
					</div>
					<h5 id="label-mensaje"></h5>
					<div class="alerta" id="cart-content-alerta">
						<span id="cart-alerta"></span>
					</div>					
					<table id="desglose" cellspacing=5 cellpadding=5>	
						<thead>
							<th class="solo_pc" width="40">&nbsp;</th>
							<th> <span> Producto </span> </th>
							<th> <span> Descripci&oacute;n </span> </th>
							<th class="solo_pc"> <span> Periodicidad </span> </th>
							<th class="solo_pc"> <span> Precio </span> </th>
							<th> <span> Cantidad </span> </th>
							<th class="solo_pc"> <span> Subtotal </span> </th>
						</thead>
						<tbody id="cart-items"></tbody>
					</table>

					<div id="cupones">
						<table cellspacing=0 cellpadding=0>	
							<tr>
								<td> ¿Dispone de un cupón de descuento? </td>
								<td>
									<div class="cupon_input_container"> 
										<input type="text" id="input_cupon" name="input_cupon" />
										<span>Aplicar</span>
									</div>
								</td>
							</tr>
						</table>
					</div>

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
							<tr id="desgloseDescuentos">
								<th class="" > 
									Descuentos 
									<div id="cupones_desglose"></div>
								</th>
								<td class="" > 
									<div>&nbsp;</div> 
									<div id="descuentos_desglose"></div> 
								</td>
							</tr>
							<tr>
								<th class="style_total" > Total </th>
								<td class="style_total" id="total"> </td>
							</tr>
						</table>
					</div>
				</div>
				
				<article class="col-md-12 text-center" style="padding-bottom: 20px;">
					<span id="agregar_plan" class="btn-kmibox-link-suscription" ><i class="fa fa-plus"></i>Agregar otro plan</span>
					<span class="btn_pagar" href="#" data-toggle="modal" data-target="#suscription">PAGAR</span>
				</article>		
			</section>	
		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog">
				<div class="Modal content text-center" >			     
					<div style=" background-color:#ffffff; border-color:#fffff1;">
						<img src="'.TEMA().'/imgs/opciones_pago/fondo.jpg" class="img-responsive" />
						<div style="background-color: #000000; color: #ffffff; text-align: left; padding: 5px 25px; font-family: GothanMedium_regular;">ELIJE TU FORMA DE PAGO</div>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="opciones_pago" >
							<div style="float:left; width:50%;">								
								<a href="#" id="pagar"><img src="'.TEMA().'/imgs/opciones_pago/Card.svg" style="width: 80%;" /><br><label style="caviar_dreamsregular">Tarjeta d&eacute;bito / cr&eacute;dito</label></a>
							</div>
							<div style="float:left; width:50%;" > 
								<a href="#" id="tienda"><img src="'.TEMA().'/imgs/opciones_pago/Cash.svg" style="width: 80%;" /><br><label style="caviar_dreamsregular">Efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';
 
	echo comprimir($HTML);

	wp_enqueue_script('mascotas', TEMA()."/js/functions_new.js", array(), '1.0.0');

	get_footer();

	if( $CARRITO != "" ){
		echo "<script> var MODIFICACION = eval('(".json_encode($CARRITO).")'); </script>";
	}else{
		echo "<script> var MODIFICACION = ''; </script>";
	}

	//echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/functions_new.js"></script>');
?>


<!-- Modal -->
<div class="modal fade" id="modal-contacto-marca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="dog-content">
	        <img src="<?php echo TEMA(); ?>/imgs/dog.png" class="img-responsive dog">
		</div>
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >Cerrar &times;</span></button>
      </div>
      <div id="mensaje" style="display:none;text-align:center;color:#fff;padding: 5px 0px;background: #699646;">Datos registrados, en breve te ayudamos con tu solicitud</div>
      <div class="modal-body row text-center">
      	<div class="col-xs-12 col-md-10 col-md-offset-1">  		
	      	<p>SI LA MARCA QUE CONSUME TU PELUDO NO APARECE AQU&Iacute; <span>D&Eacute;JANOS TUS CORREO O TU N&Uacute;MERO DE TEL&Eacute;FONO</span>
	      	</p>
	      	<p class="text-small">y te contactaremos en la pr&oacute;xima hora para ayudarte con tu solicitud</p>
	      	<form method="post" id="form-contacto" action="#">
	      		<div class="col-md-10 col-md-offset-1 text-center">
		      		<input type="text" class="form-control" name="email" id="email" placeholder="mi@email.com">
		      		<input type="text" class="form-control" name="phone" id="phone" placeholder="000 000 00000">
		      		<button class="btn-kmibox-send" type="submit">ENVIAR</button>
	      		</div>
	      	</form>
      	</div>
      </div> 
    </div>
  </div>
</div>
