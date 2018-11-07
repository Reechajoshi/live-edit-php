<?php
function initFbJs($APPID=0,$callJs=""){
	$str = "";
	if($APPID) {
		$str ='<div id="fb-root"></div>
				<script type="text/javascript">
					window.fbAsyncInit = function() {
						hideLoader();
						FB.init({appId: \''.$APPID.'\', status: true, cookie: true, xfbml: true, oauth  : true});		
						FB.getLoginStatus(function(response) { if (response.authResponse) { USERPERMS++; loadUserData(); } else {loginFb();} });								
							window.setTimeout(function() { FB.Canvas.setAutoResize();}, 250);
						};'.$callJs.'
						
						
					(function() {
						var e = document.createElement("script");
						e.type = "text/javascript";
						e.src = document.location.protocol +"//connect.facebook.net/en_US/all.js";
						e.async = true;
						document.getElementById("fb-root").appendChild(e);
					}());	
				</script>';
	}
	return $str;
}

function downloadProfilePic($fbID="",$saveTo="uploads/profile-pic"){
	if($fbID){		
		$newFile = $saveTo."/$fbID.jpg";
		
		if(!file_exists($newFile)){
			$fileUrl = "http://graph.facebook.com/$fbID/picture?type=large";
			$file_handler = fopen($newFile, 'w');
			$curl = curl_init($fileUrl);
			curl_setopt($curl, CURLOPT_FILE, $file_handler);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($curl);
			
			curl_close($curl);
			fclose($file_handler);
			
			return( true );
		}
	}
	return( false );
}
?>