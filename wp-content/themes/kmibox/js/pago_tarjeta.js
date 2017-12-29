jQuery(document).ready(function() { 

	OpenPay.setId( OPENPAY_TOKEN );
    OpenPay.setApiKey(OPENPAY_PK);
    OpenPay.setSandboxMode( OPENPAY_PRUEBAS == 1 );
    
	var deviceSessionId = OpenPay.deviceData.setup("form-pago", "deviceIdHiddenFieldName");
});