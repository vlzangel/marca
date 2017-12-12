<?php 

define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

$sts = [
	'code' => '',
	'sts' => 0,
];

$email = ( !empty( $_POST['email'] ) )? $_POST['email'] : '' ;

$sts['email'] = $email;

if( $email != '' ){
	$user = get_user_by_email( $email );
	if( $user->ID > 0 ){
		$sts['code'] = md5(uniqid(rand(), true));
		$sts['sts'] = 1;
		// Nombre
		$_name = get_user_meta($user->ID, 'first_name');
		$name =( array_key_exists('0', $_name) )? $_name[0] : '' ;
		// Create token
		update_user_meta( $user->ID, 'reset_pass_token', $sts['code'] );
		include( realpath( __DIR__ . '/../../template/email/reset_password.php' ) );
		wp_mail(
			$email, 
			"Cambio de contraseña para tu cuenta marca", 
			$HTML
		);
	}
}

echo json_encode($sts);