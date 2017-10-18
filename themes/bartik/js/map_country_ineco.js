(function($) {
	Drupal.behaviors.map_country = {
		attach: function (context) {
			$(".view-donde-estamos-europa .country").mouseover(function(){
				var id = $(this).find('.country-off').attr("id");
				id = id.replace("country-off-","");
				$('#country-on-' + id).css('display', 'block');
				$('#country-off-' + id).css('display', 'none');
			});
			
			$(".view-donde-estamos-europa .country").mouseout(function(){
				var id = $(this).find('.country-on').attr("id");
				id = id.replace("country-on-","");
				$('#country-off-' + id).css('display', 'block');
				$('#country-on-' + id).css('display', 'none');
			});

			
			$(".view-donde-estamos-europa .country").click(function(){
				var country = $(this);
				var tid = $(country).attr("id").replace("country-","");
				
				$('.view-donde-estamos-europa .view-projects-country').not('.view-projects-country-' + tid).hide();
				
				var isYellow = $(this).find(".country-title").hasClass("icon-type-yellow");
				var actual = $('.view-donde-estamos-europa .view-projects-country-' + tid);
				
				if(!isYellow){//!isYellow) {
					if(actual.length){
						if($(actual).is(':visible')){
							$(actual).fadeOut();
						}else{
							$(actual).fadeIn();
						}
					}else{
						$.ajax({
							type: 'GET',
							url: Drupal.settings.donde_estamos_europa.url_projects_country + '/' + tid,
							dataType: 'json',
							success: function(data) {
								if(data && data.html){
									//$('.view-donde-estamos-europa .view-content').before(data.html);
									var parent = $(country).parents('.views-row');
	
									$(parent).append(data.html);
									$(parent).find('.view-projects-country').fadeIn();
									
									$(parent).find('.close_popup').click(function(){
										$(this).parents('.view-projects-country').fadeOut();
									});
									//Tiny Scrollbar
									//$(parent).find('.tinyscrollbar').tinyscrollbar({invertscroll: true});
	
									var step = 50;
									var cum = 0;
									var cum_min = 0;
									var cum_max = jQuery('.donde-estamos-body .view-content').height();
	
									if(cum_max < 240){
										jQuery(".donde-estamos-controllers").hide();
									}else{
	
										jQuery("#donde-estamos-fullcontent-body-scroll-up").live('click', function(ev) {
											ev.preventDefault();
											if (!(cum - step < cum_min)) {
												jQuery(".donde-estamos-body").animate({
													scrollTop : "-=" + step + "px"
												});
												cum = cum - step;
											}
										});
										jQuery("#donde-estamos-fullcontent-body-scroll-down").live('click', function(ev) {
											ev.preventDefault();
											if (!(cum + step > cum_max)) {
												jQuery(".donde-estamos-body").animate({
													scrollTop : "+=" + step + "px"
												});
												cum = cum + step;
											}
										});
									}
								}
						}
					});
				  }
				}
			});
			
			
			/*$(window).resize(function() {
				locate_points();
			});
			
			locate_points();*/
		}
	};
		
	// Se declara la variable como global para que se vaya actualizando
	/*var original_width = 0;
	function locate_points(){
		if(original_width == 0){
			original_width = Drupal.settings.mapa_country.width;
		}
		var current_width = parseInt($('#map-image-country').css('width'));
		var porcentaje = current_width/original_width;
		original_width = current_width;
		
		if(porcentaje != 0 && !(current_width <= 300 && current_width >= Drupal.settings.mapa_country.width)){
			$('.country').each(function(){
				var id = $(this).attr("id").replace('country-', '');
				
				if(current_width < 600){
					$('#country-off-' + id + ' .country-off-title').css('display', 'none');
					$('#country-on-' + id + ' .country-off-title').css('display', 'none');
					$(this).css('margin-top', (parseInt($(this).css('margin-top').replace('px', ''))*porcentaje)  + 'px');
					$(this).css('margin-left', ((parseInt($(this).css('margin-left').replace('px', ''))*porcentaje)) + 'px');
				}else{
					$('#country-off-' + id + ' .country-off-title').css('display', 'block');
					$('#country-on-' + id + ' .country-off-title').css('display', 'block');
					$(this).css('margin-top', (parseInt($(this).css('margin-top').replace('px', ''))*porcentaje) + 'px');
					$(this).css('margin-left', (parseInt($(this).css('margin-left').replace('px', ''))*porcentaje) + 'px');
				}
			});
		}
	}*/
})(jQuery);
