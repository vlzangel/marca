jQuery(document).ready(function() { 

	OpenPay.setId( OPENPAY_TOKEN );
    OpenPay.setApiKey(OPENPAY_PK);
    OpenPay.setSandboxMode( OPENPAY_PRUEBAS == 1 );

    var errores = [];
    errores["1001"] = "La longitud del CVV2 debe ser de 4 digitos";
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
	jQuery('#form-pago')
	.on('success.form.bv', function(e) {
	    e.preventDefault();

	    jQuery("#btn_pagar_1").text("Procesando...");

	    jQuery.post(
			TEMA+"procesos/compra/nuevo_pedido_tarjeta.php",
			jQuery(this).serialize(),
			function(data){
				console.log( data );
				if( data["error"] == "" ){
					jQuery("#pagar").addClass("hidden");
					jQuery("#pago_exitoso").removeClass("hidden");
					jQuery("#btn_pagar_1").text("Realizar Pago");

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

