<?php
	include '../wp-load.php';

	extract($_GET);

	switch ($tipo_pago) {
		case '1':
			crearCobro($order_id, $pago_id);
		break;
		case '2':
			$time = strtotime("+1 day");
			crearNewCobro($order_id, $pago_id);
		break;
	}

?>