$(function($){

	// *******************************
	// Change Login
	// *******************************
	$('body').on('click', '[href="#inicio-sesion"]', function(){
		var obj = $('#'+$(this).data('target'));
		$('#inicio-sesion').removeClass('hidden');
		$('#inicio-sesion').addClass('animated fadeIn');
		obj.addClass('hidden');
	});

	// *******************************
	// Change registro
	// *******************************
	$('body').on('click', '[href="#registro"]', function(){
		var obj = $('#'+$(this).data('target'));
		$('#content-register-checkout').removeClass('hidden');
		$('#register').removeClass('hidden');
		$('#register').addClass('animated fadeIn');
		obj.addClass('hidden'); 
		$('#login-mensaje').html('');
		$('#login-mensaje').addClass('hidden');
	});

	// *******************************
	// Next. - Fase ( Sin extras )
	// *******************************
	$('#btn-omitir').on('click', function(){
		kmibox_param['cart']['extra'] = {}; // Quitar los productos extras
		addCart( urlbase ); // actualizar carro de compra en session
		loadFase(4); // limpiar los items seleccionados
		faseNext( $(this) );
	});

	// *******************************
	// Next. - Fase ( Con extras )
	// *******************************
	$('section').on('click', '[data-action="next"]', function(){
		faseNext( $(this) );
	});

	// *******************************
	// Prev. - Fase 		
	// *******************************
	$('[data-action="prev"]').on('click', function(){
		fasePrev( $(this) );
	});

	// ***************************************
	// Event - Resumen de compra
	// ***************************************

	// Quitar del carrito
	$('#cart-items').on( 'click', '[data-target="delete"]', function(){

		var type = $(this).data('type');
		var parent = $(this).data('parent');
		switch( type ){
			case 'boxextra':
				if( kmibox_param != "" ){
					var xdata = {
						'key':'delete',
						'id': parent,
					};
					debug = xdata;
					$.post( urlbase+"/ajax/admin_cart.php", {xdata}, function(result) {		
						$.each( extras, function(index, item){
							if( item['ID'] == parent ){
								delete kmibox_param['cart']['extra'][index];
								loadFase(5); 
							}
						});
					})
					.fail(function() {
						console.log( "error al registrar los datos al carrito de compras" );
					})
				}				
				break;
			case 'boxprimary':
				window.location.reload();
				break;
		}
	});

	// Sumar items
	$('section').on('click','[data-action="sumarItems"]', function(){

		$("#cart-content-alerta").addClass('hidden');

		var nItemsExtras = 2; // Numero de Items extras por Kmibox
		var nkmimbox = 20;
		var limiteKmibox = 20;
		var cantKmibox = $('[data-type="primary"]').val();
		var total = cantKmibox * nItemsExtras;

		var n = $('#cant-'+$(this).attr('data-id') );
		var tipo = $(this).attr('data-type');
		var v = parseInt( n.val() );
 
		

		if( (v < total && tipo=="extra")|| (cantKmibox < limiteKmibox && tipo=="primary") ){

				
			// $('#pagar').addClass('hidden');
			// $('#actualizar').removeClass('hidden');

			var r = v+1;
			if( v > 0 ){
				updateItem( $(this).attr('data-id'), r, urlbase ); 
				if( n.val() == '' ){
					n.val(1);
				}
			}else{
				n.val(1);
			}
		}else{
			// $("#cart-alerta").html( 'La cantidad del artículo adicional seleccionado posee el máximo permitido por cada Kmibox' );
			// $("#cart-content-alerta").removeClass('hidden');
			$('#label-titulo').html('Notificaci&oacute;n');
		if(tipo=="extra"){
			$('#label-mensaje').html('La cantidad del artículo adicional seleccionado posee el máximo permitido por cada Kmibox');
		}else{
			$('#label-mensaje').html('Excedio la cantidad maxima de kmibox permitida');
		}
			$('#mensaje').modal('show');
		}
			
		loadFase(5); 
	});

	// Restar items
	$('section').on('click','[data-action="restarItems"]', function(){

		$("#cart-content-alerta").addClass('hidden');

		// $('#pagar').addClass('hidden');
		// $('#actualizar').removeClass('hidden');

		var n = $('#cant-'+$(this).data('id') );
		var v = parseInt( n.val() );
		var r = v-1;
		if( v > 0 ){
			updateItem( $(this).data('id'), r, urlbase );
		}else{
			n.val(1);
		}
		loadFase(5); 

	});

	// Actualizar Resumen de compras
	$('#actualizar').on( 'click', function(){
		loadFase(5);
		$('#pagar').removeClass('hidden');
		$('#actualizar').addClass('hidden');		
		$("#cart-content-alerta").addClass('hidden');
	});

	// ***************************************
	// Slider productos Extras 
	// ***************************************

	// Add to Cart - Extras
	$('[data-target="add"]').on( 'click', function(){
		var add =1;
		var id = $(this).attr('data-index');
		var extraSelect = kmibox_param['cart']['extra'];
		if( extraSelect[id] >= 0 ){
			delete kmibox_param['cart']['extra'][id];
			add =0;
		}
		if( add ==1){
			kmibox_param['cart']['extra'][id] = id;
		}

		existeExtra( id, 1000, 1200, true );
	});
	// Event.Left Extras
	$('#f4-slider-next').on('click', function(){
	        var item_last = 0;
	        var item = 0;

	        if( $("#f4-slider-item2").attr('data-index') > 0 ){
	        	item = $("#f4-slider-item2").attr('data-index');
	        }
	        changeExtra( 1, item, item_last );

	        item = $("#f4-slider-item3").attr('data-index');
	        changeExtra( 2, item, item_last );

	        item = $("#f4-slider-item4").attr('data-index');
	        changeExtra( 3, item, item_last );

	        item = $("#f4-slider-item5").attr('data-index');
	        changeExtra( 4, item, item_last );

	        ++item;
	        if( item >= PRODUCTOS.length ){
	        	item = item_last;
	        }
	        changeExtra( 5, item, item_last );
	});
	// Event.Right Extras
	$('#f4-slider-prev').on('click', function(){	
	        var item_last = PRODUCTOS.length - 1;
	        var item = 0;
	        if( $("#f4-slider-item4").attr('data-index') > 0 ){
	        	item = $("#f4-slider-item4").attr('data-index');
	        }
	        changeExtra( 5, item, item_last );

	        item = $("#f4-slider-item3").attr('data-index');
	        changeExtra( 4, item, item_last );

	        item = $("#f4-slider-item2").attr('data-index');
	        changeExtra( 3, item, item_last );

	        item = $("#f4-slider-item1").attr('data-index');
	        changeExtra( 2, item, item_last );

	        item = item -1;
	        if( item < 0 ){
	        	item = item_last;
	        }
	        changeExtra( 1, item, item_last );
	});


	$(document).ready(function() {
    $("#carousel").waterwheelCarousel({
     	 
		  flankingItems: 3,
		  movingToCenter: function ($item) {
		    $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
		  },
		  movedToCenter: function ($item) {
		    $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
		  },
		  movingFromCenter: function ($item) {
		    $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
		  },
		  movedFromCenter: function ($item) {
		    $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
		  },
		  clickedCenter: function ($item) {
		    $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
		  }
      
    });
  });
 	
	// ***************************************
	// Donde esta mi kmibox - perfil
	// ***************************************
 	$('#select_kmibox_ubicacion').on('change', function(){
		$('[data-ubicacion]').addClass('selected');
		$('#mobile-estatus').text('');
		$('.loading').removeClass('hidden');
		$.get( urlbase+"/ajax/profile_ubicacion_kmibox.php?id="+$(this).val(), function(r) {

		r= jQuery.trim(r);	
		console.log(r);

			switch(r){
				case "armada":
				console.log(1);
					$('[data-ubicacion="armada"]').removeClass('selected');
					$('#mobile-estatus').text('Armada');
					break;
				case "enviada":
				console.log(2);
					$('[data-ubicacion="armada"]').removeClass('selected');
					$('[data-ubicacion="enviada"]').removeClass('selected');
					$('#mobile-estatus').text('Enviada');
					break;
				case "recibida":
				console.log(3);
					$('[data-ubicacion="armada"]').removeClass('selected');
					$('[data-ubicacion="enviada"]').removeClass('selected');
					$('[data-ubicacion="recibida"]').removeClass('selected');
					$('#mobile-estatus').text('Recibida');
					break;				
			}
			$('.loading').addClass('hidden');

 		});
 	});

	// ***************************************
	// Cargar detalle suscripcion - perfil
	// ***************************************
	$('[data-id="select_kmibox"]').on('change', function(){

		var id = $(this).val();
		var obj = $( '#' + $(this).attr( 'data-target' ) ) ;
		$('.loading').removeClass('hidden');
		$.get( urlbase+"/ajax/profile_mis_suscripciones.php", function(r) {

			var datos = $.parseJSON(r);
			var order = datos[id];

			obj.find('#imagen').attr('src', order['meta']['kmibox_thumnbnail']);
			obj.find('#tipo_suscripcion').val(order['meta']['kmibox_periodo']);
			obj.find('#tipo_kmibox').val( order['meta']['kmibox_size'] );
			obj.find('#proxima_entrega').val(order['meta']['kmibox_periodo'] );

			obj.find('#estatus').val( order['meta']['kmibox_estatus'] );
//			obj.find('#estatus').val( datos[id]['estatus'] );

			// Detalle
			var options = '<option class="text-center">'+datos[id]['items_count']+'</option>';
			$.each( order['items'], function(id, order){
				options = options  +'<option class="text-center">'+order+'</option>';
			})
			obj.find('#articulos').html( options );
 
			$('.loading').addClass('hidden');
		});
	});

	// ***************************************
	// Load municipios 
	// ***************************************
	

 	
	


	jQuery("#tienda").on("click", function(e){
        jQuery("#tienda").val("Procesando...");
        jQuery("#tienda").attr("disabled", true);
        jQuery(".perfil_cargando").css("display", "inline-block");
        $.get( urlbase+"/ajax/checkout_page_cash.php",{}, function(data){
        	var r = $.parseJSON(data);
        	var pdf = r.pdf;
			console.log(pdf);
			$("#Descarga").attr('href',pdf);
			$("#pago_efectivo").modal('show');

		});
        jQuery("#tienda").val("pago efectivo");
        jQuery("#tienda").attr("disabled", false);
        jQuery(".perfil_cargando").css("display", "none");
	});


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
		
		$.post( TEMA+"/procesos/login/registrar.php", {

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

			jQuery(".btn-register_").attr("disabled", false);
			jQuery(".btn-register_").html("Registrarme");

			if(r['code'] == 1){
				
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


	// ***************************************
	// Validar form registro
	// ***************************************
	$('#form-change-password')
	.on('init.field.fv', function(e, data) {
        // data.field   --> The field name
        // data.element --> The field element
        if (data.field === 'sexo') {
            var $icon = data.element.data('fv.icon');
            $icon.appendTo('#alertSexIcon');
        }
    })
	.on('success.form.bv', function(e) {

	    // Prevent form submission
	    e.preventDefault();

	    // Get the form instance
	    var $form = $(e.target);

	    // Get the FormValidation instance
	    var bv = $form.data('formValidation');						

		$('#login-mensaje').html('');
		$('#login-mensaje').addClass('hidden');
		$.post( urlbase+"/ajax/change_password.php", {
			email: $('[name="email"]').val(),
			clave: $('[name="clave"]').val(),
			confirm_clave: $('[name="confirm_clave"]').val(),
		}, function(r) {

			if(r==1){
				window.location = urlbase + "/iniciar-sesion";				
			}else{
				$('#login-mensaje').html('Los datos de registros no fueron guardados, por favor verifique los datos');
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
			clave: {
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
			confirm_clave: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					identical: {
                        field: 'clave',
                        message: 'La contraseña y su confirmación no son los mismos'
                    },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 20
                    }
				},
			}
		}
	});


	$('#link-registro').on('click', function(){
		$('#imgclick').addClass('hidden');	
	});

	// ***************************************
	// Validar form Login
	// ***************************************
	$('#form-login')
	.on('init.field.fv', function(e, data) {

    })
	.on('success.form.bv', function(e) {

	    // Prevent form submission
	    e.preventDefault();

	    // Get the form instance
	    var $form = $(e.target);

	    // Get the FormValidation instance
	    var bv = $form.data('formValidation');						

		$('#login-mensaje').html('');
		$('#login-mensaje').addClass('hidden');
		$.post( urlbase+"/ajax/login.php", {
			key:'login',
			usuario: $('[name="usuario"]').val(),
			clave: $('[name="clave"]').val(),
			rememberme: $('[name="rememberme"]').val()
		}, function(r) {
			if(r==1){
				window.location.reload();
			}else{
				$('#login-mensaje').html('Usuario o Clave invalidos');
				$('#login-mensaje').removeClass('hidden');

				$('[name="usuario"]').val('');
				$('[name="clave"]').val('');

				$('#form-login').bootstrapValidator('revalidateField', 'usuario');
				$('#form-login').bootstrapValidator('revalidateField', 'clave');
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
		    
			usuario: {
				message: 'Email invalido',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},					
				},
			},
			clave: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					different: {
	                    field: 'r_usuario',
	                    message: 'El nombre de usuario y la contraseña no pueden ser iguales entre sí'
	                }
				},
			},

	    }
	});

	/////////img del rgistro, cuando compras y no estas registrado/////////
	$('inicio-sesion').on('click', '[href="#registro"]', function(){
		var obj = $('#'+$(this).data('target'));
		$('#imgclick').addClass('hidden');	});


	// ***************************************
	// Validar form Login
	// ***************************************
	$('#form-reset-password')
	.on('init.field.fv', function(e, data) {
    })
	.on('success.form.bv', function(e) {

	    // Prevent form submission
	    e.preventDefault();

	    // Get the form instance
	    var $form = $(e.target);

	    // Get the FormValidation instance
	    var bv = $form.data('formValidation');						

		$('#login-mensaje').html('');
		$('#login-mensaje').addClass('hidden');
		$.post( TEMA+"/procesos/login/recuperar.php", {
			email: $('[name="email"]').val(),
		}, function(r) {
			var datos = $.parseJSON(r);

			if(datos['sts'] == 1){

				$('#login-mensaje').html('Se ha enviado un mensaje a tu email con instrucciones para recuperar la contraseña.');
				$('#login-mensaje').addClass('alert-info');
				$('#login-mensaje').removeClass('alert-danger');
				$('#login-mensaje').removeClass('hidden');

				$('[name="email"]').val('');
			}else{
				$('#login-mensaje').html('Error al tratar de verificar los datos. por favor verifique la direccion de mail');
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
			email: {
				message: 'Email invalido',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},					
				},
			},
	    }
	});



	// ***************************************
	// Validar tipo de datos 
	// ***************************************
	$('[data-charset]').on({
		keypress : function(e){
				var tipo= $(this).attr('data-charset');
				if(tipo!='undefined' || tipo!=''){
					var cadena = "";

					if(tipo.indexOf('alf')>-1 ){ cadena = cadena + "abcdefghijklmnopqrstuvwxyzáéíóúñüÁÉÍÓÚÑÜ"; }
					if(tipo.indexOf('xlf')>-1 ){ cadena = cadena + "abcdefghijklmnopqrstuvwxyzáéíóúñüÁÉÍÓÚÑÜ "; }
					if(tipo.indexOf('num')>-1 ){ cadena = cadena + "1234567890"; }
					if(tipo.indexOf('cur')>-1 ){ cadena = cadena + "1234567890,."; }
					if(tipo.indexOf('esp')>-1 ){ cadena = cadena + "-_.$%&@,/()"; }
					if(tipo.indexOf('cor')>-1 ){ cadena = cadena + "@"; }
					if(tipo.indexOf('rif')>-1 ){ cadena = cadena + "vjegi"; }

					var key = e.which,
						keye = e.keyCode,
						tecla = String.fromCharCode(key).toLowerCase(),
						letras = cadena;
				    if(letras.indexOf(tecla)==-1 && keye!=9&& (key==37 || keye!=37)&& (keye!=39 || key==39) && keye!=8 && (keye!=46 || key==46) || key==161){
				    	e.preventDefault();
				    }
				}	
			}
	});


	// ***************************************
	// Load municipios 
	// ***************************************
	$('[name="dir_estado"]').on('change', function(){

		$.get( urlbase+"/ajax/admin_municipio.php?estado="+$(this).val(), function(r) {
			var options = '<option value="0">Delegación</option>';
			var rx = $.parseJSON(r);
			$.each( rx, function(id, row){
				options = options  + '<option value="'+row.id+'">'+row.name+'</option>';
			});
			$('[name="dir_ciudad"]').html( options );
		});

	});


	// ***************************************
	// Iniciar fase 
	// ***************************************
	
	jQuery('#email').on('change', function(){
		popup_validate(jQuery(this));
	});
	jQuery('#phone').on('change', function(){
		popup_validate(jQuery(this));
	});
	jQuery('#mi_marca').on('change', function(){
		popup_validate(jQuery(this));
	});
	function popup_validate(obj){		
		obj.css('border-color', "transparent");
		obj.css('background', "#fff");
		if( obj.val() == '' ){
			obj.css('border-color', "#b30909");
			obj.css('background', "#f353538c");
			return 1;
		}		
		return 0;
	}


 
	$('#form-contacto').on( 'submit', function(e){
		// Prevent form submission
		e.preventDefault();

		var validate = 0;
		if( jQuery('#email').val() == '' ){
			validate += popup_validate( jQuery('#email') );
		}
		if( jQuery('#phone').val() == '' ){
			validate += popup_validate( jQuery('#phone') );
		}
		if( jQuery('#mi_marca').val() == '' ){
			validate += popup_validate( jQuery('#mi_marca') );
		}

		if( validate == 0 ){	
			jQuery.post(TEMA+'procesos/subscribers/subscribers.php', jQuery('#form-contacto').serialize(), function(data){
					if(data.code==1){
						jQuery('#mensaje').html('Datos registrados, en breve te ayudamos con tu solicitud.');
						jQuery('#mensaje').css('display', 'block');
						setTimeout(function() {
							jQuery('#mensaje').css('display', 'none');
				        },5000);
					}
			}, "json")
			.fail(function(e) { console.log( e ); });

			jQuery('#email').val('');
			jQuery('#phone').val('');
			jQuery('#mi_marca').val('');
		}
	});
 
	$('#form-contacto-ayuda').on( 'submit', function(e){
		// Prevent form submission
		e.preventDefault();

		var validate = 0;
		if( jQuery('#email').val() == '' ){
			validate += popup_validate( jQuery('#email') );
		}
		if( jQuery('#phone').val() == '' ){
			validate += popup_validate( jQuery('#phone') );
		}

		if( validate == 0 ){
			jQuery.post(TEMA+'procesos/subscribers/subscribers.php', jQuery('#form-contacto-ayuda').serialize(), function(data){
				if(data.code==1){
					jQuery('#mensaje').html('Datos registrados, en breve te ayudamos con tu solicitud.');
					jQuery('#mensaje').css('display', 'block');
					setTimeout(function() {
						jQuery('#mensaje').css('display', 'none');
			        },5000);
				}
			}, "json")
			.fail(function(e) { console.log( e ); });
			jQuery('#email').val('');
			jQuery('#phone').val('');

		}
	});
	
});
