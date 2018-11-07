<?php 
	$echo = true;
	$activationKey = false;
	$siteruserid = false;
	$userEmail = false;
	
	$chng_pwd_err_msg = getErrorMessages( "change_password" );
	$old_pwd_err_msg = $chng_pwd_err_msg[ 'old_password' ];
	$new_pwd_err_msg = $chng_pwd_err_msg[ 'user_password' ];
	$conf_new_pwd_err_msg = $chng_pwd_err_msg[ 'user_confirm_password' ];
	
	$submit_btn_details = getButtons( "submit", "change_pwd" );
	$cancel_btn_details = getButtons( "cancel", "change_pwd" );
		
	if( isset( $_REQUEST['key'] ) )
	{
		$activationKey = $_REQUEST['key'];
		$_q = "select userEmail, siteUserID from ".$DB->pre."site_user where activationKey='".$activationKey."';";
		
		$DB->dbRow($_q);	
		if( !( $DB->numRows > 0 ))
		{
			$echo = false;
			echo( "<div>Invalid Link.</div>" );
		}
		else
		{
			$siteruserid = $DB->row["siteUserID"];
			$userEmail = $DB->row["userEmail"];
		}
	}
	elseif( isset( $_SESSION[ 'SITEUSERID' ] ) && isset( $_SESSION[ 'SITEUSEREMAIL' ] ) )
	{
		$siteruserid = $_SESSION["SITEUSERID"];
		$userEmail = $_SESSION["SITEUSEREMAIL"];
	}
	
	if( $echo )	
	{
		echo( '<script>
				var activationKey = "'.$activationKey.'";
			</script>
			<script language="javascript" type="text/javascript" src="'.SITEURL.'/mod/user/x-user.inc.js"></script>'
			); 
			$validate = array(
			"cuserPass"=>array("func"=>"required,password","msg"=>$new_pwd_err_msg),
			"cuserConfirmPass"=>array("func"=>"required,password,equalto:cuserPass","msg"=>$conf_new_pwd_err_msg),
			"cOldPass"=>array("func"=>"required,password","msg"=>$old_pwd_err_msg));

			echo( '<div class="banner-730-90">');
			echo( getBanner( 'banner_ad_8_profile_page' ) );
			echo(' </div>
					<div class="change-password-wrapp">
					<!--h1>CHANGE USERNAME / PASSWORD</h1-->
					<h1>CHANGE PASSWORD</h1>
						<form name="changeUserPassword" id="changeUserPassword" method="post" onsubmit="return false;">
					  <input type="hidden" name="activationKey" value="'.$activationKey.'" />
					  <input type="hidden" name="userEmail" value="'.$userEmail.'" />
					  <input type="hidden" name="SITEUSERID" value="'.$siteruserid.'" />
					  <ul class="form-change-password">
						<div class="loader"></div>
						<!--li class="title">EMAIL ID:</li>
						<li>
						  <input class="text uEmail" type="text" value="" name="userEmail" id="cuserEmail" title="Email ID" />
						</li-->');
						
			if(!$activationKey)
			{
				echo( '<li class="title">CONFIRM CURRENT PASSWORD :</li>
						<li>
						  <input class="text userConfirmCurr" type="password" value="" name="oldPassword" id="cOldPass" title="Confirm Current Password" />
						</li> ');
			}			
						
			echo( '<li class="title">NEW PASSWORD :</li>
						<li>
						  <input class="text newPass" type="password" value="" name="newPassword" id="cuserPass" title="New Password" />
						</li>
						<li class="title">CONFIRM NEW PASSWORD :</li>
						<li>
						  <input class="text userConfirmNew" type="password" value="" name="userConfirmNew" id="cuserConfirmPass" title="Confirm New Password" />
						</li>
						
						<li class="last">
						  <input type="hidden" name="mxValidate" id="mxValidate" value="'.urlencode(json_encode($validate)).'" />
						  <!-- <input type="submit" value="Submit" class="button" id="changePass" /> -->
						  <input type="submit" value="'.$submit_btn_details["button_txt"].'" class="button '.$submit_btn_details["color"].'" id="changePass" />
						  
						  <!-- <a href="'.SITEURL.'" class="button">Cancel</a> -->
						  <a href="'.$cancel_btn_details["link"].'" class="button '.$cancel_btn_details["color"].'">'.$cancel_btn_details["button_txt"].'</a>
						</li>
					  </ul>
				  </form>
				</div> ');
	}
?>
