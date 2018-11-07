var FBID = "";
var USERPERMS = 0;
var FIRSTNAME = "";
var LASTNAME = "";
var USEREMAIL = "";

function loadUserData(callBack){	
	FB.api('/me', function(response) {
		//alert(JSON.stringify(response));						
		FBID = response.id;
		FIRSTNAME = response.first_name;
		LASTNAME = response.last_name;
		USEREMAIL = response.email;
		
		if(!response.error){ if(callBack) { eval(callBack); }}		
	});	
}

function loginFb(callBack){			       
	FB.login(function(response) {
	  if (response.authResponse) {
			USERPERMS++;			
			loadUserData(callBack);
	  }else{ 
	  	//hideLoader(); 
	  }
	}, {scope:'email,publish_stream'});
}
