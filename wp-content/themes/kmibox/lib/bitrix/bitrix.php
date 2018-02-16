<?php

	public function addInvoice(){
	    $options = array(
		   "FIELDS"=> [
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
	        ]
		);

		// agregar productos
		$prod = json_decode($product->body); 
		$prod = $prod->result;
		foreach ($prod as $val) {
			$options["FIELDS"]["PRODUCT_ROWS"][] = [
				"ID"=> 0, 
				"PRODUCT_ID"=>$val->ID,
				"PRODUCT_NAME"=> $val->NAME, 
				"QUANTITY"=> 1, 
				"PRICE"=> $val->PRICE
			];
		}

		$invoice = Requests::post('https://b24-eh6mlq.bitrix24.com/rest/1/ho7sg8864qfmpyci/crm.invoice.add/', array(), $options );
	}