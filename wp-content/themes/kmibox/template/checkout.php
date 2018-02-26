<?php
/* 
 *
 * Template Name: checkout 
 *
 */
 
	if( !isset($_SESSION) ){ session_start(); }

	if( !isset($_SESSION["CARRITO"]) ){
		header("location: ".get_home_url()."/quiero-mi-marca/");
	}

	$CARRITO = unserialize( $_SESSION["CARRITO"] );

	get_header(); 
?>

<div style="
	z-index: 1000;
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 70px;
    background: #FFF;
">
	<a class="controles_generales" id="vlz_atras" href="<?php echo get_home_url()."/quiero-mi-marca/"; ?>">
		<i class="fa fa-chevron-left" aria-hidden="true"></i> ATR&Aacute;S	
	</a>

	<div class="controles_generales" id="vlz_titulo">
		Completa el pago
	</div>
</div>

<div style="
	z-index: 500;
">

	<section class="container3">
		<?php if ( !is_user_logged_in() ){ ?>
			<aside class=" container3 col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
			<aside class=" container3 col-md-12 ">
				<?php get_template_part( 'template/parts/page/login', 'page' ); ?>
			</aside>
			<aside class="col-md-12 hidden" id="content-register-checkout">
				<?php get_template_part( 'template/parts/page/register', 'page' );  ?>
			</aside>
		<?php	
			}else{
				get_template_part( 'template/parts/page/checkout', 'page' ); 
			}
		?>
	</section>

</div>

<?php get_template_part( 'template/parts/footer/suscription', 'page' ); ?>

<script type="text/javascript">
	$(function($){
		$('[data-action="prev"]').addClass('hidden');
		$('#register').addClass('hidden');
		$('#title').addClass('hidden');
		$('#section-msg').addClass('hidden');
		$('#link-registro').attr( 'href', '#registro' );
		$('#link-login').attr( 'href','#inicio-sesion' );
	});
</script>

<?php
	get_footer(); 
?>