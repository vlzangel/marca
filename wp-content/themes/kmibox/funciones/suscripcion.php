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
				"descripcion" => $producto->descripcion,
				"tamanos" => unserialize($producto->tamanos),
				"edades" => unserialize($producto->edades),
				"precio" => $producto->precio,
				"existencia" => $producto->existencia,
				"peso" => $producto->peso,
				"marca" => $producto->marca,
				"tipo" => $producto->tipo_mascota,
				"planes" => unserialize($producto->planes),
				"dataextra" => unserialize($producto->dataextra)
			);
		}
		return $productos;
	}

	function get_marcas(){
		global $wpdb;
		$_marcas = $wpdb->get_results("SELECT * FROM marcas");
		$marcas = array();
		foreach ($_marcas as $marca) {
			$marcas[$marca->id] = array(
				"nombre" => $marca->nombre,
				"img" => TEMA()."/imgs/marcas/".$marca->img,
				"tipo" => $marca->tipo
			);
		}
		return $marcas;
	}

	function get_planes(){
		global $wpdb;
		$_plans = $wpdb->get_results("SELECT * FROM planes WHERE status = 'Activo' ");
		$plans = array();
		foreach ($_plans as $plan) {
			$plans[$plan->id] = array(
				"nombre" => $plan->plan,
				"meses" => $plan->meses,
				"descripcion_mes" => $plan->descripcion_mes
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

	function aplicarDescuentos(){
		global $wpdb;
		if( !isset($_SESSION) ){ session_start(); }
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
		$CARRITO = unserialize( $_SESSION["CARRITO"] );
		foreach ($CARRITO["descuentos"] as $descuento) {
			$cupon = $wpdb->get_row("SELECT * FROM cupones WHERE nombre = '{$descuento[0]}'");
			if( $cupon->usos == "" ){ 
				$cupon->usos = array();
			}else{
				$cupon->usos = unserialize($cupon->usos);
			}
			$cupon->usos[] = array($user_id, $descuento[1]);
			$cupon->usos = serialize($cupon->usos);
			$wpdb->query( "UPDATE cupones SET usos = '{$cupon->usos}' WHERE nombre = '{$descuento[0]}';" );
		}
	}

	function crearPedido($tipo = "Tarjeta"){
		setZonaHoraria();
		if( !isset($_SESSION) ){ session_start(); }
		$CARRITO = unserialize( $_SESSION["CARRITO"] );
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $hoy = date("Y-m-d H:i:s", time() );
	    $metaData = array();
	    $metaData["tipo_pago"] = $tipo;
	    if( isset($_SESSION["MODIFICACION"]) ){
			$metaData["es_modificacion_de"] = $_SESSION["MODIFICACION"];
	    }
	    unset($_SESSION["MODIFICACION"]);

	    // Buscar asesor de registro
	    $asesor = get_user_meta( $user_id, 'asesor_registro', true );
		$asesor_id = ( $asesor > 0 )? $asesor : 0 ;

	 	$SQL_PEDIDO = "
	 		INSERT INTO ordenes VALUES (
	 			NULL,
	 			'{$user_id}',
	 			'{$CARRITO["cantidad"]}',
	 			'{$CARRITO["total"]}',
		 		'{$hoy}',
		 		'Pendiente',
		 		'".serialize($metaData)."',
		 		".$asesor_id."
	 		)
	 	";
	 	$wpdb->query( $SQL_PEDIDO );
	 	$orden_id = $wpdb->insert_id;

	 	foreach ($CARRITO["productos"] as $producto) {
	 		if( $producto->producto != "" ){
	 			$data = array(
	 				"tamano" => $producto->tamano,
	 				"edad" => $producto->edad,
	 				"plan" => $producto->plan
	 			);
	 			$data = serialize($data);
			 	$SQL_SUB_PEDIDO = "
			 		INSERT INTO items_ordenes VALUES (
			 			NULL,
			 			'{$orden_id}',
			 			'{$producto->producto}',
			 			'{$producto->cantidad}',
			 			'{$data}',
			 			'{$producto->subtotal}',
			 			'{$hoy}',
			 			'{$producto->plan_id}'
			 		)
			 	";

			 	$wpdb->query( $SQL_SUB_PEDIDO );
	 		}
	 	}
	    aplicarDescuentos();

	 	return $orden_id;
	}

	function crearCobro($orden_id, $pago_id){

    	setZonaHoraria();
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
		global $wpdb;

		$orden = $wpdb->get_row( "SELECT * FROM ordenes WHERE id = {$orden_id};" );

		$wpdb->query( "UPDATE ordenes SET status = 'Activa' WHERE id = {$orden_id};" );
		$metaData = deserializar($orden->metadata);

		if( isset($metaData["es_modificacion_de"]) ){

			$orden_vieja = $wpdb->get_row( "SELECT * FROM ordenes WHERE id = {$metaData["es_modificacion_de"]};" );
			$metaData_vieja = deserializar($orden_vieja->metadata);
			$metaData_vieja["modificada_por"] = $orden_id;
			$metaData_vieja = serialize($metaData_vieja);

			$wpdb->query( "UPDATE ordenes SET status = 'Modificada', metadata = '{$metaData_vieja}' WHERE id = {$metaData["es_modificacion_de"]};" );
			
			$email = $wpdb->get_var("SELECT user_email FROM wp_users WHERE ID = {$user_id}");
			$_name = $nombre = get_user_meta($user_id, "first_name", true)." ".get_user_meta($user_id, "last_name", true);

		    $total = $wpdb->get_var("SELECT total FROM ordenes WHERE id = {$orden_id}");
		    $_productos = getProductosDesglose($orden_id);
			$productos = "";
		 	foreach ($_productos as $producto) {
		 		if( $producto != "" ){
			 		$temp = getTemplate("/compra/envio/partes/producto");
			 		$temp = str_replace("[IMG_PRODUCTO]", $producto["img"], $temp);
			 		$temp = str_replace("[NOMBRE]", $producto["nombre"], $temp);
			 		$temp = str_replace("[DESCRIPCION]", $producto["descripcion"], $temp);
			 		$temp = str_replace("[PLAN]", $producto["plan"], $temp);
			 		$temp = str_replace("[CANTIDAD]", $producto["cantidad"], $temp);
			 		$temp = str_replace("[PRECIO]", number_format($producto["precio"], 2, ',', '.'), $temp);
			 		$productos .= $temp;
			 	}
		 	}
		 	$HTML = generarEmail(
		    	"suscripciones/modificacion", 
		    	array(
		    		"USUARIO" => $_name,
		    		"PRODUCTOS" => $productos,
		    		"TOTAL" => number_format($total, 2, ',', '.'),
		    	)
		    );

		 	wp_mail( $email, "Suscripción Modificada Exitosamente - NutriHeroes", $HTML );
		 	
		}

		$items = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id_orden = {$orden_id}");
    	foreach ($items as $key => $item) {
    		$SQL = "INSERT INTO cobros VALUES (NULL, {$item->id}, NOW(), '{$pago_id}', 'Pagado', NOW(), '' );";    		
    		$wpdb->query( $SQL ); 
    		$hoy = date("d", time() );
    		$meses = $wpdb->get_var("SELECT meses FROM planes WHERE id = {$item->plan}");

    		// $proximo_cobro = date("Y-m-d", strtotime("+".$meses." month"));

    		$proximo_cobro = date("Y-m-d", strtotime( date("Y-m-d")." +".$meses." day") );

    		$SQL = "INSERT INTO cobros VALUES (NULL, {$item->id}, '{$proximo_cobro}', '---', 'Pendiente', NOW(), '' );";
			$wpdb->query( $SQL ); 

    		for ($i=0; $i < $meses; $i++) { 
    			// if( $i == 0 ){ $mes_actual = date("Y-m", time() )."-".$hoy; }else{ $mes_actual = date("Y-m", strtotime("+".$i." month") )."-".$hoy; }
    			if( $i == 0 ){ $mes_actual = date("Y-m-d", time() ); }else{ $mes_actual = date("Y-m-d", strtotime("+".$i." day") ); }
    			$SQL = "INSERT INTO despachos VALUES (NULL, {$user_id}, {$orden_id}, {$item->id}, '{$mes_actual}', 'Pendiente', '', NOW(), NULL, 0 );";
    			$wpdb->query( $SQL );
    		}
    	}

	}



	function crearNewCobro($orden_id, $_time_hoy){
    	setZonaHoraria();
		global $wpdb;

		$items = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id = {$orden_id}");
    	foreach ($items as $key => $item) {

    		$hoy = date("d", $_time_hoy );
    		$meses = $wpdb->get_var("SELECT meses FROM planes WHERE id = {$item->plan}");

    		// $proximo_cobro = date("Y-m-d", strtotime("+".$meses." month"));
    		$proximo_cobro = date("Y-m-d", strtotime( date("Y-m-d", $_time_hoy)." +".$meses." day") );

    		$SQL = "INSERT INTO cobros VALUES (NULL, {$item->id}, '{$proximo_cobro}', '---', 'Pendiente', NOW(), '' );";
			$wpdb->query( $SQL );

    		for ($i=0; $i < $meses; $i++) { 
    			// if( $i == 0 ){ $mes_actual = date("Y-m", time() )."-".$hoy; }else{ $mes_actual = date("Y-m", strtotime("+".$i." month") )."-".$hoy; }
    			if( $i == 0 ){ $mes_actual = date("Y-m-d", $_time_hoy ); }else{ $mes_actual = date("Y-m-d", strtotime("+".$i." day", $_time_hoy) ); }
    			$SQL = "INSERT INTO despachos VALUES (NULL, {$user_id}, {$orden_id}, {$item->id}, '{$mes_actual}', 'Pendiente', '', NOW(), NULL, 0 );";
    			$wpdb->query( $SQL );
    		}
    	}
	}

	function getOrdenes(){
    	setZonaHoraria();
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
		$ordenes = $wpdb->get_results("SELECT * FROM ordenes WHERE cliente = '{$user_id}' AND status in ( 'Activa', 'Pendiente' ) ORDER BY id DESC");

		return $ordenes;
	}

	function getSuscripciones(){
    	setZonaHoraria();
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $suscripciones = array();
		$ordenes = $wpdb->get_results("SELECT * FROM ordenes WHERE cliente = '{$user_id}' AND  status in ( 'Activa', 'Pendiente' ) ");
		foreach ($ordenes as $orden) {
			$planes = $wpdb->get_results("SELECT * FROM items_ordenes WHERE  id_orden = ".$orden->id);
			$suscripciones[ $orden->id ]["cantidad"] = $orden->cantidad;
			foreach ($planes as $plan) {
				$data = unserialize($plan->data);
				$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id=".$plan->id_producto );
				$_data = unserialize( $producto->dataextra );
				$img = TEMA()."/imgs/productos/".$_data["img"];
				$anio = date("Y")."-12-31";
				$entregas = $wpdb->get_results("SELECT * FROM despachos WHERE sub_orden = {$plan->id} AND status = 'Recibida' AND mes <= '{$anio}'");
				$_entregas = array();
				foreach ($entregas as $value) {
					$mes = date( "m", strtotime($value->mes) );
					$_entregas[] = $mes;
				}
				$_entregados_str = "-";
				if( count($_entregas) > 0 ){
					$_entregados_str = implode(",", $_entregas);
				}
				$estatus = ( $orden->status == 'Pendiente' )? 'Por Pagar': $orden->status;
				$suscripciones[ $orden->id ]["productos"][] = array(
					"orden" => $plan->id,
					"plan" => $data["plan"],
					"producto" => $plan->id_producto,
					"cantidad" => $plan->cantidad,
					"total" => $plan->total,
					"nombre" => $producto->nombre,
					"img" => $img,
					"status" => $estatus,
					"entrega" => date("d/m/Y", strtotime($plan->fecha_entrega)),
					"entredagos" => $_entregados_str
				);
			}
		}

		return $suscripciones;
	}

	function getDespachosActivos(){
    	setZonaHoraria();
    	$mes_actual = date("Y-m", time())."-01";
		$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";
		global $wpdb;
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;
	    $suscripciones = array();
		$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE cliente = {$user_id} AND ( mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' ) ORDER BY id DESC");
		foreach ($despachos as $despacho) {
			$status_orden = $wpdb->get_var( "SELECT status FROM ordenes WHERE id=".$despacho->orden );
			if( $status_orden != "Modificada" ){
				$sub_orden = $wpdb->get_row( "SELECT * FROM items_ordenes WHERE id=".$despacho->sub_orden );
				$producto = $wpdb->get_row( "SELECT * FROM productos WHERE id=".$sub_orden->id_producto );
				$_data = unserialize( $producto->dataextra );
				$img = TEMA()."/imgs/productos/".$_data["img"];
				$_despachos[] = array(
					"orden" => $sub_orden->id,
					"nombre" => $producto->nombre,
					"img" => $img,
					"status" => $despacho->status
				);
			}
		}
		return $_despachos;
	}



	function getProductosDesglose($id_orden){
		global $wpdb;
		$_planes = get_planes();
	    $_productos = array();
	    $ordenes = $wpdb->get_results("SELECT * FROM items_ordenes WHERE id_orden = {$id_orden}");
	    foreach ($ordenes as $sub_orden) {
	    	$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = ".$sub_orden->id_producto);
    		$dataextra = unserialize($producto->dataextra);
    		$_productos[ $sub_orden->id_producto ] = array(
    			"nombre" => $producto->nombre,
    			"descripcion" => $producto->descripcion,
    			"plan" => $_planes[ $sub_orden->plan ]["nombre"],
    			"precio" => $producto->precio,
    			"img" => TEMA()."/imgs/productos/".$dataextra["img"],
    			"cantidad" => $sub_orden->cantidad
	    	);
	    }
		return $_productos;
	}

?>