<?php
	$paginas = array(
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
		"quitar" => array(),
	);

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


		
