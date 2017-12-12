<?php 
$date = getdate();
$desde = date("Y-m-01", $date[0] );
$hasta = date("Y-m-d", $date[0]);
if(	!empty($_POST['desde']) && !empty($_POST['hasta']) ){
	$desde = (!empty($_POST['desde']))? $_POST['desde']: "";
	$hasta = (!empty($_POST['hasta']))? $_POST['hasta']: "";
}

$suscripcion = get_suscripciones();
$estatus_envio = get_estatus_envio();
$tipo_pago = get_tipo_pago();
$estatus_pago= get_estatus_pago();
/*print_r($_GET);*/
?>

<header>
	<h1>
		<img src="<?php echo get_home_url(); ?>/img/logo-text-kmibox.png" class="img-responsive"> 
		<small>Control de Despacho</small>
	</h1>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<hr>
</header>

<div class="col-sm-12">  	
	<!-- Filtros -->
    <div class="row text-right"> 
    	<div class="col-sm-12">
	    	<form class="form-inline" action="/wp-admin/admin.php?page=<?php echo $_GET['page']; ?>" method="POST">
			  <label>Filtrar:</label>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">Desde</div>
			      <input type="date" class="form-control" name="desde" value="<?php echo $desde; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">Hasta</div>
			      <input type="date" class="form-control" name="hasta" value="<?php echo $hasta ?>">
			    </div>
			  </div>
				<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Buscar</button>			  
		    </form>
			<hr>  
		</div>
    </div>

  	<?php if( empty($suscripcion) ){ ?>
  		<!-- Mensaje Sin Datos -->
	    <div class="row alert alert-info"> No existen registros </div>
  	<?php }else{ ?>  		
	    <div class="row"> 
	    	<div class="col-sm-12" id="table-container" 
	    		style="font-size: 10px!important;">
	  		<!-- Listado de Conocer Cuidador-->
			<table id="tblConocerCuidador" class="table table-striped table-bordered dt-responsive table-hover table-responsive nowrap datatable-buttons" 
					cellspacing="0" width="100%">
			  <thead>
			    <tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Cant. Articulos</th>
					<th>Estatus</th>
					<th>Total</th>
					<th>Proxima Entrega</th>
					<th>Estatus Envio</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $count=0; ?>
			  	<?php foreach($suscripcion as $key => $solicitud ){ 

					/*print_r($solicitud);*/
			  		?> 
			  		<script>
							$( '[data-target="datepicker"]' ).datepicker();
					</script>
				    		

				    <tr>
				    	<th class="text-center"><?php echo $key; ?></th>
				    	<th><?php echo $solicitud['name']; ?></th>
				    	<th class="text-center"><?php echo $solicitud['items_count']; ?></th>
				    	<th class="text-center"><?php echo $solicitud['estatus']; ?></th>	    			
				    	<th>$ <?php echo number_format( $solicitud['total'], 2, '.', ','); ?></th>
				    	<th class="text-center"> 	<input data-target="datepicker" type="text" name="datepicker" placeholder="fecha entrega" value="" ></th>
							
				    	<th class="text-center">
				    		<select  data-id="<?php echo $solicitud['entrega']['code']; ?>" data-target="estatus_envio" class="form-control" style="width: 100%;">
				    			<option value="<?php echo $solicitud['entrega']['envio_estatus'];?>">
				    				<?php echo $estatus_envio[ $solicitud['entrega']['envio_estatus'] ]; ?>
				    			</option>
				    			<?php foreach ($estatus_envio as $key => $val) { ?>
				    				<?php if( $solicitud['entrega']['envio_estatus'] != $key ){ ?>
					    			<option value="<?php echo $key; ?>">
					    				<?php echo $val; ?>
					    			</option>
					    			<?php } ?>
				    			<?php } ?>
				    		</select>
				    	</th>
				    </tr>
			   	<?php } ?>
			  </tbody>
			</table>
			</div>
		</div>
	<?php } ?>	
  </div>
</div>
<div class="clearfix"></div>	
