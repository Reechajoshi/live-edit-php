<?php
if($TPL->pageType == "list" || $TPL->pageType == "trash")
	header("location:".ASITEURL."/setting-edit/");

$MXTOTREC = 0;
$MXPGINFO["PK"] = "settingID";
$MXPGINFO["TBL"] = "admin_setting";

function updateSetting() {
	global $DB,$TPL,$MXPGINFO,$MXSETTINGS;
	$D = $MXSETTINGS;
	$_POST["logo"] = uploadFile("logo","xadmin/images/settings","logo");
	$_POST["favicon"] = uploadFile("favicon","xadmin/images/settings","favicon");		
		
	$DB->table = $DB->pre."admin_setting";
	foreach($D as $seoUri=>$v) {
		//echo "<br>settingVal=".$_POST[$seoUri]." WHERE seoUri='$seoUri'";
		$DB->data  = array("settingVal"=>$_POST[$seoUri]);
		$DB->dbUpdate("seoUri='$seoUri'");
	}
	mxMsg("Settings updated successfully.");						
	header("location:".ASITEURL."/$TPL->modName-edit/"); exit;
}

function restoreSettings(){
	global $DB;
	$DB->dbQuery("UPDATE ".$DB->pre."admin_setting SET settingVal=settingDefault WHERE 1");
	$files = glob(AABSPATH.'/images/settings/*');
	foreach($files as $file){
	  if(is_file($file))
		unlink($file);
	}
	copy(AABSPATH."/images/logo.png",AABSPATH."/images/settings/logo.png");
	copy(AABSPATH."/images/favicon.png",AABSPATH."/images/settings/favicon.png");
}


if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		case "UPDATE":										
			if(!$VERR)
				updateSetting();			
		break;
		case "restore":
			include("../../../connectdb.inc.php");			
			restoreSettings();
		break;
	}
}
?>