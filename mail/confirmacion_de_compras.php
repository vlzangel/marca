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
				<strong>Tu producto ya est&aacute; en camino</strong>. Por te brindamos la siguiente informac&iacute;on de tu compra

		</div>
		<br><br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">Direci&oacute;n de envio</h3>
			<label>direccion</label>
		</div>
		<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;"> 
			<h3 class="mayuscula">Fecha de entrega estimada</h3>
			<label>fecha</label>
		</div>
		<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">tipo de env&iacute;o</h3>
			<label>fedex</label>
		</div>
		<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">guia de rastreo</h3>
			<label>numero de guia</label>
		</div>
		<br>
		<div class="text" style="text-align: center;font-size: 17px;line-height: 27px;">
			<label>Entra en <strong>WWW.fedex.com</strong> e ingresa tu numero de gu&iacute;a para monitorear tu entrega</label>
		<hr>
		</div>
		<br>
		</div>

		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">detalles del pedido</h3>
	<div class="pull-center" style="text-align:center;font-size: 30px ! important;">
		<table cellspacing=0 cellpadding=0 style="text-align: center;">
			
			<tr>
					<td>
						<img src="[IMG_PATH]confirmacion/general.jpg"/>
					</td>
					<td >
						<div>
							<div class="mayuscula">royal canin</div>							
						</div>
					</td>
					<td><div>Raza Media Adulta 10kg Mensual</td>
					<td>$938,4 MXN</td>
				</tr>
			</table>
			</div>
		
<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;">
		<h2>total de suscripcion</h2>
		<label style="font-size:35px">total</label>
		</div>
		<br><br>

		


	';



	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>