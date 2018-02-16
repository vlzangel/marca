<?php 

	// echo "<pre>";
	// print_r($_SESSION["CARRITO"]);
	// echo "</pre>";

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		$PLANES .= "
			<option data-planes='{$plan->id}' value='{$plan->id}' ".selected($plan->id, $data_planes, false).">".strtoupper($plan->plan)."</option>
		";
	}

	$_tipos = $wpdb->get_results("SELECT * FROM tipo_mascotas");
	$tipos = "";
	foreach ($_tipos as $key => $tipo) {
		$tipos .= "<option value='{$tipo->id}' ".selected($tipo->id, $_tipo, false).">".strtoupper($tipo->tipo)."</option>";
	}
	

?>
<article class="row">
	
	<div id="register"	class="col-md-12 col-xs-12 col-md-offset-0" style="border-radius:10px; border:1px solid #ccc; margin-bottom: 2%; padding-bottom: 15px;">
		<div class="row">

			<form class="form-horizontal" id="form-cargar-orden" method="post">
				
				<div class="row row-special">
					<div class="col-md-8" style="padding: 0px 15px 0px 0px !important;">
						<div class="row">					
							<h2 class="col-sm-6">INFORMACIÓN DEL ASESOR</h2>
						</div>
						<div class="row row-special campos-obligatorios">
							<span class="fa fa-asterisk" aria-hidden="true"></span>
							<small> Campos obligatorios</small>
						</div>
						<div class="col-md-6 form-group">
							<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
							<input data-charset="num" type="text" name="codidoasesor" class="form-control col-md-6" id="codidoasesor" placeholder="Código del asesor"  maxlength="40" >
						</div>
						<div class="col-md-6 form-group">
							<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
							<input data-charset="xlf" type="text" name="nombreasesor" class="form-control col-md-6" id="nombreasesor" placeholder="Nombre del asesor"  maxlength="40" >
						</div>
						<div class="col-md-6 form-group">
							<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
							<input data-charset="xlfnumesp" type="email" name="emailasesor" class="form-control col-md-6" id="emailasesor" placeholder="Correo del asesor"  maxlength="40" >
						</div>
					</div>
					<div class="row row-special campos-obligatorios hidden" id="small1">
						<span class="fa fa-asterisk" aria-hidden="true" id="fa-asesor"></span>
						<small id="sin_asesor"></small>
					</div>
				</div>
				<div class="row">					
					<h2 class="col-sm-6">INFORMACIÓN DEL SUSCRIPTOR</h2>
				</div>

				<div class="row row-special campos-obligatorios">
					<span class="fa fa-asterisk" aria-hidden="true"></span>
					<small> Campos obligatorios</small>
				</div>
				<input type="text" class="hidden" value="" name="user_id" id="user_id">
				<div class="row row-special campos-obligatorios hidden" id="small2">
					<span class="fa fa-asterisk" aria-hidden="false" id="fa-asesor"></span>
					<small id="sin_cliente"></small>
				</div>
				<div class="row row-special">					
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="email" name="emailsus" data-charset="xlfnumesp" class="form-control col-md-6" id="r_usuario" placeholder="Correo del suscriptor"  maxlength="40">
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input data-charset="xlf" type="text" name="nombre" class="form-control col-md-6" id="inputEmail3" placeholder="Nombre del suscriptor"  maxlength="60" >
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="telef_movil" data-charset="numxlf" class="form-control col-md-6" id="telef_movil" placeholder="Teléfono celular" onKeypress=""  maxlength="13">
					</div>
									
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>					
						<select class="form-control col-md-4" name="dir_tipos" id="tipo" data-load="productos">
							<?php echo $tipos; ?>
						</select>
					</div> 
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>					
						<select class="form-control col-md-4" name="dir_tamano" id="tamano" data-load="productos">
							<option value="Pequeño">Pequeño</option>
							<option value="Mediano">Mediano</option>
							<option value="Grande">Grande</option>
						</select>
					</div> 
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>					
						<select class="form-control col-md-4" name="dir_edad" id="edad" data-load="productos">
							<option value="Cachorro">Cachorro</option>
							<option value="Adulto">Adulto</option>
							<option value="Maduro">Senior</option>
						</select>
					</div> 

					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-4" name="dir_marcas" id="dir_marcas">
							<option>Marcas</option>
						</select>
						<input type="hidden" name="dir_peso"  value="" readonly>
						<input type="hidden" name="dir_precio"  value="" readonly>
					</div>
									
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<div id="crear_planes"></div>
						<select class="form-control col-md-4" name="dir_planes" id="dir_planes" >
							<option value="0">Planes</option>
							<?php echo $PLANES; ?>
						</select>
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-4" name="dir_estado">
							<option>Estado</option>
							<?php
								$estados = get_estados();
								if( count($estados) > 0 ){ 
									foreach ($estados as $estado) { ?>
										<option value="<?php echo utf8_decode($estado->id);?>">
											<?php echo utf8_decode($estado->name);?>
										</option>	
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-8 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="r_address" data-charset="xlfnumesp" class="form-control" id="r_address" placeholder="Dirección"  maxlength="500">
					</div>
				 	 				
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<input type="text" name="dir_codigo_postal" data-charset="numalf" class="form-control col-md-6" id="dir_codigo_postal" placeholder="Código postal" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="15">
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-6" name="casa_oficina">
							<option value="">Casa u Oficina</option>
							<option value="Casa">Casa</option>
							<option value="Oficina">Oficina</option>
						</select>
					</div>
					<div class="col-md-4 form-group">
						<i class="fa fa-asterisk fa-especial" aria-hidden="true"></i>
						<select class="form-control col-md-6" name="forma_pago">
							<option value="">Forma de pago</option>
							<option value="Tarjeta">Tarjeta</option>
							<option value="Tienda">Tienda de conveniencia</option>
						</select>
					</div>
				</div>

				<div class="row row-special">
					<div class="col-md-12" style="padding-top: 20px;">	
						<div class="text-center">
							<button id="btn-register_" class="btn-register_ btn btn-sm-kmibox" style="color: #94d400; border: 2px solid #091705;">Suscribir</button>
							<!-- div id="error_registrando"> Por favor revisar tus datos arriba, hay algún campo incompleto </div> 
							<div id="success_registrando"> Datos almacenados </div -->
	 					</div>
	 					<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
					</div>
				</div>
			</form>
		</div>
	</div>
</article>

<!-- Confirmacion de orden -->
<div class="modal fade" tabindex="-1" role="dialog" id="order_confirmacion" data-backdrop='false'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="orden_action" type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
