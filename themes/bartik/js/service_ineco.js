jQuery(document).ready(function() {
	jQuery(".service").mouseover(function(){
		var id = jQuery(this).find('.service-off').attr("id");
		id = id.replace("service-off-","");
		jQuery('#service-on-' + id).css('display', 'block');
	    jQuery('#service-off-' + id).css('display', 'none');
	});
	
	jQuery('.service').mouseout(function(){
		var id = jQuery(this).find('.service-on').attr("id");
		id = id.replace("service-on-","");
		jQuery('#service-off-' + id).css('display', 'block');
	    jQuery('#service-on-' + id).css('display', 'none');
    });
	
	
	jQuery(".service-off").children('.service-off-title').each(function () {
		var num = jQuery(this).text().length;		
		if(num > 39){
			jQuery(this).find('a').css('margin-bottom','1px');
		}
		else{
			jQuery(this).find('a').css('margin-bottom','5px');
		}	
	})
	
	jQuery(".service-on").children('.service-on-title').each(function () {
		var num = jQuery(this).text().length;		
		if(num > 39){
			jQuery(this).find('a').css('margin-bottom','1px');
		}
		else{
			jQuery(this).find('a').css('margin-bottom','5px');
		}	
	})
	
	/*
	jQuery(".project-list-wrapper").children('div').children('.project-teaser-title').each(function () {
	var auxA = parseInt(jQuery(this).children('span').children('a').css('height').replace('px', ''));
	var auxSpan = parseInt(jQuery(this).children('span').css('height').replace('px', ''));
	var result = (auxSpan-auxA)/2;
	jQuery(this).children('span').children('a').css('padding-top', result + 'px');
	jQuery(this).children('span').children('a').css('padding-bottom', result + 'px');
	});
	*/
});