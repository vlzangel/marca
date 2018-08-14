<?php
/* 
 *
 * Template Name: Pago Tienda 
 *
 */
 
	if( !isset($_SESSION) ){ session_start(); }

	if( !isset($_SESSION["CARRITO"]) ){
		header("location: ".get_home_url()."/quiero-mi-marca/");
	}

	$CARRITO = unserialize( $_SESSION["CARRITO"] );

	get_header(); 
?>

<section class="container3"> <?php 
	if ( !is_user_logged_in() ){ ?>
		<aside class="col-md-6 col-xs-12 hidden col-md-offset-3 alert alert-danger" id="login-mensaje"></aside>
		<aside class="col-md-12 ">
			<?php get_template_part( 'template/parts/page/login', 'page' ); ?>
		</aside>
		<aside class="col-md-12 hidden" id="content-register-checkout">
			<?php get_template_part( 'template/parts/page/register', 'page' );  ?>
		</aside> <?php	
	}else{
	 	$current_user = wp_get_current_user();
	    $user_id = $current_user->ID;	

		$cliente = array(
			"user" => $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users WHERE ID = ".$user_id),
			"metas" => get_user_meta( $user_id )
		);

		$camposObligatoris = array(
			'first_name',
			'telef_movil',
			'dir_estado',
			'dir_ciudad',
			'dir_colonia',
			'dir_calle',
			'dir_codigo_postal',
			'dir_numext',
			'dir_numint'
		);

		$permitido = true;
		foreach ($camposObligatoris as $campo ) {
			if( $cliente["metas"][ $campo ][0] == "" ){
				$permitido = false;
				break;
			}
		}

		if( $permitido ){
			get_template_part( 'template/parts/page/checkout-tienda', 'page' );
		}else{
			$PAGE_ACTUAL = "pago-tienda";
			get_template_part( 'template/parts/page/faltan-datos', 'page' ); 
		}

	} ?>
</section>

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

<?php get_footer(); ?>