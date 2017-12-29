<?php
    extract($_POST);
    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );
	global $wpdb;
	$SQL = "UPDATE despachos SET status = '{$status}' WHERE id = {$ID};";
	$wpdb->query( $SQL );
?>