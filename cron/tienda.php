<?php
	include '../wp-load.php';

	global $wpdb;

	$ordenes_pendientes = $wpdb->get_results("SELECT * FROM ordenes WHERE status = 'Pendiente' AND metadata LIKE '%Tienda%' ");
	
	if( count($ordenes_pendientes) > 0){

		$ordenes = array();
		foreach ($ordenes_pendientes as $f) {
			$ordenes[] = $f->id;
		}

		$dataOpenpay = dataOpenpay();

	 	$openpay = Openpay::getInstance($dataOpenpay["MERCHANT_ID"], $dataOpenpay["OPENPAY_KEY_SECRET"]);
		Openpay::setProductionMode( $dataOpenpay["OPENPAY_PRUEBAS"] == 1 );
		
		$findDataRequest = array(
		    'creation[gte]' => $limite,
		    'offset' => 0,
		    'limit' => 10000
	    );

		$chargeList = $openpay->charges->getList($findDataRequest);

		$retornos = array();
		foreach ($chargeList as $key => $value) {
			$temp = explode("_", $value->order_id);
			$order_id = $temp[0];

			if( in_array($order_id, $ordenes) ){

				if( $value->status == "in_progress" && ( $hoy > strtotime($value->due_date) ) ){
					$value->status = "cancelled";
				}

				switch ($value->status) {

					case 'cancelled':
						
						$orden = $wpdb->get_row("SELECT * FROM ordenes WHERE id = {$order_id}");
						$data = unserialize( $orden->metadata );
						$data["error"] = "Pago en tienda vencido";
						$data = serialize($data);
						$wpdb->query("UPDATE ordenes SET metadata = '{$data}' WHERE id = {$order_id};");

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
		}


	}

?>