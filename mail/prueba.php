<?php
	include dirname(__DIR__).'/wp-load.php';

	$header = getTemplate('/generales/header.php');
	$footer = getTemplate('/generales/footer.php');

	$titulo = '
		<div style="">
			¡Hola Nayely!
		</div>
		<div style="">
			<img src="[IMG_PATH]confirmacion/header.jpg" />
		</div>
	';


	echo $HTML = addImgPath($header.$titulo.$footer);

	//wp_mail( "vlzangel91@gmail.com", "Prueba", $HTML);
?>