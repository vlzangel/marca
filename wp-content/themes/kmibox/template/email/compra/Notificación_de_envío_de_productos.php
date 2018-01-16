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
			<img src="[IMG_PATH]notificacion_envio/compra01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				los<strong>detalles de tu pedido</strong> se indican a contici&oacute;n

		</div>
			<br>
		<div>
			<h3>tu fecha estimada de entrega es</h3>
			<label>lunes 15 de enero - jueves 18 de enero</label>
		</div>
				<br>
		<div>
			<h3>tipo de envio</h3>
			<label>fedex</label>
		</div>
			<br>
		<div>
			<h3>tu pedido sera enviado a</h3>
			<label>rob cuevas paseo de la luna 370, interior 124 Paseo de solares Zapopan, Jalisco 45019 M&eacute;xico</label>
		</div>
			<br>
		<div>
		<h3>detalles del pedido</h3>
		<label>pedido No.123456 realizado el lunes 08 de enero</label>
		</div>
			<br>

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




		


	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>