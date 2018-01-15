<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div id="titulo_header">
			¡Hola Nayely!

			<div id="sub_titulo_header"> 
				Tu suscripci&oacute;n ha sido cancelada con ex&iacute;to
			</div>

		</div>
		<div style="">
			<img src="[IMG_PATH]confirmacion/header.png" id="img_header" />
		</div>
	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "vlzangel91@gmail.com", "Prueba", $HTML);
?>