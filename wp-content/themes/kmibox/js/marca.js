jQuery(document).ready(function() {

	console.log('data');

	jQuery('[data-target="items"]').on('click', function(){
		jQuery('#fase_1').addClass('hidden');
		jQuery('#fase_2').removeClass('hidden');
		jQuery('.comprar_container')
			.css('margin-bottom', '150px')
			.css('overflow', 'initial');
		jQuery(".comprar_container section")
			.css('height', 'auto');
	});

});