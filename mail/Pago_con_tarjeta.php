<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
		¡Hola Rodrigo!
			
			<div style="font-size: 17px; padding: 10px 20px 0px; font-weight: 400;"> 
				Haz realizado un pago
			</div>

		</div> 
		<div>
			<img src="[IMG_PATH]pago_tarjeta/pago_tarjeta01.png" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				Verifica<strong>nlos detalles de tu pago</strong>

		</div>

		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>Titular</h3>
			<label>Titular de la tarjeta</label>
		</div>
			<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>tipo de envio</h3>
			<label>fedex</label>
		</div>
			<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>N&uacute;mero de la tarjeta</h3>
			<label>41111111111111111111</label>
		</div>
			<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>Fecha de vencimiento</h3>
			<label>01/20</label>
		</div>
			<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>cvv</h3>
			<label>cvv</label>
		</div>
			<br>
		<div style="text-align: center;font-size: 17px;line-height: 27px;>
			<h3>Total a pagar</h3>
			<label>$2.400 MXN</label>
		</div>
			<br>

		<label>¡Gracias por tu compra!</label>


	


	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	wp_mail( "loaiza2610@gmail.com.com", "Prueba", $HTML);
?>