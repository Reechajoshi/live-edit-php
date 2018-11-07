<?php 
session_start();

function isUserNameAvail($userName)
{
	global $DB;
	
	$sql = "SELECT 1 cnt FROM `".$DB->pre."site_user` WHERE userName = '".$userName."' AND status = 1";	
	if($DB->dbQuery($sql)) {
		return( $DB->numRows == 0 );
	}
	return(false);
}

function createProfileImageFile($_name, $_dir)
{
	$_full_path = $_dir."/".$_name.".jpg";
	$_full_path_1 = $_dir."/1_".$_name.".jpg";
	$_full_path_2 = $_dir."/2_".$_name.".jpg";
	$_full_path_3 = $_dir."/3_".$_name.".jpg";
	$_full_path_4 = $_dir."/4_".$_name.".jpg";
	
	$obj = new resizeImage( 162, 162, $_full_path, "crop");
	$obj->__resize( $_full_path, $_full_path_1 );
	
	$obj = new resizeImage( 25, 25, $_full_path, "crop");
	$obj->__resize( $_full_path, $_full_path_2 );
	
	$obj = new resizeImage( 54, 53, $_full_path, "crop");
	$obj->__resize( $_full_path, $_full_path_3 );
	
	$obj = new resizeImage( 57, 57, $_full_path, "crop");
	$obj->__resize( $_full_path, $_full_path_4 );
}

function userRegistration(){
	global $DB;
	// $str = '';
	$resp = array();
	$sql = "SELECT userEmail FROM `".$DB->pre."site_user` WHERE userEmail = '".$_REQUEST['userEmail']."' AND status = 1";	
	if($DB->dbQuery($sql)) { 
		if($DB->numRows > 0){
			// $str.="ERR";
			$resp[ 'status' ] = false;
			$resp[ 'msg' ] = "User ".$_REQUEST['userEmail']." already registered.";			
		}else{ 
			if( !( strlen( $_REQUEST['userName'] ) >= 2 && strlen( $_REQUEST['userName'] ) <= 10 ) )
			{
				$resp[ 'status' ] = false;
				$resp[ 'msg' ] = "Username requires minimum 2 and maximum 10 letters/numbers.";
			}
			else
			{
				if( !isUserNameAvail( $_REQUEST['userName'] ) )
				{
					$resp[ 'status' ] = false;
					$resp[ 'msg' ] = "Username ".$_REQUEST['userName']." already registered.";
				}
				else
				{
					$currUrl = $_REQUEST['currUrl'];
					$vipMembership = $_REQUEST['vipMembership'];
					$_POST['userEmail'] = $_REQUEST['userEmail'];
					$_POST["userPass"] = md5($_REQUEST["userPass"]);
					$_POST['userName'] = $_REQUEST['userName'];
					$_POST["seoUri"] = makeSeoUri($_REQUEST['userName']);
					$_POST["dateAdded"] = date("Y-m-d H:i:s");
					$_POST['fbID'] = $_REQUEST['fbID'];
					$_POST['userChips'] = '1000';
					if($_POST['fbID']){
						
						if( downloadProfilePic($_POST['fbID'],ABSPATH.'/uploads/site_user') )
						{
							createProfileImageFile( $_POST['fbID'], ABSPATH.'/uploads/site_user' );
						}
						$_POST['imageName'] = $_POST['fbID'].'.jpg';
					}
				
					$DB->table = $DB->pre."site_user";	
					$DB->data  = $_POST;
					
					if($DB->dbInsert())	{
						$siteUserID = $DB->insertID;
						$DB->table = $DB->pre."shipping_address";	
						$DB->data  = array('siteUserID'=>$siteUserID);
						$DB->dbInsert();
						
						getEmailContent( "REG_DONE", $subject, $fromname, $fromid, $content );
						if( strlen( $fromid ) > 0 )
						{
							require(ABSPATH."/lib/class.phpmailer.inc.php");
							$mail = new PHPMailer();						
							$mail->From = $fromid;
							$mail->FromName = $fromname;
							$mail->AddAddress(trim($_REQUEST["userEmail"]),trim($_REQUEST["userName"]));
							$mail->Subject = $subject;
							
							$content = str_replace( "_USER_NAME_", $_POST['userName'], $content );
							$content = str_replace( "_SITE_URL_", SITEURL, $content );
							
							$mail->Body = $content;
							/* $mail->Body = "
								<p style='font-weight:bold;'>Dear ".$_POST['userName'].",<br /></p>
								<p>Thank you for registering on NU.</p>
								<p>We hope you will be able to enjoy the complete range of services at : <a href='".SITEURL."/' target='_blank'>NU</a>:</p>
								<p>Sincerely,</p>
								<p>The NU Team</p>
							"; */
							$mail->ContentType = "text/html";
							$mail->Send();
						}	
						loginMember($currUrl);
					}	
					//if($currUrl == "" && $_REQUEST['vipMembership'] == "yes"){
						//$str.=SITEURL."/user/vip-membership/";	
					//}elseif($currUrl == ""){
					if($currUrl == ""){
						$str.=SITEURL."/user/vip-membership/";	
					}elseif($currUrl = "vipMemberships"){
						$str.=SITEURL."/user/".$_SESSION['SITEUSERURI']."/".$_SESSION['SITEUSERID']."/";						
					}else{
						$str.= $currUrl;	
					}
					
					$resp[ 'status' ] = true;
					$resp[ 'resp' ] = $str;
				}
			}	
		}
	}		
	return json_encode( $resp );	
}

