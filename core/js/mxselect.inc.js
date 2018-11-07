jQuery.expr[':'].Contains = function(a,i,m){
     return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase())>=0;
};

jQuery.fn.mxDD = function() {
    var o = $(this[0]);
	var keyUpTimer;
	o.toggleText();
	
	/*var width = $('#someElt').width();
	var parentWidth = $('#someElt').offsetParent().width();
	var percent = 100*width/parentWidth;*/

	
	$("div.mxdd ul").css("top",	($("div.mxdd").height()+2)+"px");
	$("div.mxdd").css("width",$("div.mxdd").width()+"px");	
	$("div.mxdd ul li").css("min-width",($("div.mxdd").width()-28)+"px");
	$("div.mxdd ul").css("min-width",($("div.mxdd").width())+"px");
	
	o.click(function(){	$('div.mxdd ul li').show(); $("div.mxdd ul").slideToggle(500);	});
	
	$("div.mxdd span").click(function(){$('div.mxdd ul li').show(); $("div.mxdd ul").slideToggle(500);});
	
	$("div.mxdd ul li").click(function(){
		$("div.mxdd ul li").removeClass("active");
		$(this).addClass("active");
		o.val($(this).text());		
		$("div.mxdd input:hidden").val($(this).attr("id"));
		$("div.mxdd ul").slideToggle(500);	
	});
	
	o.keyup( function() {
		var filter = $.trim($(this).val()).toLowerCase();			
		clearTimeout(keyUpTimer);
		keyUpTimer = setTimeout( function() {
			if(!$("div.mxdd ul:visible").length)
				$("div.mxdd ul").slideDown("fast");
			if(filter == '') {
				$('div.mxdd ul li').show();
				$("div.mxdd input:hidden").val("");							
			} else {
				$("div.mxdd ul li:not(:Contains(" + filter +"))").hide();
				$("div.mxdd ul li:Contains(" + filter +")").show();                     
			}				                     
		}, 300);
	});
};
$(window).load( function(){$("div.mxdd input:text").mxDD();});s