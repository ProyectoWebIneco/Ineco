jQuery(document).ready(function() {
	jQuery('.sector').mouseover(function(){
		var id = jQuery(this).find('.sector-off').attr("id");
		id = id.replace("sector-off-","");
		jQuery('#sector-on-' + id).css('display', 'block');
	    jQuery('#sector-off-' + id).css('display', 'none');
	});
	
	jQuery('.sector').mouseout(function(){
		var id = jQuery(this).find('.sector-on').attr("id");
		id = id.replace("sector-on-","");
		jQuery('#sector-off-' + id).css('display', 'block');
	    jQuery('#sector-on-' + id).css('display', 'none');
    });
});