function getunqid_n($s)
{
	return(md5(uniqid(time(),true).$s));
}

function addSession($userName)
{
	global $DB;
	
	$_q = "delete from sess where userName='$userName';";
	$DB->dbQuery( $_q );
	
	$_unqId = getunqid_n( $userId );
	$_q = "insert into sess (login_date, userName, sessId) values ( now(), '$userName', '$_unqId' ) on duplicate key update login_date=now() and sessId='$_unqId';";
	
	if( $DB->dbQuery( $_q ) )
		return( $_unqId );
	return( false );
}

function loginMember($currUrl){
	global $DB;
	
	$update = false;
	
	$msg = "";
	$userName = mysql_real_escape_string($_REQUEST['userName']);
	$userPass = md5($_REQUEST['userPass']);
	
	if($_REQUEST['currUrl']){
		$currUrl = $_REQUEST['currUrl'];
	}else{
		$currUrl = $currUrl;
	}

	if($userName && $userPass) {
		$sql = "SELECT userName,isVip,siteUserID,userEmail,seoUri,status FROM `".$DB->pre."site_user` WHERE userName='$userName' AND userPass='$userPass' AND status =1";		
		
		$D = $DB->dbRow($sql);
		if($DB->numRows > 0) {
			$_SESSION['SITEUSERID'] = $DB->row["siteUserID"];
			$_SESSION['SITEUSERNAME'] = $DB->row["userName"];
			$_SESSION['SITEUSERURI'] = $DB->row["seoUri"];
			$_SESSION['SITEUSEREMAIL'] = $DB->row["userEmail"];
			
			$_sessId = addSession( $DB->row["userName"] );
			if( $_sessId )
				$_SESSION['SESSID'] = $_sessId;

			setcookie('SITEUSERID', $DB->row["siteUserID"], false, "/");
			setcookie('SITEUSERNAME', $DB->row["userName"], false, "/");
			setcookie('SITEUSERURI', $DB->row["seoUri"], false, "/");
			if($currUrl == "vipMemberships" && $D['isVip'] == '1'){
				$msg = SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/';
			}if($currUrl == "vipMemberships" && $D['isVip'] == '0'){
				$msg = SITEURL.'/user/vip-membership-confirm/';
				//$msg = SITEURL.'/checkout/vip-shipping/';
			}elseif($currUrl == ""){
				$msg = SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/' ;
			}else{
				$msg = $currUrl;
			}
			
			if( $D['isVip'] == '1' )
				allocate_daily_chips($_SESSION['SITEUSERID'], $_SESSION['SITEUSEREMAIL'], 2000);
			else
				allocate_daily_chips($_SESSION['SITEUSERID'], $_SESSION['SITEUSEREMAIL'], 1000);
		}else{
			$msg = "ERR";
		}
	} 
	return $msg;
}


