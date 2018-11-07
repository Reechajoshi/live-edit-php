<?php 
function userContact(){
	global $DB;
	$str = "";
	
	$_REQUEST['message'] = mysql_real_escape_string($_REQUEST['message']);
	$_REQUEST['dateAdded'] = date("Y-m-d H:i:s");
	$DB->table = $DB->pre."contact_us";	
	$DB->data  = $_REQUEST;
	
	if($DB->dbInsert())	{
	
		getEmailContent( "CONTACT_US", $subject, $toname, $toid, $content );
		if( strlen( $toname ) > 0 )
		{
			require(ABSPATH."/lib/class.phpmailer.inc.php");
			$mail = new PHPMailer();						
			$mail->From = trim($_REQUEST["email"]);
			$mail->FromName = trim($_REQUEST["name"]);
			$mail->AddAddress( $toid, $toname );
			$mail->Subject = $subject;
			
			$content = str_replace( "_NAME_", $_REQUEST['name'], $content );
			$content = str_replace( "_EMAIL_", $_REQUEST['email'], $content );
			$content = str_replace( "_REASON_", $_REQUEST['reason'], $content );
			$content = str_replace( "_MESSAGE_", $_REQUEST['message'], $content );
			
			//$mail->Body = "
				// <p style='font-weight:bold;'>Name: ".$_REQUEST['name'].".<br /></p>
				// <p style='font-weight:bold;'>Email: ".$_REQUEST['email'].".<br /></p>
				// <p style='font-weight:bold;'>Reason for contacting: ".$_REQUEST['reason'].".<br /></p>
				// <p style='font-weight:bold;'>Message: ".$_REQUEST['message']."<br /></p>
			// ";
			$mail->Body = $content;
			
			$mail->ContentType = "text/html";
			if($mail->Send()){
				$str = "OK";	
			}else{
				$str = "ERR";	
			}
		}
		else
			$str = "ERR";
	}else{
		$str = "ERR";	
	}
	return $str;
}

function GetHowTOPlay(){
	global $DB;
	$str = "";
	$HTPID = intval($_REQUEST['HTPID']);
	$sql = "SELECT * FROM ".$DB->pre."how_to_play  WHERE HTPID='".$HTPID."'";
	$res = $DB->dbRow($sql);
	$vidName = explode("=",$res['HTPVideoUrl']);
	if($DB->numRows > 0){
		$str ='
		<h1>'.$res['HTPGameTitle'].'</h1>
		<div class="video-box" style="height: 240px;">
			<iframe width="440" height="234" src="http://www.youtube.com/embed/'.$vidName[ count( $vidName ) - 1 ].'?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
		<div style="clear:both;" class="editable" id="how_to_play-'.$HTPID.'" >'.$res['HTPDesc'].'</div><a href="'.$res['HTPLink'].'" class="button">Play Now !</a><div class="loader"></div>';
	}
		
	return $str;
}

if($_REQUEST["xAction"]){
	switch($_REQUEST["xAction"]){
		case "userContact":
			include("../../connectdb.inc.php");
			include("../../inc_mg/inc.func.php");
			echo userContact();
		break;
		
		case "GetHowTOPlay":
			include("../../connectdb.inc.php");
			echo GetHowTOPlay();
		break;
	}
}
?>