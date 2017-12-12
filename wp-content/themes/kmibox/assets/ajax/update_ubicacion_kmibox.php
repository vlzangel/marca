<?php // header('Access-Control-Allow-Origin: *');


define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

global $wpdb;
$sts = 0;
if( array_key_exists('id', $_GET) ){
	if( array_key_exists('estatus', $_GET) ){

		$id = $_GET['id'];
		$sql = "update wp_suscripcion_transacciones set estatus = '".$_GET['estatus']."' where id=".$id;
		$result = $wpdb->get_results($sql);

		$sql1 = "select * from wp_suscripcion_transacciones where estatus = '".$_GET['estatus']."' and id=".$id;
		$c = $wpdb->get_results($sql1);
		if( count($c) > 0 ){
			$sts = 1;
		}
		
	}
}

print_r($sts);
