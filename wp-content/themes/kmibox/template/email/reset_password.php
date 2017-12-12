<?php 
$HTML = "
		<div style=\"
			padding: 30px 20px;
			background-color:#7AD2C4 ;
			margin-bottom:20px;
			text-align:center;
		\">
			<img src=\"".get_home_url()."/img/marca-logo.png\">
		</div>
		<div style=\"
				border: 1px solid #ccc; 
				border-radius: 20px;
				padding: 15px;
				text-align:center;\">
			<h1>Solicitud para restablecer contraseña</h1>
			<p>Hola <stronge>".$name."</stronge>, hemos recibido una solicitud para restablecer la contraseña de tu perfil Kmibox.</p>
			<p>Para continuar da click en el siguiente botón.</p>
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
			>Restablecer contraseña</a>
			<br>
			<br>
			<br>
			<p style=\"font-size:13px;\">Si no reconoces esta solicitud tan sólo ignora este mensaje, no es necesario realizar ninguna acción, la seguridad de tu cuenta no está en riesgo.</p>
		</div>
";