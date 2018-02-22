<?php

	function aplicarCupon($cupon, $cupones, $total, $validar, $cliente = "", $totalDescuentos){
			
		global $wpdb;
		$db = $wpdb;

		/* Get Data */

			$sub_descuento = 0; $otros_cupones = 0;
			if( count($cupones) > 0 ){
				foreach ($cupones as $value) {
					$sub_descuento += $value[1];
					if( strpos( $value[0], "saldo" ) === false ){
						$otros_cupones++;
					}
					if( $value[2] == 1 ){
						echo json_encode(array(
							"error" => "El cupón [ {$value[0]} ] ya esta aplicado y no puede ser usado junto a otros cupones"
						));
						exit;
					}
				}
			}

			$se_uso = count($cupon->usos);

		/* Validaciones */

			if( $validar === true ){

				if( $otros_cupones > 0 && $cupon->data["uso_individual"] == 1 ){
					echo json_encode(array(
						"error" => "El cupón [ {$cupon->nombre} ] no puede ser usado junto a otros cupones"
					));
					exit;
				}

				if( count($cupones) > 0 ){
					if( ya_aplicado($cupon->nombre, $cupones) ){
						echo json_encode(array(
							"error" => "El cupón ya fue aplicado"
						));
						exit;
					}
				}

				if( $cupon->data["vence"] != "" ){
					$hoy = time();
					$expiracion = (strtotime( str_replace("/", "-", $cupon->data["vence"]) )+86399);
					if( $hoy > $expiracion ){
						echo json_encode(array(
							"error" => "El cupón ya expiro"
						));
						exit;
					}
				}

				if( $cupon->data["uso_por_usuario"]+0 > 0 ){
					if( $se_uso >= $cupon->data["uso_por_usuario"]+0 ){
						echo json_encode(array(
							"error" => "El cupón ya fue usado"
						));
						exit;
					}
				}

				if( $cupon->data["uso_por_cupon"]+0 > 0 ){
					if( $se_uso >= $cupon->data["uso_por_cupon"]+0 ){
						echo json_encode(array(
							"error" => "El cupón ya fue usado"
						));
						exit;
					}
				}
				
			}

		/* Calculo */
			$descuento = 0;
			switch ( $cupon->data["tipo"] ) {
				case 1:
					$descuento = $cupon->data["precio"];
				break;
				case 2:
					$descuento = $total*($cupon->data["precio"]/100);
				break;
			}

			$sub_descuento += $descuento;

			if( ($total-$sub_descuento) < 0 ){
				$descuento += ( $total-$sub_descuento );
			}

			$_totalDescuentos = $totalDescuentos+$descuento;

			return array(
				"cupon" => array(
					$cupon->nombre,
					$descuento,
					$cupon->data["uso_individual"]
				),
				"totalDescuentos" => $_totalDescuentos
			);
	}

    if(!function_exists('ya_aplicado')){
        function ya_aplicado($cupon, $cupones){
            foreach ($cupones as $key => $valor) {
                if( $cupon == $valor[0] ){
                    return true;
                }
            }
            return false;
        }
    }

?>