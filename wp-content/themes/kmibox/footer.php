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
		/* wp_footer(); */

/*		$tamanos = array(
			"Pequeño" => 1,
			"Mediano" => 1,
			"Grande" => 1
		);

		$edad = array(
			"Cachorro" => 1,
			"Adulto" => 1,
			"Maduro" => 1
		);

		$presentaciones = array(
			"900g" => 500,
			"2000g" => 500,
			"4000g" => 500
		);

		$planes = array(
			"Quincenal" => 1,
			"Mensual" => 1,
			"Bimestral" => 1
		);

		$imgs = array(
			"9" => "NUPEC.png",
			"22" => "dow-chow.png",
			"164" => "Tier-holistic.png",
			"173" => "Royal-canin.png",
			"188" => "Belenes-max.png"
		);

		global $wpdb;

		$productos = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'product' AND post_status = 'publish' ");

		$base = 500;
		$contador = 100;

		echo "<pre>";

			foreach ($productos as $key => $producto) {
				$extras = array(
					"img" => $imgs[$producto->ID]
				);
				$presentaciones = array(
					"900g" => $base+$contador,
					"2000g" => $base+$contador,
					"4000g" => $base+$contador
				);
				$sql = "
					INSERT INTO productos VALUES (
						NULL, 
						'".strtolower($producto->post_title)."', 
						'".serialize($tamanos)."', 
						'".serialize($edad)."', 
						'".serialize($presentaciones)."', 
						'".serialize($planes)."', 
						'".serialize($extras)."',
						'activo'
					);
				";

				$wpdb->query($sql);

				$contador += 100;
			}
			
		echo "</pre>";*/
	?>
</body>
</html>
