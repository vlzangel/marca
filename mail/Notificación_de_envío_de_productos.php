<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: left; padding: 30px 20px; font-weight: 600;">
		¡Hola rob!
			
			<div  class="text" style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Tu pedido fue enviado
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]notificacion_envio/compra01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div style="text-align: center;font-size: 17px;line-height: 27px;">
				los<strong>detalles de tu pedido</strong> se indican a contici&oacute;n

		</div>
			<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">tu fecha estimada de entrega es</h3>
			<label>lunes 15 de enero - jueves 18 de enero</label>
		</div>
				<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">tipo de envio</h3>
			<label>fedex</label>
		</div>
			<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">tu pedido sera enviado a</h3>
			<label>rob cuevas paseo de la luna 370, interior 124 Paseo de solares Zapopan, Jalisco 45019 M&eacute;xico</label>
		</div>
			<br>
		<div style="text-align: left;font-size: 17px;line-height: 27px;">
			<h3 class="mayuscula">detalles del pedido</h3>
			<label>pedido No.123456 realizado el lunes 08 de enero</label>
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

			<hr>
			<div style="float:right;width:50%;">
				<label>Subtotal</label>
				<br>
				<label>Total(IVA incluido)</label>
			</div>
			<div style="float:right;width:50%;">
				<label>$1500 MXN</label>
				<br>
				<label>$1703,4 MXN</label>
			</div>
	<br>	<br><br>	<br>



	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>