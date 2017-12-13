<?php
 
	if(!session_id()){session_start();}

	$_SESSION["CARRITO"] = serialize($_POST);

	echo json_encode($_POST);

	exit;

?>