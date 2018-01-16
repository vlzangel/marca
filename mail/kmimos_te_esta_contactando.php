<?php
	//include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="font-size: 25px; background: #0b1805; color: #FFF; text-align: center; padding: 30px 20px; font-weight: 600;">
			Kmimos te est&aacute; contactando	

		</div> 
		<div>
			<img src="[IMG_PATH]contacto/contacto_kmimos1.jpg" style="width: 100%; margin: 0px 0px 10px; border-bottom: solid 10px #75e417;" />
		</div>
		<div>
				sabemos que quiere el<strong>alimento de tu peludo en tu casa</strong> y sin costo adicional 

		</div>
		<div>
		<label>por eso te estamos contact&aacute;ndote v&iacute;a telef&oacute;nica</label>
		<label>si no has recibido contacto de ninguno de nuestros asesores,verifica tus datos ac&aacute;</label>
		<label>para verificar tus datos</label>
		<a 	href="" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#091705;
					color: #fff;
					margin: 20px 0px;
				\"
			>has click aqui</a>
		</div>
		
		<div>
		<h3>detalles del pedido</h3>
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