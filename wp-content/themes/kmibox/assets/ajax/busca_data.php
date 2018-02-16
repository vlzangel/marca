<?php // header('Access-Control-Allow-Origin: *');


define('WP_USE_THEMES', false);

$url = realpath( __DIR__ . '/../../../../../wp-load.php' );
include_once( $url );

extract($_POST);

global $wpdb;

$where = '';
if( $_tamano != '' ){	
	$where .= " AND p.tamanos like '%\"{$_tamano}\";i:1;%' ";
}
if( $_edad != '' ){	
	$where .= " AND p.edades like '%\"{$_edad}\";i:1;%' ";
}

$sql = "
	SELECT m.nombre as marca_nombre, m.tipo, p.*
	FROM productos as p
		INNER JOIN marcas as m ON m.id = p.marca 
	WHERE
		m.tipo = {$_tipo} 
		{$where}
";
 
$productos = $wpdb->get_results( $sql );

foreach ($productos as $key => $value) {
	$value->planes = unserialize($value->planes);
	$productos[$key] = $value;
}

print_r( json_encode($productos) );

