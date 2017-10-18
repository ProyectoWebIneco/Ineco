jQuery(document).ready(function() {

	function getParameterByName(name){
		name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
		var regexS = "[\\?&]"+name+"=([^&#]*)", 
		regex = new RegExp( regexS ),
		results = regex.exec( window.location.href );
		if( results == null ){
			return "";
		} else{
			return decodeURIComponent(results[1].replace(/\+/g, " "));
		}
	}


	var areaGeografica = getParameterByName("area_geografica");
	if(areaGeografica != ''){
		reloadCombo(areaGeografica);
		jQuery("#edit-area-geografica").val(areaGeografica);
	}

	jQuery("#edit-area-geografica").change(function (){
		reloadCombo(jQuery(this).val());
	});

	function reloadCombo(valor){
		jQuery.ajax({
			type: 'GET',
			url: Drupal.settings.basePath + Drupal.settings.pathPrefix + 'filter-project/ajax/' + valor,
			dataType: 'json',
			success: function(data) {
				jQuery('#edit-pais').children().remove();
				jQuery('#edit-pais').html(data.html);
				var pais = getParameterByName("pais");
				if(pais != ''){
					jQuery("#edit-pais").val(pais);
				}
			}
		});
	}
});
