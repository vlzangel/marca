<?php
	if( !isset($_SESSION) ){ session_start(); }
	include_once( dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/wp-load.php' );

	global $wpdb;

	extract($_POST);

	$_SESSION["MODAL_".$modal] = 1;

	echo json_encode(array(
		"code" => 1
	));

?>