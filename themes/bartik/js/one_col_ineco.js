jQuery(document).ready(function() {
	
	jQuery(".slideshow-item-one-col-text-block").mouseover(function(){
		
		jQuery(this).find('.slideshow-item-one-col-text-on').show();
		jQuery(this).find('.slideshow-item-one-col-text').hide();
	});
		
	jQuery(".slideshow-item-one-col-text-block").mouseleave(function(){
		jQuery(this).find('.slideshow-item-one-col-text').show();
		jQuery(this).find('.slideshow-item-one-col-text-on').hide();
	});
		
	jQuery('#slideshow-item-one-col').jcarousel({
		visible: 1,
		scroll: 1,
		wrap: 'circular',
		auto: 10
    });
});
