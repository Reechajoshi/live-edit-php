 <?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" dir="ltr" lang="en-US">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<?php echo $FBMETA;?>
<?php echo mxGetMeta(); ?>
<link rel="icon" href="<?php echo SITEURL;?>/images/favicon.png">
<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/nu-casino.com/22257.css" type="text/css" /> <!--Local Link-->
<!--<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/demos.foxymoron.co.in/22257.css" type="text/css" />--> <!--live Link-->
<!--<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/mds/22257.css" type="text/css" />--> <!--local Link-->
<title><?php if($TPL->metaTitle) echo $TPL->metaTitle; else echo 'NU'; ?></title>
<link rel="stylesheet" href="<?php echo SITEURL;?>/lib/js/ui/themes/base/jquery.ui.all.css">
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/common.inc.js"></script>
<link rel="stylesheet" href="<?php echo SITEURL;?>/css/style.css" type="text/css" />
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.core.min.js"></script>
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.widget.min.js"></script>
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/mxdialog.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/validate.inc.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/inc/js/msdropdown/dd.css" />
<script type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/msdropdown/js/jquery.dd.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	try{
		oHandler = $(".mydds").msDropDown().data("dd");
		$("#ver").html($.msDropDown.version);
	}catch(e){ 
		alert("Error: "+e.message); 
	}
});
var SITEURL = '<?php echo SITEURL;?>';
var SITEUSERURI = '<?php echo $_SESSION['SITEUSERURI'];?>';
var SITEUSERID = '<?php echo $_SESSION['SITEUSERID'];?>';
var SITEUSERNAME = '<?php echo $_SESSION['SITEUSERNAME'];?>';
var SITEUSEREMAIL = '<?php echo $_SESSION['SITEUSEREMAIL'];?>';
var ABSPATH = '<?php echo ABSPATH; ?>';
</script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<link type="text/css" href="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('.scroll-pane').jScrollPane({
		autoReinitialise: true
	});
});
</script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/site.inc.js"></script>
</head>
<body>
<div id="common-message" style="top:-100px;" class="common-message">
  <p>Common Message Hare</p>
</div>
<div class="games-popup">
  <ul class="game-cat-list">
    <?php
	$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 ORDER BY RAND() LIMIT 0,3 ";
	$data = $DB->dbRows($sql);
	$TOTREC = $DB->numRows;
	if($TOTREC){
		foreach($data as $key=>$value){
			echo '
		<li>
		  <div class="img-box"> <img src="'.SITEURL.'/uploads/game/'.$value['imageName'].'" height="152px"  width="234px" /></div>
		  <span class="title">'.limitChars($value['gameTitle'],100).'</span> 
		  <a href="'.SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/ " class="button">PLAY NOW</a> 
		  <a href="'.SITEURL.'/how-to-play/" class="btn-gray">How to Play</a> 
	  </li>';
		}
	}
	?>
  </ul>
  <div class="running-low-on-chips">
    <div class="img-box"><img src="<?php echo SITEURL;?>/images/img-piggy-bank.png" /></div>
    <span class="title">Running low on chips ?</span> <?php echo '<a href="'.SITEURL.'/shop/nu-chips/" class="button"> BUY NOW ! </a>'; ?> </div>
  <ul class="top-10-player">
    <h3>TOP 10 PLAYERS</h3>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Paristosh Ajmera - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Paristosh Ajmera - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Paristosh Ajmera - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Suveer Bajaj - $ 10,00,000</span></a></li>
    <li><a href="#">
      <div class="img-box"></div>
      <span>Paristosh Ajmera - $ 10,00,000</span></a></li>
  </ul>
</div>

