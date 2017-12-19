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
		<div class=" col-md-4 col-xs-12 col-md-offset-2 hidden-sm"
			style="margin-top:20px;  margin-left: 0;    width: 55%;">
			<h3 style="color: #94d400">Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option class="caviar">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span class="caviar">Cargando datos, porfavor espere...</span>
			</span>
	</div>
	<div class=" col-md-4 col-xs-12 col-md-offset-2 visible-sm"
			style="margin-top:20px;  margin-left: 0; ">
			<h3 style="color: #94d400">Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option class="caviar">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span class="caviar">Cargando datos, porfavor espere...</span>
			</span>
	</div>
	<div style="float:left;width:100%; border-radius:10px; border:1px solid #ccc;">    
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
			<h3 style="color:#94d400">Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option class="caviar">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span class="caviar">Cargando datos, porfavor espere...</span>
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
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Tipo de suscripción</label>
			      <input readonly id="tipo_suscripcion" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Tipo de Alimento</label>
				<input readonly id="tipo_kmibox" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="caviar">Próxima entrega</label>
				<input readonly id="proxima_entrega" class="profile-content-input form-control"  value="">				
			</div>
			<div class="col-md-4 col-xs-6 hidden-sm
			hidden-md hidden-lg visible-xs ">
				<label class="caviar">Estatus:</label>
				<input readonly id="estatus" class="profile-content-input form-control"  value="">
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-6 col-xs-6 hidden-xs ">
				<label class="caviar">Estatus:</label>
				<input readonly id="estatus" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-6 col-xs-12">
				<label class="caviar">Artículos añadidos:</label>
				<select id="articulos" class="profile-content-input form-control"></select>
			</div>
		</div>
		<div class="row text-center">
			<label style="color: #94d400" class="caviar">Entregas</label>
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
		<div class="hidden row progreso-entrega form-horizontal">
			<h2 class="col-md-6 caviar">Estatus del envío</h2>
			<div class="progress-content">
				<div class="border-curvo col-md-12 text-center">
					
					<div class="row">
						<div id="armada" class="col-xs-12 col-sm-12 col-md-3  pull-left">
							<img src="<?php echo get_home_url(); ?>/img/progress-box.png" class="img-responsive" >
							<label class="caviar">Armada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="120">
						</div>
						<div id="enviada" class="col-md-3 hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/progress-cart.png" class="img-responsive" >
							<label class="caviar">Enviada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="120">
						</div>
						<div id="recibida" class="col-md-3 hidden-xs hidden-sm pull-right">
						    <img src="<?php echo get_home_url(); ?>/img/progress-house.png" class="img-responsive" >
							<label class="caviar">Recibida</label>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</article>