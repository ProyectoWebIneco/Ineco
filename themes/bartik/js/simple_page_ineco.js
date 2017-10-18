jQuery(document).ready(function() {

	var step = 20;
	var cum = 0;
	var cum_min = 0;
	var cum_max = parseInt(jQuery('.simple-page-body').css('height'));

	jQuery("#simple-page-fullcontent-body-scroll-up").click(function(ev) {
		ev.preventDefault();
		if (!(cum - step < cum_min)) {
			jQuery(".simple-page-body").animate({
				scrollTop : "-=" + step + "px"
			});
			cum = cum - step;
		}
	});

	jQuery("#simple-page-fullcontent-body-scroll-down").click(function(ev) {
		ev.preventDefault();
		if (!(cum + step > cum_max)) {
			jQuery(".simple-page-body").animate({
				scrollTop : "+=" + step + "px"
			});
			cum = cum + step;
		}
	});
});
