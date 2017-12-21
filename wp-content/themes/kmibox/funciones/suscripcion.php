<?php
	
	include( dirname(__DIR__)."/lib/openpay/Openpay.php" );

	function dataOpenpay(){
		$OPENPAY_PRUEBAS = 1;

		$OPENPAY_URL = ( $OPENPAY_PRUEBAS == 1 ) ? "https://sandbox-dashboard.openpay.mx" : "https://dashboard.openpay.mx";
		
		$MERCHANT_ID = "mbagfbv0xahlop5kxrui";
		$OPENPAY_KEY_SECRET = "sk_b485a174f8d34df3b52e05c7a9d8cb22";
		$OPENPAY_KEY_PUBLIC = "pk_dacadd3820984bf494e0f5c08f361022";
		
		if( $OPENPAY_PRUEBAS == 1 ){
			$MERCHANT_ID = "mej4n9f1fsisxcpiyfsz";
			$OPENPAY_KEY_SECRET = "sk_684a7f8598784911a42ce52fb9df936f";
			$OPENPAY_KEY_PUBLIC = "pk_3b4f570da912439fab89303ab9f787a1";
		}

		return array(
			"OPENPAY_PRUEBAS" => $OPENPAY_PRUEBAS,
			"OPENPAY_URL" => $OPENPAY_URL,
			"MERCHANT_ID" => $MERCHANT_ID,
			"OPENPAY_KEY_SECRET" => $OPENPAY_KEY_SECRET,
			"OPENPAY_KEY_PUBLIC" => $OPENPAY_KEY_PUBLIC
		);
	}

	function get_productos(){
		global $wpdb;

		$_productos = $wpdb->get_results("SELECT * FROM productos WHERE status = 'activo' ");
		$productos = array();
		foreach ($_productos as $producto) {
			$productos[$producto->id] = array(
				"nombre" => $producto->nombre,
				"tamanos" => unserialize($producto->tamanos),
				"edades" => unserialize($producto->edades),
				"presentaciones" => unserialize($producto->presentaciones),
				"planes" => unserialize($producto->planes),
				"dataextra" => unserialize($producto->dataextra)
			);
		}

		return $productos;
	}

	function get_planes(){
		global $wpdb;

		$_plans = $wpdb->get_results("SELECT * FROM plan WHERE status = 'activo' ");
		$plans = array();
		foreach ($_plans as $plan) {
			$plans[$plan->nombre] = array(
				"openpay_id" => $plan->openpay_id
			);
		}

		return $plans;
	}
	
	function get_plan($nombre){
		global $wpdb;
		$plan = $wpdb->get_var("SELECT id FROM plan WHERE nombre = '{$nombre}'");
		if( $plan != null ){
			return $plan;
		}else{
			return false;
		}
	}

	function crearPedido(){
		date_default_timezone_set('America/Mexico_City');
		if( !isset($_SESSION) ){ session_start(); }
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $CARRITO = unserialize( $_SESSION["CARRITO"] );
	    $hoy = date("Y-m-d H:i:s", time() );
	 	$SQL_PERDIDO = "
	 		INSERT INTO ordenes VALUES (
	 			NULL,
	 			'{$user_id}',
	 			'{$CARRITO["cantidad"]}',
	 			'{$CARRITO["total"]}',
	 			'Activo',
		 		'{$hoy}'
	 		)
	 	";
	 	$wpdb->query( $SQL_PERDIDO );
	 	$orden_id = $wpdb->insert_id;
	 	foreach ($CARRITO["productos"] as $producto) {
	 		for ($i=0; $i < $producto->cantidad; $i++) { 
		 		if( $producto->producto != "" ){

		 			$data = array(
		 				"tamano" => $producto->tamano,
		 				"edad" => $producto->edad,
		 				"presentacion" => $producto->presentacion,
		 				"plan" => $producto->plan
		 			);

		 			$data = serialize($data);

				 	$SQL_PERDIDO = "
				 		INSERT INTO items_ordenes VALUES (
				 			NULL,
				 			'{$orden_id}',
				 			'{$producto->producto}',
				 			'{$data}',
				 			'En espera',
				 			'{$producto->subtotal}',
				 			'{$hoy}',
				 			'{$producto->plan_id}',
				 			''
				 		)
				 	";
				 	$wpdb->query( $SQL_PERDIDO );
		 		}
	 		}
	 	}
	 	return $orden_id;
	}

	function getSuscripciones(){
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $suscripciones = array();
		$ordenes = $wpdb->get_results("SELECT * FROM ordenes WHERE status_suscripcion = 'Activo' AND cliente = ".$user_id);
		foreach ($ordenes as $orden) {
			$planes = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id_orden = ".$orden->id);
			$suscripciones[ $orden->id ]["cantidad"] = $orden->cantidad;
			foreach ($planes as $plan) {

				$data = unserialize($plan->data);

				$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id=".$plan->id_producto );
				$_data = unserialize( $producto->dataextra );
				$img = TEMA()."/productos/imgs/".$_data["img"];

				$suscripciones[ $orden->id ]["productos"][] = array(
					"orden" => $plan->id,
					"plan" => $data["plan"],
					"producto" => $plan->id_producto,
					"total" => $plan->total,
					"nombre" => $producto->nombre,
					"img" => $img,
					"presentacion" => $data["presentacion"],
					"status" => $plan->status_envio,
					"entrega" => date("d/m/Y", strtotime($plan->fecha_entrega))
				);
			}
		}

/*		echo "<pre>";
			print_r($suscripciones);
		echo "</pre>";*/

		return $suscripciones;
	}

?>