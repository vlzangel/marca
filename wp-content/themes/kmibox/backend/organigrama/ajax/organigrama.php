<?php

date_default_timezone_set('America/Mexico_City');

$raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
include( $raiz."/wp-load.php" );

global $wpdb;

$sql = '
	SELECT distinct codigo_asesor, parent, nivel, id,
		CONCAT(\'{"key":"\', codigo_asesor, \'", "name":"\', nombre, \'", "nivel":"[nivel]", "category":"asesor"}\') as \'nodeData\',
		CONCAT(\'{"from":"\', parent, \'", "to":"\', codigo_asesor, \'"}\') as \'linkData\'
	FROM asesores 
	group by codigo_asesor
	';
$asesores = $wpdb->get_results($sql);

$niveles = [];
$_niveles = $wpdb->get_results( "SELECT id, nivel as nombre, orden FROM asesores_niveles ORDER BY orden ASC" );
foreach ($_niveles as $key => $nivel) {
	if( $nivel->orden > 0 ){
		$counter++;
		$niveles[ $nivel->id ] = $nivel->nombre;
	}
}

$nodeData = '{"key":"0", "name":"Nutriheroes", "by":"Kmimos"}';	
$linkData = '';	

$user_info = get_userdata( get_current_user_id() );
$user_type = $user_info->roles[0];

if( $user_type == 'administrator' ){
	foreach ($asesores as $row) {

		$nivel = ( array_key_exists($row->nivel, $niveles) )? $niveles[ $row->nivel ] : '' ;
		$row->nodeData = str_replace('[nivel]', $nivel, $row->nodeData);

		$separador = (!empty($nodeData))? "," : '' ;
		$nodeData .= $separador.$row->nodeData;

		$separador = (!empty($linkData))? "," : '' ;
		$linkData .= $separador.$row->linkData;

		$clientes = getClientes( $row->id, $row->codigo_asesor );
		if( isset($clientes['nodeData']) && isset($clientes['linkData']) ){
			$separador = (!empty($nodeData))? "," : '' ;
			$nodeData .= (!empty($clientes['nodeData']))? $separador.$clientes['nodeData'] : '' ;
			$linkData .= (!empty($clientes['linkData']))? $separador.$clientes['linkData'] : '' ;
		}

	}
}else{
	
	$codigo_asesor = get_current_codigo_asesor();
	if( !empty($codigo_asesor) ){
		$estructura = get_hijos( $codigo_asesor, $asesores, ["nodeData"=>'', "linkData"=>''] );
		$nodeData = $estructura['nodeData'];
		$linkData = $estructura['linkData'];		
	}
}

print_r(
	str_replace(' ', '', '{"class": "go.GraphLinksModel","nodeDataArray": ['.$nodeData.'],"linkDataArray": ['.$linkData.']}')
);
exit();

function getClientes( $asesor_id, $asesor_codigo ){
	global $wpdb;
	$sql = 'SELECT distinct m.user_id,
		CONCAT(\'{"key":"C\', u.ID, \'","name":"[username]", "user_id":"\', u.ID,\'", "category":"cliente"}\') as \'nodeData\',
		CONCAT(\'{"from":"\', '.$asesor_codigo.', \'", "to":"C\', u.ID, \'"}\') as \'linkData\'
	FROM wp_users as u
		INNER JOIN wp_usermeta as m ON m.user_id = u.ID  
	WHERE m.meta_value = \''.$asesor_id.'\' and m.meta_key = \'asesor_registro\'';

	$clientes = $wpdb->get_results($sql);

	$resultado = [];
	foreach ($clientes as $cliente) {
		$separador = (!empty($resultado['nodeData']))? "," : '' ;

		// nombre de usuario
		$nombre = get_user_meta( $cliente->user_id, 'first_name', true );
		$nombre .= " ".get_user_meta( $cliente->user_id, 'last_name', true );

		$cliente->nodeData = str_replace('[username]', $nombre, $cliente->nodeData);

		$resultado['nodeData'] .= $separador.$cliente->nodeData;
		$resultado['linkData'] .= $separador.$cliente->linkData;
	}

	return $resultado;
}

function get_hijos( $codigo, $data=[], $result=[] ){

	foreach($data as $key => $item){
		// cargar datos
		if( $item->codigo_asesor == $codigo ){
			$separador = (!empty($result['nodeData']))? "," : '' ;
			$result['nodeData'] .= $separador.$item->nodeData;

			$separador = (!empty($result['linkData']))? "," : '' ;
			$result['linkData'] .= $separador.$item->linkData;

			$clientes = getClientes( $item->id, $item->codigo_asesor );
			if( isset($clientes['nodeData']) && isset($clientes['linkData']) ){
				$result['nodeData'] .= (!empty($clientes['nodeData']))? $separador.$clientes['nodeData'] : '' ;
				$result['linkData'] .= (!empty($clientes['linkData']))? $separador.$clientes['linkData'] : '' ;
			}
		}
		// buscar sus hijos
		if( $item->parent == $codigo ){
			$result = get_hijos( $item->codigo_asesor, $data, $result );
		}
	}
	return $result;
}
