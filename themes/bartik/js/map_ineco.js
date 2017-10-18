(function($) {
	Drupal.behaviors.map_country = {
		attach: function (context) {
			$(".work-zone").mouseover(function(){
				var id = $(this).find('.work-zone-off').attr("id");
				id = id.replace("work-zone-off-","");
				$('#work-zone-on-' + id).css('display', 'block');
				$('#work-zone-off-' + id).css('display', 'none');
			});
			
			$(".work-zone").mouseout(function(){
				var id = $(this).find('.work-zone-on').attr("id");
				id = id.replace("work-zone-on-","");
				$('#work-zone-off-' + id).css('display', 'block');
				$('#work-zone-on-' + id).css('display', 'none');
			});
			
			$(window).resize(function() {
				locate_points();
			});
			
			locate_points();
		}
	};
	
	
	
	// Se declara la variable como global para que se vaya actualizando
	var original_width = 0;
	function locate_points(){
		if(original_width == 0){
			original_width = Drupal.settings.mapa.width;
		}
	
		var current_width = parseInt($('#map-image').css('width'));
		var porcentaje = current_width/original_width;
		original_width = current_width;
		
		if(porcentaje != 0 && !(current_width <= 300 && current_width >= Drupal.settings.mapa.width)){
			$('.work-zone').each(function(){
				var id = $(this).attr("id").replace('work-zone-', '');
				if(current_width < 750){
					$('#work-zone-off-' + id + ' .work-zone-off-title').css('display', 'none');
					$('#work-zone-on-' + id + ' .work-zone-off-title').css('display', 'none');
					$(this).css('margin-top', (parseInt($(this).css('margin-top').replace('px', ''))*porcentaje)  + 'px');
					$(this).css('margin-left', ((parseInt($(this).css('margin-left').replace('px', ''))*porcentaje)) + 'px');
				}else{
					$('#work-zone-off-' + id + ' .work-zone-off-title').css('display', 'block');
					$('#work-zone-on-' + id + ' .work-zone-off-title').css('display', 'block');
					$(this).css('margin-top', (parseInt($(this).css('margin-top').replace('px', ''))*porcentaje) + 'px');
					$(this).css('margin-left', (parseInt($(this).css('margin-left').replace('px', ''))*porcentaje) + 'px');
				}
			});
		}
	}
})(jQuery);
