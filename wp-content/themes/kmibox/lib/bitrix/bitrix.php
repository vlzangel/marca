<?php

$bitrix = new bitrix();

class bitrix {

	// ***************************************************
	// Alias de los email 
	// para evitar que bitrix envie email a los usuarios 
	// ***************************************************
	protected $prefix_email = 'kmimos_';

	// Conexion con Bitrix 

		// ************************
		// WebHook de Bitrix (App)
		// ************************
		protected function config(){
			$is_test = 0;

			// Cuenta Italo Test
			// $URL = "https://b24-sbapnp.bitrix24.es/rest/1/5zvo252hsmaubs2a/";
			$URL = "https://b24-bcpyzj.bitrix24.es/rest/1/eslp8dpg1j1957o4/";

			if( $is_test == 1 ){
				// Cuenta Yrcel
				$URL = "https://b24-9z3vi9.bitrix24.com/rest/1/66er0e8upgiixv3n/";
			}
			return $URL;
		}

		// ************************
		// Ejecutar Comando Bitrix
		// ************************
		protected function execute( $command, $fields=[], $extra=[] ){
			$r = dirname(__dir__).'/Requests/Requests.php';
			Requests::register_autoloader();
			$url = $this->config();
			if(!empty($url)){
				$data = $extra;
				$data["fields"] = $fields;
				$request = Requests::post($url.$command, array(), $data );		
			}
			$response = [];
			if ( !empty($request->body) ){
				$data = json_decode($request->body);
				$response = ( isset($data->result) )? $data->result : $request->body ;
			} 
			return $response;
		}

	// Productos

		// ************************
		// Actualizar Productos
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

		// ************************
		// Agregar Productos
		// ************************
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

	// Asesores

		// ************************
		// Departamentos
		// ************************
		public function department( $asesor_email, $parent=1 ){
			
			$department_id = 0;

			// Buscar Id Usuario Bitrix
			$user = $this->User( $asesor_email );

			// Validar si existe un departamento
			if( isset($user->id) && $user->id > 0 ){
				$department_id = $this->getDepartmentId_by_asesorId( $user->id );

				// Crear el departamento 
				if( empty($department_id) ){
					$department_id = $this->addDepartment([
						'departament_name' => $user->nombre,
						'admin_user_id' => $user->id,
						'parent_id' => $parent,
					]);
				}

				// Actualizar ID Departamento en asesores
				if( $department_id > 0 ){
					$this->asesor_update_DptoID( $asesor_email, $department_id );
				}

			}
			
			return $department_id;
		}

		// *************************************************
		// Actualizar Departamentos Padre en Bitrix
		// *************************************************
		public function updateParent( $asesor_email, $parent_email ){

			// ID departamento del padre
			$department_id_parent = $this->department( $parent_email );
			// ID departamento del hijo
			$department_id_asesor = $this->department( $asesor_email );

			$sts =0 ;
			if( $department_id_asesor > 0 && $department_id_parent > 0 ){
				$sts = $this->updateDepartment_parent( $department_id_asesor, $department_id_parent );
			}
			return $sts;
		}

		// *************************************************
		// Agrega Departamentos en Bitrix
		// *************************************************
		protected function addDepartment( $options = [] ){

			if( !empty($options) ){
				$options['parent_id'] = ( isset($options['parent_id']) && $options['parent_id'] > 0 )? $options['parent_id'] : 1 ;
				$_options = [
					"NAME" => $options['departament_name'].'-Cachorro N1', # Nombre del departamento
					"PARENT" => $options['parent_id'],		 	# ID del departamento padre
					"UF_HEAD" => $options['admin_user_id'], 	# ID del jefe del departamento
				];
				$departamento_id = $this->execute( 'department.add', [], $_options );
			}
			return $departamento_id;
		}

		// *************************************************
		// Actualiza el padre del Departamento en Bitrix
		// *************************************************	
		protected function updateDepartment_parent( $id , $parent ){
			$sts = 0;
			if( $id>0 && $parent>0 ){
				$_options = [
					"ID" => $id,
					"PARENT" => $parent,		 	# ID del departamento padre
				];
				$this->execute( 'department.update', [], $_options );			
				$sts = 1;
			}
			return $sts;
		}

