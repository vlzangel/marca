<?php

$bitrix = new bitrix();

class bitrix {

	protected function config(){
		$is_test = 1;
		$URL = "https://b24-ha5t1l.bitrix24.es/rest/1/p27sln5arukcea22/";
		if( $is_test == 1 ){
			$URL = "https://b24-ha5t1l.bitrix24.es/rest/1/p27sln5arukcea22/";
		}
		return $URL;
	}

	protected function execute( $command, $options=[], $extra=[] ){
		$r = dirname(__dir__).'/Requests/Requests.php';
		Requests::register_autoloader();
		$url = $this->config();
		if(!empty($url)){
			$data = $extra;
			$data["fields"] = $options;
			$request = Requests::post($url.$command, array(), $data );
		}
		return ( !empty($request->body) )? $request->body : [] ;
	}

	// ************************
	// Productos
	// ************************
	public function updateProduct( $id, $options = [] ){
		$response = [];
		if( !empty($options) ){
			$_options = [
				"NAME" => $options['nombre'], 
				"CURRENCY_ID" => "MXN", 
				"PRICE" => $options['precio'], 
				"SORT" => $options['orden'],
				"DESCRIPTION" => $options['descripcion'],
			];
			$response = $this->execute( 'crm.product.update', $_options, [ 'id' => $id ] );
		}
		return $response;
	}

	public function addProduct( $options = [] ){
		$response = [];
		if( !empty($options) ){
			$_options = [
				"NAME" => $options['nombre'], 
				"CURRENCY_ID" => "MXN", 
				"PRICE" => $options['precio'], 
				"SORT" => $options['orden'],
				"DESCRIPTION" => $options['descripcion'],
			];
			$response = $this->execute( 'crm.product.add', $_options );
		}
		return $response;
	}

	// ************************
	// Departamentos
	// ************************
	public function addDepartament( $options = [] ){
		$departamento_id = 0;
		if( !empty($options) ){
			$options['parent_id'] = ( isset($options['parent_id']) )? $options['parent_id'] : 1 ;
			$_options = [
				"NAME" => $options['departament_name'].'-Cachorro N1', # Nombre del departamento
				"PARENT" => $options['parent_id'],		 	# ID del departamento padre
				"UF_HEAD" => $options['admin_user_id'], 	# ID del jefe del departamento
			];
			$response = $this->execute( 'department.add', [], $_options );	
			$response = ( !empty($response) )? json_decode($response) : $response;
			if( isset($response->result) && $response->result > 0 ){
				$departamento_id = $response->result;
			}
		}
		return $departamento_id;
	}

	public function updateDepartament_parent( $options=[] ){
		$sts = 0;
		if( !empty($options) ){
			$options['parent_id']=(isset($options['parent_id']) && $options['parent_id']>1 )? $options['parent_id'] : 1 ;
			$_options = [
				"ID" => $options['id'],
				"PARENT" => $options['parent_id'],		 	# ID del departamento padre
				"UF_HEAD" => $options['admin_user_id'], 	# ID del jefe del departamento
			];
			$this->execute( 'department.update', [], $_options );			
			$sts = 1;
		}
		return $sts;
	}

	public function findDepartament( $asesor_id ){
		global $wpdb;
		$departamento_id = 0;
		$asesor = $wpdb->get_row("SELECT * FROM asesores WHERE id = {$asesor_id}");
		if( isset($asesor->bitrix_departamento) && $asesor->bitrix_departamento > 0 ){
			$departamento_id = $asesor->bitrix_departamento;
		}
		return $departamento_id;
	}

	protected function asesor_update_DptoID( $user_email, $dpto_id ){
		$wpdb->query("update asesores set bitrix_departamento = {$dpto_id} where email = '".$user_email."'");
	}



	// ************************
	// Usuarios
	// ************************
	public function addUser( $options = [], $is_client =false ){
		global $wpdb;

		$id = 0;
		if( !empty($options) ){
			$departamento = (isset($options['departamento']))? $options['departamento'] : 1 ;
			$options = [
				"EMAIL" => 'kmimos_'.$options['email'],
				"NAME"=> $options['nombre'],
		        "LAST_NAME"=> $options['apellido'],
				"WORK_COMPANY" => 'Kmimos',
		        "UF_DEPARTMENT" => $departamento,
				"SONET_GROUP_ID" => '7',
				"ACTIVE" => 'Activo',
			];
			$response = $this->execute( 'user.add', [], $options );
			$response = ( !empty($response) )? json_decode($response) : $response;

			// Update Bitrix_id en los registros	
			if( isset($response->result) && $response->result > 0 ){
				$id = $response->result;
				$this->updateUser_BitrixID( $options['email'], $id, $is_client );
			}
		}
		return $id;
	}

	protected function updateUser_BitrixID( $user_email, $bitrix_id, $is_client=false ){
		global $wpdb;
		if( !$is_client ){
			// Actualizar ID Asesor
			$wpdb->query("update asesores set bitrix_id = {$bitrix_id} where email = '".$user_email."'");
		}else{
			// Actualizar ID Cliente
			$user = get_user_by('email', $user_email);
			if( isset($user->id) && $user->id > 0 ){
				update_usermeta( $user->id, 'bitrix_id', $bitrix_id );
			}
		}
	}

