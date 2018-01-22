<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header');
	$footer = getTemplate('/generales/footer');

	$titulo = '
		<div style="font-family: Arial;">
			<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
				¡Hola rob!
				<div  class="text" style="font-size: 13px;  padding: 10px 20px 0px; font-weight: 400;"> 
					Tu pedido fue enviado
				</div>
			</div> 

			<div>
				<img src="[IMG_PATH]notificacion_envio/compra01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
			</div>

			<div style="text-align: center; font-size: 17px; line-height: 100%; margin: 30px 0px 40px;">
				Los <strong>detalles de tu pedido</strong> se indican a continuaci&oacute;n
			</div>

			<div style="text-align: left; font-size: 15px; line-height: 100%;">
				<div style="margin: 20px 0px 10px; font-weight: 600; text-transform: uppercase;">tu fecha estimada de entrega es</div>
				<label style="color: #535353;">Lunes 15 de enero - Jueves 18 de enero</label>
			</div>

			<div style="text-align: left;font-size: 15px;line-height: 100%;">
				<div style="margin: 20px 0px 10px; font-weight: 600; text-transform: uppercase;">tipo de envio</div>
				<label style="color: #535353;">Fedex</label>
			</div>

			<div style="text-align: left; font-size: 15px; line-height: 100%;">
				<div style="margin: 20px 0px 10px; font-weight: 600; text-transform: uppercase;">tu pedido sera enviado a</div>
				<div style="color: #535353;">
					<div> Rob cuevas </div>
					<div> Paseo de la luna 370, interior 124 </div>
					<div> Paseo de solares </div>
					<div> Zapopan, Jalisco 45019 </div>
					<div> M&eacute;xico </div>
				</div>
			</div>

			<div style="text-align: left; font-size: 15px; line-height: 100%; margin: 30px 0px;">
				<div style="margin: 20px 0px 10px; font-weight: 600; text-transform: uppercase;">detalles del pedido.</div>
				<label style="color: #535353;">Pedido No.123456 realizado el lunes 08 de enero</label>
			</div>

			<div style="font-size: 15px;">
				<table cellspacing=0 cellpadding=0 style="width: 100%;">
					<tr>
						<td style="width: 100px; padding-right: 45px;">
							<img style="width: 100%;" src="[IMG_PATH]confirmacion/general.png"/>
						</td>
						<td>
							<div>
								<div style="text-transform: uppercase; font-weight: 600; margin: 10px 0px; font-size: 17px;">royal canin</div>
								<div style="font-size: 16px; color: #535353; margin-bottom: 5px;">Raza Media Adulta 10kg</div>
								<div style="font-size: 16px; color: #535353;">Bimestral</div>
								<div style="text-transform: uppercase; font-weight: 600; margin: 10px 0px;">$ 938.4 MXN</div>
							</div>						
						</td>
					</tr>
				</table>
			</div>

			<hr>

			<div style="font-size: 15px; margin-bottom: 50px;">
				<table cellspacing=3 cellpadding=3 style="width: 100%;">
					<tr>
						<td> &nbsp; </td>
						<td style="width: 150px; color: #535353;"> Subtotal: </td>
						<td style="width: 150px; text-align: right; font-weight: 600;"> $ 1320 MXN </td>
					</tr>
					<tr>
						<td> &nbsp; </td>
						<td style="width: 150px; color: #535353;"> Total (IVA Incluido): </td>
						<td style="width: 150px; text-align: right; font-weight: 600;"> $ 1500 MXN </td>
					</tr>
				</table>
			</div>

		</div>
	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	// wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>