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
			<img src="[IMG_PATH]cancelacion/cancelacion01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>

		<div>
				<strong>Esperamos que regreses pronto para poder llevar el alimento de tu peludo a casa sin ning&uacute;n costo adicional.</strong>
				<br>
				<label>Si hay un error, y no has cancelado tu suscripci&oacute;n o quieres volver <strong>haz click en el siguiente enlace</strong></label> 	
				<br>
				<a 	href="" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#091705;
					color: #fff;
					margin: 20px 0px;
				\"
			>click aqui</a>

		</div>
		<div>
			<label>para cualquier duda o informaci&oacute;n no dudes en escribirnos por esta via o por whatsapp al <strong>5540034824</strong> donde con gusto te atenderemos</label>
		</div>	
	

		<div style="float:left;width:50%;>
			<img src="[IMG_PATH]confirmacion/general.jpg" style="width: 50%; margin: 0px 0px 10px; " />
		</div>

			<div style="float:left;width:50%;>
			<label>Recuerda que con tu suscripci&oacute;n tienes un <strong>10%</strong> de descuento en TODOS los servicios kmimos durante todo un año acumulables con otras promociones <br> Kmimos es la mayor red de cuidadores certificados de Mexico, que cuidan a las mascotas en el hogar del cuidador, sin jaulas ni encierros</label>
		</div>

	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com", "Prueba", $HTML);
?>