	// ************************
	// Facturas
	// ************************
	public function loadInvoice_by_asesor( $orden_id ){
		global $wpdb;

		$today = date('Y-m-dTH:i:s');
		$fecha = date('Y-m-j');
		$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
		$nextMonth = date ( 'Y-m-jTH:i:s' , $nuevafecha );

		if($orden_id>0){

			$_INVOICE_DATA = [];

			// Buscar datos de la orden
				$_sql_orden = "
					SELECT 
						o.cliente as cliente_id,
						o.asesor as asesor_id,
						s.bitrix_id as asesor_bitrix
					FROM ordenes as o
						left join asesores as s on s.id = o.asesor 
					WHERE o.id = {$orden_id}
				"; 
				$orden = $wpdb->get_row($_sql_orden);

			if( isset($orden->cliente_id) && isset($orden->asesor_id)){
				
				// Datos de la Factura
					$_INVOICE_DATA = [
						"ORDER_TOPIC"=> "Nutriheroes - Orden No. {$orden_id}",
			            "STATUS_ID"=> "P",
			            "DATE_INSERT"=> $today,
			            "PAY_VOUCHER_DATE"=> $today,
			            "PAY_VOUCHER_NUM"=> $orden_id,
			            "DATE_MARKED"=> $today,
			            "REASON_MARKED"=> ".",
			            "COMMENTS"=> ".",
			            "USER_DESCRIPTION"=> ".",
			            "DATE_BILL"=> $today,
			            "DATE_PAY_BEFORE"=> $nextMonth,
			            "RESPONSIBLE_ID"=> $orden->asesor_bitrix,

			            "UF_DEAL_ID" => 1,
			            "UF_COMPANY_ID" => 1,
			            "UF_CONTACT_ID" => 1,
			            "PERSON_TYPE_ID"=> 1,
			            "PAY_SYSTEM_ID" => 1,
			        ];

				// Datos del CLiente
					$cliente = (object) get_user_info( $orden->cliente_id );
					$_INVOICE_DATA['INVOICE_PROPERTIES'] = [
						"COMPANY"=> $cliente->display_name,                               // Company name
		                "COMPANY_ADR"=> $cliente->calle .' '. $cliente->colonia,
		                "REG_ID"=> "",
		                "CONTACT_PERSON"=> $cliente->display_name,                                  // Contact person
		                "EMAIL"=> $cliente->email,
		                "PHONE"=> $cliente->telef_fijo,                                       // Phone
		                "FAX"=> $cliente->telef_movil,                                                          // Fax
		                "ZIP"=> $cliente->codigo_postal,                                                          // Postal code
		                "CITY"=> $cliente->colonia,                                                         // City
		                "LOCATION"=> '',                                                     // Location
		                "ADDRESS"=> $cliente->calle .' '. $cliente->colonia   
					];
				
    			// Buscar detalles de la orden y categorias
					$_sql_orden_detalle = "
						SELECT 
							p.nombre,
							i.cantidad,
							p.bitrix_id,
							p.id,
							c.niveles
						FROM items_ordenes as i
							LEFT JOIN productos as p ON p.id = i.id_producto
							LEFT JOIN categorias as c ON c.id = p.categoria
						WHERE i.id_orden = {$orden_id}
					"; 

					$resultado = $wpdb->get_results($_sql_orden_detalle);

				$_limite_niveles = 6; // Limite de niveles de los asesores

		 		// Generar puntos a los asesores
				for ($nivel = 1; $nivel <= $_limite_niveles; $nivel++) {

					// Cargar nueva factura
						$this->addPoints( $_INVOICE_DATA, $resultado, $nivel );

					// Cargar nueva data
						$sql_padre_asesor = " 
							SELECT a.parent , b.bitrix_id 
							FROM asesores as a
							 left JOIN asesores as b ON b.codigo_asesor = a.parent
							WHERE a.bitrix_id = ".$_INVOICE_DATA["RESPONSIBLE_ID"];
						$asesor = $wpdb->get_row($sql_padre_asesor);

						if( isset($asesor->parent) && $asesor->parent > 0 ){
				            $_INVOICE_DATA["RESPONSIBLE_ID"] = $asesor->bitrix_id;
				        }else{
				        	$nivel += $_limite_niveles; // finalizar contador
				        }
				}
			}

		}
	}

	protected function addInvoice( $options = [] ){
		$invoice = [];
		if( !empty($options) ){
		   	$invoice = $this->execute( 'crm.invoice.add', $options );
		}
		return $invoice;
	}

	protected function addPoints( $_INVOICE_DATA, $resultado, $nivel ){

		global $wpdb;

		// Cargar detalle de la Orden
		$total = 0;
		foreach ($resultado as $key => $val) {
			$_categoria = unserialize($val->niveles); 
			$puntos = $_categoria[$nivel];
			$total += ($puntos * $val->cantidad);
			$_INVOICE_DATA['PRODUCT_ROWS'][] = [
				"ID"=> 0, 
				"PRODUCT_ID"=>$val->bitrix_id,
				"PRODUCT_NAME"=> $val->nombre, 
				"QUANTITY"=> $val->cantidad, 
				"PRICE"=> $puntos
			];
		}

		$r = $this->addInvoice( $_INVOICE_DATA );
		$datos = json_decode($r);
		if( isset($datos->result) && $datos->result > 0){
			$sql = "update asesores set puntos = puntos + {$total} where bitrix_id = ".$_INVOICE_DATA["RESPONSIBLE_ID"];
			$wpdb->query($sql);
		}
	}

}

