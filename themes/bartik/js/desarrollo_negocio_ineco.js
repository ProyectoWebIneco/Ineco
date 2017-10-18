jQuery(document).ready(function() {

	var nombre = '';

	jQuery('.contact-form-lightbox').click(function(ev){
		ev.preventDefault();
		var enlace = jQuery(this).attr('href');
		jQuery.ajax({
		      type: 'GET',
		      url: enlace,
		      dataType: 'json',
		      success: function (data) {
				nombre = data.nombre;
			  	var resultado = jQuery('#edit-to').html().replace('%%USER_TO%%', data.nombre);
				jQuery('#edit-to').html(resultado);
				jQuery('input[name="nid_para"]').val(data.nid);
				jQuery('#edit-name').removeClass("required error");
				jQuery('#edit-first-surname').removeClass("required error");
				jQuery('#edit-second-surname').removeClass("required error");
				jQuery('#edit-mail').removeClass("required error");
				jQuery('#edit-country').removeClass("required error");
				jQuery('#edit-business').removeClass("required error");
				jQuery('#edit-request-type').removeClass("required error");
				jQuery('#edit-comments').removeClass("required error");
				jQuery('#edit-aceptance').removeClass("required error");
				jQuery('#edit-name').val('');
				jQuery('#edit-first-surname').val('');
				jQuery('#edit-second-surname').val('');
				jQuery('#edit-mail').val('');
				jQuery('#edit-country').val('');
				jQuery('#edit-business').val('');
				jQuery('#edit-comments').val('');
				//jQuery('#edit-aceptance').val('');
				//jQuery('#edit-request-type').val(154);
				jQuery('#edit-request-type-154').val(155);
				//jQuery('.form-item-request-type-154').show();

				//jQuery("#edit-request-type").attr("disabled","disabled");
				//jQuery("#edit-request-type-154").attr("disabled","disabled");

				jQuery('#page-wrapper-black').show();
		      },
		      error: function (xmlhttp) {
		      }
		});
	});

	jQuery('#close-modal-window').click(function(ev){
		ev.preventDefault();
		jQuery('#page-wrapper-black').hide();
	  	var resultado = jQuery('#edit-to').html().replace(nombre, '%%USER_TO%%');
		jQuery('#edit-to').html(resultado);
	});

	jQuery('#formulario-peticion-contacto-desarrollo-negocio').submit(function(ev){
		//ev.preventDefault();
		var enviar = true;

		jQuery('#edit-name').removeClass("required error");
		if(jQuery('#edit-name').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-name').addClass("required error");
		}

		jQuery('#edit-first-surname').removeClass("required error");
		if(jQuery('#edit-first-surname').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-first-surname').addClass("required error");
		}

		jQuery('#edit-second-surname').removeClass("required error");
		if(jQuery('#edit-second-surname').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-second-surname').addClass("required error");
		}

		jQuery('#edit-mail').removeClass("required error");
		if(jQuery('#edit-mail').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-mail').addClass("required error");
		}

		jQuery('#edit-country').removeClass("required error");
		if(jQuery('#edit-country').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-country').addClass("required error");
		}

		jQuery('#edit-business').removeClass("required error");
		if(jQuery('#edit-business').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-business').addClass("required error");
		}

		jQuery('#edit-request-type').removeClass("required error");
		if(jQuery('#edit-request-type').val() == 'All'){
			enviar = enviar && false;
			jQuery('#edit-request-type').addClass("required error");
		}

		jQuery('#edit-comments').removeClass("required error");
		if(jQuery('#edit-comments').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-comments').addClass("required error");
		}

		jQuery('#edit-aceptance').removeClass("required error");
		if(jQuery('#edit-aceptance').val() == ''){
			enviar = enviar && false;
			jQuery('#edit-aceptance').addClass("required error");
		}

		if(enviar){
			jQuery('#page-wrapper-errors').hide();
			jQuery('#formulario-peticion-contacto-desarrollo-negocio').hide();
			jQuery('#page-wrapper-ok').show();
			return true;
		}else{
			jQuery('#page-wrapper-errors').show();
			return false;
		}
	});

	jQuery('#edit-name').removeClass("required error");
	jQuery('#edit-first-surname').removeClass("required error");
	jQuery('#edit-second-surname').removeClass("required error");
	jQuery('#edit-mail').removeClass("required error");
	jQuery('#edit-country').removeClass("required error");
	jQuery('#edit-business').removeClass("required error");
	jQuery('#edit-request-type').removeClass("required error");
	jQuery('#edit-comments').removeClass("required error");
	jQuery('#edit-aceptance').removeClass("required error");
});