		// *************************************************
		// Consulta Departamento por ID del asesor 
		// en bitrix (bitrix_id)
		// *************************************************
		protected function getDepartmentId_by_asesorId( $asesor_id, $return_id=true ){
			global $wpdb;
			$departamento_id = null;
			if( $asesor_id > 0 ){
				$department = $this->execute( 'department.get', [], ['UF_HEAD'=>$asesor_id] );		
				if( isset($department[0]->ID) && isset($department[0]->ID) && $return_id ){
					$departamento_id = $department[0]->ID;
				}else{
					$departamento_id = $department[0];
				}
			}
			return $departamento_id;
		}

		// *************************************************
		// Consulta Departamento
		// *************************************************
		protected function getDepartment_by( $field, $value, $return_field='' ){
			global $wpdb;
			$department = null;
			if( !empty($field) && !empty($value) ){
				$field = strtoupper($field);
				$filter[ $field ] = $value;
				$_department = $this->execute( 'department.get', [], $filter );
				if( count($_department) > 0 ){
					$department = $_department[0];
					if( isset($department->$return_field) ){
						$department = $department->$return_field;
					}
				}
			}
			return $department;
		}

		// *************************************************
		// Actualiza el ID Departamento en el Asesor
		// *************************************************
		protected function asesor_update_DptoID( $user_email, $dpto_id ){
			global $wpdb;
			$wpdb->query("update asesores set bitrix_departamento = {$dpto_id} where email = '".$user_email."'");
		}

	// Clientes

		// *************************************************
		// Asignar Asesor al Cliente
		// *************************************************
		public function addAsesor_customer( $email, $parent_email ){

			// Verificar departamento Asesor			
			$department_id = $this->department( $parent_email, 1 );

			// Buscar nombre del departamento
			// $department_name = $this->getDepartment_by('ID', $department_id, 'NAME');

			// Verificar registro cliente
			$cliente = $this->User( $email );

			// Asociar Cliente al departamento
			if( isset($cliente->id) && $cliente->id > 0 ){
				if( $department_id > 0 ){
					$this->execute( 'user.update', [], [
						'ID' => $cliente->id,
						'UF_DEPARTMENT' => $department_id
					] );
				}
			}
		}

	// Usuarios

		// *************************************************
		// Usuarios
		// *************************************************
		public function User( $email ){
			global $wpdb;
			
			// buscar ID de usuario en bitrix
			$_user = $this->getUser_by('email', $email);

			// Agregar el usuario a Bitrix
			if( isset($_user->ID) || $_user->ID == 0 ){

				// Datos del Asesor
				$user = $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$email}'");
				if( !isset($user->id) ){
					$user = null;

					// Datos del Cliente
					$user = get_user_by('email', $email);
					if( isset($user->id) && $user->id > 0 ){
						$data = [];
						$data['nombre'] = get_user_meta( $user->id, 'first_name', true );
						$data['telefono'] = get_user_meta( $user->id, 'telef_movil', true );
						$data['email'] = $email;
						$data['id'] = 0;

						$user = (object) $data;
					}

				}

				// Envir datos de usuario a Bitrix
				if( isset($user->email) && isset($user->nombre) ){			
					$id = $this->addUser([
						'email'=>$user->email,
						'nombre'=>$user->nombre,
						'apellido'=> '',
					]);
					$user->id = $id;
				}
				$_user = $user;

			}else{
				$_user = (object) [
					'email'=> $_user->EMAIL,
					'nombre'=> $_user->NAME,
					'id'=> $_user->ID,
				];
			}

