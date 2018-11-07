<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "galleryID";
$MXPGINFO["TBL"] = "gallery";

function addGallery() {	
	global $DB,$TPL;
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["galleryTitle"]);
	$DB->table = $DB->pre."gallery";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$galleryID = $DB->insertID; 								
		if($galleryID) {
			getGalleryCategory($galleryID,$_REQUEST["categoryID"]);	
		    mxMsg("Gallery added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$galleryID"); exit;
		}
	}
}

function getGalleryCategory($galleryID,$categoryID) {
	global $DB; 
	if(count($categoryID) > 0 ){
		$DB->table = $DB->pre."gallery_category";	
		foreach($categoryID as $D){
			$DB->data  = array("galleryID"=>$galleryID,"categoryID"=>$D);
			$DB->dbInsert();
		}
	}
}


function updateGallery() {
	global $DB,$TPL;	
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$_POST["seoUri"] = makeSeoUri($_POST["galleryTitle"]);
	$galleryID = sprintf("%d",$_POST["galleryID"]);
	$gallCat = explode(",",$_POST['gallCat']);
	$DB->table = $DB->pre."gallery";
	$DB->data  = $_POST;
	if($DB->dbUpdate("galleryID='$galleryID'")){	
		if($_REQUEST['gallCat']) {
			$sql = "DELETE FROM `".$DB->pre."gallery_category` WHERE `galleryID`='$galleryID'";
			$DB->dbQuery($sql);
			
			$sql = "DELETE FROM `".$DB->pre."gallery_category` WHERE `galleryID` NOT IN (SELECT DISTINCT(galleryID) FROM `".$DB->pre."gallery` WHERE 1)";
			$DB->dbQuery($sql);
		}
		addUpdateGalleryCat($galleryID,$_REQUEST['categoryID']);						
		mxMsg("Gallery updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$galleryID"); exit;
	}			
}

function addUpdateGalleryCat($galleryID,$categoryID) {
	global $DB; 
	if(count($categoryID) > 0 ){
		$DB->table = $DB->pre."gallery_category";	
		foreach($categoryID as $D){
			$DB->data  = array("galleryID"=>$galleryID,"categoryID"=>$D);
			$DB->dbInsert();
		}
	}
}

function getGalCatName($galleryID="") {
	global $DB;
	$sql = "SELECT c.categoryTitle  FROM ".$DB->pre."gallery_category AS cc LEFT JOIN ".$DB->pre."category AS c ON c.categoryID = cc.categoryID WHERE galleryID= '$galleryID'";
	$DB->dbRows($sql);
	$arrCategory = array();
	if($DB->numRows > 0){
		foreach($DB->rows as $category){
			$arrCategory[] = $category['categoryTitle'];
		}		
	}
	return $arrCategory;
}

function getGalCatId($galID="") {
	global $DB;	
	$sql = "SELECT categoryID  FROM ".$DB->pre."gallery_category WHERE galleryID= '$galID'";	
	$DB->dbRows($sql);
	$arrCat = array();
	
	if($DB->numRows > 0){
		foreach($DB->rows as $cat){
			$arrCat[] = $cat['categoryID'];
		}		
	}
	return $arrCat;
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addGallery();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateGallery();			
		break;
	}
}
?>