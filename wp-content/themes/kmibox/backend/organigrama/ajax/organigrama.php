<?php

date_default_timezone_set('America/Mexico_City');

$raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
include( $raiz."/wp-load.php" );

global $wpdb;

$sql = '
	SELECT distinct codigo_asesor, parent, nivel,
		CONCAT(\'{"key":"\', codigo_asesor, \'", "name":"\', nombre, \'", "nivel":"[nivel]"}\') as \'nodeData\',
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

		$separador = (!empty($nodeData))? "," : '' ;
		$nodeData .= $separador. str_replace('[nivel]', $nivel, $row->nodeData);

		$separador = (!empty($linkData))? "," : '' ;
		$linkData .= $separador.$row->linkData;
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


function get_hijos( $codigo, $data=[], $result=[] ){

	foreach($data as $key => $item){
		// cargar datos
		if( $item->codigo_asesor == $codigo ){
			$separador = (!empty($result['nodeData']))? "," : '' ;
			$result['nodeData'] .= $separador.$item->nodeData;

			$separador = (!empty($result['linkData']))? "," : '' ;
			$result['linkData'] .= $separador.$item->linkData;
		}
		// buscar sus hijos
		if( $item->parent == $codigo ){
			$result = get_hijos( $item->codigo_asesor, $data, $result );
		}
	}
	return $result;
}
