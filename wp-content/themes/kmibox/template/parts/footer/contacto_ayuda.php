<?php

	wp_enqueue_style( 'contacto_ayuda', TEMA()."/css/contacto-ayuda.css" );

	wp_enqueue_style( 'contacto_ayuda_responsive', TEMA()."/css/responsive/contacto-ayuda_responsive.css" );
//	wp_enqueue_script('contacto_ayuda_script', TEMA()."/js/contacto_ayuda.js" );
?>

<section id="contacto-ayuda" >
	
	<article class="ayuda-imagen">
		<img src="<?php echo TEMA(); ?>imgs/contacto-ayuda/people_single.png" class="img-responsive">
	</article>
	<article class="ayuda-texto">
		<h2>
			Si tienes alguna duda de c&oacute;mo comprar,<br class="hidden-xs">
			<span>con&eacute;ctate con uno de nuestros asesores</span>
		</h2>
	</article>
	<article class="ayuda-form">
		<form>
			<input type="text" name="email" placeholder="Correo Electr&oacute;nico" class="form-control">
			<input type="text" name="telef" placeholder="N&uacute;mero tel&eacute;fono" class="form-control">
			<button type="submit" class="btn btn-kmibox btn-xs">ENVIAR</button>
		</form>
	</article>

</section>
