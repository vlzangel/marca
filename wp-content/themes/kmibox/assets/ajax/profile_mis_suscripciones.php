<?php // header('Access-Control-Allow-Origin: *');


define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

$suscripciones = get_suscripciones();
print_r( json_encode($suscripciones) ); 