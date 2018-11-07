<?php session_start();?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/user/x-user.inc.js"></script>

<div class="vip-membership">
  <div class="loader"></div>
  <h1>UPGRADE TO NU VIP MEMBERSHIP</h1>
  <div style="height: 580px; width:100%; padding-bottom:20px;">
	<img style="margin-left:25%;" src="<?php echo SITEURL?>/images/vip_member.jpg" />
  </div>
  <img src="<?php echo SITEURL;?>/images/vip-membership.jpg" />
  <div class="membership-content">
    <?php 
	$sql = "SELECT * FROM `".$DB->pre."site_user` WHERE siteUserID = '".$_SESSION['SITEUSERID']."' AND status =1";
	$V = $DB->dbRow($sql);
	
	$sql = "SELECT * FROM `".$DB->pre."vip_membership` WHERE status = 1";
	$D = $DB->dbRow($sql);
	
	$login_btn_details = getButtons( "login", "vip_login" );	
	$next_btn_details = getButtons( "next", "vip_login" );	
	$cancel_btn_details = getButtons( "cancel", "vip_login" );	
	$upgrade_btn_details = getButtons( "upgrade", "vip_login" );	
	
	?>
    <div class='editable' id="vip_membership-1-1" ><?php echo $D['vipMemberDesc']; ?></div>
  </div>
  <div class="membership-playing-cart"> <img src="<?php echo SITEURL;?>/images/vip-membership-II.jpg" />
    <div  class='editable' id="vip_membership-1-2"  >
     <?php echo $D['freePack'];?> 
    </div>
  </div>
  <div class="membership-btn-box">
    <?php if($V['isVip'] == 1){ ?>
    <a href="<?php echo SITEURL."/user/".$_SESSION['SITEUSERURI']."/".$_SESSION['SITEUSERID']."/";?>" class="upgrade">YOU ARE VIP MEMBER</a>
    <?php }else{
	  if($_SESSION['SITEUSERID']){ ?>
    <!-- <a href="<?php // echo SITEURL."/user/".$_SESSION['SITEUSERURI']."/".$_SESSION['SITEUSERID']."/";?>" class="no-thanks"> NO THANKS </a>  -->
	<a href="<?php echo( $cancel_btn_details["link"] );?>" class="no-thanks <?php echo( $cancel_btn_details["color"] ); ?>"><?php echo( $cancel_btn_details["button_txt"] ); ?></a> 
	<!-- <a href="#" class="upgrade addCartVip">UPGRADE</a> -->
	<a href="#" class="upgrade addCartVip <?php echo( $upgrade_btn_details["color"] ); ?>"><?php echo( $upgrade_btn_details["button_txt"] ); ?></a>
    <?php } else{ ?>
    <!-- <a href="<?php echo SITEURL;?>" class="no-thanks"> NO THANKS </a>  -->
	<a href="<?php echo SITEURL;?>" class="no-thanks <?php echo( $cancel_btn_details["color"] ); ?>"><?php echo( $cancel_btn_details["button_txt"] ); ?></a> 
	<!-- <a href="#" class="upgrade upgradeRegister">UPGRADE</a> -->
	<a href="#" class="upgrade upgradeRegister <?php echo( $upgrade_btn_details["color"] ); ?>"><?php echo( $upgrade_btn_details["button_txt"] ); ?></a>
    <?php } 
  }?>
  </div>
</div>
<?php

$vip_mbrshp_err_msg = getErrorMessages( 'vip_membership' );
$conf_pwd_err_msg = $vip_mbrshp_err_msg[ 'confirm_password' ];
$email_err_msg = $vip_mbrshp_err_msg[ 'email' ];
$password_err_msg = $vip_mbrshp_err_msg[ 'password' ];
$user_name_err_msg = $vip_mbrshp_err_msg[ 'user_name' ];

$validateVipLogin = array(
"vipUserName"=>array("func"=>"required,loginname","msg"=>$user_name_err_msg),
"vipUserPassword"=>array("func"=>"required,password","msg"=>$password_err_msg));

$validateVipRegister = array(
"VUE"=>array("func"=>"required,email","msg"=>$email_err_msg),
"VUN"=>array("func"=>"required,loginname","msg"=>$user_name_err_msg),
"VCPW"=>array("func"=>"required,password","msg"=>$password_err_msg),
"VCCPW"=>array("func"=>"required,password,equalto:CPW","msg"=>$conf_pwd_err_msg));
?>
<div class="login-wrapp checkout-step1 vip-membership-login-wrapp" style="display:none;">
  <div class="btn-fb-conect"> <a id="vipFBLogin" href="#"> <img src="<?php echo SITEURL;?>/images/trash/btn-facebook-connect.png" /> </a> </div>
  <div class="login">
    <h1>LOGIN</h1>
    <form name="vipLogin" id="vipLogin" onsubmit="return false;" >
      <ul class="login-form" id="cartLoginForm">
        <li>
          <input type="text" class="user userName" value="Username" title="Username" name="userName" id="vipUserName" />
        </li>
        <li>
          <input type="text" class="password userPass" value="Password" title="Password" name="vipUserPassword" id="vipUserPassword" />
        </li>
        <li>
          <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateVipLogin));?>" />
        </li>
        <!-- <input type="submit" name="submit" class="button"  value="Login"  /> -->
		<input type="submit" name="submit" class="button <?php echo( $login_btn_details["color"] ); ?>"  value="<?php echo( $login_btn_details["button_txt"] ); ?>"  />
        <a href="<?php echo SITEURL.'/user/forgot-password/';?>" class="btn-forgot-password">Forgot Password ?</a>
      </ul>
    </form>
  </div>
  <div class="form-first-time">
    <h1>CREATE AN ACCOUNT</h1>
    <form name="vipLoginReg" id="vipLoginReg" onsubmit="return false;" >
      <input type="hidden" name="fbID" id="fbID" value="" />
      <ul class="cartReg-form">
        <li>
          <input type="text" name="userEmail" class="email userEmail" value="Email" title="Email" id="VUE" />
        </li>
        <li>
          <input type="text" name="userName" class="user userName" value="Username" title="Username" id="VUN" />
        </li>
        <li>
          <input type="text" name="CPW" class="password userPass" value="Password" title="Password" id="VCPW" />
        </li>
        <li>
          <input type="text" class="confirm-password confirmPassword" value="Confirm Password" title="Confirm Password" id="VCCPW" name="CCPW" />
        </li>
        <li>
          <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateVipRegister));?>" />
        </li>
        <!-- <input type="submit" value="Next" id="loginVip" class="button loginVip"> -->
		<input type="submit" value="<?php echo( $next_btn_details["button_txt"] ); ?>" id="loginVip" class="button loginVip <?php echo( $next_btn_details["color"] ); ?>">
      </ul>
    </form>
  </div>
</div>
