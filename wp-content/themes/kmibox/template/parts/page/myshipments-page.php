<?php $suscripciones = get_suscripcion( ); ?>

<article class="row profile-content">

	<div class="col-md-4 col-xs-12 col-md-offset-2"
		style="margin-top:20px;">
		<h3 class="caviar" style="color: #94d400">Selecciona un envio</h3>
		<select class="form-control" data-id="select_kmibox" data-target="content-shipments">
			<option class="caviar" >Selecciona una marca</option>
			<?php foreach ($suscripciones as $key => $kmibox) { ?>
			<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
			<?php } ?>
		</select>
	</div>


	<div id="content-shipments" 
		class="col-md-8 col-xs-12 col-md-offset-2" 
		style="border-radius:10px; border:1px solid #ccc; margin-top:20px;">

		<div class="row form-horizontal">
			<h2 class="col-md-6 caviar">Tu suscripción ALimento</h2>
			<div class="col-md-6 col-md-offset-3 text-center">
				<img id="imagen" src="<?php echo get_home_url(); ?>/img/NUPEC.png" class="img-responsive" >
			</div>
		</div>

		<div class="row text-center" style="font-size: 12px">
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Tipo de suscripción</label>
			      <input id="tipo_suscripcion" class="disabled form-control profile-content-input" readonly value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Tipo de marca</label>
				<input id="tipo_kmibox" class="disabled form-control profile-content-input " readonly value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Próxima entrega</label>
				<input id="proxima_entrega" class="disabled form-control profile-content-input " readonly value="">				
			</div>
			<div class="col-md-6 visible-xs visible-sm col-xs-6">
				<label class="caviar">Estatus:</label>
				<input id="estatus" class="disabled form-control profile-content-input " readonly value="">				
			</div>
		</div>
		
		<div class="row text-center">
			<div class="col-md-6 hidden-xs hidden-sm">
				<label class="caviar">Estatus:</label>
				<input id="estatus" class="disabled form-control profile-content-input " readonly value="">				
			</div>
			<div class="col-md-6">
				<label class="caviar">Artículos añadidos:</label>
				<input id="articulos" class="disabled form-control profile-content-input " readonly value="">								
			</div>
		</div>
		<div class="row text-center">
			<label class="caviar">Entregas</label>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label class="caviar">Enero</label></li> 
					<li><span></span><label class="caviar">Febrero</label></li>
					<li><span></span><label class="caviar">Marzo</label></li>
					<li><span></span><label class="caviar">Abril</label></li>
					<li><span></span><label class="caviar">Mayo</label></li>
					<li><span></span><label class="caviar">Junio</label></li>
				</ul>				
			</div>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label class="caviar">Julio</label></li> 
					<li><span></span><label class="caviar">Agosto</label></li>
					<li><span></span><label class="caviar">Septiembre</label></li>
					<li><span></span><label class="caviar">Octubre</label></li>
					<li><span></span><label class="caviar">Noviembre</label></li>
					<li><span></span><label class="caviar">Diciembre</label></li>
				</ul>				
			</div>
		</div>

			<h2 class="col-md-6 caviar">Estatus del envío</h2>
			
	   <div class="row">
			<div class="border-curvo col-md-12 col-sm-12 col-md-12 text-center">				
				<div class="row" id="content-estatus">
					<div data-ubicacion="armada" class="col-xs-4 col-sm-3 col-md-3 pull-left selected">
						<img src="<?php echo get_home_url(); ?>/img/progress-box.png" class="img-responsive" >
						<label class="hidden-xs hidden-sm caviar">Armada</label>
					</div>
					<div class="col-md-2 col-sm-2 flecha hidden-xs ">
						<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="128">
					</div>
					<div data-ubicacion="enviada" class="col-xs-4 col-md-3 col-sm-3 selected">
						<img src="<?php echo get_home_url(); ?>/img/progress-cart.png" class="img-responsive" >
						<label class="hidden-xs hidden-sm caviar">Enviada</label>
					</div>
					<div class="col-md-2 col-sm-2 flecha hidden-xs">
						<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="128">
					</div>
					<div data-ubicacion="recibida" class="col-xs-4 col-md-3 col-sm-3 selected">
						<img src="<?php echo get_home_url(); ?>/img/progress-house.png" class="img-responsive pull-right" >
						<label class="hidden-xs hidden-sm caviar">Recibida</label>
					</div>
					<label id="mobile-estatus" class="hidden-md hidden-lg"></label>
				</div>
			</div>
			
	</div>
		

	</div>
</article> 	