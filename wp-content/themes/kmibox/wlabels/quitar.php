<?php
	session_start();

	$_SESSION["wlabel"] = "quitar";

	header( "location: ".get_home_url() );
?>