function allocate_daily_chips($uid, $email, $chips)
{
	global $DB;
	$sql = "select * from daily_track where siteUserID = $uid and login_date= CURDATE() and userEmail='$email';";
	$DB->dbRows( $sql );
	$res =$DB->numRows;
	
	if($DB->numRows === 0) 
	{
		$del_query = "delete from daily_track where siteUserID = $uid and userEmail='$email';";
		if( $DB->dbQuery( $del_query ) )
		{
			$ins_query = "insert into daily_track(login_date, siteUserID, userEmail) values(CURDATE(), $uid, '$email');";
			if( $DB->dbQuery( $ins_query ) )
			{
				$upd_query = "update ".$DB->pre."site_user set userChips = ((userChips) + $chips), msg='You have been awarded with ".$chips." daily chips!' where siteUserID = $uid and userEmail='$email';";
				return( $DB->dbQuery( $upd_query ) );
			}	
		}
		return( false );
	}
}

function fbUserLogin(){
	global $DB;
	$msg = "";
	$fbID = $_REQUEST['fbID'];
	
	if($_REQUEST['currUrl']){
		$currUrl = $_REQUEST['currUrl'];
	}else{
		$currUrl = $currUrl;
	}
	
	if($fbID) {
		$sql = "SELECT userName,isVip,siteUserID,fbID,seoUri,status FROM `".$DB->pre."site_user` WHERE fbID='$fbID' AND status = 1";	
		$D = $DB->dbRow($sql);
		if($DB->numRows > 0) {
			$_SESSION['SITEUSERID'] = $DB->row["siteUserID"];
			$_SESSION['SITEUSERNAME'] = $DB->row["userName"];
			$_SESSION['SITEUSERURI'] = $DB->row["seoUri"];
			
			$_sessId = addSession( $DB->row["userName"] );
			if( $_sessId )
				$_SESSION['SESSID'] = $_sessId;

			setcookie('SITEUSERID', $DB->row["siteUserID"], false, "/");
			setcookie('SITEUSERNAME', $DB->row["userName"], false, "/");
			setcookie('SITEUSERURI', $DB->row["seoUri"], false, "/");
			/*if($currUrl == ""){
				$msg = SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/';
			}else{
				$msg = $currUrl;
			}*/
			if($currUrl == "vipMemberships" && $D['isVip'] == '1'){
				$msg = SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/';
			}if($currUrl == "vipMemberships" && $D['isVip'] == '0'){
				$msg = SITEURL.'/checkout/vip-shipping/';
			}elseif($currUrl == ""){
				$msg = SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/';
			}else{
				$msg = $currUrl;
			}
		}else{
			$msg = "ERR";
		}
	} 
	return $msg;
}

function checkUserName(){
	global $DB;
	$str = "";
	$sql = "SELECT userName FROM `".$DB->pre."site_user` WHERE userName = '".$_REQUEST['userName']."' AND status = 1";	
	if($DB->dbQuery($sql)) { 
		if($DB->numRows > 0){
			$str ="ERR";
		}else{ 
			$str ="OK";
		}
	}		
	return $str;	
}

function checkUserEmail(){
	global $DB;
	$str = "";
	$sql = "SELECT userEmail FROM `".$DB->pre."site_user` WHERE userEmail = '".$_REQUEST['userEmail']."'";	

	if($DB->dbQuery($sql)) { 
		if($DB->numRows > 0){
			$str ="ERR";
		}else{ 
			$str ="OK";
		}
	}		
	return $str;	
}

