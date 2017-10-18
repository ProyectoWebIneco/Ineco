(function($) {
    /**
     * KeyUp with delay event setup
     * 
     * @param function callback
     * @param int ms
     */
    $.fn.delayKeyup = function(callback, ms){
            $(this).keyup(function( event ){
                var srcEl = event.currentTarget;
                if( srcEl.delayTimer )
                    clearTimeout (srcEl.delayTimer );
                srcEl.delayTimer = setTimeout(function(){ callback($(srcEl), event); }, ms);
            });

        return $(this);
    };
})(jQuery);


(function ($) {	
	Drupal.behaviors.ajax_search = {
			attach: function(context, settings) {
				$('#ajax-search-input').keydown(function (event) { return onkeydown(this, event); })
			    .delayKeyup(function (el, event) { onkeyup(el, event); }, 500)
			    .blur(function (ev) { hidePopup(); });
			}
	};
	
	

	function onkeydown(input, e) {
		if (!e) {
			e = window.event;
		}
		
		switch (e.keyCode) {
			case 40: // down arrow.
			selectDown();
			return false;
		case 38: // up arrow.
			selectUp();
			return false;
		case 9: // Tab.
		case 27: // Esc.
		case 13: // Enter.
			if(isPopupOpen()){
				e.preventDefault();
			}
			break;
		default: // All other keys.
			return true;
		}
	}
	
	function onkeyup(input, e) {
		if (!e) {
			e = window.event;
		}
		

		switch (e.keyCode) {
			case 16: // Shift.
			case 17: // Ctrl.
			case 18: // Alt.
			case 20: // Caps lock.
			case 33: // Page up.
			case 34: // Page down.
			case 35: // End.
			case 36: // Home.
			case 37: // Left arrow.
			case 38: // Up arrow.
			case 39: // Right arrow.
			case 40: // Down arrow.
				return true;
			case 9: // Tab.
				selectActiveItem();
			case 27: // Esc. -> Cierra el popup sin seleccionar el elemento
				hidePopup();			
				return true;
			case 13: // Enter.
				selectActiveItem();
				hidePopup();
				submitForm();
				return true;
			default: // All other keys.
				if ($(input).val().length >= 3) {
					search($(input));
				} else {
					hidePopup();
				}
				return true;
		}
	}
	
	
	function hidePopup(keycode){
		/*$("#ajax-search-results").hide();
		$("#ajax-search-results").children().remove(); */ 
	}
	
	function showPopup(results){
		$("#ajax-search-results").children().remove();
		for(var i in results){
			var element= results[i];
			$('<span/>', {
			    "class": 'word',
			    text: element.word
			}).after($('<span/>', {
			    "class": 'count',
			    text: element.count
			})).appendTo($('<div/>', {
			    id: 'element-'+i,
			    "class": 'result' + ((i==0) ? ' active' : '') + (((parseInt(i)+1) % 2==0) ? ' par' : ' impar') 
			}).appendTo(
					$("#ajax-search-results")
			));
		}
		
		$("#ajax-search-results .result").mousedown(function(ev){
			selectActiveItem($(this));
			submitForm();
		}).mouseover(function(ev){
			markItem($(this));
		});
		
		
		$("#ajax-search-results").show();
	}
	
	
	function search(input){
		showLoading(input);
		var searchString = $(input).val();
	    $.ajax({
	      type: 'GET',
	      url: Drupal.settings.ajax_search.ajax_search_url + '/' + Drupal.encodePath(searchString),
	      dataType: 'json',
	      success: function (matches) {
	    	  showPopup(matches);
	    	  hideLoading(input);
			  
	      },
	      error: function (xmlhttp) {
	    	  hideLoading(input);
	    	  if (console) console.log(Drupal.ajaxError(xmlhttp, db.uri));
			  
	      }
	    });
	}
	
	
	function showLoading(input){
		if(!$(input).hasClass("throbbing")){
			$(input).addClass("throbbing");
		}
	}
	
	
	function hideLoading(input){
		if($(input).hasClass("throbbing")){
			$(input).removeClass("throbbing");
		}
	}
	
	
	function selectUp(){
		var total = $("#ajax-search-results .result").length;
		if(total){
			var index = $("#ajax-search-results .active").index() - 1;
			 
			if(index<0){
				index=0;
			}
			
			$("#ajax-search-results .result").removeClass('active');
			$("#ajax-search-results .result").eq(index).addClass('active');
		}
	}
	
	function selectDown(){
		var total = $("#ajax-search-results .result").length;
		if(total){
			var index = $("#ajax-search-results .active").index() + 1;
			 
			if(index > total - 1){
				index=total - 1;
			}
			
			$("#ajax-search-results .result").removeClass('active');
			$("#ajax-search-results .result").eq(index).addClass('active');
		}
	}
	
	function selectActiveItem(activeel){
		if(activeel==null){
			activeel=$("#ajax-search-results .result.active");
		}

		if($(activeel).length){
			$('#ajax-search-input').val($(activeel).find(".word").html());
		}
	}
	
	function markItem(item){
		$("#ajax-search-results .result").removeClass('active');
		$(item).addClass('active');
	}
	
	
	function submitForm(){
		$('#ajax-search-input').parents("form").submit();
	}
	
	function isPopupOpen(){
		return $("#ajax-search-results").is(":visible");
	}
})(jQuery);
