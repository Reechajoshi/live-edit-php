<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "categoryID";
$MXPGINFO["TBL"] = "category";

function getParentSeouri($parentID=0){
	global $DB; $str = "";
	$parentID = intval($parentID);
	if($parentID){
		$d = $DB->dbRow("SELECT seoUri FROM `".$DB->pre."category` WHERE categoryID='$parentID'");
		if($d["seoUri"])
			$str = $d["seoUri"];
	}
	return $str;
}

function addCategory() {	
	global $DB,$TPL;	
	$_POST["categoryImage"] = uploadFile("categoryImage");
	$_POST["seoUri"] = getParentSeouri($_POST["parentID"])."/".makeSeoUri($_POST["categoryTitle"]);
	
	$_POST["dateAdded"] = date("Y-m-d H:i:s");	
	
	$_POST["categoryTitle"] = addslashes(cleanTitle($_POST["categoryTitle"]));
	$_POST["synopsis"] = addslashes(cleanTitle($_POST["synopsis"]));	
	
	$DB->table = $DB->pre."category";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$categoryID = $DB->insertID; 								
		if($categoryID) {					
		    mxMsg("Category added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$categoryID"); exit;
		}
	}
}

function updateCategory() {
	global $DB,$TPL;
	$_POST["categoryImage"] = uploadFile("categoryImage");	
	$_POST["seoUri"] = getParentSeouri($_POST["parentID"])."/".makeSeoUri($_POST["categoryTitle"]);	
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	
	$_POST["categoryTitle"] = addslashes(cleanTitle($_POST["categoryTitle"]));
	$_POST["synopsis"] = addslashes($_POST["synopsis"]);
	
	$categoryID    = sprintf("%d",$_POST["categoryID"]);
	$DB->table = $DB->pre."category";
	$DB->data  = $_POST;
	if($DB->dbUpdate("categoryID='$categoryID'")){
		if(file_exists(ABSPATH."/mod/menu")){
			$DB->dbQuery("UPDATE ".$DB->pre."menu SET seoUri='".$_POST["seoUri"]."' WHERE seoUri='".$_POST["oldUri"]."' AND menuType='category'");
		}
						
		mxMsg("Category updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$categoryID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addCategory();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateCategory();			
		break;
	}
}
?>