<?php
	/* 
	 *
	 * Template Name: Perfil
	 *
	*/

	get_header();

		echo MENU();

		$user = get_user_info();

		$HTML .= '
			'.cssPAGE("perfil").'

			<ul class="perfil_tabs">
				<li class="tab_activo" data-tab="1">Mi Información</li>
				<li data-tab="2">Mi suscripción</li>
				<li data-tab="3">Estatus de envíos</li>
			</ul>

			<div class="secciones_container">';
				include(__DIR__."/template/info.php");
				include(__DIR__."/template/mis_suscripciones.php");
				include(__DIR__."/template/donde_esta_mi_marca.php"); $HTML .= '
			</div>';

		echo comprimir($HTML);

	get_footer(); 
?>