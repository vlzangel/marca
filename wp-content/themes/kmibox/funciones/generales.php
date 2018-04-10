<?php

	if(!function_exists('HOME')){
	    function HOME(){
	        return get_home_url();
	    }
	}

	if(!function_exists('TEMA')){
	    function TEMA(){
	        return HOME()."/wp-content/themes/kmibox/";
	    }
	}

	if(!function_exists('cssPAGE')){
	    function cssPAGE($_page){
	        return '
	        	<link rel="stylesheet" href="'.TEMA().'/css/'.$_page.'.css'.VERSION().'">
				<link rel="stylesheet" href="'.TEMA().'/css/responsive/'.$_page.'.css'.VERSION().'">
				<script src="'.TEMA().'/js/'.$_page.'.js'.VERSION().'"></script>
			';
	    }
	}

	if(!function_exists('VERSION')){
	    function VERSION(){
	        return "?ver=".time();
	    }
	}

	if(!function_exists('comprimir')){
	    function comprimir($HTML){
	        $HTML = str_replace("\t", "", $HTML);
	        $HTML = str_replace("      ", " ", $HTML);
	        $HTML = str_replace("     ", " ", $HTML);
	        $HTML = str_replace("    ", " ", $HTML);
	        $HTML = str_replace("   ", " ", $HTML);
	        $HTML = str_replace("  ", " ", $HTML);
	        return $HTML = str_replace("\n", " ", $HTML);
	    }
	}

	if(!function_exists('setZonaHoraria')){
	    function setZonaHoraria(){
	        date_default_timezone_set('America/Mexico_City');
	    }
	}

	if(!function_exists('deserializar')){
	    function deserializar($data){
	        if( $data == ""){
	        	return array();
	        }else{
	        	return unserialize($data);
	        }
	    }
	}

	if(!function_exists('getFechas')){
	    function getFechas(){
	        return array(
	        	"semana" => array(
	        		1 => "Lunes",
	        		2 => "Martes",
	        		3 => "Mi&eacute;rcoles",
	        		4 => "Jueves",
	        		5 => "Viernes",
	        		6 => "S&aacute;bado",
	        		7 => "Domingo"
	        	),
	        	"meses" => array(
	        		1 => "Enero",
	        		2 => "Febrero",
	        		3 => "Marzo",
	        		4 => "Abril",
	        		5 => "Mayo",
	        		6 => "Junio",
	        		7 => "Julio",
	        		8 => "Agosto",
	        		9 => "Septiembre",
	        		10 => "Octubre",
	        		11 => "Noviembre",
	        		12 => "Diciembre"
	        	)
	        );
	    }
	}

	if(!function_exists('user_id')){
	    function user_id(){
	        return get_current_user_id();
	    }
	}

	function login( $info = [] ){
		$dat = 0;
		if( !empty($info) ){
			$user_signon = wp_signon( $info, true );
			if ( is_wp_error( $user_signon )) {
				$dat = 0;
			} else {
			    wp_set_auth_cookie($user_signon->ID);
				$dat = 1;
			}
		}
		return $dat;
	}

	if(!function_exists('MENU')){
	    function MENU($page = ""){
	    	$user = get_user_by( 'id', get_current_user_id() );
	    	$home = HOME();
	    	$salir = wp_logout_url( HOME() );
	    	switch ($page) {
	    		default:
	    			// Aqui va el codigo personalizado
	    			// De ser necesario
	    		break;
	    	}
	        $HTML = '
	        	<nav class="container nav_container"> 
	        		<div class="col-xs-7 col-sm-5 pull-left" style="padding: 0px;" >
						<a id="logo" href="'.$home.'" style="background-image: url('.$home.'/img/Image-Header.png);">
							
						</a> 
					</div>
			    	<ul class="col-xs-5 col-sm-7 pull-right list-inline list-unstyled" style="padding: 10px 0px;" >';
			    		if ( is_user_logged_in() ){
			    			$HTML .= '
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$home.get_source_url().'/quiero-mi-marca/"">
										<i class="fa fa-plus-circle fa-2x"></i>
										<span class="gothan nav_header" >
											Buscar alimento
										</span>
									</a>
								</li>
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$home.'/perfil/">
										<i class="fa fa-user fa-2x" ></i>
										<span class="gothan nav_header">
											Mi perfil
										</span>
									</a>
								</li>
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$salir.'">
										<i class="fa fa-close fa-2x" ></i>
										<span class="gothan nav_header">
											Salir
										</span>
									</a>
								</li>';
						}else{
			    			$HTML .= '									
								<li>
									<a href="'.$home.'/iniciar-sesion/">
										<i class="fa fa-key fa-2x" ></i>
										<span class="gothan nav_header">
											Iniciar Sesión
										</span>
									</a>
								</li>
								<li>
									<a href="'.$home.'/registro/">
										<i class="fa fa-user-plus fa-2x" ></i> 
										<span class="gothan nav_header">Registrarse</span>
									</a>
								</li>';
						} $HTML .= '
					</ul>
				</nav>
	        ';
	        return $HTML;
	    }
	    
	}

	if(!function_exists('getConfig')){
	    function getConfig($key){
	    	global $wpdb;
	        return $wpdb->get_var("SELECT valor FROM configuraciones WHERE clave = '{$key}' ");
	    }
	}

	function fechaCastellano ($fecha) {
		$numeroDia = date('d', $fecha);
		$dia = date('l', ($fecha));
		$mes = date('F', ($fecha));
		$anio = date('Y', ($fecha));
		$dias_ES = array("Lunes", "Martes", "Mi&eacute;rcoles", "Jueves", "Viernes", "S&aacute;bado", "Domingo");
		$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		$nombredia = str_replace($dias_EN, $dias_ES, $dia);
		$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
		// return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
		return $nombredia." ".$numeroDia." de ".$nombreMes;
	}


?>