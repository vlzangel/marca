<?php
	session_start();

	$_SESSION["wlabel"] = array(
		"wl" => "alsea",
		"codigo" => "1000002",
		"asesor" => "alsea.mx",
		"asesor_email" => "alsea.mx@mail.com",
	);

	header( "location: ".get_home_url() );
?>