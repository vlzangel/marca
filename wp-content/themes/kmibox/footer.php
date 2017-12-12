<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
?>

	</div><!-- Container-fluid -->

	<script type="text/javascript" src="<?php echo get_home_url(); ?>/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo get_home_url(); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo get_home_url(); ?>/wp-content/themes/kmibox/lib/jquery.waterwheelCarousel.min.js"></script>
	<?php get_template_part( 'template/parts/footer/service', 'page' ); ?>

	<?php 
		#wp_footer();
	?>
</body>
</html>
