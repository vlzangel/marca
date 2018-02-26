<?php

	global $CARRITO;
	global $wpdb;

 	include_once(dirname(dirname(dirname(__DIR__)))."/lib/openpay/Openpay.php");

 	$order_id = time();
    $CARRITO = unserialize( $_SESSION["CARRITO"] );
    if( !isset($CARRITO["orden_id"]) ){
 		$order_id = crearPedido("Tienda");
 		$CARRITO["orden_id"] = $order_id;
 		$_SESSION["CARRITO"] = serialize($CARRITO);
    }else{
 		$order_id = $CARRITO["orden_id"];
    }

 	$dataOpenpay = dataOpenpay();

 	try {
	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
	 	Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

	 	if( isset($CARRITO['user_id']) || $CARRITO['user_id'] > 0 ){
	 		$user_id = $CARRITO['user_id'];
	 	}else{
		 	$current_user = wp_get_current_user();
		    $user_id = $current_user->ID;	 		
	 	}

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
		    'order_id' => $orden_id."_CobroInicial_".time(),
		    'due_date' => $due_date
		);
	
		$charge = $customer->charges->create($chargeRequest);

		$_POST["error"] = "";

		$CARRITO["PDF"] = $dataOpenpay["OPENPAY_URL"]."/paynet-pdf/".$dataOpenpay["MERCHANT_ID"]."/".$charge->payment_method->reference;
		$_POST['order'] = $order_id;
		$HTML = generarEmail(
	    	"compra/nuevo/tienda", 
	    	array(
	    		"USUARIO" => $nombre,
	    		"INSTRUCCIONES" => $CARRITO["PDF"],
	    		"TOTAL" => number_format( $CARRITO["total"], 2, ',', '.'),
	    		"FECHA_SUSCRIPCION" => date('d')
	    	)
	    );
		$_POST['EMAIL_NUEVA_COMPRA'] = $HTML;

	    wp_mail( $email, "Pago en Tienda - NutriHeroes", $HTML );
	    mail_admin_nutriheroes( "Pago en Tienda - NutriHeroes", $HTML );

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
			
			$_descripcionPlan = $wpdb->get_results("SELECT descripcion_mes FROM planes WHERE plan ='".$value->plan."'");
	        foreach ($_descripcionPlan as $descplan) {
	        	$planDes = $descplan->descripcion_mes;
	        }
	       
	        if($planDes =='Sólo por esta vez'){
	        	$msjMovil ="El cobro de tu suscripción será <label style='font-family: GothanMedium_regular; text-transform:uppercase;''>".$planDes."</label>";
	        	$msjPc ="El cobro de tu suscripción será <label class='periodicidad' style='font-family: GothanMedium_regular; text-transform:uppercase;'>".$planDes."</label>";
	        }else{
	         	$msjMovil ="Tu asesor nutricional te contactará una semana antes de que venza tu suscripción. Adicionalmente, se hará un envío de tu orden de pago  <label style='font-family: GothanMedium_regular; text-transform:uppercase;'>".$planDes."</label> de manera automática los días ".(date("d")+0)." por el cobro de tu alimento, el cual será enviado una vez sea aprobado el pago.";
	         	$msjPc ="Tu asesor nutricional te contactará una semana antes de que venza tu suscripción. Adicionalmente, se hará un envío de tu orden de pago <label class='periodicidad' style='font-family: GothanMedium_regular; text-transform:uppercase;'>".$planDes."</label> de manera automática los días ".(date("d")+0)." por el cobro de tu alimento, el cual será enviado una vez sea aprobado el pago.";
	       	}

			$suscripciones .= "
				<tr>
					<td>
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
							<div>".$msjMovil."</div>
						</div>
					</td>
					<td class='info solo_pc' style='min-width: 200px;'>
						<div>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
					</td>
					<td class='solo_pc'>
						<div>".$msjPc."</div>
					</td>
					<td class='solo_pc' style='font-family: GothanMedium_regular;'>".$value->tamano." - ".$value->edad."</td>
				</tr>
			";
		}
	}
/*
	foreach ($CARRITO["productos"] as $key => $value) {
		$data = unserialize( $productos[ $value->producto ]->dataextra );
		if( isset($value->edad) ){

			$suscripciones .= "
				<tr>
					<td>
						<img src='".TEMA()."/imgs/productos/".$data["img"]."' />
						<div>
							<div class='info_2'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
						<div class='info_3 solo_movil'>
							".$msjMovil."
							<div>".$value->tamano." - ".$value->edad."</div>
						</div>
					</td>
					<td class='solo_pc'>
						<div style='font-weight: 400; font-family: Gothamlight_Regular;'>".$msjPc.".</div>
					</td>
					<td class='solo_pc'>".$value->tamano." - ".$value->edad."</td>
				</tr>
			";
		}
	}*/
	$suscripciones .= "</table>";

?>

<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css?ver=".time(); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/responsive/pagos.css?ver=".time(); ?>">

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
	      	<a href="<?php echo $CARRITO["PDF"]; ?>" target="_blank" class="btn btn-sm-kmibox" style="padding: 10px 30px; margin:0 auto; font-size: 12px;">INSTRUCCIONES PARA COMPLETAR EL PAGO</a>
		</aside>
		<aside class="col-md-12  text-center" id="content-profile">
	      	<a href="<?php echo get_home_url(); ?>/perfil/" class="btn btn-sm-kmibox text-btnperfil" style="padding: 10px 30px; font-size: 12px;  margin: 0 auto; margin-top:10px!important;">IR A MI PERFIL</a>
		</aside>
	</article>

</section>

<?php
	unset($_SESSION["CARRITO"]);
?>

