<?php
	include_once( __DIR__."/wp-content/themes/kmibox/lib/Requests/Requests.php" );
	$options = array( 
		'funcion' => "is_user",
		'email' => "soporte.kmimos@gmail.com"
	);
    Requests::register_autoloader();
    $request = Requests::post('http://kmimosmx.sytes.net/QA2/services/users.php', array(), $options );

    echo "<pre>";
    	print_r($request->body+0);
    echo "</pre>";
?>