<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola Daniel!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Recuerda hacer el pago de tu suscripci&oacute;n
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]recordatorio/recordatorio01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				<strong>Recuerda hacer el pago de tu suscripci&oacute;n</strong>

		</div>

		<table cellspacing=0 cellpadding=0 class=\'desglose_final\'>
			<tr>
				<th colspan=2 > <div> Producto </div> </th>
				<th class=\'solo_pc\'> <div> Periodicidad </div> </th>
				<th class=\'solo_pc\'> <div> Mascota </div> </th>
			</tr>
			<tr>
					<td>
						<img src=\'".TEMA()."/imgs/productos/".$data["img"]."\' />
					</td>
					<td class=\'info\'>
						<div>
							<div class=\'info_2\'>".$productos[ $value->producto ]->nombre."</div>
							<div>".$productos[ $value->producto ]->descripcion."</div>
							<div>".$productos[ $value->producto ]->peso."</div>
						</div>
						<div class=\'info_3 solo_movil\'>
							<div class=\'mayuscula\'>".$value->plan."</div>
							<div>".$value->tamano." - ".$value->edad."</div>
						</div>
					</td>
					<td class=\'periodicidad solo_pc\'>".$value->plan."</td>
					<td class=\'solo_pc\'>".$value->tamano." - ".$value->edad."</td>
				</tr>
			</table>

			<label>De manera que enviemos el producto a tu casa y no tengas que preocuparte por nada m&aacute;s</label>

			<a 	href="" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#091705;
					color: #fff;
					margin: 20px 0px;
				\"
			>Realizar pago</a>
			

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