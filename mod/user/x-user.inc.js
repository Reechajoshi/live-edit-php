function uploadphoto(){
	if($("#userPhoto").val()!=""){
		$("div#UIMG").show();
		var aUrl = SITEURL + '/mod/user/doajaxfileupload.php';	
		$.ajax({
			type: "GET",
			url: aUrl, 
			secureuri:false,
			fileElementId:'userPhoto',
			// dataType: 'json',
			success: function (data) {
			alert(data);
				if(typeof(data.error) != 'undefined'){	
					if(data.error){
						mxMsg("Failed to upload photo. Please try again.");
					}else {	
						var imgName = data.name;
						var aUrl = SITEURL + '/mod/user/x-user.inc.php';
						var aData = "xAction=uploadUserImage&imageName="+imgName;
						$.ajax({
							type: "GET",
							url: aUrl,
							data: aData,
							success: function(data){
								data = jQuery.trim(data);
								if(data == 'ERR'){
									mxMsg("Failed to upload photo. Please try again.");
								}else 
									if(data=='OK'){
										http:
										img = imgName;
										imgThumb = SITEURL+"/core/image.inc.php?path=site_user/"+img+"&w=162&h=162&type=crop";
										$('img#profilePic').attr('src', imgThumb);
										$("div#UIMG").fadeOut('slow');
									}
								}
							});
						return false;
					}
				}
			}
		});
	}
	return false;
}

function profileProgress(){
	var fieldCount = 0;
	var emptyFieldCount = 0;
	var emptyFieldTitle = "";
	var remainField = "";
	var remainingField = 0;
	$("ul.remaining-data").empty();
	$("ul.remaining-data").html('<span class="title">Details Remaining :</span>');
	$(".upf").each(function(index){
		fieldCount++;
		if($(this).val() == ""){
			emptyFieldCount++
			emptyFieldTitle = '<li>&bull; '+$(this).attr('distit')+'</li>';
			remainingField = (emptyFieldCount - 3);
			remainField = '<li>&bull; & '+remainingField+' others</li>';
			
			if(emptyFieldCount <=3){
				$("ul.remaining-data").append(emptyFieldTitle);
			}
		}
	});
	if(emptyFieldCount == 0){
		$("ul.remaining-data").html('');
	}
	if(remainingField && emptyFieldCount >=3){
		$("ul.remaining-data").append(remainField);
	}
	var fillVal = (fieldCount - emptyFieldCount);
	var prfCompPercent = Math.round(100 * (fillVal / fieldCount));
	$("div.bar div.percentP").css("width",prfCompPercent+"%");
	$("div.bar div.percentP").html(prfCompPercent+"%");
	if(prfCompPercent == 100){
		$("div.user-details div#rightDiv").hide();
		$("div.user-details div#vipMembership").show();
	}else{
		$("div.user-details div#rightDiv").show();
		$("div.user-details div#vipMembership").hide();
	}
}

function vipFBLogin(){
	if(!FBID) {
		loginFb("vipFBLogin();");	
	}else {
		if(FBID){
			var currUrl = "vipMemberships";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=fbUserLogin&fbID="+FBID+"&currUrl="+currUrl;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					if(data != "ERR"){
						//location.href= data;	
						var aUrl = SITEURL+"/inc/site.inc.php?xAction=addToVipMember";
						$.ajax({
							type:'post',
							url: aUrl,
							success: function(data){
								if(data == "OK"){
									$("div.loader").hide();
									location.href = SITEURL+"/checkout/vip-shipping/";
								}
							}
						});	
					}else{
						$("input#fbID").val(FBID);
						$("input#VUE").val(USEREMAIL);
						return false;
					}
				}
			});	
		}
	}
	return false;
}

