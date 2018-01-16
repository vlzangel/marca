<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola Rodrigo!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu contraseña va hacer recuperada
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]recuperar_contraseña/recuperar_contraseña01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				<label>recientemente hemos recibido una solicitud para
				<strong>Recuperar la contraseña de su cuenta</strong></label>

				<label>r.rodriguez@kmimos.la</label>


				<label>Si no haz sido tu, ignora este mensaje.<strong>Para continuar con la recuperacion de la contraseña de tu cuenta haz click en el siguiente enlace:</strong> </label> 	
				
				<a 	href="" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#091705;
					color: #fff;
					margin: 20px 0px;
				\"
			>Recuperar contraseña</a>

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

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>