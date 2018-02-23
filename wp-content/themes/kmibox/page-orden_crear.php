<?php
/* 
 *
 * Template Name: Orden Crear
 *
 */

wp_enqueue_style( 'cargar-ordenes', TEMA()."/css/ordenes.css", array(), "1.0.0" );

get_header();
?>

<?php include( "template/parts/header/cargar-orden.php" ); ?>

<div class="container">
	<?php include( "template/parts/page/cargar-orden.php" ); ?>
</div>
<?php get_footer();
