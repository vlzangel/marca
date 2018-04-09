<?php
	session_start();

	$_SESSION["wlabel"] = "momsweb";

	header( "location: ".get_home_url() );
?>