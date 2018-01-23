jQuery(document).ready(function() { 

	OpenPay.setId( OPENPAY_TOKEN );
    OpenPay.setApiKey(OPENPAY_PK);
    OpenPay.setSandboxMode( OPENPAY_PRUEBAS == 1 );
    
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
				}else{
					alert("Error, ver en la consola javascript");
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
			        creditCard: {
				        message: 'El número de tarjeta de credito no es valido'
			        },
			        stringLength: {
			        max: 16,
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
					cvv: {
						creditCardField: 'num_card',
						message: 'El código de serguridad es invalido'
					},
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

