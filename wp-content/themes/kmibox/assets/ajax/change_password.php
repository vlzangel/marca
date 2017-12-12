<?php 

define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

$sts = 0;

$email = ( !empty( $_POST['email'] ) )? $_POST['email'] : '' ;
$pass = ( !empty( $_POST['clave'] ) )? $_POST['clave'] : '' ;
$_pass = ( !empty( $_POST['confirm_clave'] ) )? $_POST['confirm_clave'] : '' ;

if( $email != '' & $pass != '' & $_pass == $pass){
	$user = get_user_by_email( $email );
	if( $user->ID > 0 ){
		$code = md5(uniqid(rand(), true));
		// Create token
		update_user_meta( $user->ID, 'reset_pass_token', $code );
		wp_set_password( $pass, $user->ID );
		$sts = 1;
	}
}

echo json_encode($sts);