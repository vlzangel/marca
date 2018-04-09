<?php
	$paginas = array(
		"momsweb",
		"quitar",
	);

	$url = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

	$url = str_replace(HOME(), "", $url);
	$url = explode("/", $url);
	$param = array_values(array_diff($url, array('')));

	global $wpdb;

	echo "<pre>";
		print_r($param);
	echo "</pre>";

	if( in_array($param[0], $paginas) ){
		if( file_exists( __DIR__."/wlabels/".$param[0].".php" ) ){
			//include( __DIR__."/wlabels/".$param[0].".php" );
		}
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


		
