<?php 
 
	if( !isset($_SESSION) ){ session_start(); }
	include_once( dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/wp-load.php' );
    
    setZonaHoraria();
	global $wpdb;
	extract($_POST);

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
			update_user_meta( $user_id, 'asesor_registro', 		$asesor->id			);

			$user = get_user_by('ID', $user_id);

			// Enviar Email 
	        $HTML = generarEmail(
		    	"login/registro_por_orden", 
		    	array(
		    		"USUARIO" => $nombre,
		    		"EMAIL" => $emailsus,
		    		"CLAVE" => $clave,
		    		"LINK" => get_home_url()."/perfil/"
		    	)
		    );
		    wp_mail( $emailsus, "Bienvenido a NutriHeroes", $HTML );
 
		    mail_admin_nutriheroes( "Bienvenido a NutriHeroes", $HTML );
	 
		}

	// Cargar registro de venta del asesor
		if( $user->ID > 0 ){
			$result['nombre'] = $nombre; 
			
			// Crear CARRITO
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
					WHERE p.id = {$dir_presentaciones}
					";	

				$temp_product = $wpdb->get_row($sql_carrito);
				$CARRITO = [
					"user_id" => $user->ID,
					"cantidad"=> 1, 
					"productos" => [
						$temp_product
					], 
					"descuentos"=> [],
					"total"=> $temp_product->subtotal
				];

		
				//Iniciar session del usuario 
			    wp_set_current_user( $user->ID , $user->user_login );
			    wp_set_auth_cookie( $user->ID );

				// Crear Orden
				$_SESSION['CARRITO'] = serialize($CARRITO);
				$orden_id = crearPedido();

				// Asignar Asesor a la venta
				$sql_asesor = "UPDATE ordenes SET asesor = ". $asesor->id. " WHERE id =". $orden_id;
				query( $sql_asesor );

				// Actualizar Session carrito
				$CARRITO['orden_id'] = $orden_id;
				$_SESSION['CARRITO'] = serialize($CARRITO);

				// Cerrar session
				wp_logout(); 
 
			

			// Formas de pago
				switch (strtolower($forma_pago)) {
					case 'tienda':
						// $CARRITO = serialize($CARRITO);
						ob_start();
						get_template_part( 'template/parts/page/checkout-tienda', 'page' ); 
						$content = ob_get_clean(); // Variable con el HTML de la vista "checkout-tienda"
						if( $_POST["error"] == '' ){
							$result['code'] = 1;
							$result['orden_id'] = $orden_id;

							if( !empty($_POST['EMAIL_NUEVA_COMPRA']) ){
								$HTML = $_POST['EMAIL_NUEVA_COMPRA'];
								$asesor_email = get_email_asesor( $orden_id );
					
		    					wp_mail( $asesor_email, "Pago en Tienda - NutriHeroes", $HTML );
							}
						}  
						break;
					
					case 'tarjeta':
						// Crear Registro para pago por Tarjeta
						$pedido = [
							'marca' => $dir_marcas,
							'presentacion' => $dir_presentacion,
							'tamano' => $dir_kg,
							'plan' => $dir_planes1,
							'direccion' => $r_address,
							'estado' => $dir_estado,
							'codigo_postal' => $dir_codigo_postal,
							'casa_oficina' => $casa_oficina,
							'forma_pago' => $forma_pago,
							'carrito' => $CARRITO,
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
								valido_hasta,
								order_id 
							)VALUES(
								 {$asesor->id},
								 {$user->ID},
								'{$pedido}',
								1,
								'{$token}',
								'{$limit}',
								'{$orden_id}'
							)
						";
						query( $sql_orden );

						$sql_search_orden = "select * from asesores_ordenes where token = '{$token}' and estatus = 1 ";
						$orden = $wpdb->get_row( $sql_search_orden );
						$result['orden_id'] = $orden->order_id; 

						if( isset($orden->id) && $orden->id > 0 ){
							// Enviar Email 
					        $HTML = generarEmail(
						    	"compra/pagos/orden_de_pago_cliente", 
						    	array(
						    		"USUARIO" => $nombre,
						    		"DIRECCION" => $r_address,
						    		"LINK" => get_home_url()."/wp-content/themes/kmibox/procesos/asesor/pago_orden.php?u=".md5($user->ID)."&t=".$token,
						    		"TOTAL" => $temp_product->subtotal,
						    	)
						    );


						    wp_mail( $emailsus, "Solicitud de Compra en NutriHeroes", $HTML );
 
						    $asesor_email = get_email_asesor( $orden->id );
						    mail_admin_nutriheroes( "Solicitud de Compra en NutriHeroes", $HTML, $asesor_email );
	        
							$result['code'] = 1;
					    }					
						break;
					}


		}

	echo json_encode( $result );

	exit();
?>