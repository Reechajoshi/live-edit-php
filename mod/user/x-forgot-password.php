<script language="javascript" type="text/javascript" src="<?php echo SITEURL;?>/mod/user/x-user.inc.js"></script>
<?php
$frgt_pwd_err_msg = getErrorMessages( "forgot_password" );
$email_err_msg = $frgt_pwd_err_msg[ 'email' ];

$validate = array(
"userEmail"=>array("func"=>"required,email","msg"=>$email_err_msg));
?>
<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_8_profile_page' ) ); ?>
</div>
<div class="forgot-password-wrapp">
  <h1>FORGOT YOUR PASSWORD ?</h1>
  <span class="data">Forgotten your password ? No Problem. Just fill in your registered email address below and we will sent you your forgotten password via email. This is done instantly but can sometimes take upto a few minutes to reach you.</span>
  <form name="forgotPassword" id="forgotPassword" method="post" onsubmit="return false;">
    <ul class="form-forgot-password">
      <div class="loader"></div>
      <li class="title">REGISTERED EMAIL ADDRESS :</li>
      <li>
        <input class="text userEmail" type="text" value="" name="userEmail" id="userEmail" title="User Email" />
        <p class="e"></p>
      </li>
      <li class="last">
      	<input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validate));?>" />
        <input type="submit" value="Submit" class="button" id="forgotPass" />
      </li>
    </ul>
  </form>
</div>
