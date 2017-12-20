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
				<option style="font-family: caviar_dremasregular">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span style="font-family: caviar_dremasregular">Cargando datos, porfavor espere...</span>
			</span>
	</div>
	<div class=" col-md-4 col-xs-12 col-md-offset-2 visible-sm"
			style="margin-top:20px;  margin-left: 0; ">
			<h3 style="color: #94d400">Selecciona una suscripción</h3>
			<select class="form-control" data-id="select_kmibox" data-target="content-suscripcion">
				<option style="font-family: caviar_dremasregular">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span style="font-family: caviar_dremasregular">Cargando datos, porfavor espere...</span>
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
				<option style="font-family: caviar_dremasregular">Selecciona una Marca</option>
				<?php foreach ($suscripciones as $key => $kmibox) { ?>
					<option value="<?php echo $key; ?>"> Orden No.: <?php echo "{$key} " . $kmibox['meta']['kmibox_size']; ?> </option>
				<?php } ?>
			</select>

			<span class="loading hidden">
				<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>
				<span style="font-family: caviar_dremasregular">Cargando datos, porfavor espere...</span>
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

		
		<div class="row text-center " style="font-size: 12px">
			<div class="col-md-4 col-xs-6">
				<label style="font-family: caviar_dremasregular">Tipo de suscripción</label>
			      <input readonly id="tipo_suscripcion" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label style="font-family: caviar_dremasregular">Tipo de Alimento</label>
				<input readonly id="tipo_kmibox" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-4 col-xs-6">
				<label style="font-family: caviar_dremasregular">Próxima entrega</label>
				<input readonly id="proxima_entrega" class="profile-content-input form-control"  value="">				
			</div>
			<div class="col-md-4 col-xs-6 
			hidden-md hidden-lg visible-xs visible-sm">
				<label style="font-family: caviar_dremasregular">Estatus:</label>
				<input readonly id="estatus" class="profile-content-input form-control"  value="">
			</div>
		</div>
		<div class="row text-center">
			<div class="col-md-6 col-xs-6 hidden-xs hidden-sm">
				<label style="font-family: caviar_dremasregular">Estatus:</label>
				<input readonly id="estatus" class="profile-content-input form-control"  value="">
			</div>
			<div class="col-md-6 col-xs-12">
				<label style="font-family: caviar_dremasregular">Artículos añadidos:</label>
				<select id="articulos" class="profile-content-input form-control"></select>
			</div>
		</div>
		<div class="row text-center">
			<label style="color: #94d400" style="font-family: caviar_dremasregular">Entregas</label>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label style="font-family: caviar_dremasregular">Enero</label></li> 
					<li><span></span><label style="font-family: caviar_dremasregular">Febrero</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Marzo</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Abril</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Mayo</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Junio</label></li>
				</ul>				
			</div>
			<div class="calendar">
				<ul class="list-inline list-unstyle" id="leyenda">
					<li><span></span><label style="font-family: caviar_dremasregular">Julio</label></li> 
					<li><span></span><label style="font-family: caviar_dremasregular">Agosto</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Septiembre</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Octubre</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Noviembre</label></li>
					<li><span></span><label style="font-family: caviar_dremasregular">Diciembre</label></li>
				</ul>				
			</div>
		</div>
		<div class="hidden row progreso-entrega form-horizontal">
			<h2 class="col-md-6" style="font-family: caviar_dremasregular">Estatus del envío</h2>
			<div class="progress-content">
				<div class="border-curvo col-md-12 text-center">
					
					<div class="row">
						<div id="armada" class="col-xs-12 col-sm-12 col-md-3  pull-left">
							<img src="<?php echo get_home_url(); ?>/img/box-marca.png" class="img-responsive" >
							<label style="font-family: caviar_dremasregular">Armada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="120">
						</div>
						<div id="enviada" class="col-md-3 hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/truck.png" class="img-responsive" >
							<label style="font-family: caviar_dremasregular" >Enviada</label>
						</div>
						<div class="col-md-2 flecha hidden-xs hidden-sm">
							<img src="<?php echo get_home_url(); ?>/img/flecha.png" width="120">
						</div>
						<div id="recibida" class="col-md-3 hidden-xs hidden-sm pull-right">
						    <img src="<?php echo get_home_url(); ?>/img/guy.png" class="img-responsive" >
							<label style="font-family: caviar_dremasregular">Recibida</label>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</article>