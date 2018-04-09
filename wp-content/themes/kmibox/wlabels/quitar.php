<?php
	session_start();

	//$_SESSION["wlabel"] = "quitar";
	unset($_SESSION["wlabel"]);

	header( "location: ".get_home_url() );
?>