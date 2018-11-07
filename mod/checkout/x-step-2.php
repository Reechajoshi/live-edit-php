<?php 
session_start(); 
//$siteUserID = $_SESSION['SITEUSERID'];
//if($siteUserID){header('location: '.SITEURL.'/checkout/step-1/');}
//if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}

?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/checkout/checkout.inc.js"></script>
<?php
$checkout_s1_err_msg = getErrorMessages( 'checkout_step_2' );
$userName_err_msg = $checkout_s1_err_msg[ 'user_name' ];
$password_err_msg = $checkout_s1_err_msg[ 'password' ];
$email_err_msg = $checkout_s1_err_msg[ 'email' ];
$confirmPassword_err_msg = $checkout_s1_err_msg[ 'confirm_password' ];

$back_btn_details = getButtons( "back", "checkout_step_02" );	
$nxt_btn_details = getButtons( "next", "checkout_step_02" );	
$login_btn_details = getButtons( "login", "checkout_step_02" );	


$validateCartLogin = array(
"cartUserName"=>array("func"=>"required,loginname","msg"=>$userName_err_msg),
"cartUserPassword"=>array("func"=>"required,password","msg"=>$password_err_msg));

$validateCartRegister = array(
"UE"=>array("func"=>"required,email","msg"=>$email_err_msg),
"UN"=>array("func"=>"required,loginname","msg"=>$userName_err_msg),
"CPW"=>array("func"=>"required,password","msg"=>$password_err_msg),
"CCPW"=>array("func"=>"required,password,equalto:CPW","msg"=>$confirmPassword_err_msg));
?>
<div class="checkout-wrapp">
  <h1>CHECKOUT</h1>
  <ul class="steps-nav">
    <li><a>Step 1</a></li>
    <li><a href="<?php echo SITEURL.'/checkout/step-2/';?>" class="active">Step 2</a></li>
    <li><a onclick="return false;">Step 3</a></li>
    <li><a onclick="return false;">Step 4</a></li>
  </ul>
  <div class="login-wrapp checkout-step1">
    <div class="btn-fb-conect"> <a id="cartFBLogin" href="#"> <img src="<?php echo SITEURL;?>/images/trash/btn-facebook-connect.png" /> </a> </div>
    <div class="login">
      <h1>LOGIN</h1>
      <form name="userLogin" id="cartUserLogin" onsubmit="return false;" >
        <ul class="login-form" id="cartLoginForm">
          <li>
            <input type="text" class="user userName" value="Username" title="Username" name="userName" id="cartUserName" />
          </li>
          <li>
            <input type="text" class="password userPass" value="Password" title="Password" name="cartUserPassword" id="cartUserPassword" />
          </li>
          <li><input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateCartLogin));?>" /></li>
          <!-- <input type="submit" name="submit" class="button cartGetLogin"  value="Login"  /> -->
		  <input type="submit" name="submit" class="button cartGetLogin <?php echo( $login_btn_details["color"] ); ?>"  value="<?php echo( $login_btn_details["button_txt"] ); ?>"  />
          <a href="<?php echo SITEURL.'/user/forgot-password/';?>" class="btn-forgot-password">Forgot Password ?</a>
        </ul>
      </form>
    </div>
    <div class="form-first-time">
      <h1>FIRST TIME</h1>
      <form name="userCartReg" id="userCartReg" onsubmit="return false;" >
        <input type="hidden" name="fbID" id="fbID" value="" />
        <ul class="cartReg-form">
          <li>
            <input type="text" name="userEmail" class="email userEmail" value="Email" title="Email" id="UE" />
          </li>
          <li>
            <input type="text" name="userName" class="user userName" value="Username" title="Username" id="UN" />
          </li>
          <li>
            <input type="text" name="CPW" class="password userPass" value="Password" title="Password" id="CPW" />
          </li>
          <li>
            <input type="text" class="confirm-password confirmPassword" value="Confirm Password" title="Confirm Password" id="CCPW" name="CCPW" />
          </li>
          <li><input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateCartRegister));?>" /></li>
          <!-- <input type="submit" value="Next" id="loginCart" class="button loginCart"> -->
		  <input type="submit" value="<?php echo( $nxt_btn_details["button_txt"] ); ?>" id="loginCart" class="button loginCart <?php echo( $nxt_btn_details["color"] ); ?>">
        </ul>
      </form>
    </div>
    <!-- <div class="chekout-btn"><a href="<?php echo SITEURL.'/checkout/step-1/';?>" class="btn-back">Back</a></div> -->
	<div class="chekout-btn"><a href="<?php echo( $back_btn_details["link"] );?>" class="btn-back <?php echo( $back_btn_details["color"] ); ?>"><?php echo( $back_btn_details["button_txt"] ); ?></a></div>
  </div>
</div>
