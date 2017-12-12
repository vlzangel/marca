<?php header('Access-Control-Allow-Origin: *');

$url = realpath( __DIR__ . '/../../../../../wp-blog-header.php' );
define('WP_USE_THEMES', false);
require_once( $url );
global $wpdb;

// Service Response
if($_POST){
	if( array_key_exists('key', $_POST['xdata']) ){
		$key = $_POST['key'];
		$data = $_POST;

		switch ($key) {
			case 'create':
				if( $user = registro() ){
					print_r($user);
				}
				break;
			case 'login':
				print_r($_POST);
				login();
				break;
		}
	}
}

function login(){
	$info['user_login'] = $_POST['usuario'];
	$info['user_password'] = $_POST['clave'];
	$info['remember'] = false;

	$user_signon = wp_signon( $info, true );
	if ( is_wp_error( $user_signon )) {
	    echo json_encode(['code'=>0]);
	} else {
	    wp_set_auth_cookie($user_signon->ID);
	    echo json_encode(['code'=>1]);
	}
}

function registro(){

	// $nombre 
	// $apellido 
	// $telfm 
	// $telfc 
	// $sexo 
	// $edad 	
	// $conocio

	$sts = 0;

	$email = ( !empty( $_POST['email'] ) )? $_POST['email'] : '' ;
	$email_c = ( !empty( $_POST['email_c'] ) )? $_POST['email_c'] : '' ;
	$pass = ( !empty( $_POST['pass'] ) )? $_POST['pass'] : '' ;
	$pass_c = ( !empty( $_POST['pass_c'] ) )? $_POST['pass_c'] : '' ;
	
	if( $pass != $pass_c ){ $sts = 2; }
	if( $email != $email_c ){ $sts = 3; }

	if( $sts == 0 ){
		$password = md5( $pass );
		$user_id  = wp_create_user( $email, $password, $email );		
		if( $user_id > 0 ){
			$user = new WP_User( $user_id );
			$user->set_role( 'subscriber' );
			$sts = 1;
		}
	}

	echo $sts;
}

