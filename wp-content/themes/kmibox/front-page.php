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

get_header(); ?>

	<?php echo MENU(); ?>
	<header id="header" class="row">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" class="img-responsive" width="75%">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 text-center">
				<img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive">
				<h2>El camino de una correcta nutrición</h2>
				<br>
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox">
					COMPRAR
				</a>
			</div>
		</div>
	</header>

	<section id='section-comment' class="row text-center ">
		<div class="container ">
			<h3>La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento 
				<br class="hidden-sm hidden-xs">
				a tu casa u oficina, sin costo de envío
			</h3>
		</div>
	</section>

	<section id="como-funciona" class="row text-center">
		<div class="container">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<img src="<?php echo get_home_url(); ?>/img/Image-2.svg" class="img-responsive">
				<p>Asesores nutricionales 
					<br class="hidden-sm hidden-xs">
					certificados
				</p>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 border-lateral">  
				<img src="<?php echo get_home_url(); ?>/img/Image-3.svg" class="img-responsive">
				<p>Entregado en tu 
					<br class="hidden-sm hidden-xs">
					casa sin costo adicional
				</p>
		    </div>
		    <div class="col-xs-12 col-sm-4 col-md-4">  
				<img src="<?php echo get_home_url(); ?>/img/Image-4.svg" class="img-responsive">
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
			<label>
				Las mejores marcas <span> TODAS EN UN MISMO LUGAR</span>
			</label>
			<br>
			<p>Puedes escoger la mejor para tu mascota</p>
		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="row text-center">
		<div class="container">
			<h2>¿Cómo funciona Nutriheroes?</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<span class="marca-circle">1</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-1.svg" class="img-responsive">
					<p>Escoge la marca y presentaci&oacute;n de tu preferencia</p>
				</div> 
				<div class="col-xs-12 col-sm-4 col-md-4"> 	
					<span class="marca-circle_2">2</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-2.svg" class="img-responsive">
					<p>Brindale a tu asesor nutricional tu información básica para el envío </p>
				</div>	
				<div class="col-xs-12 col-sm-4 col-md-4"> 
					<span class="marca-circle_2" >3</span>
					<img src="<?php echo get_home_url(); ?>/img/Icon-3.svg" class="img-responsive" >
					<p>Recibe tu orden de compra y realiza tu pago </p>	
				</div> 
			</div>
			<div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4">
				<span class="marca-circle_2">4</span>
				<img src="<?php echo get_home_url(); ?>/img/Icon-4.svg" class="img-responsive" >
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
			<h2>
				¡Regálasela a un amigo o un familiar!
			</h2>
			<div class="col-sm-12">
				<img src="<?php echo get_home_url(); ?>/img/Box-01.svg" id="regalo" class="img-responsive" >
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
				<p>
					Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
					él se nutre y tu amigo o familiar no se preocupa más
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" 
					class="btn-kmibox">COMPRAR</a> 
			</div>
		</div>
	</section>
 
	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>


 