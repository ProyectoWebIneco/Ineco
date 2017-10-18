jQuery(document).ready(function() {

	jQuery(".project-list-wrapper").children('div').children('.project-teaser-title').each(function () {
		var auxA = parseInt(jQuery(this).children('span').children('a').css('height').replace('px', ''));
		var auxSpan = parseInt(jQuery(this).children('span').css('height').replace('px', ''));
		var result = (auxSpan-auxA)/2;
		jQuery(this).children('span').children('a').css('padding-top', result + 'px');
		jQuery(this).children('span').children('a').css('padding-bottom', result + 'px');
	});

	jQuery(".project-teaser-title").each(function () {
		var auxA = parseInt(jQuery(this).children('span').children('a').css('height').replace('px', ''));
		var auxSpan = parseInt(jQuery(this).children('span').css('height').replace('px', ''));
		var result = (auxSpan-auxA)/2;
		jQuery(this).children('span').children('a').css('padding-top', result + 'px');
		jQuery(this).children('span').children('a').css('padding-bottom', result + 'px');
		if(jQuery(this).children('span').children('a').attr('id').search('project-list-') == -1){
			jQuery(this).css('display', 'none');
		}
	});
	
});
