<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			¡Hola Nayely!			

		</div>
		<div>
			<img src="[IMG_PATH]confirmacion/header.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				<strong>Tu suscripci&oacute;n ya est&aacute; en camino</strong>. Por te brindamos la siguiente informac&iacute;on de tu compra

		</div>
		<div>
		<h3>Direci&oacute;n de envio</h3>
		</div>
		<div>
		<h3>Fecha de entrega estimada</h3>
		</div>
		<div>
		<h3>tipo de env&iacute;o</h3>
		</div>
		<div>
		<h3>guia de rastreo</h3>
		</div>

		<div>
		<h3>Entra en <strong>WWW.fedex.com</strong> e ingresa tu numero de gu&iacute;a para monitorear tu entrega</h3>
		<hr>
		</div>
		<div>
		<h3>detalles del pedido</h3>

		<table cellspacing=0 cellpadding=0 >
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
							<div>"royal canin"</div>
							<div>"Raza Media Adulta</div>
							<div>"10kg"</div>
						</div>
						<div>
							<div>"semestral"</div>
							<div>"Pequeño - Adulto"</div>
						</div>
					</td>
					<td>".$value->plan."</td>
					<td>".$value->tamano." - ".$value->edad."</td>
				</tr>
			
		</div>

		<div>
		<h3>total de suscripcion</h3>
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