jQuery(document).ready(function() {

	jQuery('#edit-type option').remove();

	jQuery('#edit-type-wrapper').hide();

	jQuery('#edit-pretype').change(function(){
		var valor = jQuery(this).val();
		
		jQuery.ajax({
			type: 'GET',
			url: Drupal.settings.basePath + 'filter-contact-requests/ajax/' + valor,
			dataType: 'json',
			success: function(data) {
				jQuery('#edit-type').children().remove();
				jQuery('#edit-type').html(data.html);
				jQuery('#edit-type').removeAttr('disabled');
				jQuery('#edit-type-wrapper').show();
			}
		});
	});

	jQuery('#edit-date-min-datepicker-popup-0').change(function(){
		var valor = jQuery(this).val();
		if(valor != ''){
			valor = valor.split("/");
			jQuery(this).val(valor[2] + '-' + valor[0] + '-' + valor[1]);
		}else{
			jQuery(this).val('');
		}
	});

	jQuery('#edit-date-max-datepicker-popup-0').change(function(){
		var valor = jQuery(this).val();
		if(valor != ''){
			valor = valor.split("/");
			jQuery(this).val(valor[2] + '-' + valor[0] + '-' + valor[1]);
		}else{
			jQuery(this).val('');
		}
	});

	jQuery('.combo-final').change(function(){
		jQuery('#edit-field-contact-request-type-und').val(jQuery(this).val());
	});
});
