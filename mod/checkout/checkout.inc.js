function userFBLogin(){
	if(!FBID) {
		loginFb("userFBLogin();");	
	}else {
		if(FBID){
			var currUrl =  SITEURL+"/checkout/step-3/";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php";
			var dataString = "xAction=fbUserLogin&fbID="+FBID+"&currUrl="+currUrl;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data != "ERR"){
						location.href= data;	
					}else{
						$("input#fbID").val(FBID);
						$("input#UE").val(USEREMAIL);
						return false;
					}
				}
			});	
		}
	}
	return false;
}


function editAdd(){
	$('div.scroll-pane a.aShippingAddress').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).find('span.editAdd').show();
			return false;
		} else {
			$(this).find('span.editAdd').hide();	
			return false;
		}
		return false;
	});
	
	$('div.scroll-pane span.editAdd').unbind("click");
	$("div.scroll-pane span.editAdd").click(function(){
		$("p.e").hide();
		$("div.loader").show();
		var shipAddressID = $(this).attr('shiprel');
		var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
		var dataString = "xAction=editShippingAdd&shippingAddressID="+shipAddressID;
		$.ajax({
			type: 'post',
			url: aUrl,
			data: dataString,
			success: function(data){
				if(data != "ERR"){
					var values = eval("("+data+")");
					$.each(values, function(key,value){		  			
						$('#'+key).val(value);
						$("select#countryID").val($("select#countryID").val());
						$("select#countryID").msDropDown().data('selected');	
					});
					//$("form#shippingAddr").attr("id","uShippingAddr");
					$("input#xAdd").attr("id","xUpdate");
					$("input#xUpdate").val("UPDATE");
					$("a#addShippingAddr").attr('id','updateShippingAddr');
					$("a#updateShippingAddr").html('UPDATE');
					$("input#shippingAddressID").val(shipAddressID);
					$("form#uShippingAddr").unbind('submit');
					$('a#updateShippingAddr').unbind('click');
					$("div.loader").fadeOut(1000);
					return false;
				}else{
					mxMsg("Shipping Address not found.");	
					$("div.loader").fadeOut(1000);
					return false;
				}
			}
		});
		return false;	
	});	
}

function deleteAdd(){
	$('div.scroll-pane a.aShippingAddress').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).find('span.deleteAdd').show();
			return false;
		} else {
			$(this).find('span.deleteAdd').hide();	
			return false;
		}
		return false;
	});
	
	$('div.scroll-pane span.deleteAdd').unbind("click");
	$("div.scroll-pane span.deleteAdd").click(function(){
		$("div.loader").show();
		var shipAddressID = $(this).attr('shipdelid');
		var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
		var dataString = "xAction=deleteShippingAdd&shippingAddressID="+shipAddressID;
		$.ajax({
			type: 'post',
			url: aUrl,
			data: dataString,
			success: function(data){
				if(data != "ERR"){
					$("div#addListing").html(data);
					$("div.loader").fadeOut(1000);
					mxMsg("Shipping Address deleted successfully.");	
					deleteAdd();
					checkAddSelected();
					checkboxSelect();
					return false;
				}else{
					mxMsg("Shipping Address not found.");	
					$("div.loader").fadeOut(1000);
					return false;
				}
			}
		});
		return false;	
	});	
}

function updateForm(){
	$("form#shippingAddr").trigger('submit');
	$("form#shippingAddr").live('submit',function(){
		var errLen = $("ul.shipping p.e").length;
		if(errLen == 0){
			$("div.loader").show();
			var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
			var dataString = "xAction=updateShippingAddr&"+$("form#shippingAddr").serialize();
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					$("div#addListing").html(data);
					$("input[type='text']").val('');
					$("textarea").val('');
					$("selsect").val('');
					$("div.loader").fadeOut(1000);
					//$("form#uShippingAddr").attr("id","shippingAddr");
					$("input#xUpdate").attr("id","xAdd");
					$("input#xAdd").val("ADD");
					$("a#updateShippingAddr").attr('id','addShippingAddr');
					$("a#addShippingAddr").html('ADD NEW ADDRESS');
					$("input#shippingAddressID").val('');
					$("select#countryID").val('');
					$("select#countryID").msDropDown().data('selected');
					mxMsg("Shipping Address updated successfully.");	
					editAdd();
					deleteAdd();
					checkAddSelected();
					checkboxSelect();
				}
			});
		}else{
			return true;	
		}
		return false;
	});	
}

