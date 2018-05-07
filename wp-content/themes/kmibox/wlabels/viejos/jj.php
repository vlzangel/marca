<?php
	session_start();

	$_SESSION["wlabel"] = array(
		"wl" => "jj",
		"codigo" => "1000003",
		"asesor" => "jj.mx",
		"asesor_email" => "jj.mx@mail.com",
	);

	header( "location: ".get_home_url() );
?>