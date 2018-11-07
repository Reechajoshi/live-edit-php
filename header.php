 <?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" dir="ltr" lang="en-US">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<?php include( 'inc_mg/meta.php' ); ?>
<?php echo $FBMETA;?>
<?php echo mxGetMeta(); ?>
<link rel="icon" href="<?php echo SITEURL;?>/images/favicon.png">
<!--<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/nu-casino.com/22257.css" type="text/css" />--> <!--Local Link-->
<!--<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/demos.foxymoron.co.in/22257.css" type="text/css" />--> <!--live Link-->
<!--<link rel="stylesheet" href="http://f.fontdeck.com/s/css/zH28mslJNSfrEtk/N8vkA5GMvEQ/mds/22257.css" type="text/css" />--><!-- local Link-->
<link rel="stylesheet" href="http://f.fontdeck.com/s/css/Apze2dvNdXHEEouBEkMJw9x2A40/www.nu-casino.com/21247.css" type="text/css" /><!-- nu-casino.com-->
<title><?php if($TPL->metaTitle) echo $TPL->metaTitle; else echo 'NU'; ?></title>

<!--script type="text/javascript" src="/inc/js/alerts/jquery-1.8.1.min.js"></script-->
<script type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="<?php echo SITEURL;?>/lib/js/ui/themes/base/jquery.ui.all.css">
<!--script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/jquery-1.7.1.min.js"></script-->
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/common.inc.js"></script>
<link rel="stylesheet" href="<?php echo SITEURL;?>/css/style.mg.css.php" type="text/css" />
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.core.min.js"></script>
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.widget.min.js"></script>
<script language="javascript" src="<?php echo SITEURL;?>/lib/js/ui/jquery.ui.datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/mxdialog.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/core/js/validate.inc.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/inc/js/msdropdown/dd.css" />
<script type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/msdropdown/js/jquery.dd.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/inc_mg/image_rotate/rotate.css" />
<script type="text/javascript" src="<?php echo SITEURL; ?>/inc_mg/image_rotate/rotate.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	try{
		oHandler = $(".mydds").msDropDown().data("dd");
		$("#ver").html($.msDropDown.version);
	}catch(e){ 
		// alert("Error: "+e.message); 
	}
	// checkBrowser();
});
<?php
	if( $isSessOK )
	{
		echo( "var SITEURL = '".SITEURL."';
		var SITEUSERURI = '".$_SESSION['SITEUSERURI']."';
		var SITEUSERID = '".$_SESSION['SITEUSERID']."';
		var SITEUSERNAME = '".$_SESSION['SITEUSERNAME']."';
		var SITEUSEREMAIL = '".$_SESSION['SITEUSEREMAIL']."';
		var ABSPATH = '".ABSPATH."';");
	}
	else
	{
		echo( "var SITEURL = '';
		var SITEUSERURI = '';
		var SITEUSERID = '';
		var SITEUSERNAME = '';
		var SITEUSEREMAIL = '';
		var ABSPATH = '';");
	}
	
	// login box buttons
	$login_btn_detail = getButtons( "login", "login_box" );
	$reg_btn_detail = getButtons( "register", "login_box" );
	$createAcc_btn_detail = getButtons( "create_account", "login_box" );		
	$close_btn_detail = getButtons( "close", "login_box" );		
	
	// game pop up buttons
	$play_now_btn_detail[0] = getButtons( "play_now_01", "game_dropdown" );		
	$play_now_btn_detail[1] = getButtons( "play_now_02", "game_dropdown" );		
	$play_now_btn_detail[2] = getButtons( "play_now_03", "game_dropdown" );		
	
	$how_to_play_btn_detail[0] = getButtons( "how_to_play_01", "game_dropdown" );		
	$how_to_play_btn_detail[1] = getButtons( "how_to_play_02", "game_dropdown" );		
	$how_to_play_btn_detail[2] = getButtons( "how_to_play_03", "game_dropdown" );		
	
	$buy_now_btn_details = getButtons( "buy_now", "game_dropdown" );		
	
?>
/* var SITEURL = '<?php echo SITEURL;?>';
var SITEUSERURI = '<?php echo $_SESSION['SITEUSERURI'];?>';
var SITEUSERID = '<?php echo $_SESSION['SITEUSERID'];?>';
var SITEUSERNAME = '<?php echo $_SESSION['SITEUSERNAME'];?>';
var SITEUSEREMAIL = '<?php echo $_SESSION['SITEUSEREMAIL'];?>';
var ABSPATH = '<?php echo ABSPATH; ?>'; */
</script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<link type="text/css" href="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	try{
		$('.scroll-pane').jScrollPane({
			autoReinitialise: true
		});
	}catch(e){ 
		// alert("Error: "+e.message); 
	}
	initTime();
});
</script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/inc/js/site.inc.js"></script>

