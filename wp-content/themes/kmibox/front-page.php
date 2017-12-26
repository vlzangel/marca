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
	<!--?php echo MENU(); ?-->
	<header id="header" class="row">
		<?php get_template_part( 'template/parts/header/content', 'page' ); ?>
		<article>
			<div class="container" id="banner" style="margin-bottom: 3%">
				<div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-0">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" 	 class="img-responsive">
				</div>
				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-sm hidden-lg hidden-md">
					<img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive"> 
					<h2 style="font-size: 14px"><b>El camino de una correcta nutrición</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox" style="margin-bottom: 2% ">Comprar</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-xs ">
					<img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive" style="margin-top: 45%">
					<h2 style="font-size: 25px"><b>El camino de una correcta nutrición</b></h2>
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
			<h3 style="font-size: 24px"><B>La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento <br> a tu casa u oficina, sin costo de envío</B></h3>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<h3><B>La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento a tu casa u oficina, sin costo de envío</B></h3>
		</div>
	</section>

	<section id="como-funciona" class="row text-center" style="margin-top: 5%">
		<div class="container hidden-xs" >

			<div style="float:left;width:33%;">    
				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive" >
					<p>
						<b>Asesores nutricionales<br>certificados</b>
						</p>									    
			</div>
			<div style="float:left;width:33%;">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive" >
					<p>
						<b>Entregado en tu <br> casa sin costo adicional</b>
					</p>
		    </div>
		    <div style="float:left;width:33%;">  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive" >
					<p>
						<b>Más barato que en una<br> veterinaria</b>
					</p>
			</div>
		</div>	
		<div  class="container hidden-sm hidden-md hidden-lg" >
				<div class="col-xs-6"  >    				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive">
					<p style="font-size: 9px">
						<b>Asesores nutricionales<br>certificados</b>
						</p>									    
				</div>
				<div class="col-xs-6">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive">
					<p style="font-size: 9px">
						<b>Entregado en tu <br> casa sin costo adicional</b>
					</p>
		  	    </div>
		    	<div class="col-xs-6 col-xs-offset-3">  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive">
					<p style="font-size: 9px">
						<b>Más barato que en una<br> veterinaria</b>
					</p> 
				</div>
		</div>			
	</section>

	<section class="row text-center ">
		
		<div class="container">
			<img src="<?php echo get_home_url(); ?>/img/Image-5.jpg" class="img-responsive" >
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<label style="color: #ebb931;font-size: 20px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas <span style="color: #000000">TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 16px">Puedes escoger la mejor para tu mascota</label>
		</div>	
		<div class="container hidden-xs hidden-sm">
			<label style="color: #a9d433;font-size: 41px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas<span style="color: #000000">TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 23px">Puedes escoger la mejor para tu mascota</label>
		</div>	
		<div class="container hidden-xs hidden-md hidden-lg visible-sm">
			<label style="color: #a9d433;font-size: 45px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas<span style="color: #000000">TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 23px">Puedes escoger la mejor para tu mascota</label>
		</div>			
	</section>

	<section id='section-comment1' class="row text-center ">
		<div class="container hidden-xs">
			<h2 style="color: #000000;font-weight: bold; font-size: 34px">¿Cómo funciona la Marca?</h2>
		</div>
		<div class="container hidden-sm hidden-lg hidden-md">
			<h2 style="color: #000000;font-weight: bold; font-size: 25px">¿Cómo funciona la Marca?</h2>
		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="rowtext-center">
		<div class="container" style="margin-top: 5%">
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<div class="row hidden-xs">
					<div class="col-md-4 col-sm-4">
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style="margin-left: 5px; font-size: 14px; color: #000000; text-align: center;">
								Escoge la marca y presentacion <br> de tu preferencia
							</p>
					</div> 
					<div class="col-md-4 col-sm-4"> 	
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 20px; font-size: 12px; color: #000000; text-align: center;">
								Brindale a tu asesor nutricional tu <br> información básica para el envio 
							</p>
					</div>	
					<div class="col-md-4 col-sm-4"> 
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive">
							<p style="font-size: 12px; color: #000000; text-align: center;">
								Recibe tu orden de compra y realiza <br> tu pago 
							</p>	
					</div> 
					
							<div  style='clear:both;'></div>

					<div class="col-md-offset-3 col-sm-6 text-center" style="margin-top: 4%"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p style="font-size: 12px; color: #000000 ; text-align: center;">
								Recibe el producto en tu casa u <br> oficina sin costo adicional
							</p>
					</div> 

					<label style="text-align: center; font-size: 171%; font-weight: normal; margin-left: 14%">"Podrás pagar <b>en efectivo</b> en miles de tienda por conveniencia"</label>
					
				</div>
				<div class="row visible-xs" > 	
						<div class="col-xs-6">
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style=" font-size: 12px; color: #000000; text-align: center;">
									Escoge la marca y presentacion <br> de tu preferencia
							</p>
					</div> 
					<div class="col-xs-6"> 	
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 12px ; font-size: 9px; color: #000000; text-align: center;">
								Brindale a tu asesor nutricional tu <br> información básica para el envio 
							</p>
					</div>	
					<div class="col-xs-6"> 
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive">
							<p style="font-size: 12px; color: #000000; text-align: center;">
								Recibe tu orden de compra y realiza <br> tu pago  
							</p>	
					</div> 	
					<div class="col-xs-6" style="margin-top: 4%"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p style="font-size: 12px; color: #000000; text-align: center;">
								Recibe el producto en tu casa u <br>oficina sin costo adicional 
							</p>
					</div> 

					<label style="text-align: center; font-size: 171%; font-weight: normal">"Podrás pagar <b>en efectivo</b> en miles de tienda por conveniencia"</label>
							<div  style='clear:both;'></div>
					
				</div> 	
				
			
		</div>
	</section>

	<section style="color:#ffffff;	background: #091705;background-size: contain;padding: 25px 0px 25px 0px;" class="row text-center ">
		<div class="container hidden-xs">
			<h4 style="color:#ffffff; font-size: 25px; font-family: PoetsenOne_Regular; ">Un alimento especial	para un comñero especial</h4>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg visible-xs">
			<h4 style="color:#ffffff; font-size: 14px; font-family: PoetsenOne_Regular; font-weight: normal">Un alimento especial	para un comñero especial</h4>
		</div>
	</section>

	<section class="row text-center">
		<div class="container" style="margin-bottom: 3%">
			<div class="container  hidden-xs">
			<img src="<?php echo get_home_url(); ?>/img/Image-3.jpg" class="img-responsive">	
		</div>
			<h2 style="color:#000000;font-weight: bold; font-size:30px; font-family: caviar_dreamsregular; " >¡Regálasela a un amigo o un familiar!</h2>
				<br>
			<div class="col-sm-12">
				<img src="<?php echo get_home_url(); ?>/img/box.png" id="regalo" class="img-responsive" >
			</div>
			<br>			<br>
				<p style="font-size: 20px; color: #000000" >Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
				él se <br> nutre y tu amigo o familiar no se preocupa más</p>			
				<br><br>	
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox">Comprar</a> <!--<?php echo get_permalink(); ?>/quiero-mi-kmibox/?source=<?php echo (array_key_exists('source', $_GET))? $_GET['source'] : '' ; ?>-->
		</div>
	</section>
	<br>
	<br>


	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>



 