<?php $suscripciones = get_suscripcion( ); ?>

<!-- pre>
<?php 
/*
foreach ($suscripciones as $key => $value) {
	$d = $value['detalle']['line_items'];
	foreach ($d as $key => $q) {
		print_r($q->get_order_id());
		print_r($q->get_product()->get_name());
		echo '<hr>';
	}
}  
*/
?>
</pre -->

<article class="row profile-content">
<div style="margin-left: 250px" class="hidden-xs">
	<div style="float:left;width:70%;">    
		<div class="col-md-4 col-xs-12 col-md-offset-2"
			style="margin-top:20px;">
			<h3>Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option>Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span>Cargando datos, porfavor espere...</span>
			</span>
	</div>
	<div style="float:left;width:100%;">    
			<div class="col-md-6 col-md-offset-3 text-center">
					<img id="imagen" src="<?php echo get_home_url(); ?>/img/NUPEC.png" class="img-responsive" >
			</div>

		</div>
	</div>
</div>

<div class="visible-xs">
	<div style="float:left;width:100%;">    
		<div class="col-md-4 col-xs-12 col-md-offset-2"
			style="margin-top:20px;">
			<h3>Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option>Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span>Cargando datos, porfavor espere...</span>
			</span>
	</div>
	<div style="float:left;width:100%;">    
			<div class="col-md-6 col-md-offset-3 text-center">
					<img id="imagen" src="<?php echo get_home_url(); ?>/img/NUPEC.png" class="img-responsive" >
			</div>

		</div>
	</div>
</div>

	<div id="content-suscripcion" 
		class="col-md-8 col-xs-12 col-md-offset-2" 
		style="border-radius:10px;  margin-top:20px;">

		
		<div class="row text-center">
			<div class="col-md-4">
				<label>Tipo de suscripción</label>
			      <input readonly id="tipo_suscripcion" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4">
				<label>Tipo de ALimento</label>
				<input readonly id="tipo_kmibox" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4">
				<label>Próxima entrega</label>
				<input readonly id="proxima_entrega" class="profile-content-input form-control"  value="">				
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-6">
				<label>Estatus:</label>
				<input readonly id="estatus" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-6">
				<label>Artículos añadidos:</label>
				<select id="articulos" class="profile-content-input form-control"></select>
			</div>
		</div>
		<div class="row text-center">
			<label>Entregas</label>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label>Enero</label></li> 
					<li><span></span><label>Febrero</label></li>
					<li><span></span><label>Marzo</label></li>
					<li><span></span><label>Abril</label></li>
					<li><span></span><label>Mayo</label></li>
					<li><span></span><label>Junio</label></li>
				</ul>				
			</div>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label>Julio</label></li> 
					<li><span></span><label>Agosto</label></li>
					<li><span></span><label>Septiembre</label></li>
					<li><span></span><label>Octubre</label></li>
					<li><span></span><label>Noviembre</label></li>
					<li><span></span><label>Diciembre</label></li>
				</ul>				
			</div>
		</div>
		<div class="row text-center">
			<ul class="list-inline list-unstyle" id="leyenda">
				<li><span></span><label>Entregado</label></li> 
				<li><span></span><label>Por entregar</label></li>
			</ul>
		</div>

		<div class="hidden row progreso-entrega form-horizontal">
			<h2 class="col-md-6">Estatus del envío</h2>
			<div class="progress-content">
				<div class="border-curvo col-md-12 text-center">
					
					<div class="row">
						<div id="armada" class="col-xs-12 col-sm-12 col-md-3  pull-left">
							<img src="<?php echo get_home_url(); ?>/img/progress-box.png" class="img-responsive" >
							<label>Armada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="128">
						</div>
						<div id="enviada" class="col-md-3 hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/progress-cart.png" class="img-responsive" >
							<label>Enviada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="128">
						</div>
						<div id="recibida" class="col-md-3 hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/progress-house.png" class="img-responsive pull-right" >
							<label>Recibida</label>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</article>