<?php

	global $CARRITO;
	global $wpdb;

	$_productos = $wpdb->get_results("SELECT * FROM productos");
	$productos = array();
	foreach ($_productos as $key => $value) {
		$productos[ $value->id ] = $value;
	}

	$suscripciones = "
		<table cellspacing=0 cellpadding=0 class='desglose_final'>
			<tr>
				<th colspan=2 > <div> Producto </div> </th>
				<th> <div> Periodicidad </div> </th>
				<th> <div> Mascota </div> </th>
			</tr>";
	foreach ($CARRITO["productos"] as $key => $value) {
		$data = unserialize( $productos[ $value->producto ]->dataextra );
		if( isset($value->edad) ){
			$suscripciones .= "
				<tr>
					<td>
						<img src='".TEMA()."/imgs/productos/".$data["img"]."' />
					</td>
					<td class='info'>
						<div>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
					</td>
					<td class='periodicidad'>".$value->plan."</td>
					<td>".$value->tamano." - ".$value->edad."</td>
				</tr>
			";
		}
	}
	$suscripciones .= "</table>";

	$MERCHANT_ID = "mej4n9f1fsisxcpiyfsz";
	$OPENPAY_KEY_PUBLIC = "pk_3b4f570da912439fab89303ab9f787a1";
	$OPENPAY_PRUEBAS = 1; // width: 100%;

?>

<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css"; ?>">

<script type="text/javascript" src="<?php echo TEMA()."/js/openpay.v1.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo TEMA()."/js/openpay-data.v1.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo TEMA()."/js/pago_tarjeta.js"; ?>"></script>

<!-- Fase #6 Pagos -->
<section data-fase="6" class="container3">

	<!-- Mensaje de Error -->
	<?php if ($result['msg'] != ''){ ?>
		<aside class="col-md-10 col-md-offset-1 alert alert-danger"> <?php echo $result['msg']; ?> </aside>
	<?php } ?>

	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center hidden"  style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden; margin-top: 3%;">
		<aside class="col-md-12 text-center">
			<h1 style="font-size: 40px; font-weight: bold; color: #04b804; margin-bottom: 20px;" class="postone text-felicidades">¡Felicidades!</h1>
			<h4 style="color:#000; font-weight: bold; margin-bottom: 20px;" class="gothan text-suscripcionexitosa">Tu suscripción a Nutriheroes ha sido un éxito</h4>
		</aside>
		<aside class="col-md-8 col-md-offset-2 text-left">
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan" style="font-size: 18px;">TU SUSCRIPCIÓN: </div>				
			</div>
					<div class="col-xs-12 col-md-12 desc_value gothanligth" style="font-size: 18px;">
							<?php echo $suscripciones; ?>
					</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan text-tususcripcion" style="font-size: 18px; margin-top: 20px;">TOTAL SUSCRIPCIÓN:</div>
				
			</div>
			<div class="col-xs-12 col-md-12 desc_value gothan" style="font-size: 18px; font-weight: bold;">
					<?php 
						echo "$".number_format($CARRITO["total"], 2, ',', '.')."MXN";
					?>
				</div>
		</aside>
		<aside class="col-md-12">
	      	<a href="<?php echo get_home_url(); ?>/perfil/" class="btn btn-sm-kmibox gothanligth text-btnperfil" style="">IR A MI PERFIL</a>
		</aside>
	</article>


	<!-- Plantilla de Pago -->

	<script> 
		var OPENPAY_TOKEN = '<?php echo $MERCHANT_ID ?>';
		var OPENPAY_PK = '<?php echo $OPENPAY_KEY_PUBLIC ?>';
		var OPENPAY_PRUEBAS = <?php echo $OPENPAY_PRUEBAS; ?>;
	</script>

	<article id="pagar" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px;padding:20px; margin-top:7%;border:1px solid #ccc;">

		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" method="post" action="#" id="form-pago" >
				<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
				<input type="hidden" name="redirect" value="<?php echo get_home_url(); ?>/pagar-mi-kmibox">

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-4 control-label caviar" >Titular</label>
			    <div class="col-sm-8">
			      <input type="text" name="holder_name" 
			      	class="form-control  <?php echo $disabled; ?> " 
			      	<?php echo $disabled; ?> 
			      	id="inputEmail3" 
			      	placeholder="Titular de la tarjeta" 
			      	maxlength="25"
			      	value=""
			      	data-charset="xlf"
			      	data-openpay-card="holder_name">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar">Numero de Tarjeta</label>
			    <div class="col-sm-8">
			      <input type="text" name="num_card" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="# de tarjeta" maxlength="16" data-charset="num" value="4111111111111111" data-openpay-card="card_number">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Fecha vencimiento</label>
			    <div class="col-sm-4">
			    	<select name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> data-openpay-card="expiration_month" >
			    		<option>Mes</option>
			    		<?php for ($i=1; $i <= 12; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			      <!-- input type="text" name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Mes" -->
			    </div>
			    <div class="col-sm-4">
			      <!-- input type="text" name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Año" -->
			    	<select name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> data-openpay-card="expiration_year"  >
			    		<option>Año</option>
			    		<?php for ($i=date('y'); $i < date('y') + 15; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >CVV</label>
			    <div class="col-sm-8">
			      <input type="text" name="cvv" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  id="inputPassword3" placeholder="CVV" maxlength="3" data-charset="num" data-openpay-card="cvv2" >
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Total a pagar</label>
			    <div class="col-sm-8">
			      <input type="text" readonly class="form-control disabled" id="inputPassword3" value="$<?php echo number_format($CARRITO["total"], 2, ',', '.'); ?>">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-4	col-sm-4">

			      <a href="<?php echo get_home_url(); ?>/quiero-mi-kmibox" class="btn  <?php echo (isset($hidden))? '' : 'hidden' ; ?>  btn-sm-kmibox" id="btn_pagar_2 caviar" >Realizar Pago</a>

			      <button id="btn_pagar_1" type="submit" class="btn caviar <?php echo (isset(
			      	$hidden))? 'hidden' : '' ; ?> btn-sm-kmibox" style="padding: 10px 42px 10px 42px;">Realizar Pago</button>
			    </div>
				<div class="col-sm-3">
			      <a href="<?php echo get_home_url(); ?>/" class="btn btn-sm-kmibox caviar" >Cancelar</a>
			    </div>
			  </div>


			</form>
		</div>
	</article>

</section>

