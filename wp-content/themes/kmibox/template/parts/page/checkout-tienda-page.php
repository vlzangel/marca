<?php

	global $CARRITO;
	global $wpdb;

 	include_once(dirname(dirname(dirname(__DIR__)))."/lib/openpay/Openpay.php");

 	/*$order_id = time();

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
    }*/


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
					<td>
						<img src='".TEMA()."/imgs/productos/".$data["img"]."' />
					</td>
					<td class='info'>
						<div>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
						<div class='info_3 solo_movil'>
							<div class='mayuscula'>".$value->plan."</div>
							<div>".$value->tamano." - ".$value->edad."</div>
						</div>
					</td>
					<td class='periodicidad solo_pc'>".$value->plan."</td>
					<td class='solo_pc'>".$value->tamano." - ".$value->edad."</td>
				</tr>
			";
		}
	}
	$suscripciones .= "</table>";

?>

<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css"; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/responsive/pagos.css"; ?>">

<!-- Fase #6 Pagos -->
<section data-fase="6" class="container">

	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden; margin-top: 3%;">
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
		
		<aside class="gothanligth col-xs-12 col-md-8 col-md-offset-2">
			<h2 class="text-quedebohacer">¿QUÉ DEBO HACER AHORA?</h2>
			<ul class="text-left text-pasos">
				<li>Revisa tu correo, all&iacute; encontrar&aacute;s las instrucciones para que realices t&uacute; pago en la tienda de tu preferencia.</li>
				<li>Luego de confirmar t&uacute; pago, te enviaremos un correo con la confirmaci&oacute;n de tu suscripci&oacute;n.</li>
				<li>En caso de dudas contáctanos al (01) 800 056 4667, y te atenderemos de inmediato.</li>
			</ul>
		</aside>

		<aside class="col-md-12 text-center">
	      	<a href="<?php echo $CARRITO["PDF"]; ?>" target="_blank" class="btn btn-sm-kmibox1" style="padding: 10px 30px; margin:0 auto; font-size: 12px;">Instrucciones para completar el pago</a>
		</aside>
		<aside class="col-md-12  text-center">
	      	<a href="<?php echo get_home_url(); ?>/perfil/" class="btn btn-sm-kmibox text-btnperfil" style="padding: 10px 30px; font-size: 12px;  margin: 0 auto; margin-top:10px!important;">IR A MI PERFIL</a>
		</aside>
	</article>

</section>

<?php
	//unset($_SESSION["CARRITO"]);
?>