$(document).ready(function(){
	profileProgress();
	
	$("form#vipLogin").submit(function(){
		if(FLGERR == 0){
			var userName = $("input#vipUserName").val();
			var userPass = $("input#vipUserPassword").val();
			var currUrl = "vipMemberships";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=loginMember&userName="+userName+"&userPass="+userPass+"&currUrl="+currUrl;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					if(data != "ERR"){
						//location.href=data;
						var aUrl = SITEURL+"/inc/site.inc.php?xAction=addToVipMember";
						$.ajax({
							type:'post',
							url: aUrl,
							success: function(data){
								if(data == "OK"){
									$("div.loader").hide();
									location.href = SITEURL+"/user/vip-membership-confirm/";
								}
								else if( data == "OK1" )
								{
									alert( "You are already a VIP memeber." );
									$("div.loader").hide();
									location.href = SITEURL+"/games/";
								}
							}
						});	
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
	
	$("form#vipLoginReg").submit(function(){
		if(FLGERR == 0 ){
			var userEmail = $("input#VUE").val();
			var userName = $("input#VUN").val();
			var userPass = $("input#VCPW").val();
			var currUrl = "vipMemberships";
			var fbID = $("input#fbID").val();
			var aUrl = SITEURL+"/mod/user/x-user.inc.php";
			var dataString = "xAction=userRegistration&currUrl="+currUrl+"&userEmail="+userEmail+"&userPass="+userPass+"&userName="+userName+"&fbID="+fbID;
			$.ajax({
				type: 'post',
				url: aUrl,
				data: dataString,
				success: function(data){
					if(data != "ERR"){
						//location.href= data;	
						var aUrl = SITEURL+"/inc/site.inc.php?xAction=addToVipMember";
						$.ajax({
							type:'post',
							url: aUrl,
							success: function(data){
								if(data == "OK"){
									$("div.loader").hide();
									location.href = SITEURL+"/checkout/vip-shipping/";
								}
							}
						});	
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

	$("#vipLogin input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#vipLogin input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	$("#vipLoginReg input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#vipLoginReg input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	
	$('a#vipFBLogin').click(function(){
		vipFBLogin();
		return false;
	});
	
	$("a.upgradeRegister").click(function(){
		$("div.login-wrapp").slideToggle(1000);
		return false;	
	});
	
	var flag = 0;
	$("input#userDob").datepicker({ 
		dateFormat:"dd/mm/yy", 
		yearRange: '-60+0',
		numberOfMonths: 2, 
		changeMonth: true, 
		changeYear: true 
	});
		
	$("a.btn-save").hide();
	$("a.btn-cancel").hide();
	$("a.btn-remove").hide();
	$("ul.personalInfo li div.element").hide();
	$("ul.contactShipping li div.element").hide();
	
	$("form#personalInfo a.btn-edit").click(function(){
		$("select#userGender").val($("select#userGender").val());
		$("select#userGender").msDropDown().data('selected');	
		$("input").css('border','');
		$(this).parent().find($("a.btn-save")).show();
		$(this).parent().find($("a.btn-cancel")).show();
		$(this).parent().find($("a.btn-remove")).show();
		$(this).parent().find($("a.btn-edit")).hide();
		$("ul.personalInfo li").each(function(index){
			$(this).find("div.data").hide();	
			$(this).find("div.element").show();	
			$(this).find($(this).find("div.element input[type='text']").attr('value',($(this).find("div.data").html())));
			$(this).find($(this).find("div.element textarea").html($(this).find("div.data").html()));	
		});
		return false;
	});
	
	$("form#personalInfo a.btn-save").click(function(){
		$("div.personal-info-wrapp div#PI").show();
		$("ul.personalInfo li").each(function(index){
			var textName = $(this).find("div.element input").attr('name');
			var textareaName = $(this).find("div.element textarea").attr('name');
			if($("select#userGender").val()){
				var str = $("select#userGender option:selected").text();
			}else{
				var str = "";	
			}
			$(this).parent().parent().find($("a.btn-save")).hide();
			$(this).parent().parent().find($("a.btn-remove")).hide();
			$(this).parent().parent().find($("a.btn-cancel")).hide();
			$(this).parent().parent().find($("a.btn-edit")).show();
			$(this).find("div.data").show();	
			$(this).find("div.element").hide();	
			$(this).find($(this).find("div.data").html($(this).find("div.element input").val()));
			$(this).find($(this).find("div.data").html($(this).find("div.element textarea").val()));
			if($("select#userDay").val() != "" && $("select#userMonth").val() != "" && $("select#userYear").val() != ""){
				$("div#arrDOB").html($("select#userDay").val()+"/"+$("select#userMonth").val()+"/"+$("select#userYear").val());
			}
			$("div.data#UG").html(str);
		});
		profileProgress();
		aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=userPersonalInfo&"+$("form#personalInfo").serialize();
		console.log(aUrl);
		$.ajax({
			type: 'post',
			url: aUrl,
			success: function(data){
				// $("a.profileName").html("HI, "+$("input#userName").val());
				$("div.personal-info-wrapp div#PI").fadeOut('slow');
			}
		});
		return false;
	});
	
	$("form#personalInfo a.btn-cancel").click(function(){
		$("ul.personalInfo li").each(function(index){
			$(this).parent().parent().find($("a.btn-save")).hide();
			$(this).parent().parent().find($("a.btn-cancel")).hide();
			$(this).parent().parent().find($("a.btn-remove")).hide();
			$(this).parent().parent().find($("a.btn-edit")).show();
			$(this).find("div.data").show();	
			$(this).find("div.element").hide();	
		});
		return false;
	});
	
	$("form#personalInfo a.btn-remove").click(function(){
		return( confirm( 'Are you sure you want to delete your NU Membership? \nThis will remove your complete file. \nYou will no longer be able to access your NU Membership or NU Account information, history or use the same username if you wish to sign up again.' ) );
	});
	
	$("form#contactShipping a.btn-edit").click(function(){
		$("select#userCountry").val($("select#userCountry").val());
		$("select#userCountry").msDropDown().data('selected');	
		$(this).parent().find($("a.btn-save")).show();
		$(this).parent().find($("a.btn-cancel")).show();
		$(this).parent().find($("a.btn-edit")).hide();
		$("ul.contactShipping li").each(function(index){
			$(this).find("div.data").hide();	
			$(this).find("div.element").show();	
			$(this).find($(this).find("div.element input").val($(this).find("div.data").html()));
			$(this).find($(this).find("div.element textarea").html($(this).find("div.data").html()));	
		});
		return false;
	});
	
	$("form#contactShipping a.btn-save").click(function(){
		$("div.personal-info-wrapp div#OI").show();
		$("ul.contactShipping li").each(function(index){
			$(this).parent().parent().find($("a.btn-save")).hide();
			$(this).parent().parent().find($("a.btn-cancel")).hide();
			$(this).parent().parent().find($("a.btn-edit")).show();
			$(this).find("div.data").show();	
			$(this).find("div.element").hide();	
			$(this).find($(this).find("div.data").html($(this).find("div.element input").val()));
			$(this).find($(this).find("div.data").html($(this).find("div.element textarea").val()));
			$("div.data#UC").html($("select#userCountry option:selected").text());
		});
		
		profileProgress();
		aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=userShipping&"+$("form#contactShipping").serialize();
		$.ajax({
			type: 'post',
			url: aUrl,
			success: function(data){
				$("div.personal-info-wrapp div#OI").fadeOut('slow');
			}
		});
		return false;
	});
	
	$("form#contactShipping a.btn-cancel").click(function(){
		$("ul.contactShipping li").each(function(index){
			$(this).parent().parent().find($("a.btn-save")).hide();
			$(this).parent().parent().find($("a.btn-cancel")).hide();
			$(this).parent().parent().find($("a.btn-edit")).show();
			$(this).find("div.data").show();	
			$(this).find("div.element").hide();	
		});
		return false;
	});
	
	$("form#forgotPassword").submit(function(){
		if(FLGERR == 0){
			var userEmail = $("input#userEmail").val();
			$("div.loader").show();
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=forgotPassEmail&userEmail="+userEmail;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					$("div.loader").hide();
					if(data == "OK"){
						mxMsg("An email has been sent to you to reset your password");
					}else{
						$("input#userEmail").val('');
						mxMsg(data);
						FLGERR = 1;
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
	
	$("form#changeUserPassword").submit(function(){
		if(FLGERR == 0){
			$("div.loader").show();
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=changeUserPass&"+$("form#changeUserPassword").serialize();
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					$("input[type='text']").val('');
					$("input[type='password']").val('');
					$("div.loader").hide();
					mxMsg(data);
				}
			});	
			return false;
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});
});