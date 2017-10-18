jQuery(document).ready(function() {

	var step = 20;
	var cum = 0;
	var cum_min = 0;
	var cum_max = parseInt(jQuery('.new-fullcontent-body-right').css('width'));
	
	if(jQuery('.new-fullcontent-body-right').get(0).scrollHeight > jQuery('.new-fullcontent-body-right').innerHeight()){
		jQuery('.new-fullcontent-body-scroll-wrapper').css('display', 'block');
	}
	
	jQuery(".new-teaser-off").mouseover(function() {
		var id = jQuery(this).attr("id");
		id = id.replace("new-teaser-off-", "");
		jQuery('#new-teaser-on-' + id).css('display', 'block');
		jQuery('#new-teaser-off-' + id).css('display', 'none');
	});

	jQuery(".new-teaser-on").mouseout(function() {
		var id = jQuery(this).attr("id");
		id = id.replace("new-teaser-on-", "");
		jQuery('#new-teaser-off-' + id).css('display', 'block');
		jQuery('#new-teaser-on-' + id).css('display', 'none');
	});

	jQuery("#new-fullcontent-body-scroll-up").click(function(ev) {
		ev.preventDefault();
		if (!(cum - step < cum_min)) {
			jQuery(".new-fullcontent-body-right").animate({
				scrollTop : "-=" + step + "px"
			});
			cum = cum - step;
		}
	});

	jQuery("#new-fullcontent-body-scroll-down").click(function(ev) {
		ev.preventDefault();
		if (!(cum + step > cum_max)) {
			jQuery(".new-fullcontent-body-right").animate({
				scrollTop : "+=" + step + "px"
			});
			cum = cum + step;
		}
	});
});
