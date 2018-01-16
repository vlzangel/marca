<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Felicidades Rodrigo!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu registro fue exitoso
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]registro/registro01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				<label><strong>¡Gracias por registrarte en Nutriheroes!</strong> ahora necesitas confirmar tu correo para activar tu cuenta.</label>

		</div>
		<div>
		<h3>la direci&oacute;n asosciada a tu cuenta es:</h3>
		<label>r.rodriguez@kmimos.la</label>
		<br>
		</div>

			<div>

				<label>para confirmar la direccion de correo electr&oacute;nico<strong>haz click en este enlace:</strong> </label> 	
				<br>
				<a 	href="" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#091705;
					color: #fff;
					margin: 20px 0px;
				\"
			>confirmar correo</a>
			<br>
			<label class="text-center">si recibiste este correo sin haberte registrado, por favor ignoralo.</label> 
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