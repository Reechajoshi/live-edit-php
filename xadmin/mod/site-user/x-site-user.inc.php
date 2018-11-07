<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "siteUserID";
$MXPGINFO["TBL"] = "site_user";
function addSite_user() {	
	global $DB,$TPL;
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["userName"]);
	$_POST['userPass'] = md5($_POST['userPass']);
	$DB->table = $DB->pre."site_user";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$siteUserID = $DB->insertID; 								
		if($siteUserID) {					
		    mxMsg("Site_user added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$siteUserID"); exit;
		}
	}
}

function updateSite_user() {
	global $DB,$TPL;	
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$_POST["seoUri"] = makeSeoUri($_POST["userName"]);
	$_POST['userPass'] = md5($_POST['userPass']);
	$siteUserID = sprintf("%d",$_POST["siteUserID"]);
	$DB->table = $DB->pre."site_user";
	$DB->data  = $_POST;
	if($DB->dbUpdate("siteUserID='$siteUserID'")){						
		mxMsg("Site_user updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$siteUserID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addSite_user();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateSite_user();			
		break;
	}
}
?>