<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

	include_once( dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/wp-load.php' );
    
    setZonaHoraria();
	global $wpdb;
	extract($_POST);


	$sql_carrito = "
	SELECT 
		1 as 'cantidad',
		'{$dir_edad}' as 'edad',
		p.marca,
		pl.plan,
		pl.id as plan_id,
		p.precio,
		p.id as producto,
		( p.precio * pl.meses ) as subtotal,
		'{$dir_tamano}' as tamano
	FROM productos as p
		INNER JOIN marcas as m ON m.id = p.marca 
		INNER JOIN planes as pl ON pl.id = {$dir_planes}
	WHERE
		m.tipo = {$dir_tipos}
		AND p.marca = {$dir_marcas}
	    AND p.tamanos like '%\"{$dir_tamano}\";i:1;%' 
		AND p.edades like '%\"{$dir_edad}\";i:1;%' 
	";	
	$temp_product = $wpdb->get_row($sql_carrito);
	$CARRITO = [
		"cantidad"=> 1, 
		"productos" => [
			$temp_product
		], 
		"total"=> $temp_product->subtotal
	];

	print_r($CARRITO);
exit();


	$result = [
		'code'	=>	0, 
		'orden_id'	=>	0,
	];

	// Se valida el asesor - Creacion del asesor
		$sql_asesor = "SELECT * FROM asesores WHERE codigo_asesor = '{$codidoasesor}'";
		$asesor = $wpdb->get_row( $sql_asesor );
		if ( !isset($asesor->id) ) {
			$new_asesor = "
	            INSERT INTO asesores VALUES (
	                NULL,
	                '".$codidoasesor."',
	                '".$nombreasesor."',
	                '".$emailasesor."'
	            );
	        ";

	        query( $new_asesor );
	    	$asesor = $wpdb->get_row( $sql_asesor );
		}

	// Datos de Usuario
		$user = get_user_by('email', $emailsus);
		if( !isset($user->ID) ){

	 		$hoy = date("Y-m-d H:i:s");

	 		$clave = 'nutri'.date("mHi");
	        $password = md5(wp_generate_password( $clave, false ));
		    $user_id  = wp_create_user( $emailsus, $password, $emailsus );

			$_user = new WP_User( $user_id );
			$_user->set_role( 'subscriber' );

			// Se guarda informacion de la orden en los metas del usuario 
			update_user_meta( $user_id, 'first_name', 			$nombre 			);
			update_user_meta( $user_id, 'telef_movil', 			$telef_movil 		);
			update_user_meta( $user_id, 'dir_estado', 			$dir_estado 		);
			update_user_meta( $user_id, 'dir_codigo_postal', 	$dir_codigo_postal 	);
			update_user_meta( $user_id, 'r_address', 			$r_address			);

			$user = get_user_by('ID', $user_id);

			// Enviar Email 
	        $HTML = generarEmail(
		    	"login/registro_por_orden", 
		    	array(
		    		"USUARIO" => $nombre,
		    		"EMAIL" => $emailsus,
		    		"PASS" => $clave,
		    		"LINK" => get_home_url()."/perfil/"
		    	)
		    );
		}

	// Cargar registro de venta del asesor
		if( $user->ID > 0 ){
			$pedido = [
				'marca' => $dir_marcas,
				'presentacion' => $dir_presentacion,
				'tamano' => $dir_kg,
				'plan' => $dir_planes1,
				'direccion' => $r_address,
				'estado' => $dir_estado,
				'codigo_postal' => $dir_codigo_postal,
				'casa_oficina' => $casa_oficina,
				'forma_pago' => $forma_pago
			];
			$limit = date('Y-m-d\TH:i:s', strtotime('+ 24 hours'));
			$pedido = serialize($pedido);
			$token = md5( $user->ID . $limit );

			$sql_orden = "
				INSERT INTO asesores_ordenes ( 
					asesor_id, 
					user_id, 
					pedido, 
					estatus, 
					token, 
					valido_hasta 
				)VALUES(
					 {$asesor->id},
					 {$user->ID},
					'{$pedido}',
					1,
					'{$token}',
					'{$limit}'
				)
			";
			query( $sql_orden );

			$sql_search_orden = "select * from asesores_ordenes where token = '{$token}' and estatus = 1 ";
			$orden = $wpdb->get_row( $sql_search_orden );

			$result['orden_id'] = $orden->id; 
			$result['nombre'] = $nombre; 

			// Consultar Productos
			//$sql_search_orden = "select * from productos where marca = '{$}'";
			//$orden = $wpdb->get_row( $sql_search_orden );

			// Preparar CARRITO
			/*$productos = json_encode([
				'tamano' => ''
				'edad' => ''

				'plan' => Bimestral
				'plan_id' => 2

				'cantidad' => 1
				'precio' => 650
				'subtotal' => 1300
				'marca' => 12
				'producto' => 8
			]);
			$CARRITO = [
			    [total] => 
			    [cantidad] => 1
			    [productos][] => json_decode($productos)
			]*/



			if( isset($orden->id) && $orden->id > 0 ){
				// Enviar Email 
		        $HTML = generarEmail(
			    	"compra/pagos/orden_de_pago_cliente", 
			    	array(
			    		"USUARIO" => $nombre,
			    		"EMAIL" => $emailsus,
			    		"PASS" => $clave,
			    		"LINK" => get_home_url()."/perfil/"
			    	)
			    );
				$result['code'] = 1;
		    }
		}

	echo json_encode( $result );

	exit();
?>