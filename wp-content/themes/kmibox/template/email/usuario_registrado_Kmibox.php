<?php 
$HTML = "
<div style=\"margin-left: 120px;width:850px;\">	
		<div style=\"
			padding: 30px 20px;
			background-color:#091705;
			margin-bottom:20px;
		\">
		<h3 style=\"width:850; text-align:center; color: #ffffff; font-family: Arial; font-size: 25px; \">Estas a un paso de conseguir tu <img src=\"".get_home_url()."/wp-content/themes/kmibox/imgs/Image-footer.png\"/></h3>
			</div>
		
		<div style=\"
				border: 1px solid #ccc; 
				border-radius: 20px;
				padding: 15px;
				text-align:center;\">
			<img src=\"".get_home_url()."/img/Logo.png\">
			<br>
			<p style=\"font-family: Arial; font-size: 18px; \">Hola <stronge>".$email."</stronge>, tu registro <img src=\"".get_home_url()."/wp-content/themes/kmibox/imgs/Image-Header.png\"/> se realizo de manera exitosa.</p>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
		</div>
"; 
/*print_r($HTML);
function get_home_url(){
	return "http://kmibox.git/";
}*/
?>