function forgotPassEmail(){
	$msg = "";
	global $DB; 	
	$userEmail = mysql_real_escape_string($_REQUEST['userEmail']);
	$sql = "SELECT userPass,userName,userEmail FROM ".$DB->pre."site_user WHERE userEmail='".$userEmail."' AND status = 1"; 
	$res = $DB->dbRow($sql);
	$rand = rand('1000','1000');
	$activationKey = getunqid_n( $res["userEmail"] );
	
	if($DB->numRows > 0) {
		$sql = "UPDATE ".$DB->pre."site_user SET activationKey='".$activationKey."' WHERE userEmail='".$userEmail."' AND status = 1";
		$DB->dbQuery($sql);
		
		$subject = false;
		$fromname = false;
		$fromid = false;
		$content = false;
		
		getEmailContent( 'FORGOT_PASSWORD', &$subject, &$fromname, &$fromid, &$content );
		if( $subject !== false )
		{
			require(ABSPATH."/lib/class.phpmailer.inc.php");
			$mail = new PHPMailer();						
			$mail->From = $fromid;
			$mail->FromName = $fromname;
			$mail->AddAddress($res['userEmail'],$res['userName']);
			$mail->Subject = $subject;
			
			$_link = SITEURL."/user/change-password/?key=".$activationKey;
			
			$content = str_replace( '_USER_NAME_', $res['userName'], $content );
			$content = str_replace( '_RESET_LINK_', $_link, $content );
			
			$mail->Body = $content;
			/* $mail->Body = "
				<p style='font-weight:bold;'>Hi ".$res["userName"]."</p>
				<p>To reset your password visit the following address, otherwise just ignore this email and nothing will happen.</p>
				<p><a style='color:#209ACA;' href='".SITEURL."/user/change-password/?key=".$activationKey."' target='_blank'>".SITEURL."/user/change-password/?key=".$activationKey."</a>
				<br />(Some email client users may need to copy and paste the link into their web browser.)</p>
				<br /><br />Thanks,
				<br /><br />NU Team."; */
			$mail->ContentType = "text/html";
			
			if($mail->Send()){
				//$msg = "An email has been sent to you to reset your password.";
				$msg = "OK";
			}else{
				$msg = "Error, Try again.";
			}
		}
		/* require(ABSPATH."/lib/class.phpmailer.inc.php");
		$mail = new PHPMailer();						
		$mail->From = "sourabh@maxdigi.com";
		$mail->FromName = "NU Team";
		$mail->AddAddress($res['userEmail'],$res['userName']);
		$mail->Subject = "NU Password Reset Confirmation";
		$mail->Body = "
			<p style='font-weight:bold;'>Hi ".$res["userName"]."</p>
			<p>To reset your password visit the following address, otherwise just ignore this email and nothing will happen.</p>
			<p><a style='color:#209ACA;' href='".SITEURL."/user/change-password/?key=".$activationKey."' target='_blank'>".SITEURL."/user/change-password/?key=".$activationKey."</a>
			<br />(Some email client users may need to copy and paste the link into their web browser.)</p>
			<br /><br />Thanks,
			<br /><br />NU Team.";
		$mail->ContentType = "text/html"; */
		
		
		//$msg = "An email has been sent to you to reset your password.";
		$msg = "OK";
	}else{
		$msg = "Sorry , this email address does not exist in our database.";
	}	
	return $msg;		
}

function changeUserPass(){
	global $DB;
	$str = "";
	$activationKey = $_REQUEST['activationKey'];
	$siteUserID = intval($_REQUEST['SITEUSERID']);
	$newPassword = md5($_REQUEST["newPassword"]);		
	$userEmail = $_REQUEST["userEmail"];
	
	$oldPassword = md5(mysql_real_escape_string($_REQUEST["oldPassword"]));
	
	if($activationKey){
		$sql = "SELECT userPass,activationKey,status FROM `".$DB->pre."site_user` WHERE userEmail = '".$userEmail."' AND activationKey='".$activationKey."' AND status = 1";	
	}else{
		$sql = "SELECT userPass,activationKey,status FROM `".$DB->pre."site_user` WHERE userEmail = '".$userEmail."' AND status = 1";			
	}
	
	$DB->dbRow($sql);	
	if($DB->numRows > 0) {
		if($activationKey){
			$sql = "UPDATE `".$DB->pre."site_user` SET userPass = '".$newPassword."',activationKey='' WHERE userEmail = '".$userEmail."' AND status = 1";
			$DB->dbQuery($sql);
			$str = "New password set successfully, Please login and continue";
		}else{
			if($DB->row['userPass'] == $oldPassword) {
				if($DB->row["status"] == 1)	{
					$sql = "UPDATE `".$DB->pre."site_user` SET userPass = '".$newPassword."' WHERE siteUserID = '".$siteUserID."' AND status = 1";		
					// echo( $sql );
					$DB->dbQuery($sql);
				}
				$str = "New password set successfully";
			}else{
				$str = "Incorrect password, please try again.";	
			}
		}
	}else{
		$str = "Email ID is not matching, Please try again";
	}
	echo $str;
}

