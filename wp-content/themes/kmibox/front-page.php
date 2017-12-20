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
 */ 

get_header(); ?>
	<header id="header" class="row">
		<?php get_template_part( 'template/parts/header/content', 'page' ); ?>
		<article>
			<div class="container" id="banner">
				<div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-0">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.png" 	 class="img-responsive">
				</div>
				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-sm hidden-lg hidden-md">
					<img src="<?php echo get_home_url(); ?>/img/marca.jpg" class="img-responsive">
					<h2 style="font-size: 14px"><b>Es una dotación mensual de alimento<br> para tu mascota</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox" style="margin-bottom: 2% ">Comprar</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-xs ">
					<img src="<?php echo get_home_url(); ?>/img/marca.jpg" class="img-responsive">
					<h2 style="font-size: 25px"><b>Es una dotación mensual de alimento<br> para tu mascota</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox" style="margin-bottom: 2% ">Comprar</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div class="col-xs-12 col-sm-6 hidden" id="banner-dog">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.png" class="img-responsive">
				</div>
			</div>			
		</article> 
	</header>

	<section id='section-comment' class="row text-center ">
		<div class="container hidden-xs">
			<h3 style="font-size: 35px"><B>¿No encuentras el alimento de tu perrito en la tienda?</B></h3>
			<h2 style="font-family: PoetsenOne_Regular">¡Eso se acabó!</h2>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<h3><B>¿No encuentras el alimento de tu perrito en la tienda?</B></h3>
			<h2 style="font-family: PoetsenOne_Regular">¡Eso se acabó!</h2>
		</div>
	</section>

	<section id="como-funciona" class="row text-center">
		<div class="container hidden-xs" >
			<div style="float:left;width:33%;">    
				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive" >
					<p>
						<B>No mas viajes largos</B> a comprar <br>alimento para tu perrito
						</p>									    
			</div>
			<div style="float:left;width:33%;">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive" >
					<p>
						Con <i><strong>Marca</strong></i> tienes la seguridad <br>que <i><strong>le das lo mejor</strong></i>
					</p>
		    </div>
		    <div style="float:left;width:33%;">  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive" >
					<p>
						No más cambios de precio, con <i><strong>Marca</strong></i> siempre <i><strong>sabes cuánto vas a pagar</strong></i>
					</p>
			</div>
		</div>	
		<div  class="container hidden-sm hidden-md hidden-lg" >
				<div class="col-xs-6"  >    				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive">
					<p style="font-size: 9px">
						<B>No más viajes largos</B> a comprar <br>alimento para tu perrito
						</p>									    
				</div>
				<div class="col-xs-6">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive">
					<p style="font-size: 9px">
						Con <i><strong>Marca</strong></i> tienes la seguridad <br>que <i><strong>le das lo mejor</strong></i>
					</p>
		  	    </div>
		    	<div class="col-xs-6 col-xs-offset-3">  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive">
					<p style="font-size: 9px">
						No más cambios de precio, con <i><strong>Marca</strong></i> siempre <i><strong>sabes cuánto vas a pagar</strong></i>
					</p> 
				</div>
		</div>			
	</section>

	<section class="row text-center ">
		<div class="container  hidden-xs">
			<img src="<?php echo get_home_url(); ?>/img/bar-1.png" class="img-responsive">	
		</div>
		<div class="container1 visible-xs" style="background-color: #007bd8; color: #ffffff">
			<p style="color: #ffffff; font-size: 14px">
				Recibe en la puerta de tu casa una dotación de alimento de que si nutre
			</p>
				<h2 style="color: #ffffff; font-family:PoetsenOne_Regular">¡Suficiente para un mes!</h2>
		</div>
		<div class="container">
			<img src="<?php echo get_home_url(); ?>/img/Image-5.jpg" class="img-responsive" >
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<label style="color: #a9d433;font-size: 20px;font-family: PoetsenOne_Regular;margin-left: -31%;">Un alimento <span style="color: #ebb931">especial</span></label>
			<label style="color: #a9d433;font-size: 20px;font-family:  PoetsenOne_Regular;margin-left: 10%;">Para un <span style="color: #ebb931">compañero </span><span style="color: #a9d433">especial</span></label>
		</div>	
		<div class="container hidden-xs hidden-sm">
			<label style="color: #a9d433;font-size: 75px;font-family: PoetsenOne_Regular;margin-left: -31%;">Un alimento<span style="color: #ebb931">especial</span></label>
			<label style="color: #a9d433;font-size: 75px;font-family:  PoetsenOne_Regular;margin-left: 10%;">Para un<span style="color: #ebb931">compañero </span><span style="color: #a9d433">especial</span></label>
		</div>	
		<div class="container hidden-xs hidden-md hidden-lg visible-sm">
			<label style="color: #a9d433;font-size: 45px;font-family: PoetsenOne_Regular;margin-left: -31%;">Un alimento<span style="color: #ebb931">especial</span></label>
			<label style="color: #a9d433;font-size: 45px;font-family:  PoetsenOne_Regular;margin-left: 10%;">Para un<span style="color: #ebb931">compañero </span><span style="color: #a9d433">especial</span></label>
		</div>			
	</section>

	<section id='section-comment1' class="row text-center ">
		<div class="container hidden-xs">
			<h2 style="color: #ffffff;font-weight: none; font-size: 55px">¿Cómo funciona la <span style="font-family: PoetsenOne_Regular">Marca</span>?</h2>
		</div>
		<div class="container hidden-sm hidden-lg hidden-md">
			<h2 style="color: #ffffff;font-weight: none; font-size: 25px">¿Cómo funciona la <span style="font-family:PoetsenOne_Regular">Marca</span>?</h2>
		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="rowtext-center">
		<div class="container">
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<div class="row hidden-xs">
					<div style="float:left;width:33%;">
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style="margin-left: 5px">
								<B>Elige</B> si tu perrito es
								cachorro o adulto
							</p>
					</div> 
					<div style="float:left;width:33%;"> 	
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 20px">
								Selecciona el alimento<br>ideal para él
							</p>
					</div>	
					<div style="float:left;width:33%;"> 
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive">
							<p>
								Si lo deseas <B>Añade</B> un jueguete
								o regalo 
							</p>	
					</div> 
					
							<div  style='clear:both;'></div>

					<div style="float:left;width:50%;"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p>
								<B>Paga</B> con tarjeta o *efectivo
							</p>
					</div> 
					<div style="float:left;width:50%;"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-5.png" class="img-responsive" >
						<p>
							<B>Recibe</B> tu marca en la puerta de tu casa
						</p>
					</div> 	
				</div>
				<div class="row visible-xs" > 	
						<div class="col-xs-6">
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style=" font-size: 9px">
								<B>Elige</B> si tu perrito es
								cachorro o adulto
							</p>
					</div> 
					<div class="col-xs-6"> 	
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 5px ; font-size: 9px">
								Selecciona el alimento ideal para él
							</p>
					</div>	
					<div class="col-xs-6"> 
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive">
							<p style="font-size: 8px">
								Si lo deseas <B>Añade</B> un jueguete
								o regalo 
							</p>	
					</div> 	
					<div class="col-xs-6"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p style="font-size: 9px">
								<B>Paga</B> con tarjeta o *efectivo
							</p>
					</div> 
							<div  style='clear:both;'></div>
					<div class="col-xs-7 col-xs-offset-2"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-5.png" class="img-responsive" >
						<p style="font-size: 9px">
							<B>Recibe</B> tu marca en la puerta de tu casa
						</p>
					</div> 
				</div> 	
				
			
		</div>
	</section>

	<section style="color:#ffffff;	background: #f2bc3d;background-size: contain;padding: 25px 0px 25px 0px;" class="row text-center ">
		<div class="container hidden-xs">
			<h4 style="color:#ffffff; font-size: 25px; font-family: caviar_dreamsregular; ">*Paga en efectivo en miles de tienda de conveniencia</h4>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg visible-xs">
			<h4 style="color:#ffffff; font-size: 12px; font-family: caviar_dreamsregular; ">*Paga en efectivo en miles de tienda de conveniencia</h4>
		</div>
	</section>

	<section class="row text-center">
		<div class="container">
			<h2 style="color:#94d400;font-weight: bold; font-size:30px; font-family: caviar_dreamsregular; " >¡Regálasela a un amigo o un familiar!</h2>
				<br>
			<div class="col-sm-12">
				<img src="<?php echo get_home_url(); ?>/img/Elemento.png" id="regalo" class="img-responsive" >
			</div>
			<br>			<br>
				<p style="font-size: 14px">Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
				él se nutre y tu amigo o familiar no se preocupa más</p>			
				<br><br>	
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox">Comprar</a> <!--<?php echo get_permalink(); ?>/quiero-mi-kmibox/?source=<?php echo (array_key_exists('source', $_GET))? $_GET['source'] : '' ; ?>-->
		</div>
	</section>
	<br>
	<br>


	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>


 