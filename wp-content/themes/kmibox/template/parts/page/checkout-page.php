<?php
$result = ['visible'=>false, 'msg'=>''];
$visible = false;
$cart = get_cart();
$resumen = get_resumen();


/*print_r($resumen);*/

$order_id = 0;
if( get_current_user_id() > 0 ){
	if( $_POST ){

		if( $_POST['order_id'] > 0 ){
			$order_id = $_POST['order_id'];
		}else{
			$o = create_order();
			$order_id = $o->id;
		}
		if( $order_id > 0){
			$param = $_POST;
			$param['order_id'] = $order_id;
			try{
				$result = procesar_pago( $param );
			}catch(Exception $e){
				// $result['msg'] = "Error: ".$e->getCode()."<pre>".  $e->getMessage() .'</pre>';
				$result['msg'] = "Hemos tenido inconveniente al procesar tu pago <br>".$e->getMessage();
			}
		}
	}
}


$disabled = '';
if( $resumen['total'] <= 0 ){
	$hidden = 'hidden';
	$disabled = 'disabled';
}


?>
<!-- Fase #6 Pagos -->
<section data-fase="6" class="container">

	<!-- Mensaje de Error -->
	<?php if ($result['msg']!=''){ ?>
		<aside class="col-md-10 col-md-offset-1 alert alert-danger"> <?php echo $result['msg']; ?> </aside>
	<?php } ?>

	<!-- Mensaje Success -->
	<article class="col-md-6 col-md-offset-3 text-center <?php echo ($result['visible'])? '' : 'hidden' ; ?>"  style="border-radius:30px;padding:20px;border:1px solid #ccc;">
		<aside class="col-md-12 text-center">
			<h1 style="font-size: 60px; font-weight: bold; color: #94d400;">¡Felicidades!</h1>
			<h4 style="color:#ccc;">Tu suscripción a Marca ha sido un éxito</h4>
		</aside>
		<aside class="col-md-12 text-center thankyou-img">					
			<img src="<?php echo $resumen['kmibox']['thumnbnail']; ?>" class="img-responsive">
		</aside>
		<aside class="col-md-8 col-md-offset-2 text-left">
			<div class="row">
				<div class="col-xs-4 col-md-6 desc_name">Tu suscripción:</div>
				<div class="col-xs-6 col-md-6 desc_value"><?php echo $resumen['kmibox']['plan']; ?></div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-md-6 desc_name">Tamaño de kmibox:</div>
				<div class="col-xs-6 col-md-6 desc_value"><?php echo $resumen['kmibox']['size']; ?></div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-md-6 desc_name">Items agregados:</div>
				<div class="col-xs-6 col-md-6 desc_value"><?php echo $resumen['cant_item']; ?></div>
			</div>
		</aside>
		<aside class="col-md-12">
	      	<a href="<?php echo get_home_url(); ?>/perfil-usuario" class="btn btn-sm-kmibox">Ir a mi perfil</a>
		</aside>
	</article>


	<!-- Plantilla de Pago -->

	<article class="col-md-10 col-xs-12 col-md-offset-1 text-center <?php echo ($result['visible'])? 'hidden' : '' ; ?>" style="border-radius:30px;padding:20px; margin-top:0%;border:1px solid #ccc;">


		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" method="post" action="#" id="form-pago" >
				<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
				<input type="hidden" name="redirect" value="<?php echo get_home_url(); ?>/pagar-mi-kmibox">

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-4 control-label">Titular</label>
			    <div class="col-sm-8">
			      <input type="text" name="holder_name" 
			      	class="form-control  <?php echo $disabled; ?> " 
			      	<?php echo $disabled; ?> 
			      	id="inputEmail3" 
			      	placeholder="Titular de la tarjeta" 
			      	maxlength="25"
			      	value=""
			      	data-charset="xlf">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">Numero de Tarjeta</label>
			    <div class="col-sm-8">
			      <input type="text" name="num_cart" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="# de tarjeta" maxlength="16" data-charset="num" value="4111111111111111">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">Fecha vencimiento</label>
			    <div class="col-sm-4">
			    	<select name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> >
			    		<option>Mes</option>
			    		<?php for ($i=1; $i <= 12; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			      <!-- input type="text" name="exp_month" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Mes" -->
			    </div>
			    <div class="col-sm-4">
			      <!-- input type="text" name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?> id="inputPassword3" placeholder="Año" -->
			    	<select name="exp_year" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  >
			    		<option>Año</option>
			    		<?php for ($i=date('y'); $i < date('y') + 15; $i++) { ?>
				    		<option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
			    		<?php } ?>
			    	</select>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">CVV</label>
			    <div class="col-sm-8">
			      <input type="text" name="cvv" class="form-control  <?php echo $disabled; ?> " <?php echo $disabled; ?>  id="inputPassword3" placeholder="CVV" maxlength="3" data-charset="num" >
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">Total a pagar</label>
			    <div class="col-sm-8">
			      <input type="text" readonly class="form-control disabled" id="inputPassword3" value="$<?php echo number_format($resumen['total'], 2, ',', '.'); ?>">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-4	col-sm-4">

			      <a href="<?php echo get_home_url(); ?>/quiero-mi-kmibox" class="btn  <?php echo (isset($hidden))? '' : 'hidden' ; ?>  btn-sm-kmibox" id="btn_pagar">Realizar Pago</a>

			      <button id="btn_pagar" type="submit" class="btn <?php echo (isset(
			      	$hidden))? 'hidden' : '' ; ?> btn-sm-kmibox">Realizar Pago</button>
			    </div>
				<div class="col-sm-3">
			      <a href="<?php echo get_home_url(); ?>/" class="btn btn-sm-kmibox">Cancelar</a>
			    </div>
			  </div>


			</form>
		</div>
	</article>

</section>

