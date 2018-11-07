var TOPSPACE   = 0;
var RIGHTSPACE = 0;
var BALMARGIN  = 45;
var PGINFO;

function setWrappers(){
	$("ul#main-nav").css("height",(WINHEIGHT-120)+"px");
	$("div#wrap-data").css("height",(WINHEIGHT-110)+"px");
	$("div#wrap-form").css("min-height",(WINHEIGHT-130)+"px");
	$("div#wrap-sub-form").css("min-height",(WINHEIGHT-130)+"px");
		
	if(PGINFO["PGTYPE"] == "list" || PGINFO["PGTYPE"] == "trash")     			
		setListPage();
	else
		setFormPage();
	$('ul#main-nav').jScrollPane();	
}

function showMxLoader(){	
	if($('div#mx-loader').length)	{ $('div#mx-loader').remove(); }
	var $mxloader = $('<div id="mx-loader" class="transbg"><img src="'+ASITEURL+'/images/mx-loader.gif" /></div>');
	$mxloader.css("width",WINWIDTH);
	$mxloader.css("height",WINHEIGHT);
			
	$("body").prepend($mxloader);
	$mxloader.hide();
	
	$("div#mx-loader img").css({'position':'absolute', 'left':'50%', 'top':'50%', 'margin-left':'-15px', 'margin-top':'-15'});
	$mxloader.fadeIn();
}

function hideMxLoader(){
	if($('div#mx-loader').length){ $('div#mx-loader').fadeOut(200,function(){$(this).remove();}); }
}