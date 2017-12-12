<?php
/* 
 *
 * Template Name: register
 *
 */
get_header(); 
?>

<header  class="row">
	<?php get_template_part( 'template/parts/header/registro', 'usuario' ); ?>
</header>
<section class="container">
	<input type="hidden" name="redirect" value="<?php echo get_home_url(); ?>/perfil-usuario">
<?php if ( !is_user_logged_in() ){
		get_template_part( 'template/parts/page/register', 'page' ); 
	}
?>
</section>

<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>

<?php if ( is_user_logged_in() ){ ?>
<script type="text/javascript">
	$(function($){
		window.location = urlbase + '/perfil-usuario';
	});
</script>
<?php } ?>