function userShipping(){
	global $DB;
	$str = "";
	$siteUserID = $_REQUEST['siteUserID'];
	//$_POST['userEmail'] = mysql_real_escape_string($_REQUEST['userEmail']);
	$_POST['userFirstName'] = $_REQUEST['userFirstName'];
	$_POST['userLastName'] = $_REQUEST['userLastName'];
	$_POST['userContact'] = $_REQUEST['userContact'];
	$_POST['userCity'] = mysql_real_escape_string($_REQUEST['userCity']);
	$_POST['userState'] = mysql_real_escape_string($_REQUEST['userState']);
	$_POST['countryID'] = intval($_REQUEST['userCountry']);
	$_POST['userAddress'] = mysql_real_escape_string($_REQUEST['userAddress']);
	$_POST['shippingAddress'] = mysql_real_escape_string($_REQUEST['userAddress']);
	$_POST['userStreet'] = $_REQUEST['userStreet'];
	$_POST['userZip'] = $_REQUEST['userZip'];
	$DB->table = $DB->pre."site_user";
	$DB->data  = $_POST;
	
	if($DB->dbUpdate("siteUserID='$siteUserID'")){						
		$str = "Updated Successfully";
	}
	
	$DB->table = $DB->pre."shipping_address";
	$DB->data  = array('siteUserID'=>$siteUserID,'userFirstName'=>$_REQUEST['userFirstName'],'userLastName'=>$_REQUEST['userLastName'],'userContact'=>$_REQUEST['userContact'],'userCity'=>mysql_real_escape_string($_REQUEST['userCity']),'userState'=>mysql_real_escape_string($_REQUEST['userState']),'countryID'=>intval($_REQUEST['userCountry']),'shippingAddress'=>mysql_real_escape_string($_REQUEST['userAddress']),'userZip'=>$_REQUEST['userZip']);
	$DB->dbUpdate("siteUserID='$siteUserID'");			
	return $str;
}
	

function userPersonalInfo(){
	global $DB;
	$str = "";
	if($_REQUEST['userYear'] && $_REQUEST['userMonth'] && $_REQUEST['userDay']){
		$dobArr = $_REQUEST['userYear'].'-'.$_REQUEST['userMonth'].'-'.$_REQUEST['userDay'];
	}else{
		$dobArr = '0000-00-00';
	}
	$dob = explode("/",$_REQUEST['userDob']);
	$siteUserID = $_REQUEST['siteUserID'];
	$_POST['userGender'] = $_REQUEST['userGender'];
	$_POST['userDob'] = $dobArr;
	$_POST['aboutMe'] = mysql_real_escape_string($_REQUEST['aboutMe']);
	$DB->table = $DB->pre."site_user";
	$DB->data  = $_POST;

	if($DB->dbUpdate("siteUserID='$siteUserID'")){						
		$str = "Updated Successfully";
	}			
	return $str;
}
	
function uploadUserImage() {
	global $DB;	
	$_REQUEST["dateModified"] = date("Y-m-d H:i:s");
	$_REQUEST['imageName'] = $_REQUEST['imageName'];
	$siteUserID = sprintf("%d",$_SESSION["SITEUSERID"]);
	$sql = "SELECT imageName FROM `".$DB->pre."site_user` WHERE siteUserID='$siteUserID' AND status = 1";		
	$DB->dbRow($sql);
	
	$fileName = $DB->row['imageName'];
	$path = ABSPATH."/uploads/site_user/".$fileName;
	deleteFile($path);

	$DB->table = $DB->pre."site_user";		
	$DB->data  = $_REQUEST;
	if($DB->dbUpdate("siteUserID='$siteUserID'")){	
		echo "OK";
	} else {
		echo "ERR";			
	}
	return;	
}

function getPaymentTransaction() {
	global $DB;	
	if( isSessOK() )
	{
		$_q = " select tprod_type, tstart_date, tunit_cost, tqty, tamount, tstate from ".$DB->pre."trans_detail td, mx_trans t where t.tid =td.tid and tuserName='".$_SESSION[ 'SITEUSERNAME' ]."';";
		
		$REC = $DB->dbRows( $_q );
		if($REC)
		{
			$_arr = Array();
			foreach($REC as $d)
			{
				$_d = strtotime( $d[ 'tstart_date' ] );
				$n_date = date( 'H:i - jS F Y', $_d );   
				$_arr[] = Array( $d[ 'tprod_type' ], $n_date, getState( intval( $d[ 'tstate' ] ) ), $d[ 'tqty' ], $d[ 'tunit_cost' ], $d[ 'tamount' ] );
			}
			return( json_encode( $_arr ) );
		}
	}
}

