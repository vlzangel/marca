<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */ #

wp_enqueue_style( 'home_css', TEMA()."/css/home.css", array(), "1.0.0" );
wp_enqueue_style( 'home_responsive', TEMA()."/css/responsive/home.css" );

/* BEGIN POPUP Nutriheroes */		
wp_enqueue_style( 'nutriheroes_modal', TEMA()."/css/nutriheroes.css" );
wp_enqueue_style( 'nutriheroes_responsive', TEMA()."/css/responsive/nutriheroes_responsive.css" );
/* END POPUP Nutriheroes   */		

/* BEGIN POPUP Nutriheroes */		
wp_enqueue_style( 'contacto_ayuda', TEMA()."/css/contacto-ayuda.css" );
wp_enqueue_style( 'contacto_ayuda_responsive', TEMA()."/css/responsive/contacto-ayuda_responsive.css" );
/* END POPUP Nutriheroes   */		

get_header(); 

/* BEGIN POPUP Nutriheroes */		
include_once( 'template/parts/footer/Nutriheroes.php' );
/* END POPUP Nutriheroes   */		

/* BEGIN POPUP Nutriheroes */
include_once( 'template/parts/footer/contacto_ayuda.php' );
/* END POPUP Nutriheroes   */		
	

?>
	<?php echo MENU(); ?>
	<header id="header" class="row">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" class="img-responsive" width="75%">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 text-center">
				<img src="<?php echo get_home_url(); ?>/img/logo_by_kmimos.png" class="img-responsive">
				<h2 style="font-size:21; position: relative; top: -10px!important;"> El camino a una correcta nutrición</h2>
				<br>
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox">
					COMPRAR
				</a>
			</div>
		</div>
	</header>

	<section id='section-comment' class="row text-center ">
		<div class="container ">
			<h3>
				Las mejores marcas de alimento para tu peludo al mejor precio
			</h3>
		</div>
	</section>

	<section id="como-funciona" class="row text-center">
		<div class="container">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<img src="<?php echo get_home_url(); ?>/img/Imagen-2.png" class="img-responsive">
				<p>Asesores nutricionales 
					<br class="hidden-sm hidden-xs">
					certificados
				</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 border-lateral">  
				<img src="<?php echo get_home_url(); ?>/img/Imagen-3.png" class="img-responsive">
				<p>Entregado en tu 
					<br class="hidden-sm hidden-xs">
					casa sin costo adicional
				</p>
		    </div>
		    <div class="col-xs-12 col-sm-4 col-md-4">  
				<img src="<?php echo get_home_url(); ?>/img/Imagen-4.png" class="img-responsive">
				<p>Más barato que en una 
					<br class="hidden-sm hidden-xs">
					veterinaria
				</p>

			</div>
		</div>	
	</section>

	<section id="home-opciones" class="row text-center ">		
		<div class="container">
			<img src="<?php echo get_home_url(); ?>/img/Image-5.jpg" class="img-responsive" style="width: 80%;" >

			<label id="si-encuentras-precio" >
					<span>¡Si encuentras un precio más barato,</span>
				    muéstranos tu ticket y lo mejoramos!
			</label>
			<br>
			<p id="precio-vet">
					Precios de veterinaria o tiendas*
				
			</p>

		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="row text-center">
		<div class="container">
			<h2>¿Cómo funciona Nutriheroes?</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span class="marca-circle">1</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
					<p>Escoge la marca y presentaci&oacute;n de tu preferencia</p>
				</div> 
				<div class="col-xs-12 col-sm-4 col-md-4"> 	
					<span class="marca-circle_2">2</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
					<p>Brindale a tu asesor nutricional tu información básica para el envío </p>
				</div>	
				<div class="col-xs-12 col-sm-4 col-md-4"> 
					<span class="marca-circle_2" >3</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive" >
					<p>Recibe tu orden de compra y realiza tu pago </p>	
				</div> 
			</div>
			<div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
				<span class="marca-circle_2">4</span>
				<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
				<p>Recibe el producto en tu casa u oficina sin costo adicional</p>
			</div>

			<label>
				"Podrás pagar <b style="color: #000000">en efectivo</b> en miles de tiendas por conveniencia"
			</label>
		</div>
	</section>

	<section class="row text-center" id="home-dog">
		<div>
			<h4>Un alimento especial para un Compañero especial</h4>
		</div>
		<div id="dog" style="background: url(<?php echo get_home_url(); ?>/img/dog.jpg) no-repeat center center;"></div>
	</section>

	<section id="regalasela-amigo" class="row text-center">
		<div class="container">
			<h2 id="quiero-convertirme-asesor">
				Quiero convertirme en asesor
			</h2>
			<div class="col-sm-12">
				<img src="<?php echo get_home_url(); ?>/img/asesor_2.png" >
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
				<p>
					¿Quieres convertirte en asesor nutricional canino y formar parte de nuestro equipo? Click aquí y te explicaremos cómo. 
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3" id="asesor">
				<a href="<?php echo get_home_url(); ?>/quiero-ser-asesor/" 
					class="btn-kmibox">QUIERO CONVERTIRME EN ASESOR</a> 
			</div>
		</div>
	</section>
 
	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>


 