<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			¡Hola Nayely!			

		</div> 
		<div>
			<img src="[IMG_PATH]modificacion/modificacion_suscripcion01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div style="text-align: center;font-size: 17px;line-height: 27px;">
				<strong>Tu suscripci&oacute;n ha siso modificada con &eacute;xito</strong>. 

		</div>
			<br>
		<div>
			<label style="text-align: left;font-size: 17px;line-height: 27px;">verifica los detalles de la modificaci&oacute;n que acabas de realizar</label>
		</div>
			<br>
		<div>
			<h3 style="text-align: center;font-size: 17px;line-height: 27px;">detalles del pedido</h3>

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
					<td>"Pequeño - Adulto"</td>
				</tr>
			</table>
		</div>
<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;">
			<h3>total de suscripcion</h3>
			<label>total</label>
		</div>

		
		


	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>