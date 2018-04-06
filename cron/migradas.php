<?php
	include '../wp-load.php';

	global $wpdb;

	$ordenes = $wpdb->get_results("SELECT * FROM ordenes");
	$i = 1;
	foreach ($ordenes as $orden) {
		$migrada = $wpdb->get_row( "select * from ordenes_migradas where id_orden = ".$orden->id );
		if( !empty($migrada) ){
			$meta = unserialize($orden->metadata);
			$meta['migrada'] = "SI";

			$d = serialize($meta);
			$wpdb->query(" UPDATE ordenes SET metadata = '{$d}' WHERE id = ".$orden->id);

			print_r( serialize($meta) );
			echo '<br>';
			$i++;
		}
	}
	 

?>