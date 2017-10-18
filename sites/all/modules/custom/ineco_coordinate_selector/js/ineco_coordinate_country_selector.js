(function($) {
	Drupal.behaviors.cruzcampo_synchronize = {
		attach: function (context) {
			$("#edit-name").keyup(function () {
				$("#map-selector-title").html($(this).val());
			});
			
			
			$('#edit-field-country-geographic-area-und').change(function(ev){
				var tid=$(this).val();
				if(tid){
					reloadImageMap(tid);
				}
			});
			var tid = $('#edit-field-country-geographic-area-und').val()
			if(tid){
				reloadImageMap(tid);
			}
			
			$('#edit-field-country-icon-position-und').change(function(ev){
				var orientation=$(this).val();
				if(orientation){
					changeOrientation(orientation);
				}
			});
			var orientation = $('#edit-field-country-icon-position-und').val()
			if(orientation){
				changeOrientation(orientation);
			}
		}
	};

	function changeOrientation(orientation){
		switch(orientation){
			case 'left':
				$('#map-image-country').removeClass().addClass('position-left');
				$('#map-image-country #map-selector #map-selector-image').insertBefore('#map-image-country #map-selector #map-selector-title');
				break;
			case 'right':
				$('#map-image-country').removeClass().addClass('position-right');
				$('#map-image-country #map-selector #map-selector-image').insertAfter('#map-image-country #map-selector #map-selector-title');
				break;
		}
	}
	
	
	function reloadImageMap(tid){
		$.ajax({
			type: 'GET',
			url: Drupal.settings.ineco_coordinate_selector.url_ajax_map + '/' + tid,
			dataType: 'json',
			success: function(data) {
				if(data && data.image_url){
					$('#map-image-country').css('background-image', 'url("' + data.image_url + '")');
					$('#map-image-country').css('width', data.width);
					$('#map-image-country').css('height', data.height);
				}
			}
		});
	}
})(jQuery);




var offset_data; //Global variable as Chrome doesn't allow access to event.dataTransfer in dragover

function onDragStartMap(target, event) {
	var posleft = jQuery(target).css('margin-left');
	var postop = jQuery(target).css('margin-top');
	var style = jQuery(target).style;
	offset_data = (parseInt(posleft,10) - event.clientX) + ',' + (parseInt(postop,10) - event.clientY);
	event.dataTransfer.setData("text/plain",offset_data);
} 
function onDragOverMap(event) { 
	var offset;
	try {
		offset = event.dataTransfer.getData("text/plain").split(',');
	} 
	catch(e) {
		offset = offset_data.split(',');
	}
	
	var dm = document.getElementById('map-selector');
	dm.style.marginLeft = (event.clientX + parseInt(offset[0],10)) + 'px';
	dm.style.marginTop = (event.clientY + parseInt(offset[1],10)) + 'px';
	event.preventDefault(); 
	return false; 
} 
function onDropMap(event) { 
	var offset;
	try {
		offset = event.dataTransfer.getData("text/plain").split(',');
	} 
	catch(e) {
		offset = offset_data.split(',');
	}
	var dm = document.getElementById('map-selector');	
	var maxleft=jQuery('#map-image-country').width() - jQuery(dm).width();
	
	var posleft = (event.clientX + parseInt(offset[0],10));
	
	if(posleft<0){
		posleft=0;
	}else if(posleft>maxleft){
		posleft=maxleft;
	}

	var maxtop=jQuery('#map-image-country').height() - jQuery(dm).height();
	var postop = (event.clientY + parseInt(offset[1],10));
	if(postop<0){
		postop=0;
	}else if(postop>maxtop){
		postop=maxtop;
	}
	
	dm.style.marginLeft = posleft + 'px';
	dm.style.marginTop = postop + 'px';
	
	jQuery("#edit-field-coordinate-x-und-0-value").val(posleft);
	jQuery("#edit-field-coordinate-y-und-0-value").val(postop);
	
	event.preventDefault();
	return false;
}