<?php
/* 
 *
 * Template Name: profile 
 *
 */
get_header(); 

if ( is_user_logged_in() ){  
?>

	<header class="row">
		<?php get_template_part( 'template/parts/header/suscription', 'checkout' ); ?>
	</header>
<br>
	<div class="row" class="profile-content">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="col-sm-3 col-xs-12 col-md-3 tab-especial"><a href="#mi_senvios" aria-controls="mi_senvios" role="tab" data-toggle="tab">Mis Envios</a></li>
			<li role="presentation" class="col-sm-3 col-xs-12 col-md-3 tab-especial active"><a href="#mi_suscripcion" aria-controls="mi_suscripcion" role="tab" data-toggle="tab">Mi suscripción</a></li>
			<li role="presentation" class="col-sm-3 col-xs-12 col-md-3 tab-especial"><a href="#donde" aria-controls="donde" role="tab" data-toggle="tab">¿Dónde está mi Marca?</a></li>
			<li role="presentation" class="col-sm-3 col-xs-12 col-md-3 tab-especial"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Mi Información</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane" id="info">
				<div class="col-sm-12">
					<?php get_template_part( 'template/parts/page/profile', 'page' ); ?>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="mi_senvios">
				<div class="col-sm-12">
					<?php get_template_part( 'template/parts/page/myshipments', 'page' ); ?>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane active" id="mi_suscripcion">
				<div class="col-sm-12">
					<?php get_template_part( 'template/parts/page/mysuscription', 'page' ); ?>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="donde">
				<div class="col-sm-12">
					<?php get_template_part( 'template/parts/page/whereisit', 'page' ); ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="hidden-xs">
	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>
	</div>
<?php } ?>

<?php get_footer(); ?>


<?php if ( !is_user_logged_in() ){ ?>
<script type="text/javascript">
	$(function($){
		window.location = urlbase + '/iniciar-sesion';
	});
</script>
<?php } ?>