<?php
	include( 'inc_mg/inc.mg.php' );
?>

</head>
<body>
<div id="common-message" style="top:-100px;" class="common-message">
  <p>Common Message Hare</p>
</div>
<div class="games-popup">
  <ul class="game-cat-list">
    <?php
	$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 ORDER BY gameId asc LIMIT 0,3 ";
	$data = $DB->dbRows($sql);
	$TOTREC = $DB->numRows;
	if($TOTREC){
		/* foreach($data as $key=>$value){
		// for( $i = 0; $i < count( $data ); $i++ ) {
			echo '
		<li>
		  <div class="img-box"> <img src="'.SITEURL.'/uploads/game/'.$value['imageName'].'" height="152px"  width="234px" /></div>
		  <span class="title">'.limitChars($value['gameTitle'],100).'</span> 
		  <a href="'.SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/ " class="button">PLAY NOW</a> 
		  <a href="'.SITEURL.'/how-to-play/?i='.$value['gameID'].'" class="btn-gray">How to Play</a> 
	  </li>';
		} */
		for( $i = 0; $i < count( $data ); $i++ )
		{
			echo '
		<li>
		  <div class="img-box"> <img src="'.SITEURL.'/uploads/game/'.$data[$i]['imageName'].'" height="152px"  width="234px" /></div>
		  <span class="title">'.limitChars($data[$i]['gameTitle'],100).'</span> 
		  <a href="'.$play_now_btn_detail[$i]["link"].'" class="button '.$play_now_btn_detail[$i]["color"].'">'.$play_now_btn_detail[$i]["button_txt"].'</a> 
		  <a href="'.$how_to_play_btn_detail[$i]["link"].'" class="btn-gray '.$how_to_play_btn_detail[$i]["color"].'">'.$how_to_play_btn_detail[$i]["button_txt"].'</a> 
	  </li>';
		}
	}
	?>
  </ul>
  <div class="running-low-on-chips">
    <div class="img-box"><img src="<?php echo SITEURL;?>/images/img-piggy-bank.png" /></div>
    <span class="title">Running low on chips ?</span> <?php /* echo '<a href="'.SITEURL.'/shop/nu-chips/" class="button"> BUY NOW ! </a>'; */ echo '<a href="'.$buy_now_btn_details["link"].'" class="button '.$buy_now_btn_details["color"].'"> '.$buy_now_btn_details["button_txt"].' </a>';  ?> </div>
	<ul class="top-10-player">
    <h3>TOP 10 PLAYERS</h3>
	<?php
		include( 'inc/top_player.php' );
	?>
	</ul>
  <!--
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
  
  -->
</div>

<?php
	
	/* TO RETRIEVE HOW TO PLAY NU CARDS FROM DB */
	
	getNUCardsSteps( 'pop-up', &$title_arr, &$desc_arr );

?>

