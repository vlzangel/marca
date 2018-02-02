
// ***************************************
// Validar form cargar orden
// ***************************************
	var ORDEN_PRODUCTOS;

	$("#codidoasesor")
			.on("change", function(){
				console.log($("#codidoasesor").val());
				console.log(urlbase);
				var result;
				var codigo = {
					'codasesor' : $("#codidoasesor").val()
				}
				result = JSON.parse(getData(urlbase+"/ajax/busca_asesor.php","POST", codigo));
			
				if (result.id != "NO_ASESOR") {
					$("#small1").addClass("hidden");
					$("#nombreasesor").attr("value",result.nombre);
					$("#emailasesor").attr("value",result.email);					
				}else{
					$("#sin_asesor").text(result.msg);
					$("#small1").removeClass("hidden");
					$("#nombreasesor").attr("value",null);
					$("#emailasesor").attr("value",null);
				}
	});
	$("#r_usuario")
		.on("change", function(){
				var client;
				var email = { 'email' : $("#r_usuario").val()}
				
			$.post(urlbase+"/ajax/busca_cliente.php",email, function(data){

				client = $.parseJSON(data);
 
				if (client.id > 0) {
					$("#small2").addClass("hidden");
					$("#user_id").attr("value", client['id']);
					$("#inputEmail3").attr("value",client['nombre']+' '+client['apellido']);
					$("#telef_movil").attr("value",client['telefono']);
				}else{
					$("#small2").removeClass("hidden");
					$("#user_id").attr("value",0);
					$("#sin_cliente").text(client['msg']);	
					$("#inputEmail3").attr("value",null);
					$("#telef_movil").attr("value",null);
				}

			});	
	});
	$('#orden_action').on('click', function(){
		$('#order_confirmacion').modal('hide');	
		setTimeout(function(){
			window.location.reload();				
		}, 1000);
	});

	$('[data-load="productos"]').on('change', function(){
		cargar_datos( $('#tipo').val(), $('#tamano').val(), $('#edad').val()  );
	});

	$('[name="dir_marcas"]').on('change', function(){

		var planes = '';

		for (var i = ORDEN_PRODUCTOS.length - 1; i >= 0; i--) {
			var item = ORDEN_PRODUCTOS[i]; 
			if( item.marca == $('#dir_marcas').val() ){

				$('[name="dir_peso"]').val( item.peso );
				$('[name="dir_precio"]').val( item.precio );

				$("[data-planes]").css('display', 'none');
				$.each( item.planes, function(d,s){
					if( s == 1 ){
						$("[data-planes='"+d+"']").css('display', 'inline-block');
					}
				});
			}
		}
		
		if( planes == '' ){
			planes = '<option>No hay planes disponibles</option>';
		}

	});

	$('#form-cargar-orden')
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
			// jQuery(".btn-register_").attr("disabled", true);
			jQuery(".btn-register_").html("Procesando...");

		    // Get the form instance
		    var $form = $(e.target);

		    // Get the FormValidation instance
		    var bv = $form.data('formValidation');		

			$('#login-mensaje').html('');
			$('#login-mensaje').addClass('hidden');
			

			$.post( TEMA+"/procesos/asesor/cargar_orden.php", $('#form-cargar-orden').serialize()  , function(r) {
				r = $.parseJSON(r);
				jQuery(".btn-register_").attr("disabled", false);
				jQuery(".btn-register_").html("Registrarme");

				if(r['code'] == 1){
					jQuery("#success_registrando").css("display", "block");
					$('#order_confirmacion').find('.modal-title').html('<span style="font-size: 16px;text-transform: uppercase;color: #0ab7aa;"><strong>Orden generada satisfactoriamente.</strong></span>');
					$('#order_confirmacion').find('.modal-body').html(
							"Orden #: "+r['orden_id']+'<br>'+
							"Cliente: "+r['nombre']+'<br>'+
							"Estatus: Pendiente de pago<br>"
						);
					$('#order_confirmacion').modal('show');
				}else{
					$('#login-mensaje').html(r['msg']);
					$('#login-mensaje').removeClass('hidden');
				}
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
				emailsus: {
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
				dir_marcas: {
					message: 'Error',
					validators: {
						notEmpty: {
							message: 'Este campo no debe estar vacío'
						},integer :{
							message: 'Este campo no debe estar vacío'
						},
					},
				},
				dir_planes: {
					message: 'Error',
					validators: {
						notEmpty: {
							message: 'Este campo no debe estar vacío'
						},integer :{
							message: 'Este campo no debe estar vacío'
						},
					},
				},
				r_address: {
					message: 'Error',
					validators: {
						notEmpty: {
							message: 'Este campo no debe estar vacío'
						},
				        stringLength: {
	                        message: 'Post content must be less than 120 characters',
	                        max: 500,
	                        min: 20
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
				casa_oficina: {
					message: 'Error',
					validators: {
						notEmpty: {
							message: 'Este campo no debe estar vacío'
						}
					},
				},
				forma_pago: {
					message: 'Error',
					validators: {
						notEmpty: {
							message: 'Este campo no debe estar vacío'
						}
					},
				},
				nombreasesor: {
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
				codidoasesor: {
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
				emailasesor: {
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
				emailasesor_c: {
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
		    }
		});

	function getData(url,method, datos){
		return $.ajax({
				data: datos,
				type: method,
				url: url,
				async:false,
				success: function(data){
		            return data;
				}
			}).responseText;
	}
	
	function cargar_datos( tipo='', tamano='', edad='' ){

		if( tipo == "" || tamano == "" || edad == "" ){ return;}

		$.post( TEMA+"assets/ajax/busca_data.php", {_tipo:tipo, _tamano:tamano, _edad:edad}, function(data) {
			ORDEN_PRODUCTOS = $.parseJSON(data);
			var options = '';
			for (var i = ORDEN_PRODUCTOS.length - 1; i >= 0; i--) {
				var item = ORDEN_PRODUCTOS[i]; 
				options += '<option value="'+item.marca+'">'+item.marca_nombre+'</option>';
			} 
			if( options == '' ){
				options = '<option>No hay marcas disponibles</option>';
			}
			$('#dir_marcas').html(options);
		});
	}