function addForm(){
	$("form#shippingAddr").trigger('submit');
	$("form#shippingAddr").submit(function(){
		if(FLGERR == 0){
			$("div.loader").show();
			var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
			var dataString = "xAction=addShippingAddr&"+$("form#shippingAddr").serialize();
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					$("div#addListing").html(data);
					$("input[type='text']").val('');
					$("textarea").val('');
					$("selsect").val('');
					$("div.loader").fadeOut(1000);
					$("select#countryID").val('');
					$("select#countryID").msDropDown().data('selected');
					editAdd();
					deleteAdd();
					checkAddSelected();
					checkboxSelect();
				}
			});
			return false;
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});	
}

function checkAddSelected(){
	$('div#addListing a.aShippingAddress').unbind('click');
	$('div#addListing a.aShippingAddress').click(function(){
		var shippingAddressID = $(this).attr('rel');
		$("input#"+shippingAddressID).attr("checked", true);
		$('div#addListing a.aShippingAddress').removeClass('active');
		if($(this).hasClass('active')){
			$(this).removeClass('active')
		}else{
			$(this).addClass('active')
		}
		$('input#shippingAddressID').val(shippingAddressID);
		return false;
    });	
}

function checkboxSelect(){
	$("input.checkShipping").unbind('click');
	$("input.checkShipping").click(function(){
		$('div#addListing a').removeClass('active');
		var radioID = $(this).attr('id');
		$(this).attr("checked",true);
		$('div#addListing a#shipping'+radioID).addClass('active');
		$('input#shippingAddressID').val(radioID);
	});
}

