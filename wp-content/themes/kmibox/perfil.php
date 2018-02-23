<?php
	/* 
	 *
	 * Template Name: Perfil
	 *
	*/

	wp_enqueue_style( 'jquery.bxslider', TEMA()."/css/jquery.bxslider.css", array(), "1.0.0" );
    wp_enqueue_script('bxslider', TEMA()."/js/jquery.bxslider.js", array(), '1.0.0');

	get_header();

		echo MENU();

		$user = get_user_info();

		$HTML .= '
			'.cssPAGE("perfil").'

			<ul class="perfil_tabs">
				<li style="font-family:GothanMedium_regular" class="tab_activo" data-tab="2">Mis suscripciones</li>
				<li style="font-family:GothanMedium_regular" data-tab="3">Estatus de envío</li>
				<li style="font-family:GothanMedium_regular" data-tab="1">Mi Información</li>
			</ul>

			<div class="secciones_container">';
				include(__DIR__."/template/mis_suscripciones.php");
				include(__DIR__."/template/donde_esta_mi_marca.php");
				include(__DIR__."/template/info.php"); $HTML .= '
			</div>';

		echo comprimir($HTML);

	get_footer(); 
?>