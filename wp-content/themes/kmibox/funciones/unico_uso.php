<?php
	
	function get_data_plan($valor, $plan){
		$unidad = "week";
		$cantidad = 2;
		switch ( $plan ) {
			case 'Mensual':
				$plan = 2;
				$unidad = "month";
				$cantidad = 1;
			break;
			
			case 'Bimestral':
				$plan = 4;
				$unidad = "month";
				$cantidad = 2;
			break;
			
			default:
				$plan = 1;
			break;
		}

		return array(
			"cantidad" => $cantidad,
			"unidad" => $unidad,
			"precio" => ($valor*$plan)
		);
	}
	
	function get_name_slug($name){
		$name = strtolower($name);
		$name = str_replace(" ", "_", $name);
		return $name;
	}

	function crearPlanes(){

		global $wpdb;

		$data_openpay = dataOpenpay();
		$openpay = Openpay::getInstance($data_openpay["MERCHANT_ID"], $data_openpay["OPENPAY_KEY_SECRET"]);

		$PLANES = array();
		$PRODUCTOS = get_productos();

		foreach ($PRODUCTOS as $producto_key => $producto) {

			foreach ($producto["presentaciones"] as $presentacion_key => $presentacion_valor) {

				foreach ($producto["planes"] as $plan_key => $plan) {

					$nombre = get_name_slug( $producto["nombre"] )."_".$presentacion_key."_".get_name_slug( $plan_key );
					$data = get_data_plan($presentacion_valor, $plan_key);

					$planDataRequest = array(
					    'amount' => $data["precio"],
					    'status_after_retry' => 'unpaid',
					    'retry_times' => 2,
					    'name' => $nombre,
					    'repeat_unit' => $data["unidad"],
					    'trial_days' => '0',
					    'repeat_every' => $data["cantidad"],
					    'currency' => 'MXN'
					);

					$PLANES[] = $planDataRequest;

				}
			}
		}

		echo "<pre>";
			print_r($PLANES);
		echo "</pre>";

		foreach ($PLANES as $_plan) {
			if( get_plan($_plan["name"]) === false ){
				$plan = $openpay->plans->add($_plan);
				$wpdb->query("INSERT iNTO plan VALUES (NULL, '{$_plan["name"]}', '{$plan->id}', 'Activo' )");
			}
		}

		return $PLANES;
		
	}
	//crearPlanes();

	function delete_plan($plan_id){
		try{
			$data_openpay = dataOpenpay();
			$openpay = Openpay::getInstance($data_openpay["MERCHANT_ID"], $data_openpay["OPENPAY_KEY_SECRET"]);
			$plan = $openpay->plans->get($plan_id);
			$plan->delete();
		} catch (Exception $e) {
        	echo "<pre>";
				print_r( $e->getErrorCode() );
			echo "</pre>";
        }
	}

	function cargarTablaProductos(){
		$tamanos = array(
			"Pequeño" => 1,
			"Mediano" => 1,
			"Grande" => 1
		);

		$edad = array(
			"Cachorro" => 1,
			"Adulto" => 1,
			"Maduro" => 1
		);

		$presentaciones = array(
			"900g" => 500,
			"2000g" => 500,
			"4000g" => 500
		);

		$planes = array(
			"Quincenal" => 1,
			"Mensual" => 1,
			"Bimestral" => 1
		);

		$imgs = array(
			"9" => "NUPEC.png",
			"22" => "dow-chow.png",
			"164" => "Tier-holistic.png",
			"173" => "Royal-canin.png",
			"188" => "Belenes-max.png"
		);

		global $wpdb;

		$productos = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'product' AND post_status = 'publish' ");

		$base = 500;
		$contador = 100;

		echo "<pre>";

			foreach ($productos as $key => $producto) {
				$extras = array(
					"img" => $imgs[$producto->ID]
				);
				$presentaciones = array(
					"900g" => $base+$contador,
					"2000g" => $base+$contador,
					"4000g" => $base+$contador
				);
				$sql = "
					INSERT INTO productos VALUES (
						NULL, 
						'".strtolower($producto->post_title)."', 
						'".serialize($tamanos)."', 
						'".serialize($edad)."', 
						'".serialize($presentaciones)."', 
						'".serialize($planes)."', 
						'".serialize($extras)."',
						'activo'
					);
				";

				$wpdb->query($sql);

				$contador += 100;
			}
			
		echo "</pre>";
	}
?>