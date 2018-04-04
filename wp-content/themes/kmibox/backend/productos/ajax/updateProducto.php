<?php 
	$raiz = (dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))));
	include($raiz."/wp-load.php");

	global $wpdb;

	extract($_POST);

	$_tamanos = array(
		"Pequeño" => 0,
		"Mediano" => 0,
		"Grande" => 0
	);

	$_edades = array(
		"Cachorro" => 0,
		"Adulto" => 0,
		"Senior" => 0
	);

	$data_planes = $wpdb->get_results("SELECT * FROM planes ORDER BY id ASC");
	$_planes = array();
	foreach ($data_planes as $plan) {
		$_planes[ $plan->id ] = 0;
	}

	foreach ($tamanos as $key => $value) { $_tamanos[$value] = 1; }
	foreach ($edades as $key => $value) { $_edades[$value] = 1; }
	foreach ($planes as $key => $value) { $_planes[$value] = 1; }

	$img = $img_old;
	if( $img_producto != "" ){
		$img = guardarImg(
			dirname(dirname(dirname(__DIR__)))."/imgs/productos/", 
			$img_producto
		);
		if( $img != "" ){
			unlink( dirname(dirname(dirname(__DIR__)))."/imgs/productos/".$img_old );
		}
	}

	$dataextra = array(
		"img" => $img,
		"origen_1" => $origen_1,
		"origen_2" => $origen_2
	);

	$_tamanos 			= serialize($_tamanos);
	$_edades 			= serialize($_edades);
	$_planes 			= serialize($_planes);

	$_dataextra = "";
	if( $img != "" ){
		$_dataextra = ", dataextra = '".serialize($dataextra)."'";
	}

	// Actualizar datos en bitrix
	try{
		$bitrix_id = $wpdb->get_row( "select bitrix_id from productos where id = {$ID}"  );
		include $raiz.'/wp-content/themes/kmibox/lib/bitrix/bitrix.php';
		$respuesta = $bitrix->updateProduct(
			$bitrix_id->bitrix_id,
			[
				"nombre" => $nombre, 
				"precio" => $puntos,
				"descripcion" => $descripcion,
			]
		);
	}catch(Exception $e){}


	$SQL = "
		UPDATE 
			productos 
		SET 
			nombre = '{$nombre}',
			descripcion = '{$descripcion}',
			precio = '{$precio}',
			peso = '{$peso}',
			existencia = '{$existencia}',
			puntos = '{$puntos}',
			marca = '{$marca}',
			tamanos = '{$_tamanos}',
			edades = '{$_edades}',
			planes = '{$_planes}' {$_dataextra},
			categoria = {$category}
		WHERE 
			id = {$ID}
	";

	$wpdb->query( $SQL );

	
?>