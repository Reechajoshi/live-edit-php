<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "middleGalID";
$MXPGINFO["TBL"] = "middle_gallery";
set_time_limit(0);
function addMiddleGallery() {	
	global $DB,$TPL;
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["iconImage"] = uploadFile("iconImage");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["middleGalTitle"]);
	$DB->table = $DB->pre."middle_gallery";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$middleGalID = $DB->insertID; 								
		if($middleGalID) {					
		    mxMsg("Middle Gallery added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$middleGalID"); exit;
		}
	}
}

function updateMiddleGallery() {
	global $DB,$TPL;
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["iconImage"] = uploadFile("iconImage");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["middleGalTitle"]);
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$middleGalID = sprintf("%d",$_POST["middleGalID"]);
	$DB->table = $DB->pre."middle_gallery";
	$DB->data  = $_POST;
	if($DB->dbUpdate("middleGalID='$middleGalID'")){						
		mxMsg("Middle Gallery updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$middleGalID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addMiddleGallery();
		break;
		
		case "UPDATE":	
			if(!$VERR)
				updateMiddleGallery();			
		break;
	}
}
?>