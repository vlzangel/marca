		</div>

		<script type="text/javascript" src="<?php echo get_home_url(); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo get_home_url(); ?>/wp-content/themes/kmibox/lib/jquery.waterwheelCarousel.min.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/plugins/bootstrap-validator/bootstrapValidator.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/js/backpanel.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/js/cargar-orden.js"></script>
		<script type='text/javascript' src="<?php echo get_home_url(); ?>/js/init.js"></script>


		<?php 
			global $post;
			if( $post->post_name == "quiero-mi-marca" ){
			 	wp_footer(); 
			}
			// cargarTablaProductos()
		?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114199320-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-114199320-1');
		</script>

		<?php wlabel(); ?>
	</body>
</html>
