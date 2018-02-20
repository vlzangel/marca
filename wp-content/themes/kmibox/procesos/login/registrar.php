<?php 

	include_once( dirname(__DIR__, 5).'/wp-load.php' );
    
    setZonaHoraria();
	extract($_POST);
	$sts = 0; 
	$user_id = user_id();

	// Inicio - Crear usuario 

		if( $user_id == 0 ){

			// Validaciones

			if( get_user_by_email( $email ) != null ){  
				$sts = 2; 
			}
			if( $pass  != $pass_c  ){ 					
				$sts = 3; 
			}
			if( $email != $email_c ){ 					
				$sts = 4; 
			}

			switch ($sts) {
				case 0:

			        $hoy = date("Y-m-d H:i:s");
			        $new_user = "
			            INSERT INTO wp_users VALUES (
			                NULL,
			                '".$email."',
			                '".md5($pass)."',
			                '".$email."',
			                '".$email."',
			                '',
			                '".$hoy."',
			                '',
			                0,
			                '".$nombre." ".$apellido."'
			            );
			        ";

			        query( $new_user );
	        		$user_id = insert_id();

					$user = new WP_User( $user_id );
		    		$user->set_role( 'subscriber' );

		    		// Autenticar 

						if( !empty($pass) && !empty($email) ){	
							login(
								[
									'user_login' 	=> $email,
									'user_password' => $pass,
									'remember' 		=> false 
								]
							);
						}

					// Enviar Email 

				        $HTML = generarEmail(
					    	"login/registro", 
					    	array(
					    		"USUARIO" => $nombre,
					    		"EMAIL" => $email,
					    		"LINK" => get_home_url()."/perfil/"
					    	)
					    );
						wp_mail( $email, "Usuario Registrado NutriHeroes", $HTML );

// ----- Copia a los administradores
			$headers = array(
               'BCC: r.rodriguez@kmimos.la',
               'BCC: r.cuevas@kmimos.la',
	        );
						wp_mail( 'i.cocchini@kmimos.la', "Usuario Registrado NutriHeroes", $HTML, $headers );

				break;
				case 2:
					$msg = "El email ya existe, intente recuperar la contraseña";
				break;
				case 3:
					$msg = "El email de confirmacion no son iguales";
				break;
				case 4:
					$msg = "La clave de confirmacion no son iguales";
				break;
			}

		}
	// Fin - Crear usuario 



	if( $user_id > 0 ){

		// Inicio - Es usuario de Kmimos 
			$options = array( 
				'funcion' => "is_user",
				'email' => $email
			);
			
		    Requests::register_autoloader();
		    $request = Requests::post('http://kmimosmx.sytes.net/QA2/services/users.php', array(), $options );
		    $is_user_kmimos = "NO";
		    if( $request->body+0 > 0 ){
		    	$is_user_kmimos = "SI";
		    }
			update_user_meta( $user_id, 'is_user_kmimos', $is_user_kmimos );

		// Fin - Es usuario de Kmimos 

		// Inicio - Actualizando información del usuario 

			update_user_meta( $user_id, 'first_name', 			$nombre 			);
			update_user_meta( $user_id, 'last_name', 			$apellido 			);
			update_user_meta( $user_id, 'sexo', 				$sexo 				);
			update_user_meta( $user_id, 'edad', 				$edad 				);
			update_user_meta( $user_id, 'mascota', 				$mascota 			);
			update_user_meta( $user_id, 'telef_movil', 			$telef_movil 		);
			update_user_meta( $user_id, 'telef_fijo', 			$telef_fijo 		);
			update_user_meta( $user_id, 'dondo_conociste', 		$dondo_conociste 	);	
			update_user_meta( $user_id, 'dir_numext', 			$dir_numext 		);
			update_user_meta( $user_id, 'dir_numint', 			$dir_numint 		);
			update_user_meta( $user_id, 'dir_calle', 			$dir_calle 			);
			update_user_meta( $user_id, 'dir_estado', 			$dir_estado 		);
			update_user_meta( $user_id, 'dir_ciudad', 			$dir_ciudad 		);
			update_user_meta( $user_id, 'dir_colonia', 			$dir_colonia 		);
			update_user_meta( $user_id, 'dir_codigo_postal', 	$dir_codigo_postal 	);

			$msg = 'Carga de usuario completo';

			$sts = 1;

		// Fin - Actualizando información del usuario 
	}


	echo json_encode( 
		[
			'code'	=>	$sts, 
			'msg'	=>	$msg
		] 
	);

	exit();
?>