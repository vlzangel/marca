<?php

    date_default_timezone_set('America/Mexico_City');

    $raiz = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
    include( $raiz."/wp-load.php" );

	global $wpdb;

	// Validar si es administrador
	$user_info = get_userdata( get_current_user_id() );
	$user_type = $user_info->roles[0];
	$WHERE ='';
	$__asesor_id = '';
	if( $user_type != 'administrator' ){
		$__asesor_id = $wpdb->get_var("SELECT id FROM asesores WHERE email = '{$user_info->user_email}' ");
		$WHERE = "  AND orden IN (SELECT id FROM ordenes WHERE asesor = {$__asesor_id})  " ;
	}




    setZonaHoraria();
	$mes_actual = date("Y-m", time())."-01";
	$mes_siguiente = date("Y-m", strtotime("+1 month"))."-01";

	$despachos = $wpdb->get_results("SELECT * FROM despachos WHERE mes >= '{$mes_actual}' AND mes < '{$mes_siguiente}' {$WHERE} ORDER BY id DESC");
	$data["data"] = array();
	$excel = array();
	$ordenes = array();

	foreach ($despachos as $despacho) {

		$item = $wpdb->get_row("SELECT * FROM items_ordenes WHERE id = '{$despacho->sub_orden}' ;");
		$data_suscripcion = unserialize($item->data);
		$producto = $wpdb->get_row("SELECT * FROM productos WHERE id = '{$item->id_producto}' ");
		$user_id = $wpdb->get_var("SELECT cliente FROM ordenes WHERE id = '{$despacho->orden}' ");
		$cliente = get_user_meta($user_id, 'first_name', true)." ".get_user_meta($user_id, 'last_name', true);

		if( $despacho->fecha_entrega == null ){
			$despacho->fecha_entrega = "Cargar Fecha de Envío";
		}else{
			$despacho->fecha_entrega = date("d/m/Y", strtotime( $despacho->fecha_entrega ) );
		}

		if( $despacho->fecha_entregado == null ){
			$despacho->fecha_entregado = "Cargar Fecha de Entrega";
		}else{
			$despacho->fecha_entregado = date("d/m/Y", strtotime( $despacho->fecha_entregado ) );
		}

		if( $despacho->guia == "" ){
			$despacho->guia = "Cargar Gu&iacute;a";
		}

		$ordenes[ $despacho->orden ]["fecha_entrega"] = $despacho->fecha_entrega;
		$ordenes[ $despacho->orden ]["fecha_entregado"] = $despacho->fecha_entregado;
		$ordenes[ $despacho->orden ]["guia"] = $despacho->guia;
		$ordenes[ $despacho->orden ]["correo_enviado"] = $despacho->correo_enviado;
		$ordenes[ $despacho->orden ]["cliente"] = $cliente;
		$ordenes[ $despacho->orden ]["status"] = $despacho->status;

		$ordenes[ $despacho->orden ]["productos"][] = $item->cantidad." x ".$producto->nombre.", ".$producto->descripcion.", ".$producto->peso." - ".$data_suscripcion[ "plan" ];
		
	}

	$index_row=0;
	foreach ($ordenes as $orden_id => $_data) {

		$tiempo_entrega = "---";

		if( $_data["fecha_entrega"] != "Cargar Fecha de Envío" && $_data["fecha_entregado"] != "Cargar Fecha de Entrega" ){
			$temp_fecha_entrega = strtotime( str_replace("/", "-", $_data["fecha_entrega"]." 00:00:00" ) );
			$temp_fecha_entregado = strtotime( str_replace("/", "-", $_data["fecha_entregado"]." 00:00:00" ) );
			$tiempo_entrega = $temp_fecha_entregado - $temp_fecha_entrega;
	        $dias	= ($tiempo_entrega)/86400;
			$dias 	= abs($dias); $dias = floor($dias);
			if( $dias > 1 ){ $dias .= " d&iacute;as"; }else{ $dias .= " d&iacute;a"; }
			$tiempo_entrega = $dias;
		}

		$_productos = "";
		$_productos_excel = array();
		foreach ($_data["productos"] as $producto) {
			$_productos .= '<div style="margin:2px 0px;">'.$producto."</div>";
			$_productos_excel[] = $producto;
		}
		
		$enviar_correo = "---";
		$enviar_correo_excel = "---";

		if( $_data["guia"] != "Cargar Gu&iacute;a" && $_data["fecha_entrega"] != "Cargar Fecha de Envío" && $_data["status"] == "En transito" ){
			$enviar_correo = "
				<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Confirmaci&oacute;n de Envio de Correo' 
	        		data-modulo='despacho' 
	        		data-modal='enviar_correo' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		Enviar Correo
	        	</span>";
	        $enviar_correo_excel = "Por enviar el correo";

	        if(!empty($__asesor_id)){
	        	$enviar_correo = $enviar_correo_excel;
	        }

		}

		if( $_data["correo_enviado"] == 1 ){
			$enviar_correo .= "<br><strong>El correo ya ha sido enviado.</strong>";
	        $enviar_correo_excel = "Correo Enviado";
		}

		$guia = $_data["guia"];
		$fecha_entrega = $_data["fecha_entrega"];
		$status = $_data["status"];

		if( $_data["status"] != "Entregado" ){
			$guia = "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Gu&iacute;a de Rastreo' 
	        		data-modulo='despacho' 
	        		data-modal='guia' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["guia"]."
	        	</div>";

			$fecha_entrega = "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Fecha de Env&iacute;o' 
	        		data-modulo='despacho' 
	        		data-modal='fecha_entrega' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["fecha_entrega"]."
	        	</div>";

			$status = "
	        	<span 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Status' 
	        		data-modulo='despacho' 
	        		data-modal='editar' 
	        		class='enlace' style='text-align: center;'
	        	>".$_data["status"]."</span>
	        ";

		}

		$fecha_entregado = "
	        	<div 
	        		onclick='abrir_link( jQuery( this ) )' 
	        		data-id='".$orden_id."' 
	        		data-titulo='Editar Fecha de Entrega' 
	        		data-modulo='despacho' 
	        		data-modal='fecha_entregado' 
	        		class='enlace' style='text-align: center;'
	        	>
	        		".$_data["fecha_entregado"]."
	        	</div>
	        ";


        if( !empty($__asesor_id) ){
			$guia = "<div>".$_data["guia"]."</div>";
			$fecha_entrega = "<div>".$_data["fecha_entrega"]."</div>";
			$status = "<span>".$_data["status"]."</span>";
			$fecha_entregado = "<div>".$_data["fecha_entregado"]."</div>";
        }



		$index_row++;
		$data["data"][] = array(
			$index_row,
	        $orden_id,
	        $_data["cliente"],
	        $_productos,
	        $guia,
	        $fecha_entrega,
	        $fecha_entregado,
	        $tiempo_entrega,
	        $status,
	        $enviar_correo
	    );

		if( $_data["guia"] == "Cargar Gu&iacute;a" ){ $_data["guia"] = "---"; }
		if( $_data["fecha_entrega"] == "Cargar Fecha" ){ $_data["fecha_entrega"] = "---"; }

		$excel[] = array(
			$index_row,
	        $orden_id,
	        $_data["cliente"],
	        implode(PHP_EOL, $_productos_excel),
	        $_data["guia"],
	        $_data["fecha_entrega"]." ",
	        $_data["fecha_entregado"]." ",
	        $_data["status"],
	        $enviar_correo_excel
	    );
	}

	if( isset($_GET["excel"]) ){
    	crearEXCEL(array(
			"nombre" => "Reporte de Despachos",
			"file_name" => "despachos",
			"titulos" => array(
				"ID",
				"Orden",
				"Cliente",
				"Productos",
				"Guía de Rastreo",
				"Fecha de Envío",
				"Fecha de Entrega",
				"Status",
				"Status Notificación",
			),
			"data" => $excel
		));
    }else{
    	echo json_encode($data);
    }

?>