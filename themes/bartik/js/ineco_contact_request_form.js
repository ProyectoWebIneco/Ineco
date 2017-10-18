jQuery(document).ready(function() {
	jQuery("#edit-request-type").change(function() {
		x(jQuery(this));
		return false;
	});	
	x(jQuery("#edit-request-type"));
});


function x(elem){
var valor = jQuery(elem).val();
		//console.log('VALOR => ' + jQuery(this).val());
		if(valor == 160 || valor == 167 || valor == 174 || valor == 181){
			jQuery(".from-acepted-pdf").show();
		}
		else{
			jQuery(".from-acepted-pdf").hide();
		}
}