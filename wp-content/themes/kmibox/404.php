<?php
	$paginas = getAllWlabel();

	$url = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

	$url = str_replace(HOME(), "", $url);
	$url = explode("/", $url);
	$param = array_values(array_diff($url, array('')));

	global $wpdb;

	if( array_key_exists ($param[0], $paginas) ){
		session_start();
		if( $param[0] == "quitar"){
			unset($_SESSION["wlabel"]);
		}else{
			$_SESSION["wlabel"] = $paginas[ $param[0] ];

			$asesor = $wpdb->get_row("SELECT * FROM asesores WHERE codigo_asesor = '{$paginas[ $param[0] ]['codigo']}' ");
			if( $asesor == null  ){
				$wpdb->query("
					INSERT INTO 
						asesores 
					VALUES (
						NULL,
						'{$paginas[ $param[0] ]['codigo']}',
						'{$paginas[ $param[0] ]['asesor']}',
						'{$paginas[ $param[0] ]['asesor_email']}',
						'0000000000',
						0,
						NULL,
						NULL,
						0,
						0
					)
				");
			}

			$asesor_user = $wpdb->get_row("SELECT * FROM wp_users WHERE user_email = '{$paginas[ $param[0] ]['asesor_email']}' ");
			if( $asesor_user == null  ){
				$clave = md5( $paginas[ $param[0] ]['codigo'] );
				$wpdb->query("
					INSERT INTO 
						wp_users 
					VALUES
						(
							NULL, 
							'{$paginas[ $param[0] ]['asesor_email']}', 
							'{$clave}', 
							'{$paginas[ $param[0] ]['asesor_email']}', 
							'{$paginas[ $param[0] ]['asesor_email']}', 
							'', 
							NOW(), 
							'', 
							0, 
							'{$paginas[ $param[0] ]['asesor']}'
						);
				");

				$user_id = $wpdb->insert_id;

				update_user_meta( $user_id, 'first_name', 		 $paginas[ $param[0] ]['asesor'] );
				update_user_meta( $user_id, 'last_name', 		 "" );
				update_user_meta( $user_id, 'sexo', 			 "m" );
				update_user_meta( $user_id, 'edad', 			 "20" );
				update_user_meta( $user_id, 'mascota', 			 "" );
				update_user_meta( $user_id, 'telef_movil', 		 "00000000" );
				update_user_meta( $user_id, 'telef_fijo', 		 "00000000" );
				update_user_meta( $user_id, 'dondo_conociste', 	 "otros" );	
				update_user_meta( $user_id, 'dir_numext', 		 "01" );
				update_user_meta( $user_id, 'dir_numint', 		 "02" );
				update_user_meta( $user_id, 'dir_calle', 		 "wlabel" );
				update_user_meta( $user_id, 'dir_estado', 		 "1" );
				update_user_meta( $user_id, 'dir_ciudad', 		 "10" );
				update_user_meta( $user_id, 'dir_colonia', 		 "Ciudad de México" );
				update_user_meta( $user_id, 'dir_codigo_postal', "1040" );
				update_user_meta( $user_id, 'wp_capabilities', 	 "a:1:{s:10:\"subscriber\";b:1;}" );

			}
		}

		header( "location: ".get_home_url() );
	}else{
		get_header(); ?> 
		<div class="wrap">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
						</header><!-- .page-header -->
						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyseventeen' ); ?></p>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrap -->
		<?php get_footer();
	}


		
