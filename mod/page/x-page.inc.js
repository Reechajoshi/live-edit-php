$(document).ready(function(){

	$('input#contactBtn').click(function(e) {
		$("form#contactUs").trigger('submit');
		return false;
	});
	
	$("form#contactUs").submit(function(){
		if(FLGERR == 0 ){
			var reason = $("select#reason").val();
			var message = $("textarea#message").val();
			if(SITEUSERID){
				var name = SITEUSERNAME;
				var email = SITEUSEREMAIL;
			}else{
				var name = $("input#name").val();
				var email = $("input#email").val();
			}
			$("div.loader").show();
			var aUrl = SITEURL+"/mod/page/x-page.inc.php";
			dataString = "xAction=userContact&name="+name+"&email="+email+"&reason="+reason+"&message="+message;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data != "ERR"){
						$("input[type='text']").val('');
						$("textarea").val('');
						$("select#reason").val('');
						$("select#reason").msDropDown().data('selected');	
						$("div.loader").fadeOut(1000);
						mxMsg("Contact details sent successfully.");	
						return false;
					}else{
						mxMsg("Error in sending mail.");
						$("div.loader").fadeOut(1000);	
						return false;
					}
				}
			});
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});	
});
