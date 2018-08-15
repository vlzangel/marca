<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/pago.css?ver=".time(); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo TEMA()."/css/responsive/pagos.css?ver=".time(); ?>">

<section data-fase="6" class="container">
	<!-- Mensaje Success -->
	<article id="pago_exitoso" class="col-md-10 col-xs-12 col-md-offset-1 text-center" style="border-radius:30px; border:1px solid #ccc; overflow: hidden; margin-top: 3%;">
		<aside class="col-md-12 text-center">
			<h1 class="postone text-felicidades">¡Perfil Incompleto!</h1>
			<h4 class="gothan text-suscripcionexitosa">Perdona las molestias, pero para poder generar su orden de forma satisfactoria, es necesario que complete los datos de su perfil de usuario.</h4>
		</aside>
		<div style="text-align: center;">
			<h2 class="text-quedebohacer">¿QUÉ INFORMACIÓN NECESARIA FALTA?</h2>
			<div style="max-width: 400px; text-align: left; margin: 0px auto; font-size: 17px;">
				<?php

					global $PAGE_ACTUAL;

					$current_user = wp_get_current_user();
				    $user_id = $current_user->ID;	

					$cliente = array(
						"user" => $wpdb->get_row("SELECT * FROM {$wpdb->prefix}users WHERE ID = ".$user_id),
						"metas" => get_user_meta( $user_id )
					);

					$camposObligatorios_1 = array(
						'first_name' => 'Su Nombre',
						'telef_movil' => 'Su Teléfono'
					);

					$camposObligatorios_2 = array(
						'dir_estado' => false,
						'dir_ciudad' => false,
						'dir_colonia' => false,
						'dir_calle' => false,
						'dir_codigo_postal' => false,
						'dir_numext' => false,
						'dir_numint' => false
					);

					$camposTXT = array();
					foreach ($camposObligatorios_1 as $key => $campo ) {
						if( $cliente["metas"][ $key ][0] == "" ){
							$camposTXT[] = $campo;
						}
					}

					foreach ($camposObligatorios_2 as $key => $campo ) {
						if( $cliente["metas"][ $key ][0] == "" ){
							$camposTXT[] = 'Su Dirección (o parte de ella)';
							break;
						}
					}
				?>
				<ul class="lista_faltantes">
					<?php
						foreach ($camposTXT as $value) {
							echo "<li>{$value}</li>";
						}
					?>
				</ul>
			</div>
		</div>

		<div class="parrafo">
			Por favor, presione <strong>ACTUALIZAR DATOS</strong> y actualice la información faltante de su perfil.
		</div>

		<div class="parrafo">
			Una vez complete la actualización, será redirigido al proceso de compra.
		</div>

		<aside class="col-md-12 text-center" style="padding-bottom: 10px; color: #FFF !important;">
	      	<a href="<?php echo HOME(); ?>/perfil/" class="btn btn-sm-kmibox" style="padding: 10px 30px; margin:0 auto; font-size: 12px;">ACTUALIZAR DATOS</a>
		</aside>

	</article>

</section>

<?php
	$_SESSION["COMPRA_INCOMPLETA"] = "$PAGE_ACTUAL";
?>