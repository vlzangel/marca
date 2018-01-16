<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola rob!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu pedido fue enviado
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]notificacion_envio/compra01.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				los<strong>detalles de tu pedido</strong> se indican a contici&oacute;n

		</div>

		<div>
		<h3>tu fecha estimada de entrega es</h3>
		<label>lunes 15 de enero - jueves 18 de enero</label>
		</div>
		<div>
		<h3>tipo de envio</h3>
		<label>fedex</label>
		</div>
		<div>
		<h3>tu pedido sera enviado a</h3>
		<label>rob cuevas paseo de la luna 370, interior 124 Paseo de solares Zapopan, Jalisco 45019 M&eacute;xico</label>
		</div>
		<div>
		<h3>detalles del pedido</h3>
		<label>pedido No.123456 realizado el lunes 08 de enero</label>
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
			<hr>
			<div style="float:left;width:50%;>
			<label>Subtotal</label>
			<label>Total(IVA incluido)</label>
			</div>
			<div style="float:left;width:50%;>
			<label>$1500 MXN</label>
			<label>$1703,4 MXN</label>
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