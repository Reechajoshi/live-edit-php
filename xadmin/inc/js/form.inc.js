function setFormPage(){		
	//var perLeft = (RIGHTSPACE*65/100);
	//var perRight = (RIGHTSPACE*35/100);
	//$("div#wrap-form").width(perLeft-12);
	//$("div#wrap-sub-form").width(perRight-13);
	//$("div#wrap-form").css("min-height",(WINHEIGHT-TOPSPACE-25)+"px");
	$("input:file").change(function(){
		var fileName = $(this).val().match(/[-_\w]+[.][\w]+$/i)[0];
		$(this).closest(".file-box").find("span").text(fileName);	
	});
}

function initFormPage(){
	//$("p.err").hide();
	//$("p.err").fadeIn(3000);
}