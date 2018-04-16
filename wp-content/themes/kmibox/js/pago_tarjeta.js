jQuery(document).ready(function() { 

	OpenPay.setId( OPENPAY_TOKEN );
    OpenPay.setApiKey(OPENPAY_PK);
    OpenPay.setSandboxMode( SANDBOX_MODE == 1 );

    var errores = [];
    errores["1001"] = "Error procesando el pago";
    errores["2004"] = "El dígito de verificación del número de tarjeta no es válido";
    errores["2005"] = "La fecha de vencimiento ya ha pasado";
    errores["3001"] = "La tarjeta fue rechazada";
    errores["3002"] = "La tarjeta ha expirado";
    errores["3003"] = "La tarjeta no tiene fondos suficientes";
    errores["3004"] = "La tarjeta ha sido identificada como una tarjeta robada";
    errores["3005"] = "La tarjeta ha sido rechazada por el sistema antifraudes";
    errores["3006"] = "La operación no esta permitida para este cliente o esta transacción";
    errores["3007"] = "La tarjeta fue declinada";
    errores["3008"] = "La tarjeta no es soportada en transacciones en línea";
    errores["3009"] = "La tarjeta fue reportada como perdida";
    errores["3010"] = "El banco ha restringido la tarjeta";
    errores["3011"] = "El banco ha solicitado que la tarjeta sea retenida, contacte al banco";
    errores["3012"] = "Se requiere solicitar al banco autorización para realizar este pago";
    
	var deviceSessionId = OpenPay.deviceData.setup("form-pago", "deviceIdHiddenFieldName");

	// ***************************************
	// Validar form pago
	// ***************************************

	function procesar_pago(){
		jQuery.post(
			TEMA+"procesos/compra/nuevo_pedido_tarjeta.php",
			jQuery('#form-pago').serialize(),
			function(data){
				console.log( data );
				if( data["error"] == "" ){
					jQuery("#pagar").addClass("hidden");
					jQuery("#pago_exitoso").removeClass("hidden");
					jQuery(".controles_generales").css("display", "none");
				}else{
					data["error"].codigo += 0;
					if( data["error"].codigo == 1001 || (data["error"].codigo >= 3001 && data["error"].codigo <= 3012) ){
						var error = "Error: "+errores[ data["error"].codigo ]+"<br>";
				    	error += "Por favor comuniquese con el equipo de soporte de NutriHeroes.";
					}else{
						var error = "Error procesando la suscripci&oacute;n<br>";
				    	error += "Por favor comuniquese con el equipo de soporte de NutriHeroes.";
					}
			    	jQuery(".errores_box").html(error);
					jQuery(".errores_box").css("display", "block");
					jQuery("#btn_pagar_1").text("Realizar Pago");
					jQuery("#btn_pagar_1").prop("disabled", false);
				}
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
	}

	var success_callbak = function(response) {
		var token_id = response.data.id;
		jQuery('#token_id').val(token_id);

		jQuery("#btn_pagar_1").text("Procesando...");
		
		procesar_pago();

	};

	var error_callbak = function(response) {
		var desc = response.data.description != undefined ? response.data.description : response.message;
		console.log(response);

		var error = "";
		if( response.data.error_code == 1001 ){
			switch( desc ){
				case "cvv2 length must be 3 digits":
					error = "La longitud del cvv2 debe ser de 3 dígitos";
				break;
				case "cvv2 length must be 4 digits":
					error = "La longitud del cvv2 debe ser de 4 dígitos";
				break;
			}
		}else{
			error = errores[ response.data.error_code ];
		}

		if( error != "" ){
			var error = "Error: "+error+"<br>";
		}else{
			var error = "Error validando los datos de la tarjeta<br>";
		}

		jQuery(".errores_box").html(error);
		jQuery(".errores_box").css("display", "block");
		jQuery("#btn_pagar_1").prop( "disabled", false);
		jQuery("#btn_pagar_1").text("Realiza Pago");
	};

	jQuery('#form-pago')
	.on('success.form.bv', function(e) {
	    e.preventDefault();
	    jQuery("#btn_pagar_1").text("Validando...");

	    switch( paymentGateway ){
	    	case 'payu':
		    	procesar_pago();
		    	break;
	    	case 'openpay':
		    	OpenPay.token.extractFormAndCreate('form-pago', success_callbak, error_callbak);
		    	break;
	    }

	})
	.bootstrapValidator({
	    feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',		        
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	    },
		submitHandler: function(validator, form, submitButton){
		    validator.defaultSubmit();
		},    
	    fields: {		    
			num_card: {
			    message: 'Error',
			    validators: {
			        notEmpty: {
			            message: 'Este campo no debe estar vacío'
			        },
			        stringLength: {
			        	min: 15,
			        	max: 19,
			        	message: 'El número de tarjeta de credito no es valido'
		      		}
		    	}
			},
			cvv: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
			        	min: 3,
			        	max: 4,
			        	message: 'El código CVV debe ser mínimo 3 dígitos y máximo 4 dígitos'
		      		}
				},
			},
			exp_month: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					between: {
	                    min: 01,
	                    max: 12,
	                    message: 'Debe seleccionar un mes valido'
	                }
				},
			},
			exp_year: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					between: {
	                    min: 01,
	                    max: 99,
	                    message: 'Debe seleccionar un año valido'
	                }
				},
			},
			holder_name: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					stringLength: {
						max: 150,
						min: 2,
						message: 'Longitud Invalida'
					},
					regexp: {
	                    regexp: /^[A-Za-z\s]+$/i,
	                    message: 'Caracteres invalidos '
	                }          
				}
			},
	    }
	});

});

