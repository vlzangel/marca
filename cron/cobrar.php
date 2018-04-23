<?php
	include '../wp-load.php';

	global $wpdb;

	$time = strtotime("+1 day");
	$hoy = date("Y-m-d", $time );
	$cobros = $wpdb->get_results("SELECT * FROM cobros WHERE fecha_cobro = '{$hoy}' AND status = 'Pendiente' ");

$dev[] = 'paso1';

	foreach ($cobros as $cobro) {
		$suscripcion = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = {$cobro->item_orden}");
		$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$suscripcion->id_orden}");
		$cliente = $wpdb->get_row("SELECT * FROM wp_users WHERE ID = {$orden->cliente}");
		
		// Primera suscripcion
		$primeraSuscripcion = getPrimeraSuscripcion( $suscripcion->id_orden );

$dev[] = $orden;

		// Metadata Cobro y Cupones 
		$total = $suscripcion->total;
	
		if( $primeraSuscripcion == $cobro->item_orden ){
			$data = unserialize($orden->metadata);
			$cupones = $data["cupones"];
			$descuento = 0;
			if( !empty($cupones) ){			
				foreach ($cupones as $cupon) {
					if( $cupon[3] == 1 ){
						$descuento += $cupon[1];
					}
				}
				if( $total < $descuento ){
					$descuento -= $descuento;
				}else{
					$total = 0;
				}
			}
		}

		// Nuevo registro cobro
		if( $total == 0 ){
			crearNewCobro($cobro->item_orden, $time);
			exit();
		}
		$data = unserialize( $orden->metadata );
		$error = "";

		try {

			// Openpay - Data del Cliente			
			 	/*
			 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
		 		Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );
			 	try {
					$customer = $openpay->customers->get($openpay_cliente_id);
				} catch (Exception $e) { 
		        	$error = $e->getErrorCode()." - ".$e->getDescription();
				    $data = array(
				    	"error" => $error
				    );
				    $data = serialize($data);
		        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
	        	}
				*/

			$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$suscripcion->id_producto);
			
			// parametros
				$user_id = $orden->cliente;
				$email 	= $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
				$nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);
				$_direccion = get_user_meta( $user_id, 'dir_calle', true );
				$_ciudad = get_user_meta( $user_id, 'dir_ciudad', true );
				$_estado = get_user_meta( $user_id, 'dir_estado', true );
				$_telefono  = get_user_meta( $user_id, 'telef_movil', true );
				$descripcion = "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )";
				$tipoCobro = 'CobroSuscripcion';
				$CARRITO["total"] = (float) $total;

			if( $data["tipo_pago"] == "Tarjeta" && $error == "" ){
				
				try {
					$card_id = ( isset($data["card_id"]) && !empty($data["card_id"]) )? $data["card_id"] : '' ;
$dev[] =  'paso tarjeta';
					// Agregar el cobro
					$respuesta = '';
					include_once( "../wp-content/themes/kmibox/procesos/compra/pasarelas/payu/tarjeta.php" );
$dev[]['respuesta'] = $respuesta; 					
					if( isset($respuesta["activo"]) && $respuesta["activo"] == 1  ){
						$wpdb->query("UPDATE cobros SET payu_transaccion_id = '".$respuesta['transaccion']."', status = 'Pagado' WHERE id = {$cobro->id};");
						crearNewCobro($cobro->item_orden, $time);
$dev[] =  'nuevo cobro tajeta';						
					}
				} catch (Exception $e) {
		        	$error = $e->getErrorCode()." - ".$e->getDescription();
				    $data = array(
				    	"error" => $error
				    );
				    $data = serialize($data);
		        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
$dev[] = $error;
			    }
			}

			if( $data["tipo_pago"] == "Tienda" && $error == "" ){

				$plan = $wpdb->get_var("SELECT plan FROM planes WHERE id = ".$suscripcion->plan);
				$due_date = date( 'Y-m-d\TH:i:s', strtotime('+ 48 hours', $time) );

				$chargeRequest = array(
				    'method' => 'store',
				    'amount' => (float) $suscripcion->total,
				    'description' => "Cobro de: ".$suscripcion->cantidad." - ".$producto->nombre." ( ".$producto->descripcion." )",
				    'order_id' => $suscripcion->id_orden."_CobroSuscripcion_".$time,
				    'due_date' => $due_date
				);

				include_once( "../wp-content/themes/kmibox/procesos/compra/pasarelas/payu/tienda.php" );
				if($_POST["error"]==""){

					if(isset($CARRITO["PDF"]) && !empty($CARRITO["PDF"])){
						$PDF = $CARRITO["PDF"];
						$HTML = generarEmail(
					    	"notificacion/cobro_tienda", 
					    	array(
					    		"USUARIO" => $nombre,
					    		"PLAN" => $plan,
					    		"INSTRUCCIONES" => $PDF,
					    		"TOTAL" => number_format( $total, 2, ',', '.')
					    	)
					    );

					    //wp_mail( $email, "Cobro en Tienda - NutriHeroes", $HTML );

					    $data = array(
					    	"error" => "",
					    	"pago_id" => $charge->id,
					    	"pdf" => $PDF,
					    	"vence" => $due_date
					    );
					    $data = serialize($data);

					    $wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");						
					}

				}else{
				    $data = [ 'error' => $_POST['error'] ];
				    $data = serialize($data);
		        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");					
				}
			}
			
		} catch (Exception $e) {
        	$error = $e->getErrorCode()." - ".$e->getDescription();
		    $data = array(
		    	"error" => $error
		    );
		    $data = serialize($data);
        	$wpdb->query("UPDATE cobros SET data = '{$data}' WHERE id = {$cobro->id};");
	    }

	}

	echo '<pre>';
	print_r($dev);
	echo '</pre>';
?>