<div id="main-wrapper">
<div id="wrapper">
<div id="header">
<div class="about-popup">
  <ul class="about-popup-nav">
    <li><a href="#" class="active">Step 1</a></li>
    <li><a href="#">Step 2</a></li>
    <li><a href="#">Step 3</a></li>
    <li><a href="#">Step 4</a></li>
    <li><a href="#">Step 5</a></li>
  </ul>
  <ul class="about-popup-inside">
    <li class="about-popup-step-1" style="display:none;">
      <h3>50 cards • 5 Suits • 10 cards per suit <br />numbered 0 - 49</h3>
      <img src="<?php echo SITEURL;?>/images/img-about-popup-step1.jpg" /> 
    </li>
    <li class="about-popup-step-2" style="display:none;">
      <h3>5 'Decade' suits • 10 cards per suit </h3>
      <table width="274" border="0" bgcolor="#000" cellspacing="2" cellpadding="4">
        <tbody>
          <tr>
            <td bgcolor="#FFFFFF">SINGLES</td>
            <td bgcolor="#FFFFFF" style="font-weight:bold;"><code>0</code> - 9</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">TEENs</td>
            <td bgcolor="#FFFFFF" style="font-weight:bold;"><code>10</code> - 19</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">TWENTIES</td>
            <td bgcolor="#FFFFFF" style="font-weight:bold;"><code>20</code> - 29</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">THIRTIES</td>
            <td bgcolor="#FFFFFF" style="font-weight:bold;"><code>30</code> - 39</td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">FORTIES</td>
            <td bgcolor="#FFFFFF" style="font-weight:bold;"><code>40</code> - 49</td>
          </tr>
        </tbody>
      </table>
    </li>
    <li class="about-popup-step-3" style="display:none;">
      <h3>3 lucky cards</h3>
      <img src="<?php echo SITEURL;?>/images/img-about-popup-step3.jpg" /> 
    </li>
    <li class="about-popup-step-4" style="display:none;">
      <h3>There are 2 numbers on each card - A HIGH Number and <span>LOW Number</span></h3>
      <img src="<?php echo SITEURL;?>/images/img-about-popup-step4.jpg" />
      <h3>The <span>LOW Number</span> is the last digit of the HIGH Number</h3>
    </li>
    <li class="about-popup-step-5" style="display:block;">
      <h3>There are 5 of each <span>LOW Number:</span> <a href="#">0,</a> <a href="#">1,</a> <a href="#">2,</a> <a href="#">3,</a> <a href="#">4,</a> <a href="#">5,</a> <a href="#" class="active">6,</a> <a href="#">7,</a> <a href="#">8,</a> <a href="#" class="active">9</a></h3>
      <img src="<?php echo SITEURL;?>/images/img-about-popup-step5.jpg" /> 
    </li>
  </ul>
