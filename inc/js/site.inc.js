
var STRDATA;
function showLoginFacebook(){
	if(!FBID) {
		loginFb("showLoginFacebook();");	
	}else {
		if(FBID){
			var currUrl = "";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=fbUserLogin&fbID="+FBID+"&currUrl="+currUrl;
			
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					
					if(data != "ERR"){
						location.href= data;	
					}else{
						$("div.login-wrapp").hide();
						$("div.register-wrapp").show();
						$("input.fbID").val(FBID);
						$("input.userEmail").val(USEREMAIL);	
						return false;
					}
				}
			});	
		}
	}
	return false;
}

function loginSlideDiv(){
	$("p.e").hide();
	$("div#login-register-wrapp a.btn-close").hide();
	$("div.header-button").slideUp(200,function(){
		$("div#login-register-wrapp").slideDown(700,function(){
			$("div#login-register-wrapp a.btn-close").slideDown(200);
		});	
		return false;
	});
	return false;		
}

function mxMsg(msg){
	$("div#common-message").html(msg);
	$("div#common-message").show(function(){
		$("div#common-message").animate({top:0},1000);
	});
	$("div#common-message").animate({top:0},1000,function(){
		$("div#common-message").delay(1000).animate({top:-100},1000); 
	});
}

function deleteProfilePicture(){

	var result= confirm(" Are you sure you want to delete picture?");
		if(result == true)
		{
			$.ajax({
				type: 'post',
				url: "/inc_mg/del_profile_pic.php",
				success: function(uid){
					alert(uid);
				}
			});	
		}
		return false;


	// var request = jQuery.ajax({
		// url: "/inc_mg/del_profile_pic.php",
		// type: "POST",
		// data: "usrid="+u+""
		// image : $(obj).find("img");,
		// dataType: 'json'
		// success: function (data) {
		
			// delet img tag
		
		// }
	// });
	// console.log($(obj).find("img"));
	
}

