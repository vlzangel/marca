 <?php
/* 
 *
 * Template Name: purchase 
 *
 */

get_header(); 
// Reset Session
km_session_reset();
$info = get_user_info();	
$email = $info['email'];
get_template_part( 'template/parts/header/suscription', 'page' ); 


?>

<section id="group-purchase" class="purchase">
	<!-- Fase #1 Tamaño -->
	<section data-fase="11">

		<article data-group="carrousel">
			<div>	 
				<img src='<?php echo get_home_url(); ?>/img/p_pequeno.png'  class="img-responsive" id="Grande" />
			</div>
			<div>
				<img src='<?php echo get_home_url(); ?>/img/p_mediano.png'  class="img-responsive" id="Mediano" />
			</div>
			<div>
				<img src='<?php echo get_home_url(); ?>/img/p_adulto.png'  class="img-responsive" id="Pequeño" />
			</div>
		</article>

		<div id="edad" class="hidden">
			<br> <br> <br> 
			<div style="float:left;width:35%;">    
				<label style="margin-left: 35px;font-weight: bold;font-family: PoetsenOne_Regular; font-size:30px; color:#900e9c;">
					<B>Selecciona la edad:</B>
				</label>
			</div>				
			<div style="float:right;width:20%;"> 
				<button
					data-action="next"
					data-target="1" 
					data-value="Maduro" 
					style="color:#900e9c; font-family: caviar_dreamsregular;font-size: 18px; background-color: #fff; border : 1px solid #fff">
					<b>Maduro</b>
				</button>
			</div>
			<div style="float:right;width:20%;"> 
				<button
					data-action="next"
					data-target="1" 
					data-value="Adulto" 
					style="color:#900e9c; font-family: caviar_dreamsregular;font-size: 18px; background-color: #fff; border : 1px solid #fff"">
					<b>Adulto</b>
				</button>
			</div>  
			<div style="float:right;width:20%;"> 
				<button
					data-action="next"
					data-target="1" 
					data-value="Cachorro" 
					style="color:#900e9c; font-family: caviar_dreamsregular;font-size: 18px;background-color: #fff; border : 1px solid #fff"">
					<b>Cachorro</b>
				</button>
			</div>				
		</div>
						
	</section>
	
	<!-- Fase #2 Producto -->
	<section 
		data-fase="2"
		class ="hidden"
		>		

			<section id="carrousel1"></section>	

			<div id="presentaciones" data-value="" >
				<div style="float:left;width:35%;">    
					<label style="margin-left: 35px;font-weight: bold;font-family: PoetsenOne_Regular; font-size:30px; color:#900e9c;">
						<B>Selecciona la presentaci&oacute;n:</B>
					</label>
				</div>	
				<div style="float:right;width:20%;    padding: 10px;"> 
					<button
						id="presentacion-4000g"
						data-action="next"
						data-target="2" 
						data-value="4000g" 
						style="color:#900e9c; font-family: PoetsenOne_Regular;font-size: 18px; background-color: #fff; border : 1px solid #fff">
							<b>G</b> (4000g)
					</button>
				</div>
				<div style="float:right;width:20%;    padding: 10px;"> 
					<button
						id="presentacion-2000g"
						data-action="next"
						data-target="2" 
						data-value="2000g" 
						style="color:#900e9c; font-family: PoetsenOne_Regular;font-size: 18px; background-color: #fff; border : 1px solid #fff"
						>
						<b>M</b> (2000g) |
					</button>
				</div>  
				<div style="float:right;width:20%;    padding: 10px;"> 
					<button
						id="presentacion-900g"
						data-action="next"
						data-target="2" 
						data-value="900g" 
						style="color:#900e9c; font-family: PoetsenOne_Regular;font-size: 18px;background-color: #fff; border : 1px solid #fff""
						>
							<b>P</b> (900g) |
					</button>
				</div>				
			</div>
	</section>

	<!-- Fase #3 Plan -->
	<section 
		id="plan"
		data-fase="3" 
		class="container purchase animated text-center bounceInRight hidden" 
		>
		<article id="plan-Quincenal" class="text-center col-sm-4 separation-top">
			<img class="img-responsive" src="http://marca.dev/img/Quincenal.png" width="300px" height="370px">
			<button 
				class="btn btn-sm-kmibox btn-sm-kmibox-price" 
				data-action="next" 
				data-value="Quincenal" 
				data-target="3" 
				data-object="221" 
				data-color="#94d400" 
				style="background: rgb(144, 14, 156);"
			>
				Quincenal
			</button>
		</article>
		<article id="plan-Mensual" class="text-center col-sm-4 separation-top">
			<img class="img-responsive" src="http://marca.dev/img/Mensual.png" width="300px" height="370px">
			<button class="btn btn-sm-kmibox btn-sm-kmibox-price" data-action="next" data-value="Mensual" data-target="3" data-object="220" data-color="#94d400" style="background: rgb(144, 14, 156);">Mensual</button>
		</article>
		<article id="plan-Bimestral" class="text-center col-sm-4 separation-top">
			<img class="img-responsive" src="http://marca.dev/img/Bimestral.png" width="300px" height="370px">
			<button class="btn btn-sm-kmibox btn-sm-kmibox-price" data-action="next" data-value="Bimestral" data-target="3" data-object="219" data-color="#94d400" style="background: rgb(144, 14, 156);">Bimestral</button>
		</article>
		<span><br><span class="text-center col-sm-12 separation-top fontspan">Descuento en comparación con el precio unitario mensual*</span></span>
	</section>


	<!-- Fase #4 Extras >
	<section 
		data-fase="4" 
		class="container purchase hidden animated "
		data-title ="Agrega un artículo especial"
		data-subtitle="Da click sobre el producto para agregar "
		data-msg-color="#94d400"
		data-msg ="">
		<div class="col-sm-12 ">
			<div class="row" id="content-extra">
				<article id="f4-slider-prev" class="col-md-1 col-md-offset-1 text-center vertical-center">
					<i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
				</article>

				<article id="f4-slider-item1" 
					class="hidden-xs hidden-sm col-md-1 text-center vertical-center">
					<img src=""  class="img-responsive" width="300px">
				</article>
				<article id="f4-slider-item2" 
					class="hidden-xs hidden-sm col-md-2 text-center vertical-center">
					<img src=""  class="img-responsive" width="300px">
				</article>

				<article id="f4-slider-item3" data-target="add"
					class="col-xs-12 col-sm-12 col-md-4 text-center vertical-center">
					<img src=""  class="img-responsive" height="300px" width="300px">
				</article>

				<article id="f4-slider-item4" 
					class="hidden-xs hidden-sm col-md-2 text-center vertical-center">
					<img src=""  class="img-responsive" width="300px">
				</article>
				<article id="f4-slider-item5" 
					class="hidden-xs hidden-sm col-md-1 text-center vertical-center">
					<img src=""  class="img-responsive" width="300px">
				</article>
				<article id="f4-slider-next" class="col-md-1 text-center vertical-center">
					<i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
				</article>
			</div>

			<div class="row text-center extra-detalle">
				<h2 id="extra-price"></h2>
				<h3 id="extra-name"></h3>
				<button
					data-action="next"
					data-target="4"
					class="btn btn-sm-kmibox">Continuar</button>
			</div>
		</div>
	</section-->

	<!-- Fase #5 Resumen de Compras -->
	<section 
		data-fase="4" 
		class="container purchase hidden animated "
		data-title ="Resumen de compras"
		data-subtitle=""
		data-msg-color="transparent"
		data-msg ="">
		<article class="col-md-12">


			<div class="row">
				<div class="col-xs-12 col-md-12 hidden alert alert-danger alert-dismissible fade in" role="alert" id="cart-content-alerta">
					<span id="cart-alerta"></span>
				</div>
			</div>
				
			<header class="row">
				<article class="col-md-2">Producto</article>
				<article class="col-md-6 hidden-xs ">Descripci&oacute;n</article>
				<article class="col-md-2 hidden-xs ">Frecuencia</article>
				<!--article class="col-md-2 hidden-xs ">Cantidad</article-->
				<article class="col-md-2 hidden-xs ">Total</article>
			</header>
			<section id="cart-items" class="row">
				
			</section>
			<aside id="totales" class="row">
				<div class="col-xs-12 col-md-6 pull-right">
					<article class="row">
						<label class="col-xs-12 col-sm-8 text-right">Productos en esta compra:</label>
						<label class="col-xs-12 col-sm-4 bg-light currency" id="cant-item"></label>
					</article>
					<article  class="row">
						<label class="col-xs-12 col-sm-8 text-right">Total sin IVA:</label>
						<label class="col-xs-12 col-sm-4 bg-light currency" maxlength="6" id="subtotal"></label>
					</article>
					<article class="row">
						<label class="col-xs-12 col-sm-8 text-right">IVA:</label>
						<label class="col-xs-12 col-sm-4 bg-light currency" maxlength="6" id="iva"></label>
					</article>
					<div class="row  text-center">
						<article class="col-xs-12 col-sm-4 col-sm-offset-8 pull-right">
							<label>Total:</label>
						</article>
						<article class="col-xs-12 col-sm-4 bg-total col-sm-offset-8 pull-right">
							<label id="total" maxlength="6" class="currency"></label>
						</article>
					</div>
				</div>
			</aside>
			<!--button type="button" class="btn btn-sm-kmibox btn-extend" data-toggle="modal" data-target="#suscription">Pagar</button-->
		</article>

		
		<article class="col-md-12 text-center">

			<a href="#" data-toggle="modal" data-target="#suscription"><img src='<?php echo get_home_url(); ?>/img/Bot¢n-1.png'   alt="Cinque Terre"  width="220" height="60"/></a>

		</article>		
	</section>	

