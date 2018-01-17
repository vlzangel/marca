<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			Kmimos te est&aacute; contactando	

		</div> 
		<div>
			<img src="[IMG_PATH]contacto/contacto_kmimos1.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;"/>
		</div>
		<div class="mayuscula" style="text-align: center;font-size: 17px;line-height: 27px;">
				sabemos que quieres el<strong> alimento de tu peludo en tu casa</strong> y sin costo adicional 

		</div>
		<br><br><br><br>
		<div>
			<label style="font-size: 17px;line-height: 27px;">por eso te estamos contact&aacute;ndote v&iacute;a telef&oacute;nica</label>
		<br><br><br><br>
			<label style="font-size: 17px;line-height: 27px;">si no has recibido contacto de ninguno de nuestros asesores,verifica tus datos ac&aacute;</label>
		<br><br><br><br>
		<label style="font-size: 17px;line-height: 27px;">para verificar tus datos</label>
		<a 	href="" 
				style="
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#ffffff;
					color: #000;
					margin: 20px 0px;
					border: solid 3px #091705;
					text-decoration:none;
					text-align: center;
				"
			>haz click aqui</a>
		</div>
		<br><br>
		
		<br>
		

	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>