$(document).ready(function(){
	var h = $(window).height();   // returns height of browser viewport
	var w = $(window).width();
	
	$( "#t_content" ).css( { "position": "fixed", "top": ( ( h - 600 )/2 ) + "px", "left": ( ( w - 800 )/2 ) + "px" } );
	$( "#p_content" ).css( { "position": "fixed", "top": ( ( h - 600 )/2 ) + "px", "left": ( ( w - 800 )/2 ) + "px" } );
	$( "#ph_content" ).css( { "position": "absolute", "top": ( ( h - 300 )/2 ) + "px", "left": ( ( w - 700 )/2 ) + "px" } );
	
	$("a#gameLogin").click(function(){
		var pathname = document.URL;
		$("input#currUrl").val(pathname);
		loginSlideDiv();
		return false;	
	});
	
	$('a.btn-fblogin').click(function(){
		showLoginFacebook();
		return false;
	});
	
	/* NU SHOP PAGE, MAKE FEW BUTTONS DISABLED */
	$('#coming-soon').removeAttr('href').css('color','grey');
	$('#nu-tournaments').removeAttr('href').css('color','grey');
	
	
	// $('a.delete_button').click(function(){
		// var result= confirm(" Are you sure you want to delete picture?");
		// if(result == true)
		// {
			// deleteProfilePicture(this);
		// }
		// return false;
	// });

	
	$("#userLogin input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#userLogin input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	$("#userRegistration input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#userRegistration input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	$("#vipLoginReg input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#vipLoginReg input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	$("#vipLogin input[type='text']").focus(function(){ if ($(this).val() == $(this).attr("title")){  $(this).val(""); } });	
	$("#vipLogin input[type='text']").blur(function() { if ($(this).val() == "") { $(this).val($(this).attr("title")); } });
	
	
	$('li.show-games a span.ghover,div.games-popup').hover(function(){
		$("div#login-register-wrapp").hide('fast');
		$("div.header-button").show('fast');
		$("li.show-games").addClass('active');
		$("li.show-games a").addClass('active1');
		$("div.games-popup").css('opacity',1);
		$("div.games-popup").stop().fadeIn();
	},function(){
		$("li.show-games a").removeClass('active1');
		$("div.games-popup").stop().fadeOut();
	});
	
	$('li.show-nucards a span.chover,div.about-popup').hover(function(){
		$("div#login-register-wrapp").hide('fast');
		$("div.header-button").show('fast');
		$("ul.about-popup-nav li a").removeClass('active');
		$("ul.about-popup-nav li:first a").addClass('active');
		$("ul.about-popup-inside li").hide();
		$("ul.about-popup-inside li:first").show();
		$("li.show-nucards").addClass('active');
		$("li.show-nucards a").addClass('active');
		$("div.about-popup").css('opacity',1);
		$("div.about-popup").stop().fadeIn();
	},function(){
		$("li.show-nucards a").removeClass('active');
		$("div.about-popup").stop().fadeOut();
	});
	
	$("div.about-popup ul.about-popup-nav li").click(function(){
		$("div.about-popup ul.about-popup-nav li a").removeClass('active');
		$(this).find('a').addClass('active');
		$('ul.about-popup-inside li').hide();
		$('ul.about-popup-inside li').eq($(this).index()).show();
		return false;	
	});
	
	$("a#withOutLogin,a.btn-ligin-register").click(function(){
		loginSlideDiv();
		return false;
	});
		
	$("div#login-register-wrapp a.btn-close,div#login-register-wrapp a.btn-close-II").click(function(){
		$("div.register-wrapp").hide();
		$("div.login-wrapp").show();
		$("div#login-register-wrapp").slideUp(300,function(){
			$("div.header-button").slideDown(200);
		});
		return false;	
	});
	
	$("a#withLogin").click(function(){
		$("a.btn-arrow").toggleClass('active');
		$("ul.user-nav").slideToggle();		
		return false;
	});
	
	$("input#uRegister").click(function(){
		$("div.login-wrapp").hide();
		$("div.register-wrapp").fadeIn();
		return false;	
	});	
	
	$("input.userPass,input.confirmPassword").live('focus',function() {
	   if ($(this).val() == $(this).attr("title")){  			
			var input = $("<input type='password' />").attr({ name: $(this).attr("name"),id: $(this).attr("name"), value: "", class:"password userPass", title:$(this).attr("title")}).insertBefore(this);
			$(this).remove();
			input.focus();
		}
		if($(this).hasClass('userPass')){
			if($(this).next('p.e').length){
				$(this).parent('li').css("height","79px");
			}
		}
		//$(this).next('p.e').remove();
	});
	$("input[type='password']").trigger('click');
	
	$("input.userPass,input.confirmPassword").live('blur',function() {			
		if ($(this).val() == "") {
			$("<input type='text' />").attr({ name: $(this).attr("name"),id: $(this).attr("name"), value: $(this).attr("title"), class:"password userPass", title:$(this).attr("title") }).insertBefore(this);
			$(this).remove();
		} 		
	});
	

	
	$("form#userLogin").submit(function(){
		if(FLGERR == 0 ){
			var userName = $("input#HLUserName").val();
			var userPass = $("input#HLUserPass").val();
			var currUrl = $("input#currUrl").val();
			if(currUrl != ""){
				currCurl = currUrl;
			}else{
				currUrl = "";
			}
			
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=loginMember&userName="+userName+"&userPass="+userPass+"&currUrl="+currUrl;
			
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					
					if(data != "ERR"){
						// alert( data );
						location.href=data;
					}else{
						mxMsg("Invalid Credential, Please try again.");
					}
				}
			});	
			return false;
		}/*else{
			FLGERR = 1;
			return true;
		}		
		return false;*/
	});

	$("form#userRegistration").submit(function(){
		if(FLGERR == 0 ){
			var currUrl = "";
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=userRegistration&"+$("form#userRegistration").serialize()+"&currUrl="+currUrl;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					var resp = eval( '(' + data + ')' );
					// if(data != "ERR"){
						// location.href= data;	
					// }
					if( resp.status == true )
					{
						location.href= resp.resp;
					}
					else
						showMsg( "Error", resp.msg );
						//alert( resp.msg );
				}
			});	
			return false;
		}else{
			FLGERR = 1;
			return true;
		}		
		return false;
	});
	
	$('a.addCart').click(function(e) {
		$("div.loader").show();
        var productID = $(this).attr('rel');
		var size = $("select.size").val();
		var producttype = $(this).attr('producttype');
		var checkouttype = $(this).attr('checkouttype');
		var sizeBal = $("ul.product-available li."+size+" div").attr('bal');
		if(sizeBal == 0){
			$("div.loader").hide();
			mxMsg("Product not availabe.");	
		}else{
			var aUrl = SITEURL+"/inc/site.inc.php?xAction=addToCart&productID="+productID+"&producttype="+producttype+"&size="+size;
			$.ajax({
				type:'post',
				url: aUrl,
				success: function(data){
					$("div.loader").hide();
					$("a.btn-cart").html(data);
					location.href = SITEURL+"/checkout/step-1/";
					mxMsg("Product successfully added to cart.");	
				}
			});	
		}
		return false;
    });
	
	$('a.addCartVip').click(function(e) {
		$("div.loader").show();
		var aUrl = SITEURL+"/inc/site.inc.php?xAction=addToVipMember";
		$.ajax({
			type:'post',
			url: aUrl,
			success: function(data){
				if(data == "OK"){
					$("div.loader").hide();
					location.href = SITEURL+"/user/vip-membership-confirm/";
				}
			}
		});	
		return false;
    });
	
	
	$("form#userCartReg #UN, form#userRegistration #hUserName, form#userVipReg #VUN,").blur(function(){
		var currEvent = $(this);
		var userName = currEvent.val();
		if(!userName){
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=checkUserName&userName="+userName;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					if(data == "ERR"){
						var msg = $('<p class="e">The Username '+userName+' is not available</p>').hide();					
						msg.appendTo(currEvent.parent()).slideDown();	
						$('#loginCart, #creatAcount, #loginVip').attr("disabled","disabled");	
					}else{
						currEvent.parent('li').find('p.e').remove();
						$('#loginCart, #creatAcount, #loginVip').attr("disabled",false);	
					}
				}
			});	
		}
		return false;	
	});
	
	$("form#userCartReg #UE, form#userRegistration #hUserEmail, form#vipLoginReg #VUE").blur(function(){
		var currEvents = $(this);
		var userEmail = currEvents.val();
		if(!userEmail){
			var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=checkUserEmail&userEmail="+userEmail;
			$.ajax({
				type: 'post',
				url: aUrl,
				success: function(data){
					//alert(data);
					if(data == "ERR"){
						var msg = $('<p class="e">Email already exist</p>').hide();					
						msg.appendTo(currEvents.parent()).slideDown();
						$('#loginCart, #creatAcount, #loginVip').attr("disabled","disabled");	
					}else{
						currEvents.parent('li').find('p.e').remove();
						$('#loginCart, #creatAcount, #loginVip').attr("disabled",false);	
					}
				}
			});	
		}
		return false;	
	});
	
	initPrivacyPolicy();
	initTermsPolicy();
	
});

