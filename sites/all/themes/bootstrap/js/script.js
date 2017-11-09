jQuery(document).ready(function(){
   



function animacionAncla(){
    
    jQuery('.animacionAncla').click(function(event){
        jQuery('.animacionAncla').parent('p').removeClass('active');
        
        var id = $( $(this).attr('href') );
        jQuery(this).parent('p').addClass('active');
        if( id.length ) {
            jQuery('html, body').animate({
                scrollTop: id.offset().top
            }, 1000);
        }
        return false;
    });
}




function navegacion(){
	jQuery('.ico-nav').click(function(){
       $('body').toggleClass('nav-on');
	});
    
    jQuery('#filtro').click(function(){
		$('body').removeClass('nav-on');
	});
}
});