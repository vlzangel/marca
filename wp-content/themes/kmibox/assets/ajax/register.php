<?php 

define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

$sts = 0;

$email = ( !empty( $_POST['email'] ) )? $_POST['email'] : '' ;
$email_c = ( !empty( $_POST['email_c'] ) )? $_POST['email_c'] : '' ;
$pass  = ( !empty( $_POST['pass'] ) )? $_POST['pass'] : '' ;
$pass_c  = ( !empty( $_POST['pass_c'] ) )? $_POST['pass_c'] : '' ;

// Actualizar Usuario
$user_id = get_current_user_id();

// Crear Usuario
if( $user_id < 1 ){
	if( $email != $email_c ){ $sts = 3; }
	if( $pass  != $pass_c  ){ $sts = 2; }
	$exist_email = get_user_by_email( $email );
	if( $exist_email == null ){
		if( $sts == 0 ){
			$password =  $pass;
			$user_id  = wp_create_user( $email, $password, $email );
				if( $user_id > 0 ){
				$user = new WP_User( $user_id );
	    		$user->set_role( 'subscriber' );
	    		
			$msg = 'Usuario creado con exito';
	    		
				
			include( realpath( __DIR__ . '/../../template/email/usuario_registrado_Kmibox.php' ) );
				wp_mail(
					$email, 	
					"Usuario registrado Kmibox", 
					$HTML
		);
				// ****************************
				// Autenticar
				// ****************************
				if( !empty($password) && !empty($email) ){	
					$r = kmibox_login([
						'user_login' => $email,
						'user_password' => $password,
						'remember' => false ,
					]);
				}
			}
		}else{
			switch ($sts) {
				case 2:
					$msg = "El email de confirmacion no son iguales";
					break;
				case 3:
					$msg = "La clave de confirmacion no son iguales";
					break;
			}
		}
	}else{
		$msg = "El email ya existe, intente recuperar la contraseña";
	}
}
 

// Crear o actualizar Metas
if( $user_id > 0 ){

	$msg = 'Carga de usuario completo';
	
	$sexo = $_POST['sexo'];
	

	update_user_meta( $user_id, 'first_name', $_POST['nombre'] );
	update_user_meta( $user_id, 'last_name', $_POST['apellido'] );
	update_user_meta( $user_id, 'sexo', $sexo );
	update_user_meta( $user_id, 'edad', $_POST['edad'] );
	update_user_meta( $user_id, 'mascota', $_POST['mascota'] );
	update_user_meta( $user_id, 'telef_movil', $_POST['telef_movil'] );
	update_user_meta( $user_id, 'telef_fijo', $_POST['telef_fijo'] );
	update_user_meta( $user_id, 'dondo_conociste', $_POST['dondo_conociste'] );	
	update_user_meta( $user_id, 'dir_numext', $_POST['dir_numext'] );
	update_user_meta( $user_id, 'dir_numint', $_POST['dir_numint'] );
	update_user_meta( $user_id, 'dir_calle', $_POST['dir_calle'] );
	update_user_meta( $user_id, 'dir_estado', $_POST['dir_estado'] );
	update_user_meta( $user_id, 'dir_ciudad', $_POST['dir_ciudad'] );
	update_user_meta( $user_id, 'dir_colonia', $_POST['dir_colonia'] );
	update_user_meta( $user_id, 'dir_codigo_postal', $_POST['dir_codigo_postal'] );

	$sts = 1;
	
}


print_r( json_encode( ['code'=>$sts, "msg"=>$msg] ) );