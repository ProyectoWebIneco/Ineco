jQuery(document).ready(function() {
	
	function getParam(key){
	  var value=RegExp(""+key+"[^&]+").exec(window.location.search);
	  return unescape(!!value ? value.toString().replace(/^[^=]+./,"") : "");
	}
	
	jQuery("#preconfigured-reports-select").val(getParam("preconfigured"));

	jQuery("#preconfigured-reports-select").change(function() {
		console.log(jQuery(this).val());
		if(jQuery(this).val() != 'All'){
			jQuery.ajax({
				type: 'GET',
				url: Drupal.settings.basePath + 'preconfigured-reports/' + jQuery(this).val(),
				dataType: 'json',
				success: function(data) {
					window.location.href = window.location.pathname + '?' + data.url;
				}
			});
		}
	});
});
