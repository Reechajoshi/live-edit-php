(function($){
	$mxactive = 0;	
	$.mxoverlay = function(){		
		if($('div.mxoverlay').length)	{ 
			return $('div.mxoverlay'); 
		} else {
			var $overlay = $('<div class="mxoverlay" class="transbg"></div>');					
			$overlay.css({'position':'fixed', 'z-index':'5000', 'width':'100%', 'height':WINHEIGHT+'px',
				'background-color':'#FFF', 'background': 'rgb(0, 0, 0)', 'background': 'rgba(0, 0, 0, 0.6)',
				'filter:progid':'DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)',
				'-ms-filter': 'progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)'});
			$("body").prepend($overlay);
			$overlay.hide();			
			$overlay.fadeIn();
			return $overlay;
		}		
	}
	
	$.fn.mxdialog = function(){
		var $objpopup = $(this[0]);
		var params = arguments[0] || {};
		if($objpopup != null && $objpopup != undefined) {			 				
			var defaults = { modal:false,overlay:true};             
	        var params   = $.extend(defaults, params);			
			if(params.overlay) {
				var $overlay = $.mxoverlay();																											
				if(!params.modal){				
					$overlay.click(function(e) {
						if(e.target.id == "mxoverlay") {
							 $(this).fadeOut(function(){ $(this).remove(); });
							 $objpopup.fadeOut();
						}
					 });					 
				}
			}
			$objpopup.hide();								 
			var boxW = $objpopup.outerWidth()/2;
			var boxH =  $objpopup.outerHeight()/2;					
			$objpopup.css({'position':'fixed','left':params.left,'top':params.top,'margin-left':'-'+boxW+'px','margin-top':'-'+boxH+'px'});
			
			if(params.btnclose)		
				$objpopup.find(params.btnclose).click(function() { $mxactive--; $objpopup.fadeOut(function(){ if($mxactive < 1) $overlay.remove(); }); return false; });					
			$objpopup.fadeIn();	
		}
	}
		
	
	$.mxalert = function(params){
		if(params.msg){
			$mxactive++;
			var defaults = { modal:false, top:'50%', left:'50%',overlay:true};        
	        var params   = $.extend(defaults, params);						
			var $objpopup = $('<div id="mxalert"><a href="#" class="close">X</a>'+'<p>'+params.msg+'</p></div>');
			$("body").prepend($objpopup);							
			$objpopup.css({'z-index':'5003'});						
			$objpopup.mxdialog({modal:params.modal,overlay:params.overlay,btnclose:"a.close",left:params.left,top:params.top});
		}
	}
	
	$.fn.mxpopup = function(){
		var $objpopup = $(this[0]);
		var params = arguments[0] || {};		
		if($objpopup != null && $objpopup != undefined) {
			$mxactive++;			 				
			var defaults = { modal:false, top:'50%', left:'50%',overlay:true,btnclose:".btn-close"};             
	        var params   = $.extend(defaults, params);							
			$objpopup.css({'z-index':'5001'});														
			$objpopup.mxdialog({modal:params.modal,overlay:params.overlay,btnclose:params.btnclose,left:params.left,top:params.top});		
		}
	}
	
	$.confirm = function(params){
		
		var defaults = { modal:true, top:'50%', left:'50%',overlay:true};        
	    var params   = $.extend(defaults, params);
				
		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){			
			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'</a>';			
			if(!obj.action){ obj.action = function(){};	}
		});
		
		var $objpopup ='<div id="mxconfirm"><p>'+params.message+'</p><div>'+buttonHTML+'</div></div>';
		var buttons = $('div#mxconfirm .button'),	i = 0;
		
		$("body").prepend($objpopup);
						
		$objpopup.css({'z-index':'5002'});						
		$objpopup.mxdialog({modal:params.modal,overlay:params.overlay,btnclose:"a.close",left:params.left,top:params.top});
		
		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){				
				obj.action();
				$.confirm.hide();
				return false;
			});
		});		
	}

	$.confirm.hide = function(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}
})(jQuery);

/*$('.item .delete').click(function(){		
	var elem = $(this).closest('.item');
	$.confirm({
		'message'	: 'You are about to delete this item. <br />It cannot be restored at a later time! Continue?',
		'buttons'	: {
			'Yes'	: {
				'class'	: 'blue',
				'action': function(){
					elem.slideUp();
				}
			},
			'No'	: {
				'class'	: 'gray',
				'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
			}
		}
	});
});*/