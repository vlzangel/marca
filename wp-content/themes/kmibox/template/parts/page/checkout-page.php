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
				<th class='solo_pc'> <div> Periodicidad </div> </th>
				<th class='solo_pc'> <div> Mascota </div> </th>
			</tr>";
	foreach ($CARRITO["productos"] as $key => $value) {
		$data = unserialize( $productos[ $value->producto ]->dataextra );

		if( isset($value->edad) ){
			$suscripciones .= "
				<tr>
					<td class=''>
						<img src='".TEMA()."/imgs/productos/".$data["img"]."' />
						<div class='solo_movil' style='text-transform: uppercase; font-family: GothanMedium_regular;'>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
						</div>
						<div class='solo_movil'>
							<div>
								<div>".$productos[ $value->producto ]->descripcion."</div>
								<div>".$productos[ $value->producto ]->peso."</div>
							</div>
							<div style='font-family: GothanMedium_regular;'>".$value->tamano." - ".$value->edad."</div>
							<div>El cobro de tu suscripción se hará <label style='font-family: GothanMedium_regular;'>".$value->plan."</label> de manera automática los días ".(date("d")+0)."</div>
						</div>
					</td>
					<td class='info solo_pc'>
						<div>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
					</td>
					<td class='solo_pc'>
						<div style='font-weight: 400; font-family: Gothamlight_Regular;'>El cobro de tu suscripción se hará <label class='periodicidad' style='font-family: GothanMedium_regular;'>".$value->plan."</label> de manera automática los días ".(date("d")+0)."</div>
					</td>
					<td class='solo_pc' style='font-family: GothanMedium_regular;'>".$value->tamano." - ".$value->edad."</td>
				</tr>
			";
		}
	}
	$suscripciones .= "</table>";


 	$dataOpenpay = dataOpenpay();

	$MERCHANT_ID = $dataOpenpay["MERCHANT_ID"];
	$OPENPAY_KEY_PUBLIC = $dataOpenpay["OPENPAY_KEY_PUBLIC"];
	$OPENPAY_PRUEBAS = 1;

/*	echo "<pre>";
		print_r($CARRITO);
	echo "</pre>";*/

?>

<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css?ver=".time(); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/responsive/pagos.css?ver=".time(); ?>">

<script type="text/javascript" src="<?php echo TEMA()."/js/openpay.v1.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo TEMA()."/js/openpay-data.v1.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo TEMA()."/js/pago_tarjeta.js?ver=".time(); ?>"></script>

<!-- Fase #6 Pagos -->
<section data-fase="6" class="container3">

	<!-- Mensaje de Error -->
	<?php if ($result['msg'] != ''){ ?>
		<aside class="col-md-10 col-md-offset-1 alert alert-danger"> <?php echo $result['msg']; ?> </aside>
	<?php } ?>

	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center "  style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden; margin-top: 75px;">
		<aside class="col-md-12 text-center">
			<h1 class="postone text-felicidades">¡Felicidades!</h1>
			<h4 class="gothan text-suscripcionexitosa">Tu suscripción a Nutriheroes ha sido un éxito</h4>
		</aside>
		<aside class="col-md-8 col-md-offset-2 text-left">
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan text-tususcripcion">TU SUSCRIPCIÓN:</div>				
			</div>
			<div class="col-xs-12 col-md-12 desc_value gothanligth" style="font-size: 18px;">
					<?php echo $suscripciones; ?>
				</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan text-tususcripcion">TOTAL SUSCRIPCIÓN:</div>				
			</div>
			<div class="col-xs-12 col-md-12 desc_value gothan total">
					<?php 
						echo "$".number_format($CARRITO["total"], 2, ',', '.');
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

	<article id="pagar" class="col-md-10 col-xs-12 col-md-offset-1 text-center hidden" style="border-radius:30px;padding:20px; margin: 75px 20px 0px; border:1px solid #ccc; width: calc( 100% - 40px );">

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
			      	data-openpay-card="holder_name" style="border-radius: 50px !important;">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar">Numero de Tarjeta</label>
			    <div class="col-sm-8">
			      <input type="text" name="num_card" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="# de tarjeta" maxlength="16" data-charset="num" value="4111111111111111" data-openpay-card="card_number" style="border-radius: 50px !important;">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Fecha vencimiento</label>
			    <div class="col-sm-4">
			    	<select name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> data-openpay-card="expiration_month" style="border-radius: 50px !important;" >
			    		<option>Mes</option>
			    		<?php for ($i=1; $i <= 12; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			      <!-- input type="text" name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Mes" -->
			    </div>
			    <div class="col-sm-4">
			      <!-- input type="text" name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Año" -->
			    	<select name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> data-openpay-card="expiration_year" style="border-radius: 50px !important;" >
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
			      <input type="text" name="cvv" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  id="inputPassword3" placeholder="CVV" maxlength="3" data-charset="num" data-openpay-card="cvv2" style="border-radius: 50px !important;">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label caviar" >Total a pagar</label>
			    <div class="col-sm-8">
			      <input type="text" readonly class="form-control disabled" id="inputPassword3" value="$<?php echo number_format($CARRITO["total"], 2, ',', '.'); ?>" style="border-radius: 50px !important;">
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

