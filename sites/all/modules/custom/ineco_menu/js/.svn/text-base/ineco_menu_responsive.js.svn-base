jQuery(document).ready(function() {
	
	jQuery("#show-menu").click(function(ev){
		ev.preventDefault();
		if(jQuery("#responsive-menu-wrapper").css("display") == "none"){
			jQuery("#responsive-menu-wrapper").css("display", "block");
		}else{
			jQuery("#responsive-menu-wrapper").css("display", "none");
		}
    });
	
	jQuery(".expand-subtree").click(function(ev){
		ev.preventDefault();
		var id = jQuery(this).attr("id");
		id = id.replace("expand-","");
		
		if(jQuery(this).attr("class") == "expand-subtree not-expanded"){
			jQuery(this).attr("class", "expand-subtree expanded");
			jQuery("#child-of-" + id).css("display", "block");
		}else{
			jQuery(this).attr("class", "expand-subtree not-expanded");
			jQuery("#child-of-" + id).css("display", "none");
		}
	});
});