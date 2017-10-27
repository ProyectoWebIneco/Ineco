$(document).ready(function(){
    animacionAncla();
    navegacion();
});


function animacionAncla(){
    
    $('.animacionAncla').click(function(event){
        $('.animacionAncla').parent('li').removeClass('active');
        
        var id = $( $(this).attr('href') );
        $(this).parent('li').addClass('active');
        if( id.length ) {
            $('html, body').animate({
                scrollTop: id.offset().top
            }, 1000);
        }
        return false;
    });
}


function navegacion(){
	$('.ico-nav').click(function(){
       $('body').toggleClass('nav-on');
	});
    
    $('#filtro').click(function(){
		$('body').removeClass('nav-on');
	});
}