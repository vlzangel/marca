<?php
	include '../wp-load.php';

    date_default_timezone_set('America/Mexico_City');
    $limite = date("Y-m-d", strtotime("-30 day"));

	global $wpdb;

	$ordenes_pendientes = $wpdb->get_results("SELECT * FROM ordenes WHERE status = 'Pendiente' AND metadata LIKE '%Tienda%' ");

	
	/*
	$transacciones = array(
		215 => array(
			"transac" => "trvypwo3saz57clabpha",
			"cliente" => "ahnqlspdvxnl5pteefov"
		),
		217 => array(
			"transac" => "trslcrug2t4awloslh8p",
			"cliente" => "aqc16jxhuzajkew6kfyp"
		)
	);


	$dataOpenpay = dataOpenpay();

 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
	Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] != 1 );

	foreach ( $transacciones as $order_id => $transaccion ) {

		$customer = $openpay->customers->get( $transaccion["cliente"] );
		$value = $customer->charges->get( $transaccion["transac"] );

		$hoy = time();

		if( $value->status == "in_progress" && ( $hoy > strtotime($value->due_date) ) ){
			$value->status = "cancelled";
		}

		echo "Status: ".$value->status."<br>";

		switch ($value->status) {

			case 'cancelled':
				
				$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$order_id}");
				$data = unserialize( $orden->metadata );
				$data["error"] = "Pago en tienda vencido";
				$data = serialize($data);
				$wpdb->query("UPDATE ordenes SET status = 'Cancelada', metadata = '{$data}' WHERE id = {$order_id};");

			break;

			case 'completed':
				
				$tipo_pago = 1;
				if( isset($temp[1]) ){
					if( $temp[1] == "CobroSuscripcion" ){
						$tipo_pago = 2;
					}
				}

				switch ($tipo_pago) {
					case '1':
						crearCobro($order_id, $value->id);
					break;
					case '2':
						$time = strtotime("+1 day");
						crearNewCobro($order_id, $time);
					break;
				}
				

			break;
		
		}

	}

	*/

?>