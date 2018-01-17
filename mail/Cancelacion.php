<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			¡Hola Nayely!

			<div class="text" style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu suscripci&oacute;n ha sido cancelada con ex&iacute;to
			</div>

		</div>
		<div>
			<img src="[IMG_PATH]cancelacion/cancelacion01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>

		<div style="text-align: center;font-size: 17px;line-height: 27px;">
				<strong>Esperamos que regreses pronto para poder llevar el alimento de tu peludo a casa sin ning&uacute;n costo adicional.</strong>
				<br><br><br><br>
				
				<label style="text-align: center;font-size: 17px;line-height: 27px;">Si hay un error, y no has cancelado tu suscripci&oacute;n o quieres volver <strong>haz click en el siguiente enlace</strong></label> 	
				<br><br><br><br>
				<a 	href="" 
				style="
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#ffffff;
					color: #000;
					margin: 20px 0px;
					border: solid 2px #091705;
					text-align: center;
					margin-left: 45%; 
				"
			>click aqui</a>
<br><br>
		</div>
		

		

	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com", "Prueba", $HTML);
?>