</section>

<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" id="suscription">
		<div class="Modal content" id="suscription" >			     
			<div  class="btn btn-sm-kmibox"  style="border-color:#fffff1; border-style: solid; border-width: 14px;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
				<div class="row" >
					<div  style='clear:both;'></div>
					<div style="float:left;width:50%;">    
						<img src='<?php echo get_home_url(); ?>/img/tarjeta.png'  alt="Cinque Terre" class="img-responsive" width="250" height="240"/>
						<a href="<?php echo get_home_url(); ?>/pagar-mi-marca"  id="pagar" role="button"  data-target="suscription"><img src='<?php echo get_home_url(); ?>/img/btn_tarjeta.png' class="img-responsive" alt="Cinque Terre" width="220" height="80"/></a>
					</div>
					<div style="float:left;width:50%;" >    
						<img src='<?php echo get_home_url(); ?>/img/efectivo.png'  alt="Cinque Terre" class="img-responsive" width="250" height="250"/>
						<a href="#" type="button" id="tienda" data-target="suscription"><img src='<?php echo get_home_url(); ?>/img/btn_efectivo.png'   alt="Cinque Terre"  width="220" height="60"/></a>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>	


		<div id="pago_efectivo" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">

			  <div class="modal-dialog" id="pago_efectivo">

			    <!-- Modal content-->
			    <div class="Modal content" id="pago_efectivo" >			     
			      

			      <div  class="btn btn-sm-kmibox"  style=" background-color:#ffffff">

			      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
				<div>						

							<div style=" background-color: #00d8b5; text-align: center;">
								<h3>Estas a un paso de conseguir tu <img src='<?php echo get_home_url(); ?>/img/logo-text-white.png' width="80" height="25" /></h3>
							</div>

							<div style="text-align: center;">

							<label style="font-size: 12px; font-family: Arial; text-align: justify; color: #000000;">Hola para realizar el pago de tu kmibox en tienda de conveniencia, por favor sigue la siguientes intrucciones.</label>
							</div>
				    <br>

					<div>    