initTime = function() {
	setInterval( function(){
		var now = new Date(); 
		var dt =  now.getUTCDate();
		var hrs = check_digit( now.getUTCHours() );
		var mins = check_digit( now.getUTCMinutes() );
		
		switch(dt % 10) {
			case "1": suffix = "st";
			case "2": suffix = "nd";
			case "3": suffix = "rd";
			default: suffix = "th";
		}
		
		var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
		var utc_time = hrs + " : " + mins + " - " + dt + suffix + " " + monthNames[now.getUTCMonth()] + " " + now.getUTCFullYear();
		var feed_back_time = monthNames[now.getUTCMonth()] + " " + now.getUTCFullYear() + "<br />" + hrs + " : " + mins + " - " + dt + suffix;
		
		document.getElementById('time').innerHTML=utc_time;
		
		if( document.getElementById('feedback_time') )
			document.getElementById('feedback_time').innerHTML = feed_back_time;
		
	},500 );
}

check_digit = function( no ) {
	if( ( no.toString() ).length == 1 )
		return "0" + no;
	else
		return no;
}

/* checkBrowser = function() {
	alert( "code name"+navigator.appCodeName+" app name "+navigator.appName+" cookie enabled "+navigator.cookieEnabled+ " onLine " + navigator.onLine+" platform "+navigator.platform+ " userAgent " +navigator.userAgent );
	showMsg( "Hello", "code name"+navigator.appCodeName+" app name "+navigator.appName+" cookie enabled "+navigator.cookieEnabled+ " onLine " + navigator.onLine+" platform "+navigator.platform+ " userAgent " +navigator.userAgent );
} */

initPrivacyPolicy = function(){
	$( "#p_base" ).height( $( "body" ).height() + "px" );
}

initTermsPolicy = function(){
	$( "#t_base" ).height( $( "body" ).height() + "px" );
}

hideP = function(){
	$( "#p_content" ).hide();
	$( "#p_base" ).hide();
}

hideT = function(){
	$( "#t_content" ).hide();
	$( "#t_base" ).hide();
}

hidePH = function(){
	$( "#ph_content" ).hide();
	$( "#ph_base" ).hide();
}

showT = function(){
	$( "#t_content" ).show();
	$( "#t_base" ).show();
}

