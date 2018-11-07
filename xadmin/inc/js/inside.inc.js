$(window).bind("resize",function() { setWindow(); setWrappers(); });
$(document).ready( function(){	
	$("input#XJSON").val("1");	
	PGINFO = jQuery.parseJSON($.URLDecode($("#PGINFO").val()));
	setWrappers();		
	
	$('ul#main-nav li span').click(function(){		
		$(this).parent().find("ul").slideToggle(function(){ $('ul#main-nav').jScrollPane();});		
		return false;
	});
	
	$('ul#main-nav li a.active').closest("ul").slideDown();	
	$('ul#main-nav').jScrollPane();
	
	if(PGINFO["PGTYPE"] == "list" || PGINFO["PGTYPE"] == "trash")    			
		initListPage();
	else
		initFormPage();
	//==============================
	
	$('div#navigate a').tipsy({gravity: 'e',fade: true,delayOut: 200});
	
	if($("p#err-main").length){
		var ew = $("p#err-main").width();
		$("p#err-main").show();
		$("p#err-main").css("right","-"+(ew+100)+"px");
		$("p#err-main").animate({right:0},1000,function(){
			$("p#err-main").delay(5000).animate({right:-(ew+100)},1000);
		});	
	}
});