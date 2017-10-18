jQuery(document).ready(function() {
	jQuery('.project-teaser').mouseover(function(){
		var id = jQuery(this).find('.project-teaser-off').attr("id");
		id = id.replace("project-teaser-off-","");
		jQuery('#project-teaser-on-' + id).css('display', 'block');
	    	jQuery('#project-teaser-off-' + id).css('display', 'none');

		if(jQuery(this).attr('id') == 'project-list'){
			jQuery(this).children('.project-teaser-title').css('display', 'block');
		}
	});
	
	jQuery('.project-teaser').mouseout(function(){
		var id = jQuery(this).find('.project-teaser-on').attr("id");
		id = id.replace("project-teaser-on-","");
		jQuery('#project-teaser-off-' + id).css('display', 'block');
	        jQuery('#project-teaser-on-' + id).css('display', 'none');

		if(jQuery(this).attr('id') == 'project-list'){
			jQuery(this).children('.project-teaser-title').css('display', 'none');
		}
    });

	if (jQuery("#revistAlone").length) {
		jQuery("#revistAlone .simple-page-links").toggle();
	}
});

var FBVideo = {
open: function(width, height, url, txt) {
	jQuery("#footer .copyright-pie").fancybox({
		'autoScale'		: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'width'			: width,
		'height'			: height,
		'padding'		: 0,
		'type'			: 'swf',
		'swf'			: {
			'wmode'		: 'transparent',
			'allowfullscreen'	: 'true',
			'loop'          	: 'false',
			'menu'		: 'true',
			'quality'		: 'best'
		},
		'href'			: '/webineco/sites/default/files/' + url,
		'titlePosition' 		: 'inside',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return (txt != undefined) ?txt :"";
		}
	}).trigger('click');
}
};
