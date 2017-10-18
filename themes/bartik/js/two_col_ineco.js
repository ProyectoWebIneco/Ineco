jQuery(document).ready(function() {
	
	function twocolumnscarouselcallback(carousel) {
	    jQuery('.slideshow-item-two-col-control a').bind('click', function() {
	        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
	        return false;
	    });
	}
	
	function twocolumnscarouselcallbackafteranimation(carousel, item, i, state) {
		if(i <= 0){
			i = carousel.size() + (i % carousel.size());
		}
		i = ((i - 1) % carousel.size()) + 1;
	    jQuery('.slideshow-item-two-col-control a').attr("class", "");
	    jQuery('#slideshow-item-two-col-control-' + i).attr("class", "item-selected");
	}
	
	jQuery("#slideshow-item-two-col").jcarousel({
		visible: 1,
		scroll: 1,
		wrap: 'both',
		auto: 10,
		initCallback: twocolumnscarouselcallback,
		itemVisibleInCallback: {
			onAfterAnimation: twocolumnscarouselcallbackafteranimation
		}
	});
});