<div>
				<div>
				    <div style="float:left;width:25%;">    
						<img src='<?php echo get_home_url(); ?>/img/Correo_de_instrucciones_pago_en_efectivo1.png' width="150" height="150" />
					</div>
				    <div style="float:left;width:25%;">    
				      <img src='<?php echo get_home_url(); ?>/img/Correo_de_instrucciones_pago_en_efectivo2.png' width="150" height="150" />	
					</div>
				    <div style="float:left;width:25%;">    
						<img src='<?php echo get_home_url(); ?>/img/Correo_de_instrucciones_pago_en_efectivo3.png' width="150" height="150" />
					</div>	
					 <div style="float:left;width:25%; ">    
						<img src='<?php echo get_home_url(); ?>/img/Correo_de_instrucciones_pago_en_efectivo4.png' width="150" height="150" />
					</div>	
				</div>	
				<div style=" text-align: center;">
				   <div style="float:left;width:25%; color: #000000; font-size: 12px;"> 
						<label>Descarga tu ficha de pago e <br>imprimela o llevala en tu <br> movil</label>
					</div>
				    <div style="float:left;width:25%; color: #000000;font-size: 12px;"> 
				      	<label>Acude a cualquiera de los <br>cientos de tiendas de <br>conveniencia indicadas <br>en tu ficha de pago</label>	    
					</div>
				    <div style="float:left;width:25%; color: #000000; font-size: 12px;"> 
						<label>Realiza el pago por el monto <br>señanalado de acuerdo a tu <br>suscripción, se reflejará de manera <br>automatica a tu perfil kmibox</label>
					</div>	
					 <div style="float:left;width:25%;color: #000000;font-size: 12px;"> 
						<label>Ya estas listo para<br> recibir tu kmibox</label>
					</div>	
					<div  style='clear:both;'></div>
				</div>	


			</div> 
		  		
</div>


<br>	
					<div style="text-align: center;">					
						<div style=" background-color: #F5DA81; padding: 5px">

							<h4 style=" color: #000000">Descarga tu ficha de pago aqui</h4>

						</div>
<br>
						
						<div style="background: #00d8b5; border-radius: 40px; color: #ffffff; padding: 10px; text-decoration:none; width: 280px ; margin-left: 170px">		
							
							<a style="color: #ffffff;" id="Descarga"  data-target="suscription">Descargar mi ficha de pago 
															
									</a> 

									<!--?php include( realpath( __DIR__ . '/../../template/email/pago_tienda.php' ) );
									wp_mail(
									$email, 	
									"Pago Tienda por conveniencia", 
									$HTML);?-->
				
			

						</div>
					</div>
					
					</div>
						     
			    </div>
			   </div>
			  </div>
			</div>	

<?php 

get_template_part( 'template/parts/footer/footer', 'fase1' ); 

get_footer();

