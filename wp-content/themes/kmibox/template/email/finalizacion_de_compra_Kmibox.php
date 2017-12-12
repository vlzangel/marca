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

			<h1>Gracias por adquirir una <img src=\"".get_home_url()."/img/logo-white-text.png\"></h1>
			<br>
			<img src=\"".get_home_url()."/img/alimento.png\">
			<br>
			<h1>Detalles de tu compra</h1>
			<br>

			<div style=\"
				border: 1px solid #ccc; 
				border-radius: 30px;
				padding: 20px;
				text-align:left;\">
				
				<p>Tipo de Kmibox</p>
				<p>Tipo de Suscripcion</p>
			<br>
			<br>
			<a 	href=\"".get_home_url(). '/recuperar-clave/?confirmar='.$sts['code'].'&e=' . $email."\" 
				style=\"
					padding: 15px 30px;
					border-radius: 50px;
					background-color:#7AD2C4 ;
					color: #fff;
					margin: 20px 0px;
				\"
			>Ir a tu perfil</a>
			<br>
			<br>
			<br>
		</div>
";