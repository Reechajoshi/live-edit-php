var PGINFO;
$(window).bind("resize",function() { setWindow(); setWrappers(); });
$(document).ready( function(){
	$("input#XJSON").val("1");
	$("input#userName").toggleText();
	
	$("input#userPass").live('focus',function() {
	   if ($(this).val() == $(this).attr("title")){  			
			var input = $("<input type='password' />").attr({ name: $(this).attr("name"),id: $(this).attr("name"), value: "", class:"text", title:$(this).attr("title") }).insertBefore(this);
    		input.focus();
			$(this).remove();
		}
	});

	$("input#userPass").live('blur',function() {			
		if ($(this).val() == "") {
			$("<input type='text' />").attr({ name: $(this).attr("name"),id: $(this).attr("name"), value: $(this).attr("title"), class:"text", title:$(this).attr("title") }).insertBefore(this);
			$(this).remove();
		} 		
	});
	
	PGINFO = jQuery.parseJSON($.URLDecode($("#PGINFO").val()));
	$('#frmLogin').submit(function() {
		var aUrl = ASITEURL+"/inc/ajax.inc.php";
		var aData = $(this).serialize();
		showMxLoader();		
		//alert(aUrl+"?"+aData);				
		$.ajax({
			type: "GET",
			url: aUrl,
			data: aData,					
			success: function(msg){
				hideMxLoader();
				if(msg=="OK") {
					if($("input#redirectMe").val()) {
						window.location = ASITEURL+"/"+$("input#redirectMe").val();
					} else {
						window.location = ASITEURL+"/"+PGINFO["PGDEFAULT"]+"/";
					}					
				} else {
					mxMsg(msg);
				}
			}
		});		
		return false;		
	});
});