$(document).ready(function(e) {
	editAdd();
	deleteAdd();
	checkAddSelected();
	checkboxSelect();
	
	
	$("#userCartReg input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#userCartReg input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	$("#cartUserLogin input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#cartUserLogin input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	
	$('a#updateShippingAddr').live('click',function(e) {
		$("form#shippingAddr").trigger('submit');
		updateForm();
		return false;
	});

	$('a#addShippingAddr').live('click',function(e) {
		$("form#shippingAddr").trigger('submit');
		addForm();
		return false;
	});

	$('a#cartFBLogin').click(function(){
		userFBLogin();
		return false;
	});
	
	$("a.changeVal").live('click',function(){
		$(this).parent().find($("a.saveVal")).show();
		$(this).hide();
		var productID = $(this).attr('rel');
		var productSize = $(this).attr('sizename');
		if(productSize){
			$("input[pid="+productID+"][sizename="+productSize+"]").attr("disabled",false);
		}else{
			$("input[pid="+productID+"]").attr("disabled",false);	
		}
		return false;
	});
	
	$("a.saveVal").live('click',function(){
		$("div.loader").show();
		var productID = $(this).attr('rel');
		var productSize = $(this).attr('sizename');
		var prodQty = $(this).parent().find($("input.text")).val();
		if(prodQty == 0){
			mxMsg("Invalid Number.");	
			return false;	
		}else{
			$(this).hide();
			$("a.changeVal").show();
			$("input[pid="+productID+"]").attr("disabled",true);
			var aUrl = SITEURL+"/inc/site.inc.php";
			var dataString = "xAction=changeProdQty&changeQty=changeQty&prodQty="+prodQty+"&productID="+productID+"&size="+productSize;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data == "ERR"){
						mxMsg("Invalid Number.");	
					}else{
						$("a.btn-cart").html(data);
						var aUrl = SITEURL+"/inc/site.inc.php";
						var dataString = "xAction=checkOutForm";
						$.ajax({
							type: 'post',
							url: aUrl,
							data: dataString,
							success: function(data){
								$("div.order-summary-wrapp-step-4").html(data);
								$("div.loader").fadeOut(1000);
								return false;
							}
						});	
						$("div.loader").hide();
					}
				}
			});	
		}
		return false;
	});
	
	$("a.btn-remove").live('click',function(){
		$("div.loader").show();
		var productID = $(this).attr('rel');
		var productSize = $(this).attr('productsize');
		var aUrl = SITEURL+"/inc/site.inc.php?xAction=deleteCartProduct&productID="+productID+"&productsize="+productSize;
		$.ajax({
			type: 'post',
			url: aUrl,
			success: function(data){
				if(data != "ERR"){
					$("a.btn-cart").html(data);
					var aUrl = SITEURL+"/inc/site.inc.php";
					var dataString = "xAction=checkOutForm";
					$.ajax({
					type: 'post',
					url: aUrl,
					data: dataString,
					success: function(data){
						$("div.order-summary-wrapp-step-4").html(data);
						$("div.loader").fadeOut(1000);
						return false;
					}
				});	
					return false;
				}else{
					mxMsg('Error while deleting product from cart');	
					return false;
				}
			}
		});	
		return false;	
	});
	
	$("form#cartUserLogin").submit(function(){
		if(FLGERR == 0){
			var userName = $("input#cartUserName").val();
			var userPass = $("input#cartUserPassword").val();
			var currUrl = SITEURL+"/checkout/step-3/";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php";
			var dataString = "xAction=loginMember&userName="+userName+"&userPass="+userPass+"&currUrl="+currUrl;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data != "ERR"){
						location.href=data;
					}else{
						mxMsg("Invalid Credential, Please try again.");	
					}
				}
			});	
			return false;
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});
	
	$("form#userCartReg").submit(function(){
		if(FLGERR == 0 ){
			var userEmail = $("input#UE").val();
			var userName = $("input#UN").val();
			var userPass = $("input#CPW").val();
			var currUrl = SITEURL+"/checkout/step-3/";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php";
			var dataString = "xAction=userRegistration&currUrl="+currUrl+"&userEmail="+userEmail+"&userPass="+userPass+"&userName="+userName;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data != "ERR"){
						location.href= data;	
					}
				}
			});	
			return false;
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});
	
    $('#addNewUser').click(function(e) {
        var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
		var dataString = "xAction=addAddr&"+$("form#firstUser").serialize();
		$.ajax({
			type: 'post',
			url: aUrl,
			data: dataString,
			success: function(data){
				alert(data);
			}
		});
    });
	
	$('a#setAddress').click(function(e) {
		var shippingAddressID = $('input#shippingAddressID').val();
		if(shippingAddressID){
			var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
			var dataString = "xAction=addCartDetails&shippingAddressID="+shippingAddressID;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data=='OK'){
						location.href=SITEURL+"/checkout/step-4/";
					}else{
						mxMsg("Please Select One Shipping Address.");	
					}
				}
			});
		}else{		
			mxMsg("Please Select One Shipping Address.");	
			return false;			
		}
		return false;
    });
	
	$("input.btn-proceed-to-payment").click(function(){
		$("div#shipping-summary").hide();
		$("div.wait-moment-step-4").show();
		setTimeout(function(){
			$("form#checkOutForm").submit();
		},5000);			
	});
	
	$("a#vipProceedPayment").click(function(){
		var shippingAddressID = $('input#shippingAddressID').val();
		if(shippingAddressID){
			var aUrl = SITEURL+"/mod/checkout/x-checkout.inc.php";
			var dataString = "xAction=addCartDetails&shippingAddressID="+shippingAddressID;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data=='OK'){
						$("div.checkout-wrapp").hide();
						$("div.wait-moment-step-4-II").show();
						setTimeout(function(){
							location.href = SITEURL+'/mod/checkout/inc/paypal/review-order.php';
						},5000);
					}else{
						mxMsg("Please Select One Shipping Address.");	
					}
				}
			});
			return false;
		}else{		
			mxMsg("Please Select One Shipping Address.");	
			return false;			
		}
	});
	return false;
});
