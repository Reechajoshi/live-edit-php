<?php
//ob_start();
session_start();
require("../connectdb.inc.php");

if(trim($_GET["xAction"]) == "xLogout"){
	if(isset($_SESSION['MXID'])){ unset($_SESSION['MXID']); }
	if(isset($_SESSION['MXNAME'])){ unset($_SESSION['MXNAME']); }
	if(isset($_SESSION['MXROLE'])){ unset($_SESSION['MXROLE']); }		
	header("location:".ASITEURL."/login/"); exit;
}

$MXSHOWREC = 20;
if($_REQUEST["showRec"] > 0)
	$MXSHOWREC = sprintf("%d",$_REQUEST["showRec"]);

require("inc/settings.inc.php");
require("inc/common.inc.php");
require("../inc/common.inc.php");
require("inc/tpl.class.inc.php");
$MXSETTINGS = getSetting();

$TPL = new manageTemplate();
$TPL->tplFile    = AABSPATH."/x-login.php";	
$TPL->requestUri = $_SERVER["REQUEST_URI"];
$TPL->tplDefault = $MXSETTINGS["default-page"]."-list";
$TPL->tplTitle   = "";
$TPL->modName    = "";
$TPL->pageType   = "";
$TPL->setPage();

$MXOFFSET = 0; $STATUS = 1;
if($_REQUEST["offset"] && $_REQUEST["offset"]>=0)
	$MXOFFSET = sprintf("%d",$_REQUEST["offset"]);
if($TPL->pageType == "trash")
	$STATUS = 0;
	
if($TPL->pageUri == "login"){
	require($TPL->tplFile);
} else {

	if($TPL->pageType == "edit" || $TPL->pageType == "add")
		require("../core/validate.inc.php");
	require("../core/form.class.inc.php");
	if($TPL->tplInc)
	require($TPL->tplInc);
	require("header.php");
	require($TPL->tplFile);
	require("footer.php");
}
?>
