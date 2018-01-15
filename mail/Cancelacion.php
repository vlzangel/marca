<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			¡Hola Nayely!

			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu suscripci&oacute;n ha sido cancelada con ex&iacute;to
			</div>

		</div>
		<div>
			<img src="[IMG_PATH]confirmacion/header.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "vlzangel91@gmail.com", "Prueba", $HTML);
?>