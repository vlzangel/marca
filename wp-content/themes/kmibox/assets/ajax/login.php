<?php
define('WP_DEBUG', true);
define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

if(!array_key_exists('rememberme', $_POST)){
	$rememberme = false;
}else{
	$rememberme = $_POST['rememberme'];
}

// $info['user_login'] = $_POST['usuario'];
// $info['user_password'] = sanitize_text_field($_POST['clave']);
// $info['remember'] = ($rememberme == true)? true : false ;

$info = array();
$username = sanitize_user($_POST['usuario'], true);
$user = get_user_by( 'email', $username );
if ( isset( $user, $user->user_login, $user->user_status ) && 0 == (int) $user->user_status ){
    $username = $user->user_login;
}else{
    $username = sanitize_user($_POST['usuario'], true);
}

$info['user_login'] = $username;
$info['user_password'] = sanitize_text_field($_POST['clave']);
$info['remember'] = $rememberme;

$dat = 0;
$dat = kmibox_login([
	'user_login' => $username,
	'user_password' =>  sanitize_text_field($_POST['clave']),
	'remember' => $rememberme ,
]);
print_r( $dat );
