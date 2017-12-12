<?php // header('Access-Control-Allow-Origin: *');


define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

send_nosniff_header();
nocache_headers();

$estado = $_GET['estado'];

$result = [];
$d = get_municipios( $estado );
foreach ($d as $row) {
	$result[] = [ 
		'name'=> utf8_decode( $row->name ),
		'id'=> $row->id,
	];
}
print_r( json_encode($result) );

