<?php
	session_start();

	$_SESSION["wlabel"] = array(
		"wl" => "momsweb",
		"codigo" => "1000001",
		"asesor" => "momsweb.mx",
		"asesor_email" => "momsweb.mx@mail.com",
	);

	header( "location: ".get_home_url() );
?>