			// Actualiza el registro del Usuario en Nutriheroes ( Bitrix User_ID )
			if( isset($_user->id) && $_user->id > 0 ){
				$this->update_bitrix_id( $email, $_user->id );
			} 	
			return $_user;
		}

		// *************************************************
		// Agrega Usuarios a Bitrix
		// *************************************************
		protected function addUser( $options = [], $is_client =false ){
			global $wpdb;

			// Validar si el usuario esta registrado en Bitrix
			$id = $this->getUser_by('email', $options['email'], true);

			// Registrar usuario en Bitrix
			if( !empty($options) && empty($id) ){

				$departamento = (isset($options['departamento']))? $options['departamento'] : 1 ;
				$options = [
					"EMAIL" => $this->prefix_email.$options['email'],
					"NAME"=> $options['nombre'],
			        "LAST_NAME"=> $options['apellido'],
					"WORK_COMPANY" => 'Kmimos',
			        "UF_DEPARTMENT" => $departamento,
					"SONET_GROUP_ID" => '7',
					"ACTIVE" => 'Activo',
				];
				$id = $this->execute( 'user.add', [], $options );
				if( isset($id[0]) ){
					$id = $id[0];
				}
			}

			return ($id > 0)? $id : 0;
		}

		// *************************************************
		// Actualiza Bitrix_ID de Usuarios en Nutriheroes
		// *************************************************
		protected function update_bitrix_id( $email, $bitrix_id ){
			global $wpdb;
			$user = $wpdb->get_row("SELECT * FROM asesores WHERE email = '{$email}'");
			if( isset($user->id) && $user->id > 0 ){
				// Actualizar ID Asesor
				$wpdb->query("update asesores set bitrix_id = {$bitrix_id} where email = '".$email."'");
			}else{
				// Actualizar ID Cliente
				$user = get_user_by('email', $email);
				if( isset($user->id) && $user->id > 0 ){
					update_usermeta( $user->id, 'bitrix_id', $bitrix_id );
				}
			}

			return $this->getUser_by('email', $email);
		}

		// *************************************************
		// Consulta datos de Usuarios en Bitrix
		// *************************************************
		protected function getUser_by( $field, $value, $return_id=false){
			global $wpdb;
				switch ($field) {
					case 'email':
						$value = $this->prefix_email.$value;
						break;
				}
				$filter[ strtoupper($field) ] = $value;
				$user = $this->execute( 'user.get', [], $filter );

				if( $return_id && isset($user[0]->ID) ){
					$user = $user[0]->ID;	
				}
				if(empty($user)){
					$user = null;
				}
			return $user;
		}

	// Facturas

		// *************************************************
		// Construir Facturas por asesor
		// *************************************************
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

					$payment_system_id = $this->getPaymentSystemID();

					$cliente = (object) get_user_info( $orden->cliente_id );

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

				            "COMMENTS" => $cliente->first_name ." ".$cliente->last_name." (".$cliente->email.")",

				            "UF_DEAL_ID" => 1,
				            "UF_COMPANY_ID" => 1,
				            "UF_CONTACT_ID" => 1,
				            "PERSON_TYPE_ID"=> 1,
				            "PAY_SYSTEM_ID" => $payment_system_id,
				        ];

					// Datos del CLiente
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

						// Cargar nueva data ( asesor padre )
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

		// *************************************************
		// Agregar puntos a los productos y asesores
		// *************************************************
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
			if( isset($r) && $r > 0){
				$sql = "update asesores set puntos = puntos + {$total} where bitrix_id = ".$_INVOICE_DATA["RESPONSIBLE_ID"];
				$wpdb->query($sql);
			}
		}

		// *************************************************
		// Consultar el primer metodos de pago en bitrix
		// *************************************************
		protected function getPaymentSystemID(){
			$id = 0;
			
			$payment_ist = $this->execute( 'sale.paysystem.list', $options );

			foreach ($payment_ist as $payment) {
				if( isset($payment->ID) ){
					$id = $payment->ID;
					break;
				}
			}
			return $id;
		}

		// *************************************************
		// Agregar factura en bitrix
		// *************************************************
		protected function addInvoice( $options = [] ){
			$invoice = [];
			if( !empty($options) ){
			   	$invoice = $this->execute( 'crm.invoice.add', $options );
			}
			return $invoice;
		}


}

