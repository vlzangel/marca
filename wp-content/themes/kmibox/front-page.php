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

get_header(); ?>
	<?php echo MENU(); ?>
	<header id="header" class="row" style="margin-bottom: 2%">		
		<article>
			<div class="container" id="banner" style="margin-bottom: 4%">
				<div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-0 hidden-xs hidden-sm">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" 	 class="img-responsive" style="width: 59%;     margin-top: -5%;">
				</div>
				<div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-0 hidden-sm hidden-lg hidden-md">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" style="width: 182px;margin-left: -29%;">
				</div>

				<div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-0 hidden-xs hidden-lg hidden-md">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.jpg" style="width: 71%;margin-left: -8%; margin-top: 5%">
				</div>

				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-sm hidden-lg hidden-md">
					<img src="<?php echo get_home_url(); ?>/img/Logo.png" class="img-responsive"> 
					<h2 style="font-size: 14px; font-family: caviar_dreamsregular; color: #181E0D !important"><b>El camino de una correcta nutrición</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox gothan" style="margin-bottom: 2%; font-family: GothanMedium_regular">COMPRAR</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-xs hidden-sm">
					<img src="<?php echo get_home_url(); ?>/img/Logo.png"  style="margin-top: 11%; width: 126%">
					<h2 style="font-size: 22px ; font-family: caviar_dreamsregular ; color: #181E0D !important"><b>El camino de una correcta nutrición</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox gothan" style="margin-bottom: 2%; font-family: GothanMedium_regular; padding: 22px 92px !important; font-size: 32px !important" >COMPRAR</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div id="banner-text" class="col-xs-12 col-sm-12 col-md-5 hidden-xs hidden-lg hidden-md " style="margin-left: -19%">
					<img src="<?php echo get_home_url(); ?>/img/Logo.png"  style="margin-top: 11%; width: 85%; margin-left: 35%">
					<h2 style="font-size: 22px ; font-family: caviar_dreamsregular ; color: #181E0D !important"><b>El camino de una correcta nutrición</b></h2>
					<br>	
					<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox gothan" style="margin-bottom: 2%; font-family: GothanMedium_regular; padding: 22px 92px !important; font-size: 32px !important" >COMPRAR</a> <!--<?php echo get_home_url(); ?>/quiero-mi-kmibox/?source=<?php echo get_source_url(); ?>-->	
				</div>

				<div class="col-xs-12 col-sm-6 hidden" id="banner-dog">
					<img src="<?php echo get_home_url(); ?>/img/Image_1.png" class="img-responsive">
				</div>
			</div>			
		</article> 
	</header>

	<section id='section-comment' class="row text-center ">
		<div class="container hidden-xs">
			<h3 style="font-size: 24px; font-family: Gothamlight_Regular">La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento <br> a tu casa u oficina, sin costo de envío</h3>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<h3 style="font-family: Gothamlight_Regular; font-size: 16px;">La mayor red de Asesores de Nutrición para tu mascota, que te envian tu alimento a tu casa u oficina, sin costo de envío</h3>
		</div>
	</section>

	<section id="como-funciona" class="row text-center" style="margin-top: 5%">
		<div class="container hidden-xs" style="    margin-top: -3%;" >

			<div style="float:left;width:33%;" >    
				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive" style="    margin-bottom: 5%;">
					<p style="  font-family:  Gothamlight_Regular;">
						Asesores nutricionales<br>certificados
						</p>									    
			</div>
			<div style="float:left;width:33%;">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive" style="    margin-bottom: 5%;">
					<p style="  font-family:  Gothamlight_Regular;">
						Entregado en tu <br> casa sin costo adicional
					</p>
		    </div>
		    <div style="float:left;width:33%;" >  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive" style="    margin-bottom: 5%;">
					<p style="  font-family:  Gothamlight_Regular;">
						Más barato que en una<br> veterinaria
					</p>
			</div>
		</div>	
		<div  class="container hidden-sm hidden-md hidden-lg" >
				<div class="col-xs-6"  >    				
					<img src="<?php echo get_home_url(); ?>/img/image-2.png" class="img-responsive" style="    margin-bottom: 3%;">
					<p style="font-size: 12px; font-family: Gothamlight_Regular">
						Asesores nutricionales<br>certificados
						</p>									    
				</div>
				<div class="col-xs-6">  
					<img src="<?php echo get_home_url(); ?>/img/Image-3.png" class="img-responsive" style="    margin-bottom: 3%;">
					<p style="font-size: 12px; font-family: Gothamlight_Regular">
						Entregado en tu <br> casa sin costo adicional
					</p>
		  	    </div>
		    	<div class="col-xs-6 col-xs-offset-3">  
					<img src="<?php echo get_home_url(); ?>/img/Image-4.png" class="img-responsive" style="    margin-bottom: 3%;">
					<p style="font-size: 12px; font-family: Gothamlight_Regular">
						Más barato que en una<br> veterinaria
					</p> 
				</div>
		</div>			
	</section>

	<section class="row text-center ">
		
		<div class="container">
			<img src="<?php echo get_home_url(); ?>/img/Image-5.jpg" class="img-responsive" style="width: 60%;" >
		</div>
		<div class="container hidden-md hidden-sm hidden-lg">
			<label style="color: #ebb931;font-size: 20px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas <span style="color: #000000"> TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 16px;font-family: Gothamlight_Regular"">Puedes escoger la mejor para tu mascota</label>
		</div>	
		<div class="container hidden-xs hidden-sm">
			<label style="color: #ebb931;font-size: 41px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas<span style="color: #000000"> TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 23px; font-family: Gothamlight_Regular"">Puedes escoger la mejor para tu mascota</label>
		</div>	
		<div class="container hidden-xs hidden-md hidden-lg visible-sm">
			<label style="color: #ebb931;font-size: 45px;font-family: PoetsenOne_Regular;margin-left: -5%;">Las mejores marcas<span style="color: #000000"> TODAS EN UN MISMO LUGAR</span></label>
			<br>
			<label style="text-align: center; font-weight: normal; font-size: 23px; font-family: Gothamlight_Regular"">Puedes escoger la mejor para tu mascota</label>
		</div>			
	</section>

	<section id='section-comment1' class="row text-center ">
		<div class="container hidden-xs">
			<h2 style="color: #000000;font-weight: bold; font-size: 34px; font-family: GothanMedium_regular">¿Cómo funciona Nutriheroes? </h2>
		</div>
		<div class="container hidden-sm hidden-lg hidden-md">
			<h2 style="color: #000000;font-weight: bold; font-size: 25px; font-family: GothanMedium_regular">¿Cómo funciona Nutriheroes?</h2>
		</div>
	</section>
 
	<section id="como-consigo-kmibox" class="rowtext-center">
		<div class="container">
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<div style="margin-bottom: 2%">
					<br>
				<span  class="hidden-xs" style="/* text-align:  center; */margin-left: 14%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 9px;">1</span>
				<span class="hidden-xs" style="/* text-align:  center; */margin-left: 30%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">2</span>
				<span class="hidden-xs" style="/* text-align:  center; */margin-left: 31%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">3</span>
				</div>
				<div class="row hidden-xs">
					<div class="col-md-4 col-sm-4">
							
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style="margin-left: 5px; font-size: 16px; color: #878a87; text-align: center; font-family: Gothamlight_Regular; margin-top: 8%;">
								Escoge la marca y presentacion <br> de tu preferencia
							</p>
					</div> 
					<div class="col-md-4 col-sm-4"> 	
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 20px; font-size: 16px; color: #878a87; text-align: center; font-family: Gothamlight_Regular;   margin-top: 8%;">
								Brindale a tu asesor nutricional tu <br> información básica para el envío 
							</p>
					</div>	
					<div class="col-md-4 col-sm-4"> 
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive" style="margin-top: 4%; ">
							<p style="font-size: 16px; color: #878a87; text-align: center; font-family: Gothamlight_Regular; margin-top: 10%;">
								Recibe tu orden de compra y realiza <br> tu pago 
							</p>	
					</div> 
					
							<div  style='clear:both;'></div>
					<span class="hidden-xs" style="margin-left: -52%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">4</span>

					<div class="col-md-0 col-sm-12 text-center" style="margin-top: 6%"> 
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p style="font-size: 16px; color: #878a87 ; text-align: center; font-family: Gothamlight_Regular; margin-top: 3%;">
								Recibe el producto en tu casa u <br> oficina sin costo adicional
							</p>
					</div> 

					<label style="text-align: center; font-size: 171%; font-weight: normal; margin-left: 14%; font-family: Gothamlight_Regular; color: #878a87">"Podrás pagar <b style="color: #000000">en efectivo</b> en miles de tienda por conveniencia"</label>
					
				</div>
				<div class="row visible-xs" > 	
					<div class="col-xs-12" style="margin-left: 3%">
						<div style="margin-bottom: 2%">
						<span class="hidden-md hidden-lg hidden-sm" style="/* text-align:  center; */margin-left: 40%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 9px;">1</span>
						</div>
							<img src="<?php echo get_home_url(); ?>/img/Icon-1.png" class="img-responsive">
							<p style=" font-size: 14px; color: #878a87; text-align: center; font-family: Gothamlight_Regular">
									Escoge la marca y presentacion <br> de tu preferencia
							</p>
					</div> 
					<div class="col-xs-12"> 
						<div style="margin-bottom: 2%">
						<span class="hidden-md hidden-lg hidden-sm" style="/* text-align:  center; */margin-left: 43%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">2</span>	
					</div>
							<img src="<?php echo get_home_url(); ?>/img/Icon-2.png" class="img-responsive">
							<p style="margin-left: 12px ; font-size: 14px; color: #878a87; text-align: center; font-family: Gothamlight_Regular">
								Brindale a tu asesor nutricional tu <br> información básica para el envio 
							</p>
					</div>	
							<div  style='clear:both;'></div>
					<div class="col-xs-12" style="margin-left: -5%"> 
						<div style="margin-bottom: 2%">
						<span class="hidden-md hidden-lg hidden-sm" style="/* text-align:  center; */margin-left:49%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">3</span>
					</div>
							<img src="<?php echo get_home_url(); ?>/img/Icon-3.png" class="img-responsive">
							<p style="font-size: 14px; color: #878a87; text-align: center; font-family: Gothamlight_Regular">
								Recibe tu orden de compra y realiza <br> tu pago  
							</p>	
					</div> 	
					<div class="col-xs-12"> 
						<div style="margin-bottom: 2%">
						<span class="hidden-md hidden-lg hidden-sm" style="/* text-align:  center; */margin-left: 45%;font-size: 22px;color: #000000;  text-align: center;font-family: PoetsenOne_Regular;border: 3px solid #091705;   border-radius: 27px;padding: 0px 7px;">4</span>
						</div>
						<img src="<?php echo get_home_url(); ?>/img/Icon-4.png" class="img-responsive" >
							<p style="font-size: 14px; color: #878a87; text-align: center; font-family: Gothamlight_Regular">
								Recibe el producto en tu casa u <br>oficina sin costo adicional 
							</p>
					</div> 

					<label style="text-align: center; font-size: 114%; font-weight: normal; font-family: GothanMedium_regular; color: #878a87">"Podrás pagar <b style="color: #000000">en efectivo</b> en miles de tienda por conveniencia"</label>
							<div  style='clear:both;'></div>
					
				</div> 	
				
			
		</div>
	</section>

	<section style="color:#ffffff;	background: #181E0D;background-size: contain;padding: 25px 0px 25px 0px;" class="row text-center ">
		<div class="container hidden-xs hidden-sm">
			<h4 style="color:#ffffff; font-size: 48px; font-family: PoetsenOne_Regular; ">Un alimento especial	para un compañero especial</h4>
		</div>
		<div class="container hidden-md hidden-sm hidden-lg visible-xs">
			<h4 style="color:#ffffff; font-size: 12px; font-family: PoetsenOne_Regular; font-weight: normal">Un alimento especial	para un compañero especial</h4>
		</div>
		<div class="container hidden-xs hidden-lg hidden-md rowAlimento">
			<h4 style="color:#ffffff; font-size: 29px; font-family: PoetsenOne_Regular; font-weight: normal">Un alimento especial	para un compañero especial</h4>
		</div>
	</section>

	<section class="row text-center">
		<div class="container" style="margin-bottom: 3%">
			<div class="container  hidden-xs hidden-sm">
				<img src="<?php echo get_home_url(); ?>/img/dog.jpg"  style="width: 121%; margin-left: -13%">	
				<span style="padding: 2px 122%; background: #52fa0a; margin-left: -13%"></span>
			</div>
			<div class="container  hidden-xs hidden-lg hidden-md">
				<img src="<?php echo get_home_url(); ?>/img/dog.jpg"  style="width: 114%; margin-left: -13%">	
				<span style="padding: 2px 114%; background: #52fa0a; margin-left: -13%"></span>
			</div>

			<div class="container visible-xs">
				<img src="<?php echo get_home_url(); ?>/img/Image_responsive.jpg" style="width: 123%; margin-left: -13%; margin-top: -4%;">	
				<span style="padding: 2px 120%; background: #52fa0a; margin-left: -10%"></span>
			</div>
			<h2 style="color:#000000;font-weight: bold; font-size:30px; font-family: GothanMedium_regular; " >¡Regálasela a un amigo o un familiar!</h2>
				<br>
			<div class="col-sm-12 hidden-xs">
				<img src="<?php echo get_home_url(); ?>/img/box.png" id="regalo" class="img-responsive" >
			</div>
			<div class="col-sm-12 hidden-md hidden-sm hidden-lg">
				<img src="<?php echo get_home_url(); ?>/img/box.png" id="regalo" class="img-responsive" style="width: 36% !important">
			</div>
			<br>			<br>
				<p style="font-size: 20px; color: #878a87; font-family: GothanMedium_regular;" class="hidden-xs">Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
				él se <br> nutre y tu amigo o familiar no se preocupa más</p>		


				<p style="font-size: 16px; color: #878a87; font-family: GothanMedium_regular;" class="hidden-md hidden-sm hidden-lg">Regala el alimento nutritivo y necesario que todo amiguito peludo necesita,
				él se <br> nutre y tu amigo o familiar no se preocupa más</p>	

				<br><br>	
				<a href="<?php echo get_home_url(); ?>/quiero-mi-marca/<?php echo get_source_url(); ?>" class="btn-kmibox" style=" font-family:GothanMedium_regular">COMPRAR</a> <!--<?php echo get_permalink(); ?>/quiero-mi-kmibox/?source=<?php echo (array_key_exists('source', $_GET))? $_GET['source'] : '' ; ?>-->
		</div>
	</section>
	<br>
	<br>


	<?php get_template_part( 'template/parts/footer/footer', 'page' ); ?>

<?php get_footer(); ?>


 