<div id="main-wrapper">
<div id="wrapper">
<div id="header">
<div class="about-popup">
  <ul class="about-popup-nav">
    <!-- <li><a href="#" class="active">Step 1</a></li>
    <li><a href="#">Step 2</a></li>
    <li><a href="#">Step 3</a></li>
    <li><a href="#">Step 4</a></li>
    <li><a href="#">Step 5</a></li> -->
	<?php
	
		for( $i = 0; $i < 5; $i++ )
		{
			echo( "<li><a href='#'>".$title_arr[ $i ]."</a></li>" );
		}
	
	?>
  </ul>
  <ul class="about-popup-inside">
  
	
	<?php
		
		for( $i = 0; $i < 5; $i++ )
		{
			echo( "<li class='about-popup-step-".($i+1)."' style='display:none;'>" );
			
			echo( $desc_arr[ $i ] );
			
			echo( "</li>" );
		}
		
	?>
  
    <!-- <li class="about-popup-step-1" style="display:none;">
      <h3>50 cards • 5 Suits • 10 cards per suit <br />numbered 0 - 49</h3>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-step1.jpg" /> 
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
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-step3.jpg" /> 
    </li>
    <li class="about-popup-step-4" style="display:none;">
      <h3>There are 2 numbers on each card - A HIGH Number and <span>LOW Number</span></h3>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-step4.jpg" />
      <h3>The <span>LOW Number</span> is the last digit of the HIGH Number</h3>
    </li>
    <li class="about-popup-step-5" style="display:block;">
      <h3>There are 5 of each <span>LOW Number:</span> <a href="#">0,</a> <a href="#">1,</a> <a href="#">2,</a> <a href="#">3,</a> <a href="#">4,</a> <a href="#">5,</a> <a href="#" class="active">6,</a> <a href="#">7,</a> <a href="#">8,</a> <a href="#" class="active">9</a></h3>
      <img src="<?php //echo SITEURL;?>/images/img-about-popup-step5.jpg" /> 
    </li> -->
  </ul>
