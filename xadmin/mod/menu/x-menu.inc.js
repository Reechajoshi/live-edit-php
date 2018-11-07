/*function validateMenu(){
	var msg = "";
	if(menuType != "other"){		
		if($("#type-items").find("input:checked").length)
			msg = "<p><b>Menu Type: </b>Please select at least one "+menuType+".</p>";
	}
	
	if(msg) {
		$.mxalert({msg:msg});
		return false;
	} else {
		return true;
	}	
	return false;
}
*/
function loadMenuType(param){	
	var url   = SITEURL+"/xadmin/mod/menu/x-menu.inc.php";
	//alert(url+"?"+param);	
	$.ajax({
		type: "GET",
		url: url,
		data: param,
		cache: false,
		success: function(data){
			hideMxLoader();														
			$("ul#type-items").html(data);			
			$("ul#type-items").hide().slideDown();						
		}
	});	
}

$(document).ready(function(){
	$("input.menu-type").click(function(){		
		menuType = $(this).val();
		if(menuType == "other"){
			$("ul#type-items").html("");
		} else {
			showMxLoader();
			loadMenuType("pageType="+$(this).val());
		}
	});	
});