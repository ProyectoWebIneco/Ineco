jQuery(document).ready(function() {
	
	function projectcarouselcallback(carousel) {
	    jQuery('.project-fullcontent-header-right-slideshow-control a').bind('click', function() {
	        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
	        return false;
	    });
	};
	
	function projectcallbackafteranimation(carousel, item, i, state) {
		if(i <= 0){
			i = carousel.size() + (i % carousel.size());
		}
		i = ((i - 1) % carousel.size()) + 1;
	    	jQuery('.project-fullcontent-header-right-slideshow-control a').attr("class", "");
	    	jQuery('#project-fullcontent-header-right-slideshow-control-' + i).attr("class", "item-selected");
	}

	function calculateAutoTime(){
		autoTime = 5;
		if(jQuery('.project-fullcontent-header-right-slideshow-imagen').length == 1){
			autoTime = 600;
		}
		return autoTime;
	}

	function calculatebuttonNextHTML(){
		if(jQuery('.project-fullcontent-header-right-slideshow-imagen').length == 1){
			return null;
		}
	}

	function calculatebuttonPrevHTML(){
		if(jQuery('.project-fullcontent-header-right-slideshow-imagen').length == 1){
			return null;
		}
	}

	var carrusel = jQuery("#project-fullcontent-header-right-slideshow").jcarousel({
		visible: 1,
		scroll: 1,
        	wrap: 'circular',
        	auto: calculateAutoTime(),
        	initCallback: projectcarouselcallback,
        	itemVisibleInCallback: {
			onAfterAnimation: projectcallbackafteranimation
		},
		buttonNextHTML:calculatebuttonNextHTML(),
		buttonPrevHTML:calculatebuttonPrevHTML()
	});
	
	jQuery('#project-testimony-carousel').jcarousel({
		visible: 1,
		scroll: 1,
		wrap: 'circular',
		auto: 10
	});

	jQuery('#project-testimony-carousel-ii').jcarousel({
		visible: 1,
		scroll: 1,
		wrap: 'circular',
		auto: 1000
	});


	// Se centran las flechas
	if(!(jQuery('.carousel-wrapper').css('height') === undefined)){
		jQuery('.carousel-wrapper').css('height', jQuery('.carousel-wrapper').css('height'))
		jQuery('#project-testimony-carousel').children('.jcarousel-prev').css('top', (parseInt(jQuery('.carousel-wrapper').css('height').replace("px",""))-40)/2);
		jQuery('#project-testimony-carousel').children('.jcarousel-next').css('top', (parseInt(jQuery('.carousel-wrapper').css('height').replace("px",""))-40)/2);
	}
	
	if(!(jQuery('.carousel-wrapper-ii').css('height') === undefined)){
		jQuery('.carousel-wrapper-ii').css('height', jQuery('.carousel-wrapper-ii').css('height'))
		var top = (parseInt(jQuery('.carousel-wrapper-ii').css('height').replace("px",""))-40)/2;
		jQuery('#project-testimony-carousel-ii').children('.jcarousel-prev').css('top', top);
		jQuery('#project-testimony-carousel-ii').children('.jcarousel-next').css('top', top);
	}

	// Se centran las citas
	jQuery('.project-fullcontent-paragraph-0-right-body-testimony-ii').each(function(){
		var alturaTotal = parseInt(jQuery('.carousel-wrapper-ii').css('height').replace('px', ''));
		var alturaActual = parseInt(jQuery(this).css('height').replace('px', ''));
		var padding = (alturaTotal - alturaActual - 40) / 2;
		padding = padding + 20;
		jQuery(this).css('padding-top', padding + 'px');
	});

	if(!(jQuery.browser.msie && jQuery.browser.version == '9.0')){
		jQuery('.project-testimony-carousel-item').each(function(){
			var alturaTotal = parseInt(jQuery('.carousel-wrapper').css('height').replace('px', ''));		
			var alturaActual = parseInt(jQuery(this).css('height').replace('px', ''));		
			var padding = (alturaTotal - alturaActual - 40) / 2;
			padding = padding + 20;
			jQuery(this).css('padding-top', padding + 'px');
		});
	}else{
		/*jQuery('.project-testimony-carousel-item').each(function(){
			var alturaTotal = parseInt(jQuery('.carousel-wrapper').css('height').replace('px', ''));		
			var alturaActual = parseInt(jQuery(this).css('height').replace('px', ''));		
			alert('alturaTotal => ' + alturaTotal + ' alturaActual => ' + alturaActual);
		});*/
	}
});
