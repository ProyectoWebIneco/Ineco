jQuery(document).ready(function() {
	jQuery(".banner-teaser-off").mouseover(function(){
		var id = jQuery(this).attr("id");
		id = id.replace("banner-teaser-off-","");
		jQuery('#banner-teaser-on-' + id).css('display', 'block');
	    jQuery('#banner-teaser-off-' + id).css('display', 'none');
	});
	
	jQuery(".banner-teaser-on").mouseout(function(){
		var id = jQuery(this).attr("id");
		id = id.replace("banner-teaser-on-","");
		jQuery('#banner-teaser-off-' + id).css('display', 'block');
	    jQuery('#banner-teaser-on-' + id).css('display', 'none');
    });
    
  jQuery(".ofertas-links .banner-list a").append(function() {
    return "<span>" + jQuery(this).attr("alt") + "</span>";
  }); 
    
  jQuery(".becas-links .banner-list a").append(function() {
    return "<span>" + jQuery(this).attr("alt") + "</span>";
  });
});