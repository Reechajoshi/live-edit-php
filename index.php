<?php
session_start();

require("connectdb.inc.php");
require("config.inc.php");

require("inc_mg/inc.func.php");
require_once("inc_mg/browser.php");

require( ABSPATH."/inc_mg/inc.sess.php" );
$isSessOK = isSessOK();

function unsetSession(){
	GLOBAL $DB;
	$_userName = $_SESSION['SITEUSERNAME'];
		
	unset($_SESSION['SITEUSERID']);
	unset($_SESSION['SITEUSERNAME']);
	unset($_SESSION['SITEUSERURI']);
	unset($_SESSION['PRODUCTCART']);
	unset($_SESSION['totProCartCount']);
	unset($_SESSION['VIPMEMBERSHIPCART']);
	unset($_SESSION['shipID']);
	
	unset($_SESSION['SESSID']);
	
	setcookie("SITEUSERID", "", false, "/");
	setcookie("SITEUSERNAME", "", false, "/");
	setcookie("SITEUSERURI", "", false, "/");
	
	// require("connectdb.inc.php");
	$_q = "delete from sess where userName='$_userName';";
	$DB->dbQuery( $_q );
	
	header("location:".SITEURL."/"); exit;
}

if($isSessOK && isset($_GET["xAction"]) ){ 
	if( trim($_GET["xAction"]) == "logout" )
		unsetSession();
	else if( trim($_GET["xAction"]) == "remove" )
	{
		$_q = "update ".$DB->pre."site_user set status=0 where userName='".$_SESSION['SITEUSERNAME']."';";
		$DB->dbQuery( $_q );
		unsetSession();
	}
}

if(isset($_COOKIE["MSG"])) { $MSG = $_COOKIE["MSG"]; setcookie("MSG", "", false, "/"); } 
// require("connectdb.inc.php");
require("inc/tpl.class.inc.php");  
require("inc/common.inc.php");
require("core/form.class.inc.php");
require("core/validate.inc.php");

$TPL = new manageTemplate();
$TPL->tplFile    = ABSPATH."/mod/home/x-home.php";
$TPL->tplInc     = ABSPATH."/mod/home/x-home.inc.php";
$TPL->modPath    = ABSPATH."/mod/home";
$TPL->modUrl     = SITEURL."/mod/home";
$TPL->tplTitle   = "Home";
$TPL->pageType   = "home";
$TPL->requestUri = $_SERVER["REQUEST_URI"];
$TPL->setPage();

$MXOFFSET = 0;
if($_REQUEST["offset"])
	$MXOFFSET = sprintf("%d",$_REQUEST["offset"]);

require("inc/tplhook.inc.php");

if($TPL->tplInc)
require($TPL->tplInc);
require("header.php");
require($TPL->tplFile);
require("footer.php");
require("privacy.php");
require("terms.php");
if( $isSessOK )
	require("payment_history.php");
?>
