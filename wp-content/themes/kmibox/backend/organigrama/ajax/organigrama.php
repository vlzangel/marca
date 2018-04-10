<?php

date_default_timezone_set('America/Mexico_City');

$raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
include( $raiz."/wp-load.php" );

global $wpdb;

$sql = '
	SELECT distinct codigo_asesor,
		CONCAT(\'{"key":"\', codigo_asesor, \'", "name":"\', nombre, \'"}\') as \'nodeData\',
		CONCAT(\'{"from":"\', parent, \'", "to":"\', codigo_asesor, \'"}\') as \'linkData\'
	FROM asesores 
	group by codigo_asesor
	';
$asesores = $wpdb->get_results($sql);

$nodeData = '{"key":"0", "name":"Nutriheroes", "by":"Kmimos"}';	
$linkData = '';	

foreach ($asesores as $row) {
	$separador = (!empty($nodeData))? "," : '' ;
	$nodeData .= $separador.$row->nodeData;

	$separador = (!empty($linkData))? "," : '' ;
	$linkData .= $separador.$row->linkData;
}

print_r( 
	str_replace(' ', '', '{"class": "go.GraphLinksModel","nodeDataArray": ['.$nodeData.'],"linkDataArray": ['.$linkData.']}')
);
 
exit();