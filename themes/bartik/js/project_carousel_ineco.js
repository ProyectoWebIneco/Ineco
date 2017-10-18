jQuery(document).ready(function() {
	
	function nvisible(){
		var width = jQuery('.project-carousel-carousel-wrapper').css('width').replace('px', '');
		
		var num_visible = 3;
		if(width < 639){
			num_visible = 2;
		}
		if(width <= 460){
			num_visible = 1;
		}
		return num_visible;
	}
	
	jQuery('#project-carousel-carousel').jcarousel({
		visible: nvisible(),
		scroll: 1,
		wrap: 'last',
		auto: 10
	});
	
	jQuery('.jcarousel-next').mouseenter(function() {
		this.iid = setInterval(function() {
			jQuery('.jcarousel-next').click();	
    		}, 2500);
	}).mouseleave(function(){
    		this.iid && clearInterval(this.iid);
	});

	jQuery('.jcarousel-prev').mouseenter(function() {
		this.iid = setInterval(function() {
			jQuery('.jcarousel-prev').click();	
    		}, 2500);
	}).mouseleave(function(){
    		this.iid && clearInterval(this.iid);
	});
});
