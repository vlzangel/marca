 <?php
/* 
 *
 * Template Name: Quiero mi Marca template
 *
 */
	
	wp_enqueue_style( 'proceso_compra', TEMA()."/css/proceso_compra.css", array(), "1.0.0" );
	wp_enqueue_style( 'responsive_proceso_compra', TEMA()."/css/responsive/proceso_compra.css", array(), "1.0.0" );

	wp_enqueue_style( 'a', TEMA()."/css/marca.css", array(), "1.0.0" );

	get_header(); 

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$PLANES = "";
	foreach ($data_planes as $plan) {
		$PLANES .= '
			<article id="plan-'.$plan->plan.'" data-value="'.$plan->id.'" class="select_plan">
				<img class="img-responsive" src="'.TEMA().'/imgs/planes/'.$plan->plan.'.svg">
				<span class="precio_plan"></span>
				<div>
					'.$plan->descripcion.'
				</div>
			</article>
		';
	}
?>

		<a class="controles_generales" id="vlz_atras" href="#">
			<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S	
		</a>

		<div class="controles_generales" id="vlz_titulo">
			Elije el tamaño de tu mascota
		</div>

		<div class="controles_generales" id="vlz_controles_fases">
			<span id="fase_indicador_1" class="fase_activa"></span>
			<span id="fase_indicador_2" ></span>
			<span id="fase_indicador_3" ></span>
			<span id="fase_indicador_4" ></span>
		</div>

		<div class="comprar_container">


			<!-- FASE 2 - SELECCIONA TU MARCA -->
			<section id="fase_1" class="container marcas-list">

				<div class="col-sm-12">
					<span>20 RESULTADOS</span>
					<div class="pull-right col-xs-2">
						<select class="form-control">
							<option value="perros">PERROS</option>
							<option value="gatos">GATOS</option>
						</select>
					</div>
				</div>

 				<?php for ($i=1; $i < 9; $i++) { ?>
				<article class="col-xs-12 col-sm-6 col-md-3 text-center">
					<div class="row"  data-target="items">
						<img src="<?php echo get_home_url(); ?>/img/productos/marcas/6.PNG" class="img-responsive" id=""/>
					</div>
				</article>
				<?php } ?>
				  
				<div class="col-sm-12">
					<button class="btn btn-marca btn-lg pull-right">SIGUIENTE</button>
				</div>
			</section>

			<!-- FASE 2.1 - SELECCIONA TU PRESENTACION -->
			<section id="fase_2" class="hidden container marcas-list">

				<div class="col-sm-12">
					<span>20 RESULTADOS</span>
				</div>

 				<?php for ($i=1; $i < 9; $i++) { ?>
				<article class="col-xs-12 col-sm-6 col-md-3 text-center">
					<div class="row">
						<img src="<?php echo get_home_url(); ?>/img/productos/Belenes-max.png" width="70%" class="img-responsive" id=""/>
						<strong>ROYAL CANIN</strong><br>
						<span>Raza media adulta</span><br>
						<h2>13,9 Kg</h2>
					</div>
				</article>
				<?php } ?>
				  
				<div class="col-sm-12">
					<button class="btn btn-marca btn-lg pull-right">SIGUIENTE</button>
				</div>
			</section>

		</div>

<?php

	echo comprimir($HTML);

	get_footer();

	
	echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/functions_new.js"></script>');
	echo comprimir('<script type="text/javascript" src="'.TEMA().'/js/marca.js"></script>');
?>
 