showP = function(){
	$( "#p_content" ).show();
	$( "#p_base" ).show();
}

showPH = function(){
	$( "#ph_content" ).show();
	$( "#ph_base" ).show();
}

handleLeaderBoard = function(ob, ind){
	$( ".leaderboard-left-lst-item" ).each( function(){
		 $( this ).removeClass( "leaderboard-left-lst-item-sel" );
	});
	
	$( ob ).addClass( "leaderboard-left-lst-item-sel" );
	
	loadleaderboard( ind );
}

loadleaderboard = function(t){
	var aUrl = SITEURL+"/mod/games/x-leadercontent.php";
	var aData = "lt="+t;
	
	$( "#leader-loading" ).show();
	$( "#leaderboard-content" ).hide();
	//$( "#leaderboard-content" ).html( "" );
	
	$.ajax({
		type: "POST",
		url: aUrl,
		data: aData,
		success: function(data){			
			if(data) {
				
				$( "#leader-loading" ).hide();
				
				if(data){
					var _json = JSON.parse( data ),
						_html = '';
					
					for( var i in _json )
					{
						_html += '<td><div class="leaderboard-right-element" > <div class="leaderboard-right-element-txt" >'+_json[ i ].name.toUpperCase()+'</div> <div class="leaderboard-right-element-im" ><img src="'+SITEURL+'/inc_mg/get_im.php?lb&us='+_json[ i ].name+'" style="position: relative; top: 14px; left: 15px;" /></div> <div class="leaderboard-right-element-txt" >'+_json[ i ].count+'</div> </div> </td>';
					}
					
					if( _html.length > 0 )
					{
						$( "#leaderboard-content" ).find( ".jspPane" ).css({"left": "0px" });
						$( "#leaderboard-content" ).find( ".jspPane" ).html( "<table><tr>"+_html+"</tr></table>" );
						$( "#leaderboard-content" ).show();
						$( ".scroll-pane" ).jScrollPane();
					}	
					else	
						$( "#leaderboard-content" ).hide();	
					// $(".scroll-pane").jScrollPane();
				}
			}
			return false;
		}
	});
}

showLogin = function(){
	loginSlideDiv();
	$('html, body').animate({scrollTop: '0px'}, 300);
	return false;
}

showPaymentTrans = function(){
	showPH();
	
	var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=getPayTrans";
	$( ".content" ).html( "" );
	$.ajax({
		type: 'post',
		url: aUrl,
		success: function(data){
			var _res = JSON.parse( data );
			for( x in _res )
			{
				var _x = '<div class="row" > <div class="col brdr_bottom brdr_left" style="width: 5%; text-align: center;" > <div class="col_cont" >'+ ( parseInt( x )+1 ) +'</div></div> <div class="col brdr_bottom brdr_left" style="width: 30%;" > <div class="col_cont" > '+_res[ x ][ 0 ]+' </div></div> <div class="col brdr_bottom brdr_left" style="width: 23%;" > <div class="col_cont" > '+_res[ x ][ 1 ]+' </div></div> <div class="col brdr_bottom brdr_left" style="width: 15%;" > <div class="col_cont" > '+_res[ x ][ 2 ]+' </div></div> <div class="col brdr_bottom brdr_left" style="width: 5%;" > <div class="col_cont" style="text-align: center;" > '+_res[ x ][ 3 ]+' </div></div><div class="col brdr_bottom brdr_left " style="width: 9%;" > <div class="col_cont" > '+_res[ x ][ 4 ]+' </div></div><div class="col brdr_bottom brdr_left brdr_right" style="width: 10%;" > <div class="col_cont" > '+_res[ x ][ 5 ]+' </div></div> </div>';
				
				$( ".content" ).append( _x );
			}
			
			$( ".scroll-pane" ).jScrollPane();
		}
	});
	
}

sendFeedBack = function(){
	var aUrl = SITEURL+"/mod/user/x-user.inc.php?xAction=sendFeedBack";
	$( "#feedback_send" ).hide();
	$.ajax({
		type: 'post',
		url: aUrl,
		data: "time="+$( "#feedback_time" ).html()+"&table="+$( "#feedback_table" ).html()+"&desc="+$( "#feedback_desc" ).val(),
		success: function(data){
			$("div.game-feedback-pop a.btnclose").click();
			$( "#feedback_desc" ).val( "" );
			alert( 'Feedback Sent' );
			$( "#feedback_send" ).show();
		},
		error: function(data){
			$( "#feedback_send" ).show();
		}
	});	
}