function sendFeedBack()
{
	global $DB;
	if( isSessOK() )
	{
		if( isset( $_POST[ 'time' ] ) && isset( $_POST[ 'table' ] ) && isset( $_POST[ 'desc' ] ) )
		{
			$_time = mysql_real_escape_string( $_POST[ 'time' ] );
			$_table = mysql_real_escape_string( $_POST[ 'table' ] );
			$_desc = mysql_real_escape_string( $_POST[ 'desc' ] );
			
			$_q = "insert into ".$DB->pre."feedback (ftime, fuserName, ftimestamp, ftable, fdesc) values( now(), '".$_SESSION[ 'SITEUSERNAME' ]."', '$_time', '$_table', '$_desc' )";
			
			if( $DB->dbQuery( $_q ) )
			{
				$subject = false; $toname = false; $toid = false; $content = false;
				
				getEmailContent( "ON_FEEDBACK", $subject, $toname, $toid, $content );
				if( strlen( $toid ) > 0 )
				{
					require(ABSPATH."/lib/class.phpmailer.inc.php");
					$mail = new PHPMailer();						
					$mail->From = "misslucky@nu-casino.com";
					$mail->FromName = 'Miss Lucky';
					$mail->AddAddress( $toid, $toname );
					$mail->Subject = str_replace( "_#_USER_NAME_#_", $_SESSION[ 'SITEUSERNAME' ], $subject );
					
					$content = str_replace( "_#_USER_NAME_#_", $_SESSION[ 'SITEUSERNAME' ], $content );
					$content = str_replace( "_#_TIME_#_", $_time, $content );
					$content = str_replace( "_#_TABLE_#_", $_table, $content );
					$content = str_replace( "_#_FEEDBACK_QUERY_#_", $_desc, $content );
					
					$mail->Body = $content;
					$mail->ContentType = "text/html";
					$mail->Send();
				}
			}
		}
	}	
}

if($_REQUEST["xAction"]){
	switch($_REQUEST["xAction"]){
		case "userRegistration":
			include("../../connectdb.inc.php");
			include("../../core/fb.inc.php");
			require( "../../inc_mg/inc.img.php" );
			require( "../../inc_mg/inc.func.php" );
			echo userRegistration();
		break;
		
		case "checkUserName":
			include("../../connectdb.inc.php");
			echo checkUserName();
		break;
		
		case "checkUserEmail":
			include("../../connectdb.inc.php");
			echo checkUserEmail();
		break;

		case "loginMember":
			include("../../connectdb.inc.php");
			echo loginMember($_REQUEST['currUrl'] );				
		break;		
		
		case "fbUserLogin":
			include("../../connectdb.inc.php");
			echo fbUserLogin();				
		break;		
		
		case "forgotPassEmail":
			include("../../connectdb.inc.php");
			require( "../../inc_mg/inc.func.php" );
			echo forgotPassEmail();				
		break;	
		
		case "changeUserPass":
			include("../../connectdb.inc.php");
			echo changeUserPass();				
		break;	
		
		case "userShipping":
			include("../../connectdb.inc.php");
			echo userShipping();				
		break;	
		
		case "userPersonalInfo":
			include("../../connectdb.inc.php");
			echo userPersonalInfo();				
		break;	
		
		case "uploadUserImage":
			include("../../connectdb.inc.php");
			echo uploadUserImage();				
		break;	
		
		case "getPayTrans":
			include("../../connectdb.inc.php");
			include("../../inc_mg/inc.sess.php");
			include("../../inc_mg/inc.trans.php");
			echo getPaymentTransaction();				
		break;
		
		case "sendFeedBack":
			include("../../connectdb.inc.php");
			include("../../inc_mg/inc.sess.php");
			include("../../inc_mg/inc.func.php");
			echo sendFeedBack();				
		break;	
	}
}
?>