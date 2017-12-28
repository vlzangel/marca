 <?php
/* 
 *
 * Template Name: Quiero mi Marca 
 *
 */

	get_header(); 

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		$PLANES .= '
			<article id="plan-'.$plan->plan.'" class="select_plan">
				<img class="img-responsive" src="'.get_home_url().'/img/x'.$plan->plan.'.png">
				<button 
					class="btn btn-sm-marca btn-sm-kmibox-price postone" 
					data-value="'.$plan->id.'" 
				>
					'.$plan->plan.'
				</button>
			</article>
		';
	}

	$HTML = '
		<link rel="stylesheet" href="'.TEMA().'/css/proceso_compra.css">

		<div class="controles_generales" id="vlz_atras">
			
		<div>

		<div class="controles_generales" id="vlz_titulo">
			
		<div>

		<div class="controles_generales" id="vlz_controles_fases">

		<div>




			<a class="vlz_boton" id="btn-atras" href="#" data-value="0">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S
			</a>

			<label class="header_titulo" id="header"></label>

		<div class="comprar_container">

			<section id="fase_1">
				<div class="comprar_box">
					<div id="vlz_carrousel" class="vlz_carrousel hidden-xs carro">
						<img src="'.get_home_url().'/img/edad/Cachorro.png"  class="img-responsive" width="400px" id="Pequeño" />
						<img src="'.get_home_url().'/img/edad/Mediano.png"  class="img-responsive" width="400px" id="Mediano" />	
						<img src="'.get_home_url().'/img/edad/Adulto.png"  class="img-responsive"  width="400px" id="Grande" />
					</div>
					<div id="carrousel_responsive" class="vlz_carrousel hidden-md hidden-sm hidden-lg" style="margin-top:12%"> 
						<img src="'.get_home_url().'/img/edad/Cachorro-resp.png"  class="img-responsive" width="250px" id="Pequeño" />
						<img src="'.get_home_url().'/img/edad/Mediano-resp.png"  class="img-responsive" width="250px" id="Mediano" />	
						<img src="'.get_home_url().'/img/edad/Adulto-resp.png"  class="img-responsive"  width="250px" id="Grande" />
					</div>
				</div>
				
			</section>

		</div>

		<div id="suscription" class="modal fade img-responsive" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" id="suscription">
				<div class="Modal content text-center" id="suscription" >			     
					<div  class="btn btn-sm-marca"  style=" background-color:#ffffff; border-color:#fffff1; border-style: solid; border-width: 14px; /*display: inline-block; */">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btn_cerrar">X</button>
						<div class="row" >
							<div  style="clear:both;"></div>
							<div style="float:left;width:50%;">								
								<a href="#"  id="pagar" role="button"  data-target="suscription"><img src="'.get_home_url().'/img/tarjeta.png" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago con tarjeta</label></a>
							</div>
							<div style="float:left;width:50%;" > 
								<a href="#" type="button" id="tienda" data-target="suscription"><img src="'.get_home_url().'/img/efectivo.png" width="240" height="180"/><br><label style="caviar_dreamsregular">Pago en efectivo</label></a>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/functions_new.js"></script>');
?>

