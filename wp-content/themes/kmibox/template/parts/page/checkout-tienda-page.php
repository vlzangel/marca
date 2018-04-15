<?php

	global $CARRITO;
	global $wpdb;
	$dir = dirname(dirname(dirname(__DIR__)));
 	include_once($dir."/funciones/suscripcion.php");

 	$order_id = time();
    $CARRITO = unserialize( $_SESSION["CARRITO"] );
    if( !isset($CARRITO["orden_id"]) ){
 		$order_id = crearPedido("Tienda");
 		$CARRITO["orden_id"] = $order_id;
 		$_SESSION["CARRITO"] = serialize($CARRITO);
    }else{
 		$order_id = $CARRITO["orden_id"];
    }

    if( $_SESSION['admin_sub_login'] != "YES" ){
    	
		$due_date = date('Y-m-d\TH:i:s', strtotime('+ 5 day'));

	 	$payment_gateway = get_payment_gateway();	
	    switch( strtolower( $payment_gateway ) ){
	    	case "openpay":
    		 	include_once($dir . "/procesos/compra/pasarelas/openpay/tienda.php");
		    	break;
	    	case "payu":
    		 	include_once($dir . "/procesos/compra/pasarelas/payu/tienda.php");
		    	break;
		    default:
				crearCobro( $order_id, time() );
				break;
	    }	 	

	    if( $_POST["error"] == "" ){	    	
			$_productos = getProductosDesglose($order_id);
			$dia_de_cobro = end( explode("-", $wpdb->get_var("SELECT fecha_creacion FROM ordenes WHERE id = ".$order_id) ) );
			$productos = "";
		 	foreach ($_productos as $producto) {
		 		if( $producto != "" ){
			 		$temp = getTemplate("/compra/envio/partes/producto");
			 		$temp = str_replace("[IMG_PRODUCTO]", $producto["img"], $temp);
			 		$temp = str_replace("[NOMBRE]", $producto["nombre"], $temp);
			 		$temp = str_replace("[DESCRIPCION]", $producto["descripcion"], $temp);
			 		$temp = str_replace("[PLAN]", ' Tu asesor nutricional te contactará una semana antes de que venza tu suscripción. Adicionalmente, se hará un envío de tu orden de pago <strong>'.$producto["plan_meses"].'</strong> de manera automática los días <strong>'.$dia_de_cobro.'</strong> por el cobro de tu alimento, el cual será enviado una vez sea aprobado el pago.', $temp);
			 		$temp = str_replace("[CANTIDAD]", $producto["cantidad"], $temp);
			 		$temp = str_replace("[PRECIO]", number_format($producto["precio"], 2, ',', '.'), $temp);
			 		$productos .= $temp;
			 	}
		 	}

			$fecha = fechaCastellano ( time() );

			$HTML = generarEmail(
		    	"compra/nuevo/tienda", 
		    	array(
		    		"ID" => $order_id,
		    		"CODIGO" => $charge->payment_method->reference,
		    		"USUARIO" => $nombre,
		    		"INSTRUCCIONES" => $CARRITO["PDF"],
		    		"SUBTOTAL" => number_format( $CARRITO["total"]-($CARRITO["total"]*0.12), 2, ',', '.'),
		    		"TOTAL" => number_format( $CARRITO["total"], 2, ',', '.'),
		    		"FECHA_SUSCRIPCION" => date('d'),
		    		"FECHA_TXT" => $fecha,
	    			"PRODUCTOS" => $productos,
		    	)
		    );
			$_POST['EMAIL_NUEVA_COMPRA'] = $HTML;

		    wp_mail( $email, "Pago en Tienda - NutriHeroes", $HTML );
		    mail_admin_nutriheroes( "Pago en Tienda - NutriHeroes", $HTML );
	    }
	}else{
		crearCobro( $order_id, time() );
	} 

	?>

	<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css?ver=".time(); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/responsive/pagos.css?ver=".time(); ?>"> <?php

	if( $_POST["error"] != "" ){ ?>
		<section data-fase="6" class="container">
			<!-- Mensaje Success -->
			<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px;padding:20px;border:1px solid #ccc; overflow: hidden; margin-top: 3%;">
				<aside class="col-md-12 text-center">
					<h1 class="postone text-felicidades">¡Error!</h1>
					<h4 class="gothan text-suscripcionexitosa">Lo sentimos, pero ha ocurrido un error al generar la orden de pago.</h4>
				</aside>
				<aside class="gothanligth col-xs-12 col-md-8 col-md-offset-2">
					<h2 class="text-quedebohacer">¿QUÉ DEBO HACER AHORA?</h2>
					<ul class="text-left text-pasos" style="margin: 0px auto 15px; display: block; max-width: 500px;">
						<li>Puedes volver a intentar</li>
						<li>Si el error persiste, puedes intentar con otro m&eacute;todo de pago</li>
						<li>Tambi&eacute;n puedes contactarnos al (01) 800 056 4667, y te atenderemos de inmediato.</li>
					</ul>
				</aside>

				<aside class="col-md-12 text-center">
			      	<a href="<?php echo HOME(); ?>" class="btn btn-sm-kmibox" style="padding: 10px 30px; margin:0 auto; font-size: 12px;">INTENTAR NUEVAMENTE</a>
				</aside>
				<aside class="col-md-12  text-center" id="content-profile">
			      	<a href="<?php echo get_home_url(); ?>/pagar-mi-marca/" class="btn btn-sm-kmibox text-btnperfil" style="padding: 10px 30px; font-size: 12px;  margin: 0 auto; margin-top:10px!important;">PAGAR CON TARJETA</a>
				</aside>
			</article>

		</section> <?php
	}else{

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

		$suscripciones .= "</table>"; ?>

		<!-- Fase #6 Pagos -->
		<section data-fase="6" class="container" style="padding: 20px 15px;">

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

		</section> <?php
		unset($_SESSION["CARRITO"]);
	} 
?>

