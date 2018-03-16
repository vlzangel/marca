<?php

$bitrix = new bitrix();

class bitrix {

	protected function config(){
		$is_test = 1;
		//$URL = "https://b24-eh6mlq.bitrix24.com/rest/1/ho7sg8864qfmpyci/";
		$URL = "https://b24-sbapnp.bitrix24.es/rest/1/fsmtqonhm70qb1sb/";
		if( $is_test == 1 ){
			$URL = "https://b24-sbapnp.bitrix24.es/rest/1/fsmtqonhm70qb1sb/";
		}
		return $URL;
	}

	protected function execute( $command, $options=[] ){
		$r = dirname(__dir__).'/Requests/Requests.php';
		Requests::register_autoloader();
		$url = $this->config();
		$request = Requests::post($url.$command, array(), ["fields"=>$options] );
		return ( !empty($request->body) )? $request->body : [] ;
	}

	public function addProduct( $options = [] ){
		$response = [];
		if( !empty($options) ){
			$_options = [
				"NAME" => $options['nombre'], 
				"CURRENCY_ID" => "USD", 
				"PRICE" => $options['precio'], 
				"SORT" => $options['orden']
			];
			$response = $this->execute( 'crm.product.add', $_options );
		}
		return $response;
	}

	public function addDepartament( $options = [] ){
		$response = [];
		if( !empty($options) ){
			$_options = [
				"NAME" => $options['departament_name'],		# Nombre del departamento
				"PARENT" => $options['parent_id'],		 	# ID del departamento padre
				"UF_HEAD" => $options['admin_user_id'], 	# ID del jefe del departamento
			];
			$response = $this->execute( 'department.add', $_options );
		}
		return $response;
	}

	public function addUser( $options = [] ){
		$response = [];
		if( !empty($options) ){
			$options = [
				"EMAIL" => $options['email'],		# Email del usuario
				"EXTRANET" => "Y",
				"SONET_GROUP_ID" => '',
			];
			$response = $this->execute( 'user.add', $options );
		}
		return $response;
	}

	public function addInvoice(){
	    $options = array(
            "ORDER_TOPIC"=> "Invoice for kmimos",
            "STATUS_ID"=> "P",
            "DATE_INSERT"=> $today,
            "PAY_VOUCHER_DATE"=> $today,
            "PAY_VOUCHER_NUM"=> "876",
            "DATE_MARKED"=> $today,
            "REASON_MARKED"=> "Paid immediately.",
            "COMMENTS"=> "comment",
            "USER_DESCRIPTION"=> "client comments",
            "DATE_BILL"=> $today,
            "DATE_PAY_BEFORE"=> $nextMonth,
            "RESPONSIBLE_ID"=> 1,
            "UF_DEAL_ID"=> 10,
            "UF_COMPANY_ID"=> 5,
            "UF_CONTACT_ID"=> 2,
            "PERSON_TYPE_ID"=> 2,
            "PAY_SYSTEM_ID"=> 6,
            "INVOICE_PROPERTIES"=> [
                "COMPANY"=> "Advanced Technology LLC",                               // Company name
                "COMPANY_ADR"=> "687, New Broadway, London, A5 2XA",                 // Legal address
                "REG_ID"=> "17863734634",                                            // Company registration number
                "CONTACT_PERSON"=> "Jhon Smith",                                  // Contact person
                "EMAIL"=> "pr@logistics-north.com",                                  // E-Mail
                "PHONE"=> "8 (495) 234-54-32",                                       // Phone
                "FAX"=> "",                                                          // Fax
                "ZIP"=> "",                                                          // Postal code
                "CITY"=> "",                                                         // City
                "LOCATION"=> "",                                                     // Location
                "ADDRESS"=> ""                                                       // Delivery address
            ],
            "PRODUCT_ROWS"=> []
		);

		// agregar productos
		$prod = json_decode($product->body); 
		$prod = $prod->result;
		foreach ($prod as $val) {
			$options["PRODUCT_ROWS"][] = [
				"ID"=> 0, 
				"PRODUCT_ID"=>$val->ID,
				"PRODUCT_NAME"=> $val->NAME, 
				"QUANTITY"=> 1, 
				"PRICE"=> $val->PRICE
			];
		}

		$invoice = $this->execute( 'crm.invoice.add/', $options );
	}

}

