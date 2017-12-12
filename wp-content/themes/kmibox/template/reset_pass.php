<?php
/* 
 *
 * Template Name: Reset password
 *
 */
get_header(); 

$autorizado = reset_password_confirm();

?>
<header class="row">
	<?php get_template_part( 'template/parts/header/content', 'page' ); ?>
</header>
<section class="container">

	<?php if( $autorizado['code'] == 1){ ?>
		<?php get_template_part( 'template/parts/page/change_password', 'page' ); ?>
	<?php }else{ ?>
		<?php if( $autorizado['sts'] != '' ){?>
			<aside class=" <?php echo $hidden; ?> col-md-6 col-xs-12 col-md-offset-3 alert alert-danger"><?php echo $autorizado['sts']; ?></aside>
		<?php } ?>
		<?php get_template_part( 'template/parts/page/reset_password', 'page' ); ?>
	<?php } ?>

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

