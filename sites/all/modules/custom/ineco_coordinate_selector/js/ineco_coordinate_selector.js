jQuery(document).ready(function() {
	
	jQuery("#edit-title").keyup(function () {
	    jQuery("#map-selector-title").html(jQuery(this).val());
	});
});


/*
function onDropMap(target, event) {	
	console.log('DROP MAP');
	console.log(target);
	console.log(event);
	console.log("X: " + event.offsetX);
	console.log("Y: " + event.offsetY);
	
	var corX = event.offsetX - 10; //La mitad del ancho del icono
	var corY = event.offsetY - 10; //La mitad del alto del icono

	jQuery("#map-selector").css({marginLeft: corX, marginTop: corY});
	
	jQuery("#edit-field-work-zone-x-und-0-value").val(corX);
	jQuery("#edit-field-work-zone-y-und-0-value").val(corY);
}
    
	
function onDragStartMap(target, event) {	
	console.log('DRAG START');
	console.log(target);
	console.log(event);
}
*/

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
	
	console.log(event);
	console.log(jQuery('#map-image'));
	console.log(jQuery('#map-image').width());
	console.log(jQuery('#map-image').height());
	
	console.log('------');
	
	var maxleft=jQuery('#map-image').width() - jQuery(dm).width();
	console.log(maxleft);
	var posleft = (event.clientX + parseInt(offset[0],10));
	console.log(posleft);
	if(posleft<0){
		posleft=0;
	}else if(posleft>maxleft){
		posleft=maxleft;
	}
	console.log(posleft);
	console.log('------');
	console.log('------');
	console.log('------');
	var maxtop=jQuery('#map-image').height() - jQuery(dm).height();
	var postop = (event.clientY + parseInt(offset[1],10));
	if(postop<0){
		postop=0;
	}else if(postop>maxtop){
		postop=maxtop;
	}
	
    dm.style.marginLeft = posleft + 'px';
    dm.style.marginTop = postop + 'px';
	
	jQuery("#edit-field-work-zone-x-und-0-value").val(posleft);
	jQuery("#edit-field-work-zone-y-und-0-value").val(postop);
	
    event.preventDefault();
    return false;
}