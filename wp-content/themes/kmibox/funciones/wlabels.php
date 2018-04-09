<?php
	
	function wlabel(){
		if( !isset($_SESSION) ){ session_start(); }
		if( isset( $_SESSION["wlabel"] ) ){
			echo '<link rel="stylesheet" href="'.TEMA().'wlabels/css/'.$_SESSION["wlabel"]["wl"].'.css?v='.time().'">';
		}

	}
?>