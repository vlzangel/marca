<?php

	global $CARRITO;
	global $wpdb;

 	include_once(dirname(dirname(dirname(__DIR__)))."/lib/openpay/Openpay.php");

 	$order_id = time();

 	$dataOpenpay = dataOpenpay();

 	try {
	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);

	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;

	    $email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
	    $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);
	    $openpay_cliente_id = get_user_meta($user_id, "openpay_id", true);

	    if( $openpay_cliente_id == "" ){
			$customerData = array(
		     	'name' => $nombre,
		     	'email' => $email
		  	);
			$customer = $openpay->customers->add($customerData);
			$openpay_cliente_id = $customer->id;
			update_user_meta($user_id, "openpay_id", $openpay_cliente_id);
	    }

		$customer = $openpay->customers->get($openpay_cliente_id);

		$due_date = date('Y-m-d\TH:i:s', strtotime('+ 48 hours'));

		$chargeRequest = array(
		    'method' => 'store',
		    'amount' => (float) $CARRITO["total"],
		    'description' => 'Tienda',
		    'order_id' => $order_id,
		    'due_date' => $due_date
		);
	
		$charge = $customer->charges->create($chargeRequest);

		$_POST["error"] = "";

		$CARRITO["PDF"] = $dataOpenpay["OPENPAY_URL"]."/paynet-pdf/".$dataOpenpay["MERCHANT_ID"]."/".$charge->payment_method->reference;

	} catch (Exception $e) {
    	$error_code = $e->getErrorCode();
    	$error_info = $e->getDescription();

    	$_POST["error"] = array(
    		"codigo" => $error_code,
    		"info" => $error_info
    	);
    }


	$_productos = $wpdb->get_results("SELECT * FROM productos");
	$productos = array();
	foreach ($_productos as $key => $value) {
		$productos[ $value->id ] = $value;
	}

	$suscripciones = "";
	foreach ($CARRITO["productos"] as $key => $value) {
		if( isset($value->edad) ){
			$suscripciones .= "
				<div style='font-weight: normal;'>
					<strong>".$productos[ $value->producto ]->nombre." : </strong>".$productos[ $value->producto ]->descripcion." ".$value->edad.", ".$value->tamano.", ".$value->peso.", ".$value->plan."
				</div>
				
			";
		}
	}

?>
<!-- Fase #6 Pagos -->
<section data-fase="6" class="container">

	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden; margin-top: 3%;">
		<aside class="col-md-12 text-center">
			<h1 style="font-size: 40px; font-weight: bold; color: #04b804; margin-bottom: 5%;" class="postone text-felicidades">¡Felicidades!</h1>
			<h4 style="color:#000; font-weight: bold; margin-bottom: 5%" class="gothan text-suscripcionexitosa">Tu suscripción a Nutriheroes ha sido un éxito</h4>
		</aside>
		<aside class="col-md-8 col-md-offset-2 text-left">
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan" style="font-size: 18px;">TU SUSCRIPCIÓN:</div>				
			</div>
			<div class="col-xs-12 col-md-12 desc_value gothanligth" style="font-size: 18px;">
					<?php echo $suscripciones; ?>
				</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 desc_name gothan text-tususcripcion" style="font-size: 18px;  margin-top: 5%;">TOTAL SUSCRIPCIÓN:</div>				
			</div>
			<div class="col-xs-12 col-md-12 desc_value gothan" style="font-size: 18px; font-weight: bold;">
					<?php 
						echo "$".number_format($CARRITO["total"], 2, ',', '.');
					?>
				</div>
		</aside>
		<aside class="col-md-12">
	      	<a href="<?php echo $CARRITO["PDF"]; ?>" target="_blank" class="btn btn-sm-kmibox1" style="padding: 10px 10px 10px 10px;margin-left: -6%;font-size: 12px;">Instrucciones para completar el pago</a>
		</aside>
		<aside class="col-md-12">
	      	<a href="<?php echo get_home_url(); ?>/perfil/" class="btn btn-sm-kmibox text-btnperfil" style="padding: 10px 20px 10px 20px; font-size: 12px;  margin-left: -6%">IR A MI PERFIL</a>
		</aside>
	</article>

</section>

<?php
	unset($_SESSION["CARRITO"]);
?>

