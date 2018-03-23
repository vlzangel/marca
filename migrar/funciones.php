<?php
	function esAsesor($data){
		extract($data);
		global $wpdb;
		$existe = $wpdb->get_var("SELECT id FROM asesores WHERE email = '{$asesor_email}' ");
		if ( $existe+0 > 0 ){
			return $existe;
		}else{
			return false;
		}
	}

	function crearAsesor($data){
		extract($data);
		global $wpdb;
		$_asesor = esAsesor($data);
		if( $_asesor === false ){
			$new_asesor = "
	            INSERT INTO asesores VALUES (
	                NULL,
	                '".time()."',
	                '{$asesor}',
	                '{$asesor_email}'
	            );
	        ";
	        $wpdb->query( $new_asesor );
			return $wpdb->insert_id;
		}else{
			return $asesor;
		}
	}

	function esUser($data){
		extract($data);
		global $wpdb;
		global $wpdb;
		$existe = $wpdb->get_var("SELECT ID FROM wp_users WHERE user_email = '{$email}' ");
		if ( $existe+0 > 0 ){
			return $existe;
		}else{
			return false;
		}
	}

	function crearUser($data){
		extract($data);
		global $wpdb;
		$user = esUser($data);
		if( $user === false ){
	        $hoy = date("Y-m-d H:i:s");
	        $new_user = "
	            INSERT INTO wp_users VALUES (
	                NULL,
	                '".$email."',
	                '".md5($hoy)."',
	                '".$email."',
	                '".$email."',
	                '',
	                '".$hoy."',
	                '',
	                0,
	                '".$first_name." ".$last_name."'
	            );
	        ";
	        $wpdb->query( $new_user );
			$user_id = $wpdb->insert_id;
			crearUserMetas($user_id, $data);

			return $user_id;
		}else{
			return $user;
		}
	}

	function crearUserMetas($user_id, $data){
		extract($data);
		update_user_meta( $user_id, 'first_name', 			$first_name 		);
		update_user_meta( $user_id, 'last_name', 			$last_name 			);
		update_user_meta( $user_id, 'sexo', 				$sexo 				);
		update_user_meta( $user_id, 'edad', 				$edad 				);
		update_user_meta( $user_id, 'mascota', 				$mascota 			);
		update_user_meta( $user_id, 'telef_movil', 			$telef_movil 		);
		update_user_meta( $user_id, 'telef_fijo', 			$telef_fijo 		);
		update_user_meta( $user_id, 'dondo_conociste', 		$donde_conociste 	);	
		update_user_meta( $user_id, 'dir_numext', 			$dir_numext 		);
		update_user_meta( $user_id, 'dir_numint', 			$dir_numint 		);
		update_user_meta( $user_id, 'dir_calle', 			$dir_calle 			);
		update_user_meta( $user_id, 'dir_estado', 			$dir_estado 		);
		update_user_meta( $user_id, 'dir_ciudad', 			$dir_ciudad 		);
		update_user_meta( $user_id, 'dir_colonia', 			$dir_colonia 		);
		update_user_meta( $user_id, 'dir_codigo_postal', 	$dir_codigo_postal 	);
		update_user_meta( $user_id, 'asesor_registro', 		$asesor_registro	);
		update_user_meta( $user_id, 'is_user_kmimos', 		"NO"				);
	}

?>