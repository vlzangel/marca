<?php 

	include_once( dirname(__DIR__, 5).'/wp-load.php' );
    
    setZonaHoraria();

	extract($_POST);

	$sts = [
		'code' => '',
		'sts' => 0,
		'email' => $email
	];

	if( $email != '' ){
		$user = get_user_by_email( $email );
		if( $user->ID > 0 ){

			$user = get_user_by_email( $email );
			$_name = get_user_meta($user->ID, 'first_name', true);
			$sts['code'] = md5(uniqid(rand(), true));
			$sts['sts'] = 1;

			update_user_meta( $user->ID, 'reset_pass_token', $sts['code'] );

			$HTML = generarEmail(
		    	"login/recuperar", 
		    	array(
		    		"USUARIO" => $_name,
		    		"EMAIL" => $email,
		    		"LINK" => get_home_url()."/recuperar-clave/?confirmar=".$sts['code']."&e=".$email
		    	)
		    );

			wp_mail( $email, "Cambio de contraseña para tu cuenta Nutriheroes", $HTML );
			
	      

			// ----- Copia a los administradores
			$headers = array(
               'BCC: r.rodriguez@kmimos.la',
               'BCC: r.cuevas@kmimos.la',
	        );
			wp_mail( 'i.cocchini@kmimos.la', "Cambio de contraseña para tu cuenta Nutriheroes", $HTML, $headers );

		}
	}

	echo json_encode($sts);

?>