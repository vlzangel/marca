<?php
	
	function getAllWlabel(){
		return array(
			"momsweb" => array(
				"wl" => "momsweb",
				"codigo" => "1000001",
				"asesor" => "momsweb.mx",
				"asesor_email" => "momsweb.mx@mail.com",
			),
			"alsea" => array(
				"wl" => "alsea",
				"codigo" => "1000002",
				"asesor" => "alsea.mx",
				"asesor_email" => "alsea.mx@mail.com",
			),
			"jj" => array(
				"wl" => "jj",
				"codigo" => "1000003",
				"asesor" => "jj.mx",
				"asesor_email" => "jj.mx@mail.com",
			),
			"petco" => array(
				"wl" => "petco",
				"codigo" => "1000004",
				"asesor" => "petco.mx",
				"asesor_email" => "petco.mx@mail.com",
			),
			"quitar" => array(),
		);
	}

	function is_wlabel($email){
		if($email == ""){ return false; }
		$wlabels = getAllWlabel();
		foreach ($wlabels as $key => $wlabel) {
			if( $wlabel["asesor_email"] == $email ){
				return $key;
			}
		}
		return false;
	}
	
	function wlabel(){
		if( !isset($_SESSION) ){ session_start(); }
		if( isset( $_SESSION["wlabel"] ) && isset( $_SESSION["wlabel"]["wl"] ) ){
			echo '<link rel="stylesheet" href="'.TEMA().'wlabels/css/'.$_SESSION["wlabel"]["wl"].'.css?v='.time().'">';
		}
	}

	
	function parametros_wlabel(){
		if( !isset($_SESSION) ){ session_start(); }
		if( $_SESSION["wlabel"]["wl"] == 'momsweb' && isset( $_SESSION["wlabel"] ) && isset( $_SESSION["wlabel"]["wl"] ) ){
			$dir = dirname(__DIR__).'/wlabels/parametros/'. $_SESSION["wlabel"]["wl"] . '.php';		
			require_once( $dir );
			return $wl_param;
		}
		return [];
	}
?>