</div>
  <?php 
  if(!$_SESSION['SITEUSERID']){ 
  	$validateUserRegister = array(
		"hUserEmail"=>array("func"=>"required,email","msg"=>""),
		"hUserName"=>array("func"=>"required,loginname","msg"=>""),
		"userPass"=>array("func"=>"required,password","msg"=>""),
		"hUserCPass"=>array("func"=>"required,password,equalto:userPass","msg"=>"Confirm Password cannot be blank, should be equals to Password"));
  ?>
  <div id="login-register-wrapp" style="display:none;">
  <a href="#" class="btn-close-II"><img src="<?php echo SITEURL;?>/images/btn-remove.png" /></a> <a href="#" class="btn-close">CLOSE</a>
    <div class="login-register-wrapp-inside">
      <div class="btn-connect-fb"> <a class="btn-fblogin" href="#"> <img src="<?php echo SITEURL;?>/images/btn-connect-with-facebook.png" /> </a> </div>
      <p class="login-register-copy">If you use Facebook to sign up, it will make it quicker to get started and easier to play games, earn free chips, win goodies and share your games with your friends.</p>
      <div class="register-wrapp" style="display:none">
        <h1>CREATE AN ACCOUNT</h1>
        <form name="userRegistration" id="userRegistration" method="post" onsubmit="return false;" >
          <input type="hidden" name="fbID" class="fbID" value="" />
          <ul class="register-form">
            <li>
              <input type="text" name="userEmail" class="email userEmail" id="hUserEmail" value="Email" title="Email" />
              <p class="e userEmail">Email required</p>
            </li>
            <li>
              <input type="text" name="userName" class="user userName" id="hUserName" value="Username" title="Username" />
              <p class="e userName">Username required</p>
            </li>
            <li>
              <input type="text" name="userPass" class="password userPass" value="Password" title="Password" id="userPass" />
              <p class="e userPass">Password required</p>
            </li>
            <li>
              <input type="text" class="confirm-password confirmPassword" value="Confirm Password" title="Confirm Password" id="hUserCPass" name="hUserCPass" />
              <p class="e confirmPassword">Confirm Password required</p>
            </li>
           <!-- <li>
              Vip Membership
              <input type="checkbox" value="yes" id="vipMembership" name="vipMembership" />
            </li>-->
            <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateUserRegister));?>" />
            <input type="submit" class="button" value="CREATE ACCOUNT" id="creatAcount" />
          </ul>
        </form>
        <p class="register-bottom-copy">By clicking "Create Account", you are indicating that you have read and agree to the Terms & Conditions and Privacy Policy </p>
      </div>
      <div class="login-wrapp" style="display:block">
        <div class="login">
          <h1>LOGIN</h1>
          <h3>START PLAYING NU GAMES RIGHT AWAY !</h3>
          <?php
		  $validateUserLog = array(
			"HLUserName"=>array("func"=>"required,loginname","msg"=>""),
			"HLUserPass"=>array("func"=>"required,password","msg"=>""));
		  ?>
          <form name="userLogin" id="userLogin" method="post" onsubmit="return false;" >
            <input type="hidden" name="currUrl" id="currUrl" value="" />
            <ul class="login-form">
              <li>
                <input type="text" class="user userName" value="Username" title="Username" name="userName" id="HLUserName" />
              </li>
              <li>
                <input type="text" class="password userPass" value="Password" title="Password" id="HLUserPass" name="HLUserPass" />
              </li>
              <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateUserLog));?>" />
              <input type="submit" class="button getLogin"  value="Login"/>
              <a href="<?php echo SITEURL.'/user/forgot-password/';?>" class="btn-forgot-password">Forgot Password ?</a>
            </ul>
          </form>
        </div>
        <div class="register">
          <h1>REGISTER</h1>
          <h3>SIGN UP NOW, TAKES ONLY 30 SECONDS !</h3>
          <p>Create a Nu account today and start playing games like Poker, Cricket, Nu Luck and more with your friends, family and people across the world.</p>
          <input type="button" class="button" value="REGISTER" id="uRegister" />
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <ul id="main-nav">
    <li><a href="<?php echo SITEURL;?>" class="<?php if($TPL->urlBase  == "") echo "active";?>">HOME</a></li>
    <?php echo getMenu("MAIN");?> 
    <script>
    $("ul#main-nav li.nuHome").attr('href','<?php echo SITEURL;?>', 'class','active');
    </script>
  </ul>
  <?php if($_SESSION['SITEUSERID']){ ?>
  <a href="<?php echo SITEURL;?>" class="logo"> <img src="<?php echo SITEURL;?>/images/logo.png" /> </a>
  <?php }  else {?>
  <a href="<?php echo SITEURL;?>" class="logo"> <img src="<?php echo SITEURL;?>/images/logo1.png" /> </a>
  <?php } ?>
  <div class="top-nav">
    <?php 
	if($_SESSION['SITEUSERID']){ 
		$sql = "SELECT isVip FROM ".$DB->pre."site_user WHERE siteUserID = '".$_SESSION['SITEUSERID']."' AND status = 1";
		$isVip = $DB->dbRow($sql);
	?>
    <ul class="user-nav" style="display:none;">
      <li><a href="<?php echo SITEURL.'?xAction=logout'; ?>"><img src="<?php echo SITEURL; ?>/images/icon-sign-out.png">SIGN OUT</a></li>
      <?php if($isVip['isVip'] != 1) { ?>
      <li><a href="<?php echo SITEURL.'/user/vip-membership/'; ?>"><img src="<?php echo SITEURL; ?>/images/icon-upgrade-to-vip.png">UPGRADE TO VIP</a></li>
      <?php } ?>
      <li><a href="<?php echo SITEURL.'/shop/nu-chips/'; ?>"><img src="<?php echo SITEURL; ?>/images/icon-buy-chips.png">buy chips</a></li>
      <li><a href="<?php echo SITEURL.'/checkout/step-1/'; ?>"><img src="<?php echo SITEURL; ?>/images/icon-shopping-cart.png">shopping cart</a></li>
      <li><a href="<?php echo SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/'; ?>"><img src="<?php echo SITEURL; ?>/images/icon-profile-setting.png">My profile</a></li>
    </ul>
    <?php } ?>
    <div class="header-button">
      <?php 
	  	if($isVip['isVip'] == "1"){ $isVip = "*"; } else{ echo $isVip = "";}
	  	if(!$_SESSION['totProCartCount']){ $couterCart = "0"; } else { $couterCart = $_SESSION['totProCartCount'];}		
		if($_SESSION['SITEUSERID']){
			$sql = "SELECT userChips FROM ".$DB->pre."site_user  WHERE siteUserID='".$_SESSION['SITEUSERID']."'";
			$CHIP = $DB->dbRow($sql);
			$dispName = '
			<a class="btn-arrow" id="withLogin" href="#"></a>
			<a href="'.SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/" class="name profileName">
				Hi, '.$_SESSION['SITEUSERNAME'].' '.$isVip.'
			</a>
			';
			if($TPL->pageType == 'module' && $TPL->urlBase == 'games' && $TPL->uriArr[0] !='games'){
				echo '<a class="btn-arrow" id="withLogin" href="#"></a>';	 
		 	}
			if($TPL->uriArr[0] == 'games'){
				echo 'CHIPS - '.number_format($CHIP['userChips']).' <a class="btn-arrow" id="withLogin" href="#"></a>';	
			}else{
				echo $dispName;
			}
			if($TPL->pageType != 'home' && $TPL->pageType != 'page' && $TPL->urlBase != 'games' && $TPL->requestUri != 'games/' && $TPL->urlBase != 'forgot-password' && $TPL->uriArr[0] != 'user' && $TPL->uriArr[0] != 'games'){
				 echo '<a href="'.SITEURL.'/checkout/step-1/" class="btn-cart">'.$couterCart.'</a> ';
		 	}
		} else {
		  	echo '<a class="btn-arrow" id="withOutLogin" href="#"></a><a href="#" class="name btn-ligin-register">Login / Register now !</a>';
			if($TPL->pageType != 'home' && $TPL->pageType != 'page' && $TPL->urlBase != 'games' && $TPL->urlBase != 'forgot-password'){
				 echo '<a href="'.SITEURL.'/checkout/step-1/" class="btn-cart">'.$couterCart.'</a> ';
		 	}
	  }
  	?>
    </div>
  </div>
</div>
