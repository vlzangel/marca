<?php
	include dirname(__DIR__).'/wp-load.php';

	$PATH_TEMPLATE = dirname(__DIR__)."/wp-content/themes/kmibox/template/email/";

	$header = getTemplate('/generales/header.php');

	$titulo = '
		<div style="">

		</div>
	';

	$footer = getTemplate('/generales/footer.php');

	echo $HTML = addImgPath($header.$footer);

	// wp_mail( "vlzangel91@gmail.com", "Prueba", $HTML);
?>