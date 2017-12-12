<?php // header('Access-Control-Allow-Origin: *');


define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

global $wpdb;
$estatus = '';
if( array_key_exists('id', $_GET) ){

	$id = $_GET['id'];
	$sql = "select estatus from wp_suscripcion_transacciones where post_id = ".$id." order by id desc limit 1";
	$result = $wpdb->get_results($sql);
	foreach ($result as $row) {
		$estatus = $row->estatus;
	}
}
print_r( $estatus ); 