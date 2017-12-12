<?php 
$HTML = "
		<div style=\"
			padding: 30px 20px;
			background-color:#7AD2C4 ;
			margin-bottom:20px;
		\">
			<img src=\"".get_home_url()."/img/logo-white-text.png\">
		</div>
		<div style=\"
				border: 1px solid #ccc; 
				border-radius: 20px;
				padding: 15px;
				text-align:center;\">
			<h1>Estás a un paso de conseguir tu <img src=\"".get_home_url()."/img/logo-white-text.png\"> </h1>
			<br>
			
			<br>
			<p>Hola <stronge>".$name."</stronge>, Pra realizar tu pago de tu kmibox en tíendas de conveniencia, por favor sigue las siguientes intrucciones..</p>
			<br>
			<img src=\"".get_home_url()."/img/Correo_de_instrucciones_pago_en_efectivo1.png\">
			<img src=\"".get_home_url()."/img/Correo_de_instrucciones_pago_en_efectivo2.png\">
			<img src=\"".get_home_url()."/img/Correo_de_instrucciones_pago_en_efectivo3.png\">
			<img src=\"".get_home_url()."/img/Correo_de_instrucciones_pago_en_efectivo4.png\">

			<br>
			<h2>Descarga tu ficha de pago aqui <img src=\"".get_home_url()."/img/logo-white-text.png\"> </h2>
			<a 	href=\"".get_home_url(). '/registro/?confirmar='.$sts['code'].'&e=' . $email."\" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#7AD2C4 ;
					color: #fff;
					margin: 20px 0px;
				\"

			>Descargar mi ficha de pago</a>
			<br>
			<br>
			<br>
		</div>
";