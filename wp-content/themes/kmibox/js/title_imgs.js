jQuery(document).ready(function() {
	jQuery("img").attr("alt", "Nutriheroes - El camino a una correcta nutrición");
	if(navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod' || navigator.platform == 'MacIntel'){ 
		jQuery("body").addClass("iOS");
	}
});