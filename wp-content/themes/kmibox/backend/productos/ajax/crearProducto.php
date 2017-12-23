<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	extract($_POST);

	$_tamanos = array(
		"Pequeños" => 0,
		"Medianos" => 0,
		"Grandes" => 0
	);

	$_edades = array(
		"Cachorros" => 0,
		"Adultos" => 0,
		"Maduros" => 0
	);

	$_presentaciones = array(
		"900g" => 0,
		"2000g" => 0,
		"4000g" => 0
	);

	$_planes = array(
		"Mensual" => 0,
		"Bimestral" => 0,
		"Trimestral" => 0,
		"Semestral" => 0
	);

	foreach ($tamanos as $key => $value) { $_tamanos[$value] = 1; }
	foreach ($edades as $key => $value) { $_edades[$value] = 1; }
	foreach ($_presentaciones as $key => $value) { 
		$_presentaciones[$key] = $_POST[$key]; 
	}
	foreach ($planes as $key => $value) { $_planes[$value] = 1; }

	$dataextra = array(
		"img" => $img
	);

	$imgx = explode(',', $img_producto);
	$img = end($imgx);
    $sImagen = base64_decode($img);
    $dir = "Temp/";
    if( !file_exists($dir) ){ @mkdir($dir); }
    $name = time().".png";
    $path = $dir.$name;
    @file_put_contents($path, $sImagen);
    $sExt = @mime_content_type( $path );
    switch( $sExt ) {
        case 'image/jpeg':
            $aImage = @imageCreateFromJpeg( $path );
        break;
        case 'image/gif':
            $aImage = @imageCreateFromGif( $path );
        break;
        case 'image/png':
            $aImage = @imageCreateFromPng( $path );
        break;
        case 'image/wbmp':
            $aImage = @imageCreateFromWbmp( $path );
        break;
    }
    $nWidth  = 600;
    $nHeight = 450;
    $aSize = @getImageSize( $path );
    if( $aSize[0] > $aSize[1] ){
        $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
    }else{
        $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
    }
    $aThumb = @imageCreateTrueColor( $nWidth, $nHeight );
    @imageCopyResampled( $aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1] );
    @imagejpeg( $aThumb, $path );
    @imageDestroy( $aImage ); 
    @imageDestroy( $aThumb );

	echo $SQL = "
		INSERT INTO productos VALUES (
			NULL,
			'$nombre',
			'".serialize($_tamanos)."',
			'".serialize($_edades)."',
			'".serialize($_presentaciones)."',
			'".serialize($_planes)."',
			'',
		);
	";

	print_r($_POST);
?>