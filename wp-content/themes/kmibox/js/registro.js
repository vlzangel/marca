// ***************************************
// Validar form registro
// ***************************************
$('#form-registro')
.on('init.field.fv', function(e, data) {
	scroll(0);

    // data.field   --> The field name
    // data.element --> The field element
    if (data.field === 'sexo') {
        var $icon = data.element.data('fv.icon');
        $icon.appendTo('#alertSexIcon');
    }
})
.on('error.form.bv', function(e) {
	jQuery("#error_registrando").css("display", "block");
})
.on('success.form.bv', function(e) {
    // Prevent form submission
    e.preventDefault();

	jQuery("#error_registrando").css("display", "none");

	jQuery(".btn-register_").attr("disabled", true);
	jQuery(".btn-register_").html("Procesando...");

    
    // Get the form instance
    var $form = $(e.target);

    // Get the FormValidation instance
    var bv = $form.data('formValidation');		

    
	$('#login-mensaje').html('');
	$('#login-mensaje').addClass('hidden');
	
	$.post( urlbase+"/ajax/register.php", {
		key:'registro',

		email: $('[name="r_usuario"]').val(),
		email_c: $('[name="r_usuario_c"]').val(),
		pass: $('[name="r_clave"]').val(),
		pass_c: $('[name="r_clave_c"]').val(),

		nombre: $('[name="nombre"]').val(),
		apellido: $('[name="apellido"]').val(),
		sexo: $('[name="sexo"]').val(),
		edad: $('[name="edad"]').val(),
		mascota: $('[name="mascota"]').val(),
		telef_movil: $('[name="telef_movil"]').val(),
		telef_fijo: $('[name="telef_fijo"]').val(),
		dondo_conociste: $('[name="dondo_conociste"]').val(),

		dir_numint: $('[name="dir_numint"]').val(),
		dir_numext: $('[name="dir_numext"]').val(),

		dir_calle: $('[name="dir_calle"]').val(),
		dir_estado: $('[name="dir_estado"]').val(),
		dir_ciudad: $('[name="dir_ciudad"]').val(),
		dir_colonia: $('[name="dir_colonia"]').val(),
		dir_codigo_postal: $('[name="dir_codigo_postal"]').val()

	}, function(r) {

		r = $.parseJSON(r);

		console.log( r );

		jQuery(".btn-register_").attr("disabled", false);
		jQuery(".btn-register_").html("Registrarme");

		if(r['code']==1){
			
			jQuery("#success_registrando").css("display", "block");

			setTimeout(function(){
				var redirect = $('[name="redirect"]').val();
				if( typeof $('[name="redirect"]').val() == 'undefined'){
					redirect = '';
				}
				if( redirect != '' ){
					window.location = redirect;
				}else{
					window.location.reload();				
				}			
			}, 1000);

		}else{
			$('#login-mensaje').html(r['msg']);
			$('#login-mensaje').removeClass('hidden');

		}
		//<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
		//<span class="sr-only">Loading...</span>
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
	    
		nombre: {
		    message: 'Error',
		    validators: {
		        notEmpty: {
		            message: 'Este campo no debe estar vacío'
		        },
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 50
                }
	    	}
		},
		apellido: {
		    message: 'Error',
		    validators: {
		        notEmpty: {
		            message: 'Este campo no debe estar vacío'
		        },
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 50
                }
	    	}
		},
		sexo: {
			message: 'Error',
			validators: {
				choice: {
					min: 1,
					max: 1,
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		edad: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				}, 
					integer :{
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		telef_movil: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 13,
                    min: 10
                }

			},
		},
		telef_fijo:{
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 13,
                    min: 10
                }

			},
		},
		dondo_conociste: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		r_usuario: {
			message: 'Email invalido',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},					
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 200
                }
			},
		},
		r_usuario_c: {
			message: 'Email invalido',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
				identical: {
                    field: 'r_usuario',
                    message: 'El usuario y su confirmación no son los mismos'
                },
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 200
                }
			},
		},
		r_clave: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
				different: {
                    field: 'r_usuario',
	                    message: 'El nombre de usuario y la contraseña no pueden ser iguales entre sí'
                },
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 20
                }
			},
		},
		r_clave_c: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
				identical: {
                    field: 'r_clave',
                    message: 'La contraseña y su confirmación no son los mismos'
                },
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 20
                }
                
			},
		},
		dir_calle: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 200
                }
			},
		},
		dir_numext: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 20
                }
			},
		},
		dir_estado: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},integer :{
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		dir_ciudad: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},integer :{
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		dir_colonia: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 50

                }					
			},
		},
		dir_codigo_postal: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
		        stringLength: {
                    message: 'Post content must be less than 120 characters',
                    max: 15
                }					
			},
		},
    }
});

/*/////////img del rgistro, cuando compras y no estas registrado/////////
	$('inicio-sesion').on('click', '[href="#registro"]', function(){
		var obj = $('#'+$(this).data('target'));
		$('#imgclick').addClass('hidden');	});*/
