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
		<div >
			<img src="[IMG_PATH]confirmacion/recuperar_contraseña01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div style="text-align: center;font-size: 17px;line-height: 27px>
				<label>Recientemente hemos recibido una solicitud para<br> <strong>Recuperar la contraseña de su cuenta</strong></label>

				<label>r.rodriguez@kmimos.la</label>

<br><br><br><br>
				<label>Si no haz sido tu, ignora este mensaje.<strong>Para continuar con la recuperacion de la contraseña de tu cuenta haz click en el siguiente enlace:</strong> </label> 	
				<br><br><br><br><br>
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
			>Recuperar contraseña</a>

		</div>

		
	


	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>