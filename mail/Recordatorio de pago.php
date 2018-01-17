<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola Daniel!
			
			<div  class="text" style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Recuerda hacer el pago de tu suscripci&oacute;n
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]recordatorio/recordatorio01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div style="text-align: center;font-size: 17px;line-height: 27px;">
				<strong>Recuerda hacer el pago de tu suscripci&oacute;n</strong>

		</div>
				<br>
		<table cellspacing=0 cellpadding=0 style="text-align: center;">
			<tr>
				<th colspan=2 > <div> Producto </div> </th>
				<th> <div> Periodicidad </div> </th>
				<th> <div> Mascota </div> </th>
			</tr>
			<tr>
					<td>
						<img src="[IMG_PATH]confirmacion/general.jpg"/>
					</td>
					<td >
						<div>
							<div>royal canin</div>
							<div>Raza Media Adulta</div>
							<div>10kg</div>
						</div>
						<div>
							<div>semestral</div>
							<div>Pequeño - Adulto</div>
						</div>
					</td>
					<td>semestral</td>
					<td>Pequeño - Adulto</td>
				</tr>
			</table>
				<br>
			<label style="text-align:center; font-size: 17px;line-height: 27px;">De manera que enviemos el producto a tu casa y no tengas que preocuparte por nada m&aacute;s</label>
					<br><br><br><br><br><br>

			<a 	href="" 
				style="
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#ffffff;
					color: #000;
					margin: 20px 0px;
					border: solid 2px #091705;
					text-align: center;
				"
			>Realizar pago</a>
			<br><br><br>

	

	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>