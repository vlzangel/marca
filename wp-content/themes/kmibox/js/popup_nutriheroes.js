 /*
 
$('#form-contacto')
.on('error.form.bv', function(e) {
	jQuery("#error_registrando").css("display", "block");
})
.on('success.form.bv', function(e) {
    // Prevent form submission
    e.preventDefault();
	jQuery.post(
		TEMA+"procesos/subscribers/subscribers.php", jQuery('#form-contacto').serialize(), function(data){
			if(data.code==1){
				jQuery('#mensaje').html('Datos registrados en breve te ayudarte con tu solicitud');
				jQuery('#mensaje').css('display', 'block');
				setTimeout(function() {
					jQuery('#mensaje').css('display', 'none');
		        },5000);
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
	    
		email: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				}, 
			},
		},
		phone: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				}, 
				integer :{
					message: 'Debes ingresar solo n&uacute;meros'
				},
			},
		},
		mi_marca: {
			message: 'Error',
			validators: {
				notEmpty: {
					message: 'Este campo no debe estar vacío'
				},
			},
		},
		
    }
});*/