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
		<link rel="stylesheet" href="'.get_home_url().'/css/quiero.css">

		<!-- BEGIN Estilos nuevos -->
		<link rel="stylesheet" href="'.get_home_url().'/css/marca.css">
		<!-- END Estilos nuevos -->

		<div class="marca-breadcrumb col-xs-1 pull-right text-right">
			<ul class="list-unstyled">
				<li><i class="fa fa-circle selected"></i></li>
				<li><i class="fa fa-circle"></i></li>
				<li><i class="fa fa-circle"></i></li>
				<li><i class="fa fa-circle"></i></li>
				<li><i class="fa fa-circle"></i></li>
			</ul>
		</div>

		<div class="vlz_header">
			<a class="btn btn-sm btn-black pull-left" id="btn-atras" href="#" data-value="0">
				<i class="fa fa-chevron-left" aria-hidden="true"></i> Atras
			</a>
			<label class="header_titulo" id="header">Prueba</label>
		</div>

		<div class="comprar_container">

			<section id="fase_11" class="hidden">

				<div class="carrousel-items col-xs-12 col-md-10 col-md-offset-1">
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_pequeno.png" class="img-responsive img-circle" id="Grande"/>
							<p  class="col-md-12">Pequeño</p>
						</div>
					</article>
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_mediano.png" class="img-responsive img-circle" id="Mediano"/>
							<p  class="col-md-12">Mediano</p>
						</div>
					</article>
					<article>
						<div>
							<img src="'.get_home_url().'/img/edad/p_adulto.png" class="img-responsive img-circle" id="Pequeño"/>
							<p  class="col-md-12">Grande</p>
						</div>
					</article>
				</div>
				<div class="text-center col-xs-12 col-md-8 col-md-offset-2">
					<h2>Selecciona la edad</h2>
					<button id="edad-btn1" data-value="Cachorro" class="col-md-3 btn btn-black">CACHORRO</button>
					<button id="edad-btn1" data-value="Adulto" class="col-md-3 btn btn-black">ADULTO</button>
					<button id="edad-btn1" data-value="Maduro" class="col-md-3 btn btn-black">SENIOR</button>
				</div>
			</section>

			<section id="fase_1" >

				<div class="carrousel2-items col-xs-12 col-md-10 col-md-offset-1">
					<article data-text="Belenes Max">
						<div>
							<img src="'.get_home_url().'/img/productos/Belenes-max.png" class="img-responsive" id=""/>
							<p  class="col-md-12">Belenes Max</p>
						</div>
					</article>

					<article data-text="Dog Chow">
						<div>
							<img src="'.get_home_url().'/img/productos/dow-chow.png" class="img-responsive" id=""/>
							<p  class="col-md-12">Dog Chow</p>
						</div>
					</article>

					<article data-text="Nupec">
						<div>
							<img src="'.get_home_url().'/img/productos/NUPEC.png" class="img-responsive" id=""/>
							<p  class="col-md-12">Nupec</p>
						</div>
					</article>

					<article data-text="Royal Canin">
						<div>
							<img src="'.get_home_url().'/img/productos/Royal-canin.png" class="img-responsive" id=""/>
							<p  class="col-md-12">Royal Canin</p>
						</div>
					</article>

					<article data-text="Tier Holistic">
						<div>
							<img src="'.get_home_url().'/img/productos/Tier-holistic.png" class="img-responsive" id=""/>
							<p  class="col-md-12">Tier Holistic</p>
						</div>
					</article>
				</div>

				<div class="text-center col-xs-12 col-md-8 col-md-offset-2">
					<ul class="tamano-list list-inline list-unstyled">
						<li>P</li>
						<li>M</li>
						<li class="selected">G</li>
						<li>XL</li>
					</ul>
				</div>
				<div class="text-center col-xs-12 col-md-12" style="line-height:50%">
					<div class="col-xs-12 col-md-3">
						<div class="no-pull-right pull-right">
							<strong>SELECCION:</strong>
						</div>
					</div>
					<div class="col-xs-12 col-md-6 text-center producto-titulo">
						<h1 data-target="producto_name">ROYAL CANIN</h1>
						<h2>Raza mediana adulto <span>13.7 KG</span></h2>
					</div>
				</div>
				<div class="text-center col-xs-12 cargar-mas-productos">
					Si no aparece tu marca, <strong data-target="show-list">haz click aqu&iacute;</strong>
				</div>
			</section>

			<section id="product-list" class="hidden">

				<article class="container">
					<div>
						<span>20 RESULTADOS</span>
						<div class="pull-right text-right">
							<input type="text" class="form-control" placeholder="Filtrar por"></input>
						</div>
					</div>
					<div class="row listado-productos">

						<article class="col-xs-6 col-md-3 text-center" data-text="Tier Holistic">
							<div class="col-xs-12">
								<img src="'.get_home_url().'/img/productos/Tier-holistic.png" class="img-responsive" id=""/>
								<div  class="col-md-12"><strong>Tier Holistic</strong></div>
								<div  class="col-md-12">Small Bites Adulto</div>
							</div>
						</article>
   
					</div>
				</article>

				<article class="section-seleccion">
					<div class="container">
						<h1 data-target="producto_name">ROYAL CANIN</h1>
						<h2>Raza mediana adulto <span>13.7 KG</span></h2>
						<span>Presentaci&oacute;n: </span>
						<ul class="tamano-list list-inline list-unstyled">
							<li>P</li>
							<li>M</li>
							<li class="selected">G</li>
							<li>XL</li>
						</ul>
						<span>Cantidad:</span>
						<select><option>1</option></select>
						<button class="btn btn-lg btn-black pull-right"><i class="fa fa-shopping-cart "></i> AGREGAR AL CARRITO</button>
					</div>					
				</article>

				<div class="clear"></div>
			</section>

		</div>


			 
	';

	echo comprimir($HTML);

	get_footer();

	echo comprimir('<script type="text/javascript" src="'.get_home_url().'/js/functions.js"></script>');

	/* BEGIN Scripts Nuevos */
	echo comprimir('<script type="text/javascript" src="'.get_home_url().'/js/marca.js"></script>');
	/* END Scripts Nuevos */
?>

