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
		<div class="pull-center" style="text-align:center; font-size: 30px ! important;">
		<table cellspacing=5 cellpadding=0 style="text-align: center;">
			<tr>
					<td>
						<img src="[IMG_PATH]confirmacion/general.jpg"/>
					</td>
					<td >
						<div>
							<div><strong>royal canin</strong></div>
							<div>Raza Media Adulta 10kg</div>
							<div>Bimestral</div>
							<div<strong>$ 938.4 MXN</strong></div>
						</div>						
					</td>
				</tr>
			</table>
			</div>
				<br>
			<label class="text" style="text-align:center; font-size: 16px;line-height: 27px;">De manera que enviemos el producto a tu casa y no tengas que preocuparte por nada m&aacute;s</label>
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
				"
			>Realizar pago</a>
			<br><br><br>

	

	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>