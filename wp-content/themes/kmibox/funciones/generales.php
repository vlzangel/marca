<?php

	if(!function_exists('HOME')){
	    function HOME(){
	        return get_home_url();
	    }
	}

	if(!function_exists('TEMA')){
	    function TEMA(){
	        return get_template_directory_uri();
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
	        		<div id="oculto" class="col-xs-6  col-xs-6-1 col-sm-5 col-md-5 pull-left headerResponsive-img" >
						<a href="'.$home.'">
							<img src="'.$home.'/img/Image-Header.png" class="img-responsive">
						</a> 
					</div>
			    	<ul id="desaparecer"class="col-xs-6  col-sm-10 col-md-10 pull-right list-inline list-unstyled headerResponsive" >';
			    		if ( is_user_logged_in() ){
			    			$HTML .= '
								<li style="padding-right:0px;padding-left:0px;">
									<a href="'.$home.get_source_url().'/quiero-mi-marca/"">
										<i class="fa fa-plus-circle fa-2x"></i>
										<span class="gothan nav_header" >
											Quiero mi NutriHeroes
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


?>