</div>
  <?php 
	
	$home_pg_err_msg = getErrorMessages( "home_page" );
	$userName_err_msg = $home_pg_err_msg[ 'user_name' ];
	$password_err_msg = $home_pg_err_msg[ 'password' ];
	$email_err_msg = $home_pg_err_msg[ 'email' ];
	$confirmPassword_err_msg = $home_pg_err_msg[ 'confirm_password' ];
	
  if(!$isSessOK){ 
  	$validateUserRegister = array(
		"hUserEmail"=>array("func"=>"required,email","msg"=>$email_err_msg),
		"hUserName"=>array("func"=>"required,loginname","msg"=>$userName_err_msg),
		"userPass"=>array("func"=>"required,password","msg"=>$password_err_msg),
		"hUserCPass"=>array("func"=>"required,password,equalto:userPass","msg"=>$confirmPassword_err_msg));
		
  
  ?>
  <div id="login-register-wrapp" style="display:none;">
  <a href="#" class="btn-close-II"><img src="<?php echo SITEURL;?>/images/btn-remove.png" /></a> <a href="#" class="btn-close <?php echo( $close_btn_detail["color"] ); ?>"><?php echo( $close_btn_detail["button_txt"] ); ?></a>
    <div class="login-register-wrapp-inside">
      <div class="btn-connect-fb"> <a class="btn-fblogin" href="#"> <img src="<?php echo SITEURL;?>/images/btn-connect-with-facebook.png" /> </a> </div>
      <p id="texts-REG_MAIN_DESC" class="login-register-copy editable"><?php echo( getRegText( 'REG_MAIN_DESC' ) ); ?></p>
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
            <input type="submit" class="button <?php echo( $createAcc_btn_detail["color"] ); ?>" value="<?php echo( $createAcc_btn_detail["button_txt"] ); ?>" id="creatAcount" />
          </ul>
        </form>
        <p class="register-bottom-copy">By clicking "Create Account", you are indicating that you have read and agree to the Terms & Conditions and Privacy Policy </p>
      </div>
      <div class="login-wrapp" style="display:block">
        <div class="login">
          <h1>LOGIN</h1>
          <h3 id="texts-REG_LOGIN_LINE" class="editable" ><?php echo( getRegText( 'REG_LOGIN_LINE' ) ); ?></h3>
          <?php
		  $validateUserLog = array(
			"HLUserName"=>array("func"=>"required,loginname","msg"=>$userName_err_msg),
			"HLUserPass"=>array("func"=>"required,password","msg"=>$password_err_msg));
		  ?>
          <form name="userLogin" id="userLogin" method="post" onsubmit="return false;" >
		  <?php
			$_ar = explode( '/', $TPL->tplFile );
			$_fl = $_ar[ ( count( $_ar ) - 1) ];
			if( $_fl == 'tpl-chips.php' )
				echo( '<input type="hidden" name="currUrl" id="currUrl" value="'.SITEURL.'shop/nu-chips/" />' );
			else
				echo( '<input type="hidden" name="currUrl" id="currUrl" value="" />' );
		  ?>
            <ul class="login-form">
              <li>
                <input type="text" class="user userName" value="Username" title="Username" name="userName" id="HLUserName" />
              </li>
              <li>
                <input type="text" class="password userPass" value="Password" title="Password" id="HLUserPass" name="HLUserPass" />
              </li>
              <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validateUserLog));?>" />
              <input type="submit" class="button-red getLogin <?php echo( $login_btn_detail[ "color" ] ); ?>" style="float:right;margin:20px 0px 0px 0px;"  value="<?php echo( $login_btn_detail[ "button_txt" ] ); ?>"/>
              <a href="<?php echo SITEURL.'/user/forgot-password/';?>" class="btn-forgot-password">Forgot Password ?</a>
            </ul>
          </form>
        </div>
        <div class="register">
          <h1>REGISTER</h1>
          <h3 id="texts-REG_LINE" class="editable" ><?php echo( getRegText( 'REG_LINE' ) ); ?></h3>
          <p id="texts-REG_DESC" class="editable" ><?php echo( getRegText( 'REG_DESC' ) ); ?></p>
          <input type="button" class="button <?php echo( $reg_btn_detail["color"] ); ?>" value="<?php echo( $reg_btn_detail["button_txt"] ); ?>" id="uRegister" />
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
  <?php if($isSessOK && $_SESSION['SITEUSERID']){ ?>
  <a href="<?php echo SITEURL;?>" class="logo"> <img src="<?php echo SITEURL;?>/images/logo.png" /> </a>
  <?php }  else {?>
  <a href="<?php echo SITEURL;?>" class="logo"> <img src="<?php echo SITEURL;?>/images/logo1.png" /> </a>
  <?php } ?>
  <div class="time_block" style="font-size:15px;">
	<div class="curr_time"><b>NU TIME : </b><span id="time"></span></div>
	<!-- <div class="count_down"><b>NU COUNTDOWN : </b><span id="countdown"></span></div> -->
  </div>
  <div class="top-nav">
    <?php 
	if($isSessOK && $_SESSION['SITEUSERID']){ 
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
	  	if(!$isSessOK && !$_SESSION['totProCartCount']){ $couterCart = "0"; } else { $couterCart = $_SESSION['totProCartCount'];}		
		if($isSessOK && $_SESSION['SITEUSERID']){
			$sql = "SELECT userChips FROM ".$DB->pre."site_user  WHERE siteUserID='".$_SESSION['SITEUSERID']."'";
			$CHIP = $DB->dbRow($sql);
			$dispName = '<table><tr><td>
			<div><a href="'.SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/" class="name profileName">
				Hi, '.$_SESSION['SITEUSERNAME'].' '.$isVip.'
			</a></div>
			</td><td rowspan=2 >';
			
			if($TPL->pageType != 'home' && $TPL->pageType != 'page' && $TPL->urlBase != 'games' && $TPL->requestUri != 'games/' && $TPL->urlBase != 'forgot-password' && $TPL->uriArr[0] != 'user' && $TPL->uriArr[0] != 'games')
				$dispName .= '<a style="margin-top: 12px; float: left;"  href="'.SITEURL.'/checkout/step-1/" class="btn-cart">'.$couterCart.'</a> ';
		 	
			$dispName .= '<a class="btn-arrow" id="withLogin" href="#"></a>
			</td></tr><tr><td>
			<div>NU $'.number_format(trim($CHIP['userChips'])).'</div></td></tr></table>';
			
			// if($TPL->pageType == 'module' && $TPL->urlBase == 'games' && $TPL->uriArr[0] !='games'){
				// echo '<a class="btn-arrow" id="withLogin" href="#"></a>';	 
		 	// }
			// if($TPL->uriArr[0] == 'games'){
				// echo 'NU CHIPS - '.number_format(trim($CHIP['userChips'])).'<a class="btn-arrow" id="withLogin" href="#"></a>';	
			// }else{
				echo $dispName;
			// }
			
		} else {
		  	echo '<a class="btn-arrow" id="withOutLogin" href="#"></a><a href="#" class="name btn-ligin-register" style="line-height: 44px;" >Login / Register now !</a>';
			if($TPL->pageType != 'home' && $TPL->pageType != 'page' && $TPL->urlBase != 'games' && $TPL->urlBase != 'forgot-password'){
				 echo '<a style="line-height: 44px;" href="'.SITEURL.'/checkout/step-1/" class="btn-cart">'.$couterCart.'</a> ';
		 	}
	  }
  	?>
    </div>
  </div>
</div>
